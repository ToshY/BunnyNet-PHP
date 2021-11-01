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
        'path' => [
            'url' => '%s/%s/%s',
            'params' => [
                'storageZoneName' => [
                    'required' => true,
                    'type' => 'string',
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
        ],
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPLOAD_FILE = [
        'method' => 'PUT',
        'path' => [
            'url' => '%s/%s/%s',
            'params' => [
                'storageZoneName' => [
                    'required' => true,
                    'type' => 'string',
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
        ],
        'headers' => [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ],
        'query' => [],
        'body' => [
        ],
    ];

    /** @var array */
    public const DELETE_FILE = [
        'method' => 'DELETE',
        'path' => [
            'url' => '%s/%s/%s',
            'params' => [
                'storageZoneName' => [
                    'required' => true,
                    'type' => 'string',
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
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];
}
