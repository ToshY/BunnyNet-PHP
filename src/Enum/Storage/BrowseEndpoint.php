<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Storage;

use ToshY\BunnyNet\Enum\Header;

final class BrowseEndpoint
{
    public const LIST_FILE_COLLECTION_ROOT = [
        'method' => 'GET',
        'path' => '%s//',
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'query' => [],
        'body' => [],
    ];

    public const LIST_FILE_COLLECTION_DIRECTORY = [
        'method' => 'GET',
        'path' => '%s/%s/',
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'query' => [],
        'body' => [],
    ];
}
