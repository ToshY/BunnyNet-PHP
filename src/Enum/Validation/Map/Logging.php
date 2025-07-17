<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Logging\GetLog;

final class Logging
{
    /** @var array<class-string,ModelValidationStrategy> */
    public static array $map = [
        GetLog::class => ModelValidationStrategy::STRICT_QUERY,
    ];
}
