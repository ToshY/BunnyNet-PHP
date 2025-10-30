<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

/**
 * @internal
 */
final class OriginErrors
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
        '/{pullZoneId}/{dateTime}' => [
            'get' => null,
        ],
    ];
}
