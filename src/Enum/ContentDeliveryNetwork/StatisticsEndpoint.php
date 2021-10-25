<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

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
    ];
}
