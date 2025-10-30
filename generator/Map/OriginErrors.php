<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\OriginErrors\GetOriginErrorLogs;

/**
 * @internal
 */
final class OriginErrors
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
        '/{pullZoneId}/{dateTime}' => [
            'get' => GetOriginErrorLogs::class,
        ],
    ];
}
