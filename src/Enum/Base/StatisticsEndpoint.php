<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class StatisticsEndpoint
 */
final class StatisticsEndpoint
{
    /** @var array */
    public const GET_STATISTICS = [
        'method' => 'GET',
        'path' => 'statistics',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'dateFrom' => [
                'required' => false,
                'type' => 'string',
            ],
            'dateTo' => [
                'required' => false,
                'type' => 'string',
            ],
            'pullZone' => [
                'required' => false,
                'type' => 'int',
            ],
            'serverZoneId' => [
                'required' => false,
                'type' => 'int',
            ],
            'loadErrors' => [
                'required' => false,
                'type' => 'bool',
            ],
            'hourly' => [
                'required' => false,
                'type' => 'bool',
            ],
        ],
        'body' => [],
    ];
}
