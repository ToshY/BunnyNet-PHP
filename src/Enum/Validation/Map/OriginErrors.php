<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\OriginErrors\GetOriginErrorLogsForASpecificPullZoneAndDate;

final class OriginErrors
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        GetOriginErrorLogsForASpecificPullZoneAndDate::class => ModelValidationStrategy::NONE,
    ];
}
