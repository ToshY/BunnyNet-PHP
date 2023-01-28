<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Storage;

use ToshY\BunnyNet\Enum\Header;

final class ManageEndpoint
{
    public const DOWNLOAD_FILE = [
        'method' => 'GET',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'query' => [],
        'body' => [],
    ];

    public const UPLOAD_FILE = [
        'method' => 'PUT',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ],
        'query' => [],
        'body' => [],
    ];

    public const DELETE_FILE = [
        'method' => 'DELETE',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];
}
