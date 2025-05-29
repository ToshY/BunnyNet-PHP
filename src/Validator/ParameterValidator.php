<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validator;

use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\InvalidTypeForKeyValueException;
use ToshY\BunnyNet\Exception\InvalidTypeForListValueException;
use ToshY\BunnyNet\Exception\ParameterIsRequiredException;
use ToshY\BunnyNet\Model\AbstractParameter;

class ParameterValidator
{
    /**
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws ParameterIsRequiredException
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
        foreach ($template as $abstractParameterObject) {
            $abstractParameterObjectName = $abstractParameterObject->getName();
            $abstractParameterObjectType = $abstractParameterObject->getType();
            $abstractParameterObjectChildren = $abstractParameterObject->getChildren();

            if ($abstractParameterObjectName === null) {
                foreach ($values as $value) {
                    self::checkTypeForListValue(
                        value: $value,
                        parameterType: $abstractParameterObjectType,
                        parentKey: $parentKey,
                    );
                }
            }

            if (array_is_list($values) === true && $abstractParameterObjectName !== null) {
                foreach ($values as $value) {
                    [
                        $parameterNameInValuesKey,
                        $parameterIsRequired,
                        $isValueOptionalAndNotInOptions,
                    ] = self::isValueOptionalAndNotInOptions(
                        $abstractParameterObjectName,
                        $value,
                        $abstractParameterObject,
                    );

                    if ($isValueOptionalAndNotInOptions === true) {
                        continue;
                    }

                    self::validateParameterValue(
                        $parameterIsRequired,
                        $parameterNameInValuesKey,
                        $abstractParameterObjectName,
                        $value[$abstractParameterObjectName],
                        $abstractParameterObjectType,
                        $abstractParameterObjectChildren,
                    );
                }

                continue;
            }

            [
                $parameterNameInValuesKey,
                $parameterIsRequired,
                $isValueOptionalAndNotInOptions,
            ] = self::isValueOptionalAndNotInOptions(
                $abstractParameterObjectName,
                $values,
                $abstractParameterObject,
            );

            if ($isValueOptionalAndNotInOptions === true) {
                continue;
            }

            self::validateParameterValue(
                $parameterIsRequired,
                $parameterNameInValuesKey,
                $abstractParameterObjectName,
                $values[$abstractParameterObjectName],
                $abstractParameterObjectType,
                $abstractParameterObjectChildren,
            );
        }
    }

    /**
     * @throws InvalidTypeForKeyValueException
     */
    private static function checkTypeForKeyValue(
        mixed $value,
        Type $parameterType,
        string $parameterName,
    ): void {
        $isType = sprintf('is_%s', $parameterType->value);
        if (true === $isType($value)) {
            return;
        }

        throw InvalidTypeForKeyValueException::withKeyValueType(
            key: $parameterName,
            expectedValueType: $parameterType,
            actualValue: $value,
        );
    }

    /**
     * @param string|null $abstractParameterObjectName
     * @param mixed $value
     * @param AbstractParameter $abstractParameterObject
     * @return bool[]
     */
    private static function isValueOptionalAndNotInOptions(
        string|null $abstractParameterObjectName,
        mixed $value,
        AbstractParameter $abstractParameterObject,
    ): array {
        $parameterNameInValuesKey = in_array($abstractParameterObjectName, array_keys($value), true);
        $parameterIsRequired = $abstractParameterObject->isRequired();

        if (
            false === $parameterIsRequired
            && false === $parameterNameInValuesKey
        ) {
            return [$parameterNameInValuesKey, $parameterIsRequired, true];
        }

        return [$parameterNameInValuesKey, $parameterIsRequired, false];
    }

    /**
     * @throws InvalidTypeForListValueException
     */
    private static function checkTypeForListValue(
        mixed $value,
        Type $parameterType,
        string $parentKey,
    ): void {
        $isType = sprintf('is_%s', $parameterType->value);
        if (true === $isType($value)) {
            return;
        }

        throw InvalidTypeForListValueException::withParentKeyValueType(
            parentKey: $parentKey,
            expectedValueType: $parameterType,
            actualValue: $value,
        );
    }

    /**
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws ParameterIsRequiredException
     * @param bool $parameterIsRequired
     * @param bool $parameterNameInValuesKey
     * @param string|null $abstractParameterObjectName
     * @param mixed $values
     * @param Type $abstractParameterObjectType
     * @param array<AbstractParameter>|null $abstractParameterObjectChildren
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

        $parameterValue = $values;

        if (
            Type::ARRAY_TYPE === $abstractParameterObjectType
            && null !== $abstractParameterObjectChildren
        ) {
            foreach ($abstractParameterObjectChildren as $childAbstractParameterObject) {
                if (
                    null !== $childAbstractParameterObject->getName()
                    && false === is_array($parameterValue)
                ) {
                    self::checkTypeForKeyValue(
                        value: $parameterValue,
                        parameterType: $abstractParameterObjectType,
                        parameterName: $abstractParameterObjectName,
                    );
                }

                self::validate(
                    $parameterValue,
                    [$childAbstractParameterObject],
                    $abstractParameterObjectName,
                );
            }
        }

        self::checkTypeForKeyValue(
            value: $parameterValue,
            parameterType: $abstractParameterObjectType,
            parameterName: $abstractParameterObjectName,
        );
    }
}
