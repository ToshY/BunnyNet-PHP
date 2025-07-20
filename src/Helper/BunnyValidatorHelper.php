<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Helper;

use InvalidArgumentException;
use ReflectionClass;
use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

/**
 * @internal
 */
class BunnyValidatorHelper
{
    /**
     * @param QueryModelInterface $model
     * @return array<string,mixed>
     */
    public static function getQueryValue(QueryModelInterface $model): array
    {
        $propertyName = 'query';
        $reflection = new ReflectionClass($model);
        try {
            $property = $reflection->getProperty($propertyName);
        } catch (\ReflectionException $e) {
            throw new InvalidArgumentException(
                message: sprintf(
                    'Model `%s` has no `%s` property despite implementing `%s`.',
                    $model::class,
                    $propertyName,
                    QueryModelInterface::class,
                ),
                previous: $e,
            );
        }

        $hasAttribute = empty($property->getAttributes(QueryProperty::class)) === false;
        if ($hasAttribute === true) {
            return $property->getValue($model);
        }

        throw new InvalidArgumentException(
            message: sprintf(
                'Model `%s` has `%s` property without attribute `%s`.',
                $model::class,
                $propertyName,
                QueryProperty::class,
            ),
        );
    }

    /**
     * @param BodyModelInterface $model
     * @return mixed
     */
    public static function getBodyValue(BodyModelInterface $model): mixed
    {
        $propertyName = 'body';
        $reflection = new ReflectionClass($model);
        try {
            $property = $reflection->getProperty($propertyName);
        } catch (\ReflectionException $e) {
            throw new InvalidArgumentException(
                message: sprintf(
                    'Model `%s` has no `%s` property despite implementing `%s`.',
                    $model::class,
                    $propertyName,
                    BodyModelInterface::class,
                ),
                previous: $e,
            );
        }

        $hasAttribute = empty($property->getAttributes(BodyProperty::class)) === false;
        if ($hasAttribute === true) {
            return $property->getValue($model);
        }

        throw new InvalidArgumentException(
            message: sprintf(
                'Model `%s` has `%s` property without attribute `%s`.',
                $model::class,
                $propertyName,
                BodyProperty::class,
            ),
        );
    }
}
