<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

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
        'query' => [
            'page' => [
                'required' => false,
                'type' => 'int',
            ],
            'perPage' => [
                'required' => false,
                'type' => 'int',
            ],
        ],
        'body' => [],
    ];

    /** @var array */
    public const ADD_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'OriginUrl' => [
                'type' => 'string',
            ],
            'Name' => [
                'type' => 'string'
            ],
            'Region' => [
                'type' => 'string'
            ],
            'ReplicationRegions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
        ],
    ];

    /** @var array */
    public const GET_STORAGE_ZONE = [
        'method' => 'GET',
        'path' => 'storagezone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPDATE_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'ReplicationZones' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'OriginUrl' => [
                'type' => 'string'
            ],
            'Custom404FilePath' => [
                'type' => 'string'
            ],
            'Rewrite404To200' => [
                'type' => 'bool'
            ],
        ],
    ];

    /** @var array */
    public const DELETE_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone/%d',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const RESET_PASSWORD_QUERY = [
        'method' => 'POST',
        'path' => 'storagezone/resetPassword',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const RESET_PASSWORD_PATH = [
        'method' => 'POST',
        'path' => 'storagezone/%d/resetPassword',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const RESET_READONLY_PASSWORD = [
        'method' => 'POST',
        'path' => 'storagezone/resetReadOnlyPassword',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];
}
