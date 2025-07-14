<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception\Client;

use Exception;
use Throwable;

class BunnyHttpClientResponseException extends Exception
{
    public function __construct(string $message, int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
