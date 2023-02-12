<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;

class InvalidJSONForBodyException extends Exception
{
    public static function withMessage(
        string $message
    ): self {
        return new self($message);
    }
}
