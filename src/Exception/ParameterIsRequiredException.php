<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;
use Throwable;

final class ParameterIsRequiredException extends Exception
{
    public const MESSAGE = 'The parameter key `%s` is required but not provided.';

    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
