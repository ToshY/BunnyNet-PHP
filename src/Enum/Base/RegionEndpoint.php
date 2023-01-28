<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

/**
 * Class RegionEndpoint
 */
final class RegionEndpoint
{
    /** @var array */
    public const GET_REGION_LIST = [
        'method' => 'GET',
        'path' => 'region',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];
}
