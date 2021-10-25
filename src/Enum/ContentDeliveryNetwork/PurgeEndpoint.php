<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class PurgeEndpoint
 */
final class PurgeEndpoint
{
    /** @var array */
    public const PURGE_URL = [
        'method' => 'POST',
        'path' => 'purge',
        'headers' => [],
    ];

    /** @var array */
    public const PURGE_URL_HEADERS = [
        'method' => 'GET',
        'path' => 'purge',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];
}
