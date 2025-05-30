<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;

class UnexpectedParameterForObjectException extends Exception
{
    public const MESSAGE = 'Unexpected parameter `%s provided for `%s`%s.';

    /**
     * @param string $key
     * @param string $context
     * @param string[] $expectedKeys
     * @return self
     */
    public static function withKeyAndContext(string $key, string $context, array $expectedKeys = []): self
    {
        $expectedKeysPart = '';
        if (empty($expectedKeys) === false) {
            $expectedKeysPart = sprintf(', expected one of: [%s]', implode(', ', $expectedKeys));
        }

        return new self(
            sprintf(
                self::MESSAGE,
                $key,
                $context,
                $expectedKeysPart,
            ),
        );
    }
}
