<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;

class RegionDoesNotExistException extends Exception
{
    public const MESSAGE = 'The region abbreviation `%s` is not a valid primary storage region.'
    . ' Please check your storage dashboard for the correct hostname.';

    public static function withHostCode(
        string $hostCode,
    ): self {
        return new self(
            sprintf(
                self::MESSAGE,
                $hostCode
            )
        );
    }
}
