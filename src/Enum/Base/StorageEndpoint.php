<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

final class StorageEndpoint
{
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
                'type' => 'string',
            ],
            'Region' => [
                'type' => 'string',
            ],
            'ReplicationRegions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
        ],
    ];

    public const GET_STORAGE_ZONE = [
        'method' => 'GET',
        'path' => 'storagezone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

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
                'type' => 'string',
            ],
            'Custom404FilePath' => [
                'type' => 'string',
            ],
            'Rewrite404To200' => [
                'type' => 'bool',
            ],
        ],
    ];

    public const DELETE_STORAGE_ZONE = [
        'method' => 'POST',
        'path' => 'storagezone/%d',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    public const RESET_PASSWORD_QUERY = [
        'method' => 'POST',
        'path' => 'storagezone/resetPassword',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    public const RESET_PASSWORD_PATH = [
        'method' => 'POST',
        'path' => 'storagezone/%d/resetPassword',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    public const RESET_READONLY_PASSWORD = [
        'method' => 'POST',
        'path' => 'storagezone/resetReadOnlyPassword',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];
}
