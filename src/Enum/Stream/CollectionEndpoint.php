<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Stream;

use ToshY\BunnyNet\Enum\Header;

final class CollectionEndpoint
{
    /** @var array */
    public const GET_COLLECTION = [
        'method' => 'GET',
        'path' => [
            'url' => 'library/%d/collections/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'collectionId' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPDATE_COLLECTION = [
        'method' => 'POST',
        'path' => [
            'url' => 'library/%d/collections/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'collectionId' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [],
        'body' => [
            'name' => [
                'type' => 'string',
            ]
        ],
    ];

    /** @var array */
    public const DELETE_COLLECTION = [
        'method' => 'DELETE',
        'path' => [
            'url' => 'library/%d/collections/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'collectionId' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const GET_COLLECTION_LIST = [
        'method' => 'GET',
        'path' => [
            'url' => 'library/%d/collections',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON
        ],
        'query' => [
            'page' => [
                'required' => false,
                'type' => 'int',
            ],
            'itemsPerPage' => [
                'required' => false,
                'type' => 'int',
            ],
            'search' => [
                'required' => false,
                'type' => 'string',
            ],
            'orderBy' => [
                'required' => false,
                'type' => 'string',
            ],
        ],
        'body' => [],
    ];

    /** @var array */
    public const CREATE_COLLECTION = [
        'method' => 'POST',
        'path' => [
            'url' => 'library/%d/collections/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [],
        'body' => [
            'name' => [
                'type' => 'string',
            ],
        ],
    ];
}
