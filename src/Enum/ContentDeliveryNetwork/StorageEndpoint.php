<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class StorageEndpoint
 */
final class StorageEndpoint
{
    /** @var array */
    public const LIST_STORAGE_ZONES = [
        'method' => 'GET',
        'path' => 'storagezone',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const ADD_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const GET_STORAGE_ZONE = [
        'method' => 'GET',
        'path' => 'storagezone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const UPDATE_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const DELETE_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone/%d',
        'headers' => [],
    ];

    /** @var array */
    public const RESET_PASSWORD_QUERY = [
        'method' => 'POST',
        'path' => 'storagezone/resetPassword',
        'headers' => [],
    ];

    /** @var array */
    public const RESET_PASSWORD_PATH = [
        'method' => 'POST',
        'path' => 'storagezone/%d/resetPassword',
        'headers' => [],
    ];

    /** @var array */
    public const RESET_READONLY_PASSWORD = [
        'method' => 'POST',
        'path' => 'storagezone/resetReadOnlyPassword',
        'headers' => [],
    ];
}
