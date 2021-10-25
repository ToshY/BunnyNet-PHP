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
    public const LIST_FILE_COLLECTION = [
        'method' => 'GET',
        'path' => '%s/%s/',
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
        ],
        'query' => [],
        'body' => [],
    ];
}