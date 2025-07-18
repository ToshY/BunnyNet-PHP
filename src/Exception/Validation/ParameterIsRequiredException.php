<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception\Validation;

use Exception;

class ParameterIsRequiredException extends Exception implements BunnyValidatorExceptionInterface
{
    public const MESSAGE = 'The parameter key `%s`%s is required but not provided.';

    public static function withKey(
        string $key,
        ?string $parent = null,
    ): self {
        return new self(
            sprintf(
                self::MESSAGE,
                $key,
                $parent ? sprintf(' (at parent key `%s`)', $parent) : '',
            ),
        );
    }
}
