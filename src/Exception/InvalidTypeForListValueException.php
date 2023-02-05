<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;
use Throwable;

final class InvalidTypeForListValueException extends Exception
{
    public const MESSAGE = 'Key `%s` expected list value of type `%s` got `%s` (%s).';

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
