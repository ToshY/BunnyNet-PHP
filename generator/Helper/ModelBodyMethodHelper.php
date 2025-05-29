<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Helper;

use cebe\openapi\exceptions\TypeErrorException;
use cebe\openapi\exceptions\UnresolvableReferenceException;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use InvalidArgumentException;
use LogicException;
use ToshY\BunnyNet\Generator\Model\AbstractParameter;
use ToshY\BunnyNet\Generator\Model\Type;
use ToshY\BunnyNet\Generator\Utils\LoggerUtils;

/**
 * @note This was almost all written with the help of AI. And while it's probably too complex, and I definitely don't
 * even understand half of the logic it made, after a lot of iterations, it gets the job done and can accurately
 * create models based on the OpenAPI specs.
 */
final class ModelBodyMethodHelper
{
    /**
     * Main public static function to generate an array of AbstractParameter objects from the root request body schema.
     *
     * @throws UnresolvableReferenceException|TypeErrorException
     * @return array<AbstractParameter>
     * @param Schema $rootSchema The root schema of the request body (expected to be an object).
     */
    public static function generateParameters(Schema $rootSchema, LoggerUtils $loggerUtils): array
    {
        $parameters = [];
        $effectiveRootSchema = ModelMethodHelper::getEffectiveSchema($rootSchema);

        if (isset($effectiveRootSchema->{'x-oneOf'}) || isset($effectiveRootSchema->{'x-anyOf'})) {
            $loggerUtils::print(
                "* WARNING: Root schema is a oneOf/anyOf construct. Attempting to combine properties from all alternatives.\n",
            );
            $alternatives = isset($effectiveRootSchema->{'x-oneOf'}) ? $effectiveRootSchema->oneOf : $effectiveRootSchema->anyOf;
            $combinedProperties = [];
            $combinedRequired = [];
            $combinedAdditionalProperties = null;

            foreach ($alternatives as $altSchemaRef) {
                $altSchema = ($altSchemaRef instanceof Reference) ? $altSchemaRef->resolve() : $altSchemaRef;
                if ($altSchema instanceof Schema) {
                    $effectiveAltSchema = ModelMethodHelper::getEffectiveSchema($altSchema);
                    if ($effectiveAltSchema->type === 'object' && (!empty($effectiveAltSchema->properties) || isset($effectiveAltSchema->additionalProperties))) {
                        // Get current combined properties or initialize
                        $currentCombinedProperties = $combinedProperties;

                        foreach ($effectiveAltSchema->properties as $propName => $propSchema) {
                            if (!isset($currentCombinedProperties[$propName])) {
                                $currentCombinedProperties[$propName] = $propSchema;
                            } else {
                                // Conflict resolution: merge existing with new
                                $currentCombinedProperties[$propName] = ModelMethodHelper::mergeSchemas(
                                    $currentCombinedProperties[$propName],
                                    $propSchema,
                                );
                            }
                        }
                        // Assign back
                        $combinedProperties = $currentCombinedProperties;

                        $currentCombinedRequired = $combinedRequired;
                        $combinedRequired = array_values(
                            array_unique(
                                array_merge($currentCombinedRequired, $effectiveAltSchema->required ?? []),
                            ),
                        );

                        // Merge additionalProperties for root-level unions
                        if (isset($effectiveAltSchema->additionalProperties)) {
                            if ($combinedAdditionalProperties === null) {
                                $combinedAdditionalProperties = $effectiveAltSchema->additionalProperties;
                            } elseif ($combinedAdditionalProperties instanceof Schema && $effectiveAltSchema->additionalProperties instanceof Schema) {
                                $combinedAdditionalProperties = ModelMethodHelper::mergeSchemas(
                                    $combinedAdditionalProperties,
                                    $effectiveAltSchema->additionalProperties,
                                );
                            }
                            // Logic for boolean additionalProperties would be here
                        }
                    }
                }
            }

            // Construct a temporary schema for the combined properties
            $tempCombinedSchema = new Schema([
                'type' => 'object',
                'properties' => $combinedProperties,
                'required' => $combinedRequired,
                'additionalProperties' => $combinedAdditionalProperties, // Add merged additionalProperties
            ]);

            // Now, process this combined schema as a regular object
            if (!empty($tempCombinedSchema->properties)) {
                foreach ($tempCombinedSchema->properties as $propName => $propertySchema) {
                    $parameters[] = ModelMethodHelper::createParameterRepresentation(
                        $propName,
                        $propertySchema,
                        $tempCombinedSchema->required ?? [],
                    );
                }
            }
            // If the combined schema also has additionalProperties, handle it as a direct child of the root
            // This is likely the source of the duplicated null object at the root for `PullZoneSettingsModel`.
            // We should only do this if the root schema itself IS a map (i.e., no 'properties' at all).
            if (isset($tempCombinedSchema->additionalProperties) && empty($tempCombinedSchema->properties)) {
                if ($tempCombinedSchema->additionalProperties instanceof Schema) {
                    $parameters[] = new AbstractParameter(
                        name: null, // Dynamic keys for a map at root level
                        type: Type::ARRAY_TYPE, // Represent the map itself as an array
                        required: false, // Not "required" as a specific named property
                        children: [
                            ModelMethodHelper::createParameterRepresentation(null, $tempCombinedSchema->additionalProperties),
                        ],
                    );
                } else { // additionalProperties is true (free-form object at root)
                    $parameters[] = new AbstractParameter(
                        name: null,
                        type: Type::OBJECT_TYPE, // Represent as a generic object (no specific children)
                        required: false,
                        children: null,
                    );
                }
            }
            return $parameters;
        }

        if ($effectiveRootSchema->type !== 'object' || (!isset($effectiveRootSchema->properties) && !isset($effectiveRootSchema->additionalProperties))) {
            if ($effectiveRootSchema->format === 'binary') {
                return [];
            } else {
                throw new InvalidArgumentException(
                    "Root schema for generateParameters must be an object with properties or additionalProperties. Got type: " . ($effectiveRootSchema->type ?? 'null'),
                );
            }
        }

        $rootRequiredList = $effectiveRootSchema->required ?? [];

        foreach ($effectiveRootSchema->properties as $propName => $propertySchema) {
            if (!$propertySchema instanceof Schema) {
                throw new LogicException("Schema for property '$propName' is not a valid Schema object.");
            }
            $parameters[] = ModelMethodHelper::createParameterRepresentation($propName, $propertySchema, $rootRequiredList);
        }

        // Also check for additionalProperties at the root level, but *only* if there are no explicit properties.
        // If there are explicit properties, additionalProperties describes the *behavior* of other properties,
        // not an additional "member" in the object structure.
        if (isset($effectiveRootSchema->additionalProperties) && empty($effectiveRootSchema->properties)) {
            if ($effectiveRootSchema->additionalProperties instanceof Schema) {
                // This means the root object can have arbitrary properties whose values conform to this schema
                $parameters[] = new AbstractParameter(
                    name: null, // Represents the dynamic keys of the root object
                    type: Type::ARRAY_TYPE, // Represent the dictionary itself as an array
                    required: false, // Not a required named property
                    children: [
                        ModelMethodHelper::createParameterRepresentation(null, $effectiveRootSchema->additionalProperties),
                    ],
                );
            } else { // additionalProperties is true
                $parameters[] = new AbstractParameter(
                    name: null,
                    type: Type::OBJECT_TYPE, // A generic free-form object
                    required: false,
                    children: null,
                );
            }
        }

        return $parameters;
    }
}
