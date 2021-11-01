<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Exception;

use Exception;
use Throwable;

/**
 * Class InvalidQueryParameterRequirement
 */
final class InvalidQueryParameterRequirement extends Exception
{
    /**
     * InvalidQueryParameterRequirement constructor.
     * @param $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
