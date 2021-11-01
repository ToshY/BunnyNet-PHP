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
        'path' => [
            'url' => '%s/%s/',
            'params' => [
                'storageZoneName' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'path' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_ALL,
        ],
        'query' => [],
        'body' => [],
    ];
}
