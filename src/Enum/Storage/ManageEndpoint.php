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
    ];

    /** @var array */
    public const UPLOAD_FILE = [
        'method' => 'PUT',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ],
    ];

    /** @var array */
    public const DELETE_FILE = [
        'method' => 'DELETE',
        'path' => '%s/%s/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];
}
