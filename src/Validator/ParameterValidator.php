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
     * @throws InvalidTypeForListValueException
     * @throws InvalidTypeForKeyValueException
     * @throws ParameterIsRequiredException
     */
    public static function validate(
        array $values,
        array $template,
        string $parentKey = null,
    ): void {
        /** @var AbstractParameter $abstractParameterObject */
        foreach ($template as $abstractParameterObject) {
            $abstractParameterObjectName = $abstractParameterObject->getName();
            $abstractParameterObjectType = $abstractParameterObject->getType();
            $abstractParameterObjectChildren = $abstractParameterObject->getChildren();

            if ($abstractParameterObjectName === null) {
                foreach ($values as $value) {
                    self::checkTypeForListValue(
                        value: $value,
                        parameterType: $abstractParameterObjectType,
                        parentKey: $parentKey
                    );
                }
            }

            $parameterNameInValuesKey = in_array($abstractParameterObjectName, array_keys($values), true);
            $parameterIsRequired = $abstractParameterObject->isRequired();

            if (
                false === $parameterIsRequired
                && false === $parameterNameInValuesKey
            ) {
                continue;
            }

            if (
                true === $parameterIsRequired
                && false === $parameterNameInValuesKey
            ) {
                throw new ParameterIsRequiredException(
                    sprintf(
                        ParameterIsRequiredException::MESSAGE,
                        $abstractParameterObjectName
                    )
                );
            }

            $parameterValue = $values[$abstractParameterObjectName];

            if (
                Type::ARRAY_TYPE === $abstractParameterObjectType
                && null !== $abstractParameterObjectChildren
            ) {
                foreach ($abstractParameterObjectChildren as $childAbstractParameterObject) {
                    if (null !== $childAbstractParameterObject->getName()) {
                        if (
                            false === is_array($abstractParameterObjectChildren)
                            || false === is_array($parameterValue)
                        ) {
                            self::checkTypeForKeyValue(
                                value: $parameterValue,
                                parameterType: $abstractParameterObjectType,
                                parameterName: $abstractParameterObjectName,
                            );
                        }
                    }

                    self::validate(
                        $parameterValue,
                        [$childAbstractParameterObject],
                        $abstractParameterObjectName
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

    /**
     * @throws InvalidTypeForKeyValueException
     */
    private static function checkTypeForKeyValue(
        mixed $value,
        Type $parameterType,
        string $parameterName
    ): void {
        $isType = sprintf('is_%s', $parameterType->value);
        if (true === $isType($value)) {
            return;
        }

        throw new InvalidTypeForKeyValueException(
            sprintf(
                InvalidTypeForKeyValueException::MESSAGE,
                $parameterName,
                $parameterType->value,
                gettype($value),
                is_array($value) === true ? json_encode($value) : $value
            )
        );
    }

    /**
     * @throws InvalidTypeForListValueException
     */
    private static function checkTypeForListValue(
        mixed $value,
        Type $parameterType,
        string $parentKey
    ): void {
        $isType = sprintf('is_%s', $parameterType->value);
        if (true === $isType($value)) {
            return;
        }

        throw new InvalidTypeForListValueException(
            sprintf(
                InvalidTypeForListValueException::MESSAGE,
                $parentKey,
                $parameterType->value,
                gettype($value),
                is_array($value) === true ? json_encode($value) : $value
            )
        );
    }
}
