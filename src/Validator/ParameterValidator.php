<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validator;

use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\InvalidTypeForKeyValueException;
use ToshY\BunnyNet\Exception\InvalidTypeForListValueException;
use ToshY\BunnyNet\Exception\ParameterIsRequiredException;
use ToshY\BunnyNet\Exception\UnexpectedParameterForObjectException;
use ToshY\BunnyNet\Model\AbstractParameter;

class ParameterValidator
{
    /**
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws ParameterIsRequiredException
     * @throws UnexpectedParameterForObjectException
     * @return void
     * @param array<string,mixed> $values
     * @param array<AbstractParameter> $template
     * @param string|null $parentKey
     */
    public static function validate(
        array $values,
        array $template,
        ?string $parentKey = null,
    ): void {
        // Determine if the current template expects named properties or is a list/map of unnamed items.
        $currentTemplateHasNamedChildren = false;
        foreach ($template as $abstractParameterObject) {
            if ($abstractParameterObject->getName() !== null) {
                $currentTemplateHasNamedChildren = true;
                break;
            }
        }

        // Only check for unexpected keys if:
        // 1. The current $values is an associative array (representing an object).
        // 2. The current $template explicitly defines named children (i.e., it's not a map-like object with dynamic keys, nor a list of unnamed items).
        // If it's a map-like object (single unnamed child, type OBJECT_TYPE), or an array of unnamed items, we don't check for unexpected keys.
        if (array_is_list($values) === false && $currentTemplateHasNamedChildren === true) {
            $expectedParameterNames = [];
            foreach ($template as $abstractParameterObject) {
                if ($abstractParameterObject->getName() !== null) {
                    $expectedParameterNames[] = $abstractParameterObject->getName();
                }
            }

            foreach (array_keys($values) as $actualKey) {
                if (in_array($actualKey, $expectedParameterNames, true) === true) {
                    continue;
                }

                throw UnexpectedParameterForObjectException::withKeyAndContext(
                    key: $actualKey,
                    context: $parentKey ? 'nested object "' . $parentKey . '"' : 'root object',
                    expectedKeys: $expectedParameterNames,
                );
            }
        }

        foreach ($template as $abstractParameterObject) {
            $abstractParameterObjectName = $abstractParameterObject->getName();
            $abstractParameterObjectType = $abstractParameterObject->getType();
            $abstractParameterObjectChildren = $abstractParameterObject->getChildren();

            if ($abstractParameterObjectName === null) {
                // This branch handles:
                // 1. Array items where the item itself doesn't have a name (e.g., `['item1', 'item2']` or `[{'prop': 'val'}]`).
                // 2. The values of a map-like object (e.g., `{'key1': 'value1', 'key2': 'value2'}` where `key1` and `key2` are dynamic).
                foreach ($values as $value) { // Iterate over both keys (numeric for lists, string for maps) and values
                    self::checkTypeForListValue(
                        value: $value,
                        parameterType: $abstractParameterObjectType,
                        parentKey: $parentKey,
                    );

                    if ($abstractParameterObjectChildren === null) {
                        continue;
                    }

                    // If the unnamed child itself has children (e.g., an array of objects, or a map of objects), validate them recursively
                    if (is_array($value) === false) {
                        throw InvalidTypeForListValueException::withParentKeyValueType(
                            parentKey: $parentKey,
                            expectedValueType: Type::OBJECT_TYPE,
                            actualValue: $value,
                        );
                    }

                    self::validate(
                        $value,
                        $abstractParameterObjectChildren,
                        $parentKey,
                    );
                }

                continue;
            }

            // This block handles cases where the current 'values' is a list (numeric keys)
            // but the current template parameter has a name (e.g., validating an object within a list of objects)
            // This is for scenarios like: `Parameter3` (ARRAY_TYPE) containing `NestedParameter1` (INT_TYPE)
            // where `Parameter3`'s value is `[['NestedParameter1' => 1]]`.
            if (array_is_list($values) === true) {
                foreach ($values as $itemValue) {
                    // Check if the current value in the list is an array (representing an object)
                    if (is_array($itemValue) === false) {
                        throw InvalidTypeForListValueException::withParentKeyValueType(
                            parentKey: $parentKey,
                            expectedValueType: Type::OBJECT_TYPE,
                            actualValue: $itemValue,
                        );
                    }

                    self::validateParameterValue(
                        $abstractParameterObject->isRequired(),
                        array_key_exists($abstractParameterObjectName, $itemValue),
                        $abstractParameterObjectName,
                        $itemValue[$abstractParameterObjectName] ?? null,
                        $abstractParameterObjectType,
                        $abstractParameterObjectChildren,
                    );
                }

                continue;
            }

            // This block handles cases where the current 'values' is an associative array (object)
            // and the current template parameter has a name.
            // We already checked for unexpected keys at the beginning of the validate method (unless it's a map type).
            // Now we just need to validate the value if it exists.
            $parameterNameInValuesKey = array_key_exists($abstractParameterObjectName, $values);
            $parameterIsRequired = $abstractParameterObject->isRequired();

            if (
                false === $parameterIsRequired
                && false === $parameterNameInValuesKey
            ) {
                continue;
            }

            self::validateParameterValue(
                $parameterIsRequired,
                $parameterNameInValuesKey,
                $abstractParameterObjectName,
                $values[$abstractParameterObjectName] ?? null,
                $abstractParameterObjectType,
                $abstractParameterObjectChildren,
            );
        }
    }

    /**
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws ParameterIsRequiredException
     * @throws UnexpectedParameterForObjectException
     * @param bool $parameterIsRequired
     * @param bool $parameterNameInValuesKey
     * @param string|null $abstractParameterObjectName
     * @param mixed $values
     * @param Type $abstractParameterObjectType
     * @param array<mixed>|null $abstractParameterObjectChildren
     * @return void
     */
    private static function validateParameterValue(
        bool $parameterIsRequired,
        bool $parameterNameInValuesKey,
        ?string $abstractParameterObjectName,
        mixed $values,
        Type $abstractParameterObjectType,
        ?array $abstractParameterObjectChildren,
    ): void {
        if (
            true === $parameterIsRequired
            && false === $parameterNameInValuesKey
        ) {
            throw ParameterIsRequiredException::withKey(
                key: $abstractParameterObjectName,
            );
        }

        // If the parameter is not required and not present, we can skip further validation for its value.
        if (false === $parameterIsRequired && false === $parameterNameInValuesKey) {
            return;
        }

        if (self::isValidType($abstractParameterObjectType, $values) === false) {
            throw InvalidTypeForKeyValueException::withKeyValueType(
                key: $abstractParameterObjectName,
                expectedValueType: $abstractParameterObjectType,
                actualValue: $values,
            );
        }

        if ($abstractParameterObjectChildren === null) {
            return;
        }

        // Ensure the current value is an array before attempting to validate its children
        if (is_array($values) === false) {
            throw InvalidTypeForKeyValueException::withKeyValueType(
                key: $abstractParameterObjectName,
                expectedValueType: $abstractParameterObjectType,
                actualValue: $values,
            );
        }

        self::validate(
            $values, // Pass the current parameter's value (which is an array/object) as values for its children
            $abstractParameterObjectChildren,
            $abstractParameterObjectName,
        );
    }


    /**
     * @throws InvalidTypeForListValueException
     */
    private static function checkTypeForListValue(
        mixed $value,
        Type $parameterType,
        string $parentKey,
    ): void {
        if (self::isValidType($parameterType, $value) === true) {
            return;
        }

        throw InvalidTypeForListValueException::withParentKeyValueType(
            parentKey: $parentKey,
            expectedValueType: $parameterType,
            actualValue: $value,
        );
    }

    private static function isValidType(Type $type, mixed $value): bool
    {
        return match ($type) {
            Type::STRING_TYPE => is_string($value),
            Type::INT_TYPE => is_int($value),
            Type::NUMERIC_TYPE => is_numeric($value),
            Type::BOOLEAN_TYPE => is_bool($value),
            Type::ARRAY_TYPE, Type::OBJECT_TYPE => is_array(
                $value,
            ),
        };
    }
}
