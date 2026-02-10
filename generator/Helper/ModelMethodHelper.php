<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Helper;

use cebe\openapi\exceptions\UnresolvableReferenceException;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use InvalidArgumentException;
use LogicException;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Generator\Utils\PrinterUtils;

final class ModelMethodHelper
{
    /** @var array<string,bool> $processingStack */
    private static array $processingStack = [];

    /**
     * Recursively creates an AbstractParameter representation from an OpenAPI Schema.
     *
     * @throws UnresolvableReferenceException
     * @param Schema $schema The OpenAPI schema for this parameter.
     * @param array<mixed> $parentRequiredList Array of required property names from the parent object's schema.
     * @return AbstractParameter
     * @param string|null $name The name of the parameter (property name, or null for array items).
     */
    public static function createParameterRepresentation(
        ?string $name,
        Schema $schema,
        array $parentRequiredList = [],
    ): AbstractParameter {
        $schemaHash = spl_object_hash($schema);

        // Check if we're already processing this schema (circular reference detected)
        if (isset(self::$processingStack[$schemaHash]) === true) {
            // Break the circular reference by returning a simple object parameter
            return new AbstractParameter(
                name: $name,
                type: Type::OBJECT_TYPE,
                required: ($name !== null) && in_array($name, $parentRequiredList, true),
                children: null,
            );
        }

        // Mark this schema as being processed
        self::$processingStack[$schemaHash] = true;

        $effectiveSchema = self::getEffectiveSchema($schema);
        $children = null;
        $paramType = self::mapOpenApiTypeToEnumType($effectiveSchema);

        $isCurrentParamRequired = ($name !== null) && in_array($name, $parentRequiredList, true);

        // Handle oneOf/anyOf
        if (isset($effectiveSchema->{'x-oneOf'}) || isset($effectiveSchema->{'x-anyOf'})) {
            $alternatives = isset($effectiveSchema->{'x-oneOf'}) ? $effectiveSchema->oneOf : $effectiveSchema->anyOf;
            $children = [];

            // Case 1: Single alternative and it's an object (or resolves to an object)
            if (count($alternatives) === 1) {
                $singleAltSchema = ($alternatives[0] instanceof Reference) ? $alternatives[0]->resolve() : $alternatives[0];
                if ($singleAltSchema instanceof Schema) {
                    $effectiveSingleAltSchema = self::getEffectiveSchema($singleAltSchema);
                    if ($effectiveSingleAltSchema->type === 'object') {
                        $paramType = Type::OBJECT_TYPE; // The parameter is an object
                        $objRequiredList = $effectiveSingleAltSchema->required ?? [];

                        // Directly populate children from the properties of this single object alternative
                        foreach ($effectiveSingleAltSchema->properties as $propName => $propertySchema) {
                            $children[] = self::createParameterRepresentation(
                                $propName,
                                $propertySchema,
                                $objRequiredList,
                            );
                        }
                        // Handle additionalProperties for this single object alternative if it's a map (no explicit properties)
                        if (isset($effectiveSingleAltSchema->additionalProperties) && empty($effectiveSingleAltSchema->properties) && $effectiveSingleAltSchema->additionalProperties !== false) {
                            if ($effectiveSingleAltSchema->additionalProperties instanceof Schema) {
                                $children[] = new AbstractParameter(
                                    name: null,
                                    type: self::mapOpenApiTypeToEnumType($effectiveSingleAltSchema->additionalProperties),
                                    required: false,
                                    children: self::createParameterRepresentation(
                                        null,
                                        $effectiveSingleAltSchema->additionalProperties,
                                    )->getChildren(),
                                );
                            } else {
                                // This case means additionalProperties is `true`, resulting in a free-form map.
                                // If MIXED_TYPE is removed, this might default to OBJECT_TYPE for the value,
                                // or it might need to throw an error depending on strictness.
                                $children[] = new AbstractParameter(
                                    name: null,
                                    type: Type::OBJECT_TYPE, // Default to object type for free-form map values
                                    required: false,
                                    children: null,
                                );
                            }
                        }
                    } else {
                        // Single alternative but not an object (e.g., scalar or array), map to its actual type
                        $paramType = self::mapOpenApiTypeToEnumType($effectiveSingleAltSchema);
                        $singleAlternativeRepresentation = self::createParameterRepresentation(null, $effectiveSingleAltSchema);
                        if ($singleAlternativeRepresentation->getChildren() !== null) {
                            $children = $singleAlternativeRepresentation->getChildren();
                        } else {
                            $children = null; // Ensure children is null if the representation has no children
                        }
                    }
                }
            } else { // Case 2: Multiple alternatives in oneOf/anyOf.
                // The mapOpenApiTypeToEnumType function will now throw an exception if it encounters
                // a truly mixed type that doesn't resolve to an object.
                // We'll let mapOpenApiTypeToEnumType determine the type and potential error for the parent parameter.
                $paramType = self::mapOpenApiTypeToEnumType($effectiveSchema);

                // Collect children from all alternatives if it's a structure that can be merged,
                // or if it's a collection of disparate types (which should now error out via mapOpenApiTypeToEnumType).
                foreach ($alternatives as $altSchemaRef) {
                    $altSchema = ($altSchemaRef instanceof Reference) ? $altSchemaRef->resolve() : $altSchemaRef;
                    if ($altSchema instanceof Schema) {
                        $effectiveAltSchema = self::getEffectiveSchema($altSchema);
                        if ($effectiveAltSchema->type === 'object' || (!empty($effectiveAltSchema->properties) || (isset($effectiveAltSchema->additionalProperties) && $effectiveAltSchema->additionalProperties !== false))) {
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
                            if (isset($effectiveAltSchema->additionalProperties) && empty($effectiveAltSchema->properties) && $effectiveAltSchema->additionalProperties !== false) {
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
                                } else {
                                    $childrenOfMixed[] = new AbstractParameter(
                                        name: null,
                                        type: Type::OBJECT_TYPE, // Default to object type for free-form map values
                                        required: false,
                                        children: null,
                                    );
                                }
                            }
                            if (!empty($childrenOfMixed)) {
                                $children = array_merge($children, $childrenOfMixed); // Merge children from alternatives
                            }
                        } else {
                            // If an alternative is a scalar or simple array, this might lead to an error
                            // from mapOpenApiTypeToEnumType when we assign paramType above.
                            // If it reaches here, it means the overall type is already determined or error-ed out.
                            // For now, we still need to process its children if it has any, but the type itself
                            // should have been caught by the parent `mapOpenApiTypeToEnumType` call.
                            $tempRepresentation = self::createParameterRepresentation(null, $effectiveAltSchema);
                            if ($tempRepresentation->getChildren() !== null) {
                                $children = array_merge($children, $tempRepresentation->getChildren());
                            }
                        }
                    }
                }
                $children = array_values(array_unique($children, SORT_REGULAR)); // Remove duplicates
            }
        }


        if ($effectiveSchema->type === 'array') {
            $paramType = Type::ARRAY_TYPE;
            if (isset($effectiveSchema->items)) {
                $itemsSchema = $effectiveSchema->items;
                if ($itemsSchema instanceof Schema) {
                    $effectiveItemsSchema = self::getEffectiveSchema($itemsSchema);

                    // Array of objects (items are objects)
                    if ($effectiveItemsSchema->type === 'object' || !empty($effectiveItemsSchema->properties)) {
                        $itemObjectChildren = [];
                        $itemRequiredList = $effectiveItemsSchema->required ?? [];

                        // Populate children for explicit properties of the inner object
                        if (!empty($effectiveItemsSchema->properties)) {
                            foreach ($effectiveItemsSchema->properties as $propName => $propertySchema) {
                                $itemObjectChildren[] = self::createParameterRepresentation(
                                    (string)$propName,
                                    $propertySchema,
                                    $itemRequiredList,
                                );
                            }
                        }

                        // Handle additionalProperties for the item object (if it's a map)
                        if (isset($effectiveItemsSchema->additionalProperties) && empty($effectiveItemsSchema->properties) && $effectiveItemsSchema->additionalProperties !== false) {
                            if ($effectiveItemsSchema->additionalProperties instanceof Schema) {
                                $itemObjectChildren[] = new AbstractParameter(
                                    name: null, // Represents the value type of the map
                                    type: self::mapOpenApiTypeToEnumType($effectiveItemsSchema->additionalProperties),
                                    required: false,
                                    children: self::createParameterRepresentation(
                                        null,
                                        $effectiveItemsSchema->additionalProperties,
                                    )->getChildren(),
                                );
                            } else {
                                $itemObjectChildren[] = new AbstractParameter(
                                    name: null,
                                    type: Type::OBJECT_TYPE, // Default to object type for free-form map values
                                    required: false,
                                    children: null,
                                );
                            }
                        }

                        // For the item object itself (e.g., each "Trigger" in the "Triggers" array)
                        $children = [
                            new AbstractParameter(
                                name: null,
                                type: Type::OBJECT_TYPE,
                                required: false,
                                children: $itemObjectChildren,
                            ),
                        ];
                    } elseif (isset($effectiveItemsSchema->{'x-oneOf'}) || isset($effectiveItemsSchema->{'x-anyOf'})) {
                        // Array of oneOf/anyOf types. Create a single child representing the complex item type.
                        // mapOpenApiTypeToEnumType will throw if it's a truly mixed type
                        $children[] = new AbstractParameter(
                            name: null,
                            type: self::mapOpenApiTypeToEnumType($effectiveItemsSchema), // Map to its actual type
                            required: false,
                            children: self::createParameterRepresentation(null, $effectiveItemsSchema)->getChildren(),
                        );
                    } else {
                        // Array of simple types (string, int, etc.) or nested arrays
                        $children[] = self::createParameterRepresentation(null, $effectiveItemsSchema);
                    }
                }
            }
        } elseif ($effectiveSchema->type === 'object') {
            $paramType = Type::OBJECT_TYPE; // Default to OBJECT_TYPE for objects
            $children = [];

            if (!empty($effectiveSchema->properties)) {
                $objectRequiredList = $effectiveSchema->required ?? [];
                foreach ($effectiveSchema->properties as $propName => $propertySchema) {
                    if (!$propertySchema instanceof Schema) {
                        throw new LogicException("Schema for property '$propName' is not a valid Schema object.");
                    }
                    $children[] = self::createParameterRepresentation($propName, $propertySchema, $objectRequiredList);
                }
            }

            // Handle additionalProperties for objects that are effectively maps (no explicit properties)
            if (isset($effectiveSchema->additionalProperties) && empty($effectiveSchema->properties) && $effectiveSchema->additionalProperties !== false) {
                $paramType = Type::OBJECT_TYPE; // Use OBJECT_TYPE for the map itself
                if ($effectiveSchema->additionalProperties instanceof Schema) {
                    // Object with arbitrary keys whose values conform to a specific schema
                    $children[] = new AbstractParameter(
                        name: null, // Represents the value type of the map
                        type: self::mapOpenApiTypeToEnumType($effectiveSchema->additionalProperties),
                        required: false, // Not a required named property
                        children: self::createParameterRepresentation(
                            null,
                            $effectiveSchema->additionalProperties,
                        )->getChildren(),
                    );
                } else { // additionalProperties is true (free-form object values)
                    $children[] = new AbstractParameter(
                        name: null,
                        type: Type::OBJECT_TYPE, // A generic free-form object
                        required: false,
                        children: null,
                    );
                }
            }
        }

        $result = new AbstractParameter(
            name: $name,
            type: $paramType,
            required: $isCurrentParamRequired,
            children: $children,
        );

        // Unmark after processing complete
        unset(self::$processingStack[$schemaHash]);

        return $result;
    }

    /**
     * Resolves a schema, particularly handling allOf to get the most direct type information.
     * After cebe/php-openapi's global resolveReferences, most $ref within allOf are resolved.
     * This public static function ensures the 'type' property is robustly determined.
     * @throws UnresolvableReferenceException
     */
    public static function getEffectiveSchema(Schema $schema): Schema
    {
        $currentSchema = $schema;
        $clonedSchema = clone $currentSchema; // Always start with a clone to avoid modifying original

        // Handle oneOf/anyOf
        if (empty($currentSchema->oneOf) === false) {
            /* @phpstan-ignore-next-line property.notFound */
            $clonedSchema->{'x-oneOf'} = true;
            if (count($currentSchema->oneOf) === 1) {
                $singleAltSchema = ($currentSchema->oneOf[0] instanceof Reference) ? $currentSchema->oneOf[0]->resolve() : $currentSchema->oneOf[0];
                if ($singleAltSchema instanceof Schema) {
                    $effectiveSingleAltSchema = self::getEffectiveSchema($singleAltSchema);
                    if ($effectiveSingleAltSchema->type === 'object') {
                        // If oneOf resolves to a single object, merge its properties
                        $clonedSchema->properties = self::mergeProperties(
                            $clonedSchema->properties ?? [],
                            $effectiveSingleAltSchema->properties ?? [],
                        );
                        $clonedSchema->required = array_values(array_unique(array_merge(
                            $clonedSchema->required ?? [],
                            $effectiveSingleAltSchema->required ?? [],
                        )));
                        $clonedSchema->type = 'object'; // Ensure type is object
                    } else {
                        // If oneOf resolves to a single non-object type (string, integer, etc.), use that type
                        if ($effectiveSingleAltSchema->type !== null) {
                            $clonedSchema->type = $effectiveSingleAltSchema->type;
                            $clonedSchema->format = $effectiveSingleAltSchema->format;
                            $clonedSchema->enum = $effectiveSingleAltSchema->enum;
                        }
                    }
                }
            }
            return $clonedSchema;
        }

        if (empty($currentSchema->anyOf) === false) {
            /* @phpstan-ignore-next-line property.notFound */
            $clonedSchema->{'x-anyOf'} = true;
            if (count($currentSchema->anyOf) === 1) {
                $singleAltSchema = ($currentSchema->anyOf[0] instanceof Reference) ? $currentSchema->anyOf[0]->resolve() : $currentSchema->anyOf[0];
                if ($singleAltSchema instanceof Schema) {
                    $effectiveSingleAltSchema = self::getEffectiveSchema($singleAltSchema);
                    if ($effectiveSingleAltSchema->type === 'object') {
                        // If anyOf resolves to a single object, merge its properties
                        $clonedSchema->properties = self::mergeProperties(
                            $clonedSchema->properties ?? [],
                            $effectiveSingleAltSchema->properties ?? [],
                        );
                        $clonedSchema->required = array_values(array_unique(array_merge(
                            $clonedSchema->required ?? [],
                            $effectiveSingleAltSchema->required ?? [],
                        )));
                        $clonedSchema->type = 'object'; // Ensure type is object
                    } else {
                        // If oneOf resolves to a single non-object type (string, integer, etc.), use that type
                        if ($effectiveSingleAltSchema->type !== null) {
                            $clonedSchema->type = $effectiveSingleAltSchema->type;
                            $clonedSchema->format = $effectiveSingleAltSchema->format;
                            $clonedSchema->enum = $effectiveSingleAltSchema->enum;
                        }
                    }
                }
            }
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
        }
        // Only infer 'object' from additionalProperties if type is null AND no properties/items
        elseif ($currentSchema->type === null && empty($currentSchema->properties) && !isset($currentSchema->items) && isset($currentSchema->additionalProperties)) {
            $clonedSchema = clone $currentSchema;
            $clonedSchema->type = 'object';
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

    public static function mergeSchemas(Schema $targetSchema, Schema $sourceSchema): Schema
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

    /**
     * Helper to merge properties arrays.
     *
     * @param array<string, Schema> $targetProperties
     * @param array<string, Schema> $sourceProperties
     * @return array<string, Schema>
     */
    private static function mergeProperties(array $targetProperties, array $sourceProperties): array
    {
        $mergedProperties = $targetProperties;
        foreach ($sourceProperties as $propName => $propSchema) {
            if (isset($mergedProperties[$propName]) && $propSchema instanceof Schema) {
                $mergedProperties[$propName] = self::mergeSchemas($mergedProperties[$propName], $propSchema);
            } else {
                $mergedProperties[$propName] = $propSchema;
            }
        }
        return $mergedProperties;
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
     * Maps OpenAPI schema type to your Type enum.
     * Adjusted to handle `x-oneOf` and `x-anyOf` markers by throwing an exception if genuinely mixed.
     * @throws UnresolvableReferenceException|InvalidArgumentException
     */
    private static function mapOpenApiTypeToEnumType(Schema $schema): Type
    {
        $effectiveSchema = self::getEffectiveSchema($schema);

        // If it's explicitly an object or has properties, it's an object type
        if ($effectiveSchema->type === 'object' || !empty($effectiveSchema->properties)) {
            return Type::OBJECT_TYPE;
        }

        $openApiType = $effectiveSchema->type;

        // If it still has oneOf/anyOf markers at this point, it means it's not a clear object type,
        // and thus, it's a truly mixed type that we now want to error on.
        if ((isset($effectiveSchema->{'x-oneOf'}) || isset($effectiveSchema->{'x-anyOf'})) && $openApiType === null) {
            throw new InvalidArgumentException(
                "Unsupported: Schema defines a genuinely mixed type (oneOf/anyOf) that does not resolve to a concrete object or scalar. Schema title: " . ($effectiveSchema->title ?? 'N/A') . ". Full schema: " . substr(json_encode($effectiveSchema->getSerializableData()), 0, 200) . "...",
            );
        }

        if ($openApiType === null) {
            if (isset($effectiveSchema->items)) {
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
            default => throw new InvalidArgumentException("Unknown or unmappable OpenAPI type: '$openApiType'."),
        };
    }
}
