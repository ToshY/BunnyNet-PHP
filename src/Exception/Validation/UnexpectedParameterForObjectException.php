<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception\Validation;

use Exception;

class UnexpectedParameterForObjectException extends Exception implements BunnyValidatorExceptionInterface
{
    public const MESSAGE = 'Unexpected parameter `%s` provided%s%s.';

    /**
     * @param string $key
     * @param string|null $parent
     * @param string[] $expectedKeys
     * @return self
     */
    public static function withKeyAndContext(string $key, string|null $parent, array $expectedKeys = []): self
    {
        $expectedKeysPart = '';
        if (empty($expectedKeys) === false) {
            $expectedKeysPart = sprintf(', expected one of: [%s]', implode(', ', $expectedKeys));
        }

        return new self(
            sprintf(
                self::MESSAGE,
                $key,
                $parent ? sprintf(' (at parent key `%s`)', $parent) : '',
                $expectedKeysPart,
            ),
        );
    }
}
