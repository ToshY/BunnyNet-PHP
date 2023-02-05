<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;
use Throwable;

final class RegionDoesNotExistException extends Exception
{
    public const MESSAGE = 'The region abbreviation `%s` is not a valid primary storage region.'
    . ' Please check your storage dashboard for the correct hostname.';

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
