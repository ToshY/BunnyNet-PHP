<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class UserEndpoint
 */
final class UserEndpoint
{
    /** @var array */
    public const GET_USER_DETAILS = [
        'method' => 'GET',
        'path' => 'user',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const UPDATE_USER_DETAILS = [
        'method' => 'POST',
        'path' => 'user',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];
}
