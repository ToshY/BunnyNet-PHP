<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Storage;

use ToshY\BunnyNet\Enum\Header;

final class BrowseEndpoint
{
    /** @var array */
    public const LIST_FILE_COLLECTION_ROOT = [
        'method' => 'GET',
        'path' => '%s//',
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
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
