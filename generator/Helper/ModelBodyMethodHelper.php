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
use ToshY\BunnyNet\Generator\Utils\PrinterUtils;

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
        $effectiveRootSchema = self::getEffectiveSchema($rootSchema);

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
                    $effectiveAltSchema = self::getEffectiveSchema($altSchema);
                    if ($effectiveAltSchema->type === 'object' && (!empty($effectiveAltSchema->properties) || isset($effectiveAltSchema->additionalProperties))) {
                        // Get current combined properties or initialize
                        $currentCombinedProperties = $combinedProperties;

                        foreach ($effectiveAltSchema->properties as $propName => $propSchema) {
                            if (!isset($currentCombinedProperties[$propName])) {
                                $currentCombinedProperties[$propName] = $propSchema;
                            } else {
                                // Conflict resolution: merge existing with new
                                $currentCombinedProperties[$propName] = self::mergeSchemas(
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
                                $combinedAdditionalProperties = self::mergeSchemas(
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
                    $parameters[] = self::createParameterRepresentation(
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
                        name: null, // Dynamic keys for map at root level
                        type: Type::ARRAY_TYPE, // Represent the map itself as an array
                        required: false, // Not "required" as a specific named property
                        children: [
                            self::createParameterRepresentation(null, $tempCombinedSchema->additionalProperties),
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
                throw new LogicException("Schema for property '{$propName}' is not a valid Schema object.");
            }
            $parameters[] = self::createParameterRepresentation($propName, $propertySchema, $rootRequiredList);
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
                        self::createParameterRepresentation(null, $effectiveRootSchema->additionalProperties),
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

    /**
     * Recursively converts AbstractParameter array into code string.
     *
     * @param AbstractParameter[] $params
     * @return string
     */
    public static function generateAbstractParameterArrayCode(array $params): string
    {
        $lines = [];

        foreach ($params as $param) {
            $args = [];

            if ($param->getName() !== null) {
                $args[] = "name: '" . $param->getName() . "'";
            } else {
                $args[] = "name: null";
            }

            $args[] = "type: Type::" . $param->getType()->name;

            if ($param->isRequired()) {
                $args[] = "required: true";
            }

            $children = $param->getChildren();
            if ($children !== null) {
                $childCode = self::generateAbstractParameterArrayCode($children);
                $args[] = "children: [\n" . PrinterUtils::indentCode($childCode) . "\n]";
            }

            $lines[] = 'new AbstractParameter(' . implode(', ', $args) . '),';
        }

        return implode("\n", $lines);
    }

    /**
     * Resolves a schema, particularly handling allOf to get the most direct type information.
     * After cebe/php-openapi's global resolveReferences, most $ref within allOf are resolved.
     * This public static function ensures the 'type' property is robustly determined.
     * @throws UnresolvableReferenceException
     */
    private static function getEffectiveSchema(Schema $schema): Schema
    {
        $currentSchema = $schema;
        // Handle oneOf/anyOf first, as they represent choices, not merges
        if (!empty($currentSchema->oneOf)) {
            $clonedSchema = clone $currentSchema;
            $clonedSchema->type = 'object'; // Or 'mixed' for a more generic type
            $clonedSchema->{'x-oneOf'} = true;  // @phpstan-ignore property.notFound
            return $clonedSchema;
        }

        if (!empty($currentSchema->anyOf)) {
            $clonedSchema = clone $currentSchema;
            $clonedSchema->type = 'object'; // Or 'mixed'
            $clonedSchema->{'x-anyOf'} = true;  // @phpstan-ignore property.notFound
            return $clonedSchema;
        }

        // If type is already set, it's often reliable.
        if ($currentSchema->type !== null && $currentSchema->type !== 'object') {
            // Edge case: schema declares itself as 'object' but has no properties and a single allOf
            // that points to a non-object type (e.g., a string alias).
            /* @phpstan-ignore-next-line booleanAnd.alwaysFalse */
            if ($currentSchema->type === 'object' && empty($currentSchema->properties) && !empty($currentSchema->allOf) && count(
                $currentSchema->allOf,
            ) === 1) {

                $subRefOrSchema = $currentSchema->allOf[0];
                $subSchema = ($subRefOrSchema instanceof Reference) ? $subRefOrSchema->resolve() : $subRefOrSchema;
                if ($subSchema instanceof Schema && $subSchema->type !== null && $subSchema->type !== 'object') {
                    $effectiveSub = self::getEffectiveSchema($subSchema);
                    $finalEffective = clone $effectiveSub;
                    if ($currentSchema->description && !$finalEffective->description) {
                        $finalEffective->description = $currentSchema->description;
                    }
                    return $finalEffective;
                }
            }
            // If it has a definite scalar/array type, and no complex allOf, return it.
            return $currentSchema;
        }

        // --- Handle allOf ---
        if (!empty($currentSchema->allOf)) {
            $primarySchema = clone $currentSchema; // Start with the current schema's direct properties

            // Get existing properties or initialize an empty array for the primary schema
            $primaryProperties = $primarySchema->properties ?? [];
            $primaryRequired = $primarySchema->required ?? [];
            $primaryAdditionalProperties = $primarySchema->additionalProperties ?? null;

            $hasExplicitType = ($primarySchema->type !== null);

            foreach ($currentSchema->allOf as $subRefOrSchema) {
                $subSchema = ($subRefOrSchema instanceof Reference) ? $subRefOrSchema->resolve() : $subRefOrSchema;
                if ($subSchema instanceof Schema) {
                    // Recursively get the effective schema of the sub-schema before merging
                    $effectiveSubSchema = self::getEffectiveSchema($subSchema);

                    // Merge properties
                    if (!empty($effectiveSubSchema->properties)) {
                        foreach ($effectiveSubSchema->properties as $propName => $propSchema) {
                            if (isset($primaryProperties[$propName])) {
                                // If a property exists in both, recursively merge it
                                $primaryProperties[$propName] = self::mergeSchemas(
                                    $primaryProperties[$propName],
                                    $propSchema,
                                );
                            } else {
                                $primaryProperties[$propName] = $propSchema;
                            }
                        }
                        // If properties were merged, and no explicit type was set, it's an object
                        if (!$hasExplicitType && $primarySchema->type === null) {
                            $primarySchema->type = 'object';
                        }
                    }

                    // Merge required fields
                    if (!empty($effectiveSubSchema->required)) {
                        $primaryRequired = array_values(
                            array_unique(array_merge($primaryRequired, $effectiveSubSchema->required)),
                        );
                    }

                    // Merge additionalProperties (only if not already set or if it's a schema)
                    if (isset($effectiveSubSchema->additionalProperties)) {
                        if ($primaryAdditionalProperties === null) {
                            $primaryAdditionalProperties = $effectiveSubSchema->additionalProperties;
                        } elseif ($primaryAdditionalProperties instanceof Schema && $effectiveSubSchema->additionalProperties instanceof Schema) {
                            $primaryAdditionalProperties = self::mergeSchemas(
                                $primaryAdditionalProperties,
                                $effectiveSubSchema->additionalProperties,
                            );
                        }
                        // Other cases for boolean additionalProperties would need specific logic.
                    }

                    // If a sub-schema defines a non-object type and the current schema is still object/null
                    // and has no direct properties, then the allOf might be defining the ultimate type.
                    if ($effectiveSubSchema->type !== null && $effectiveSubSchema->type !== 'object' && empty($primaryProperties)) {
                        if ($primarySchema->type === null) {
                            $primarySchema->type = $effectiveSubSchema->type;
                            $primarySchema->format = $effectiveSubSchema->format; // Also copy format
                        }
                    }
                }
            }
            // Assign the modified properties, required, and additionalProperties arrays/values back to the primary schema
            $primarySchema->properties = $primaryProperties;
            $primarySchema->required = $primaryRequired;
            $primarySchema->additionalProperties = $primaryAdditionalProperties;


            // After merging all `allOf` schemas, ensure type is 'object' if properties exist or additionalProperties is set
            if ($primarySchema->type === null && (!empty($primarySchema->properties) || isset($primarySchema->additionalProperties))) {
                $primarySchema->type = 'object';
            }
            return $primarySchema;
        }

        // If type is still null, infer from properties or items or additionalProperties.
        $clonedSchema = null;
        if (!empty($currentSchema->properties)) {
            $clonedSchema = clone $currentSchema;
            $clonedSchema->type = 'object';
        } elseif (isset($currentSchema->items)) {
            $clonedSchema = clone $currentSchema;
            $clonedSchema->type = 'array';
        } elseif (isset($currentSchema->additionalProperties)) { // Added this check
            $clonedSchema = clone $currentSchema;
            $clonedSchema->type = 'object'; // An object with additionalProperties is still an object
        }


        if ($clonedSchema) {
            // Ensure 'required' array exists if it's an object and 'required' was null
            if ($clonedSchema->type === 'object' && !isset($clonedSchema->required)) {
                $clonedSchema->required = [];
            }
            return $clonedSchema;
        }

        // If type is still null, the schema is underspecified.
        // Return original; subsequent mapping will likely fail if type is crucial.
        return $currentSchema;
    }


    /**
     * Maps OpenAPI schema type to your Type enum.
     * Adjusted to handle `x-oneOf` and `x-anyOf` markers.
     * @throws UnresolvableReferenceException
     */
    private static function mapOpenApiTypeToEnumType(Schema $schema): Type
    {
        // If it's a marked oneOf/anyOf, return MIXED_TYPE or another appropriate type
        if (isset($schema->{'x-oneOf'}) || isset($schema->{'x-anyOf'})) {
            return Type::MIXED_TYPE; // Indicates a complex type that needs special handling
        }

        $effectiveSchema = self::getEffectiveSchema($schema);
        $openApiType = $effectiveSchema->type;

        if ($openApiType === null) {
            // If still null after resolving, try to infer based on properties/items if not already done
            if (!empty($effectiveSchema->properties)) {
                return Type::OBJECT_TYPE;
            } elseif (isset($effectiveSchema->items)) {
                return Type::ARRAY_TYPE;
            }
            throw new InvalidArgumentException(
                "Cannot map OpenAPI type: Schema type is null. Schema context: " . ($effectiveSchema->title ?? substr(
                    json_encode($effectiveSchema->getSerializableData()),
                    0,
                    100,
                )),
            );
        }

        return match ($openApiType) {
            'string' => Type::STRING_TYPE,
            'integer' => Type::INT_TYPE,
            'number' => Type::NUMERIC_TYPE,
            'boolean' => Type::BOOLEAN_TYPE,
            'array' => Type::ARRAY_TYPE,
            'object' => Type::OBJECT_TYPE,
            default => throw new InvalidArgumentException("Unknown or unmappable OpenAPI type: '{$openApiType}'."),
        };
    }

    /**
     * Recursively creates an AbstractParameter representation from an OpenAPI Schema.
     *
     * @throws UnresolvableReferenceException
     * @param Schema $schema The OpenAPI schema for this parameter.
     * @param array<mixed> $parentRequiredList Array of required property names from the parent object's schema.
     * @return AbstractParameter
     * @param string|null $name The name of the parameter (property name, or null for array items).
     */
    private static function createParameterRepresentation(
        ?string $name,
        Schema $schema,
        array $parentRequiredList = [],
    ): AbstractParameter {
        $effectiveSchema = self::getEffectiveSchema($schema);
        $children = null;
        $paramType = null;

        $isCurrentParamRequired = ($name !== null) && in_array($name, $parentRequiredList, true);

        // Handle oneOf/anyOf by creating children for each alternative.
        // The main parameter will have a 'MIXED' type.
        if (isset($effectiveSchema->{'x-oneOf'}) || isset($effectiveSchema->{'x-anyOf'})) {
            $paramType = Type::MIXED_TYPE;
            $alternatives = isset($effectiveSchema->{'x-oneOf'}) ? $effectiveSchema->oneOf : $effectiveSchema->anyOf;
            $children = [];
            foreach ($alternatives as $altSchemaRef) {
                $altSchema = ($altSchemaRef instanceof Reference) ? $altSchemaRef->resolve() : $altSchemaRef;
                if ($altSchema instanceof Schema) {
                    $effectiveAltSchema = self::getEffectiveSchema($altSchema);
                    // If it's an object with direct properties or additionalProperties, we'll try to represent its structure
                    if ($effectiveAltSchema->type === 'object' && (!empty($effectiveAltSchema->properties) || isset($effectiveAltSchema->additionalProperties))) {
                        $childrenOfMixed = [];
                        if (!empty($effectiveAltSchema->properties)) {
                            $objRequiredList = $effectiveAltSchema->required ?? [];
                            foreach ($effectiveAltSchema->properties as $propName => $propertySchema) {
                                $childrenOfMixed[] = self::createParameterRepresentation(
                                    $propName,
                                    $propertySchema,
                                    $objRequiredList,
                                );
                            }
                        }
                        // This section was problematic for nested 'Properties' in OptimizerClasses
                        if (isset($effectiveAltSchema->additionalProperties)) {
                            // If it's a map (object without explicit 'properties' but with 'additionalProperties')
                            if (empty($effectiveAltSchema->properties)) {
                                if ($effectiveAltSchema->additionalProperties instanceof Schema) {
                                    $childrenOfMixed[] = new AbstractParameter(
                                        name: null,
                                        type: self::mapOpenApiTypeToEnumType($effectiveAltSchema->additionalProperties),
                                        required: false,
                                        children: self::createParameterRepresentation(
                                            null,
                                            $effectiveAltSchema->additionalProperties,
                                        )->getChildren(),
                                    );
                                } else { // additionalProperties is true (free-form object values)
                                    $childrenOfMixed[] = new AbstractParameter(
                                        name: null,
                                        type: Type::MIXED_TYPE,
                                        required: false,
                                        children: null,
                                    );
                                }
                            }
                        }
                        if (!empty($childrenOfMixed)) {
                            $children = array_merge($children, $childrenOfMixed); // Merge children from alternatives
                        }
                    }
                }
            }
            $children = array_values(array_unique($children, SORT_REGULAR)); // Remove duplicates for combined children
            if (empty($children)) { // If after trying to parse alternatives, we still have no children
                return new AbstractParameter(
                    name: $name,
                    type: Type::MIXED_TYPE,
                    required: $isCurrentParamRequired,
                    children: null,
                );
            }
            // If we found children, we can still return as mixed, but with those children to describe possible structures.
            // Or we could return as object if all alternatives were objects. For now, keep as MIXED_TYPE.
        }


        if ($effectiveSchema->type === 'array') {
            $paramType = Type::ARRAY_TYPE;
            if (isset($effectiveSchema->items)) {
                $itemsSchema = $effectiveSchema->items;
                if ($itemsSchema instanceof Schema) {
                    $effectiveItemsSchema = self::getEffectiveSchema($itemsSchema);

                    $children = [];
                    // Array of objects (with explicit properties or additionalProperties)
                    if ($effectiveItemsSchema->type === 'object') {
                        // This is where the core issue for nested 'Properties' lay.
                        // If the object primarily defines `additionalProperties` and has no fixed `properties`,
                        // it should be treated as a map, and its "children" should represent the *values* of that map.
                        // We only add children for explicit properties or if it's a true map.

                        if (!empty($effectiveItemsSchema->properties)) {
                            // Case 1: Array of objects with *named* properties
                            $itemRequiredList = $effectiveItemsSchema->required ?? [];
                            foreach ($effectiveItemsSchema->properties as $propName => $propertySchema) {
                                $children[] = self::createParameterRepresentation(
                                    $propName,
                                    $propertySchema,
                                    $itemRequiredList,
                                );
                            }
                        }

                        if (isset($effectiveItemsSchema->additionalProperties)) {
                            // Case 2: Array of objects that are *maps* (defined by additionalProperties)
                            // This applies to OptimizerClasses.Properties and BunnyAiImageBlueprints.Properties
                            // Here, the 'children' of the OBJECT_TYPE parameter should be the type of the map's *values*.
                            if (empty($effectiveItemsSchema->properties)) { // If it's purely a map, no fixed properties
                                if ($effectiveItemsSchema->additionalProperties instanceof Schema) {
                                    // Recursively call createParameterRepresentation for the value type
                                    $childrenForMapValue = self::createParameterRepresentation(
                                        null,
                                        $effectiveItemsSchema->additionalProperties,
                                    )->getChildren();
                                    $children[] = new AbstractParameter(
                                        name: null, // This represents the value of the dynamic key in the map
                                        type: self::mapOpenApiTypeToEnumType(
                                            $effectiveItemsSchema->additionalProperties,
                                        ),
                                        required: false,
                                        children: $childrenForMapValue, // Pass its children if it's a complex value
                                    );
                                } else { // additionalProperties is true (array of free-form objects)
                                    $children[] = new AbstractParameter(
                                        name: null,
                                        type: Type::MIXED_TYPE, // array of generic mixed values
                                        required: false,
                                        children: null,
                                    );
                                }
                            } else {
                                // Case 3: Object with *both* named properties and additionalProperties
                                // This scenario typically means the object has some fixed keys and can have arbitrary others.
                                // For simplicity and to avoid the extra null object, we assume the named properties sufficiently describe it.
                                // If you need to represent the "arbitrary" part, you'd need a different strategy (e.g., a flag).
                            }
                        }

                        // Handle empty object schemas (e.g., {} as an item)
                        if (empty($children) && empty($effectiveItemsSchema->properties) && !isset($effectiveItemsSchema->additionalProperties)) {
                            // This is an object with no further specified properties (empty object schema)
                            $children[] = new AbstractParameter(name: null, type: Type::OBJECT_TYPE, required: false);
                        }
                    } elseif (isset($effectiveItemsSchema->{'x-oneOf'}) || isset($effectiveItemsSchema->{'x-anyOf'})) {
                        // Array of oneOf/anyOf types. Create a single child representing the complex item type.
                        $children[] = new AbstractParameter(
                            name: null,
                            type: Type::MIXED_TYPE,
                            required: false,
                            children: null,
                        );
                    } else {
                        // Array of simple types (string, int, etc.) or nested arrays
                        $children[] = self::createParameterRepresentation(null, $effectiveItemsSchema, []);
                    }
                }
            }
        } elseif ($effectiveSchema->type === 'object') {
            $paramType = Type::ARRAY_TYPE;
            $children = [];

            if (!empty($effectiveSchema->properties)) {
                $objectRequiredList = $effectiveSchema->required ?? [];
                foreach ($effectiveSchema->properties as $propName => $propertySchema) {
                    if (!$propertySchema instanceof Schema) {
                        throw new LogicException("Schema for property '{$propName}' is not a valid Schema object.");
                    }
                    $children[] = self::createParameterRepresentation($propName, $propertySchema, $objectRequiredList);
                }
            }

            // Handle additionalProperties for objects themselves
            // Only add if there are no explicit properties (i.e., it's a map).
            if (isset($effectiveSchema->additionalProperties) && empty($effectiveSchema->properties)) {
                if ($effectiveSchema->additionalProperties instanceof Schema) {
                    $subMappedType = self::mapOpenApiTypeToEnumType($effectiveSchema->additionalProperties);
                    /* @phpstan-ignore-next-line identical.alwaysTrue */
                    if ($subMappedType !== Type::OBJECT_TYPE && $effectiveSchema->type === 'object') {
                        $subMappedType = Type::ARRAY_TYPE;
                    }

                    $children[] = new AbstractParameter(
                        name: null, // The key name is dynamic, so we give null
                        type: $subMappedType,
                        required: false,
                        children: self::createParameterRepresentation(
                            null,
                            $effectiveSchema->additionalProperties,
                        )->getChildren(),
                    );
                } else { // additionalProperties is true (free-form object)
                    if (isset($effectiveSchema->{'x-oneOf'}) || isset($effectiveSchema->{'x-anyOf'})) {
                        $paramType = Type::ARRAY_TYPE;
                        $alternatives = isset($effectiveSchema->{'x-oneOf'}) ? $effectiveSchema->oneOf : $effectiveSchema->anyOf;
                        $children = [];
                        foreach ($alternatives as $altSchemaRef) {
                            $altSchema = ($altSchemaRef instanceof Reference) ? $altSchemaRef->resolve(
                            ) : $altSchemaRef;
                            if ($altSchema instanceof Schema) {
                                $effectiveAltSchema = self::getEffectiveSchema($altSchema);
                                // If it's an object with direct properties or additionalProperties, we'll try to represent its structure
                                if ($effectiveAltSchema->type === 'object' && (!empty($effectiveAltSchema->properties) || isset($effectiveAltSchema->additionalProperties))) {
                                    $childrenOfMixed = [];
                                    if (!empty($effectiveAltSchema->properties)) {
                                        $objRequiredList = $effectiveAltSchema->required ?? [];
                                        foreach ($effectiveAltSchema->properties as $propName => $propertySchema) {
                                            $childrenOfMixed[] = self::createParameterRepresentation(
                                                $propName,
                                                $propertySchema,
                                                $objRequiredList,
                                            );
                                        }
                                    }
                                    // This section was problematic for nested 'Properties' in OptimizerClasses
                                    if (isset($effectiveAltSchema->additionalProperties)) {
                                        // If it's a map (object without explicit 'properties' but with 'additionalProperties')
                                        if (empty($effectiveAltSchema->properties)) {
                                            if ($effectiveAltSchema->additionalProperties instanceof Schema) {
                                                $childrenOfMixed[] = new AbstractParameter(
                                                    name: null,
                                                    type: self::mapOpenApiTypeToEnumType(
                                                        $effectiveAltSchema->additionalProperties,
                                                    ),
                                                    required: false,
                                                    children: self::createParameterRepresentation(
                                                        null,
                                                        $effectiveAltSchema->additionalProperties,
                                                    )->getChildren(),
                                                );
                                            } else { // additionalProperties is true (free-form object values)
                                                $childrenOfMixed[] = new AbstractParameter(
                                                    name: null,
                                                    type: Type::MIXED_TYPE,
                                                    required: false,
                                                    children: null,
                                                );
                                            }
                                        }
                                    }
                                    if (!empty($childrenOfMixed)) {
                                        $children = array_merge(
                                            $children,
                                            $childrenOfMixed,
                                        ); // Merge children from alternatives
                                    }
                                }
                            }
                        }
                        $children = array_values(
                            array_unique($children, SORT_REGULAR),
                        ); // Remove duplicates for combined children
                        if (empty($children)) { // If after trying to parse alternatives, we still have no children
                            return new AbstractParameter(
                                name: $name,
                                type: Type::MIXED_TYPE,
                                required: $isCurrentParamRequired,
                                children: null,
                            );
                        }
                        // If we found children, we can still return as mixed, but with those children to describe possible structures.
                        // Or we could return as object if all alternatives were objects. For now, keep as MIXED_TYPE.
                    }
                }
            }
            // If an object has no properties and no additionalProperties, it's an empty object.
            // Children remain null/empty.
        } else {
            // Scalar types (string, integer, boolean, number)
            $paramType = self::mapOpenApiTypeToEnumType($effectiveSchema);
            // No children for scalar types.
        }

        return new AbstractParameter(
            name: $name,
            type: $paramType,
            required: $isCurrentParamRequired,
            children: $children,
        );
    }

    private static function mergeSchemas(Schema $targetSchema, Schema $sourceSchema): Schema
    {
        // Clone target to avoid modifying original shared objects
        $mergedSchema = clone $targetSchema;

        // Merge type if not set in target but set in source
        if ($mergedSchema->type === null && $sourceSchema->type !== null) {
            $mergedSchema->type = $sourceSchema->type;
        } elseif ($mergedSchema->type !== null && $sourceSchema->type !== null && $mergedSchema->type !== $sourceSchema->type) {
            // Handle type conflicts if necessary. For now, we'll let the initial type dominate
            // or set to 'mixed' if a clear single type can't be established.
            if (!($mergedSchema->type === 'object' || $sourceSchema->type === 'object')) {
                // If conflicting non-object types, this is a more complex scenario
                // For now, keep target type, or consider it an error.
            }
        }

        // Merge description
        if ($sourceSchema->description !== null && $mergedSchema->description === null) {
            $mergedSchema->description = $sourceSchema->description;
        }

        // Merge properties
        if (!empty($sourceSchema->properties)) {
            // Get existing properties or initialize an empty array
            $currentProperties = $mergedSchema->properties ?? [];

            foreach ($sourceSchema->properties as $propName => $propSchema) {
                if (isset($currentProperties[$propName])) {
                    // Recursively merge property schemas if they exist in both
                    $currentProperties[$propName] = self::mergeSchemas($currentProperties[$propName], $propSchema);
                } else {
                    $currentProperties[$propName] = $propSchema;
                }
            }
            // Assign the modified properties array back
            $mergedSchema->properties = $currentProperties;

            // Ensure type is object if properties exist
            if ($mergedSchema->type === null) {
                $mergedSchema->type = 'object';
            }
        }

        // Merge required fields
        if (!empty($sourceSchema->required)) {
            // Get existing required fields or initialize an empty array
            $currentRequired = $mergedSchema->required ?? [];
            $mergedSchema->required = array_values(
                array_unique(array_merge($currentRequired, $sourceSchema->required)),
            );
        }

        // Merge items for arrays
        if ($sourceSchema->type === 'array' && $sourceSchema->items instanceof Schema) {
            if (!isset($mergedSchema->items)) {
                $mergedSchema->items = $sourceSchema->items;
            } elseif ($mergedSchema->items instanceof Schema) {
                $mergedSchema->items = self::mergeSchemas($mergedSchema->items, $sourceSchema->items);
            }
        }

        // Merge additionalProperties
        if (isset($sourceSchema->additionalProperties)) {
            if (!isset($mergedSchema->additionalProperties)) {
                $mergedSchema->additionalProperties = $sourceSchema->additionalProperties;
            } elseif ($mergedSchema->additionalProperties instanceof Schema && $sourceSchema->additionalProperties instanceof Schema) {
                $mergedSchema->additionalProperties = self::mergeSchemas(
                    $mergedSchema->additionalProperties,
                    $sourceSchema->additionalProperties,
                );
            }
            // Handle cases where additionalProperties is boolean (true/false)
            // For simplicity, if one is true, and other is schema, keep schema.
            // If one is false, and other is schema, keep false.
        }


        // Other properties like format, default, enum, etc., can be merged similarly
        foreach (['format', 'default', 'enum', 'nullable'] as $attr) {
            if (isset($sourceSchema->$attr) && !isset($mergedSchema->$attr)) {
                $mergedSchema->$attr = $sourceSchema->$attr;
            }
        }

        return $mergedSchema;
    }
}
