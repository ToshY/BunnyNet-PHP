<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Storage;

use ToshY\BunnyNet\Enum\Header;

final class ManageEndpoint
{
    /** @var array */
    public const DOWNLOAD_FILE = [
        'method' => 'GET',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'params' => [
            'storageZoneName' => [
                'required' => true,
                'type'  => 'string',
            ],
            'path' => [
                'required' => true,
                'type' => 'string',
            ],
            'fileName' => [
                'required' => true,
                'type' => 'string',
            ]
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPLOAD_FILE = [
        'method' => 'PUT',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ],
        'params' => [
            'storageZoneName' => [
                'required' => true,
                'type'  => 'string',
            ],
            'path' => [
                'required' => true,
                'type' => 'string',
            ],
            'fileName' => [
                'required' => true,
                'type' => 'string',
            ]
        ],
        'query' => [],
        'body' => [
            'required' => true,
        ],
    ];

    /** @var array */
    public const DELETE_FILE = [
        'method' => 'DELETE',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'params' => [
            'storageZoneName' => [
                'required' => true,
                'type'  => 'string',
            ],
            'path' => [
                'required' => true,
                'type' => 'string',
            ],
            'fileName' => [
                'required' => true,
                'type' => 'string',
            ]
        ],
        'query' => [],
        'body' => [],
    ];
}
