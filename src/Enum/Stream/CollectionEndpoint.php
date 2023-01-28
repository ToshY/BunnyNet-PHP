<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Stream;

use ToshY\BunnyNet\Enum\Header;

final class CollectionEndpoint
{
    public const GET_COLLECTION = [
        'method' => 'GET',
        'path' => 'library/%d/collections/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    public const UPDATE_COLLECTION = [
        'method' => 'POST',
        'path' => 'library/%d/collections/%s',
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

    public const DELETE_COLLECTION = [
        'method' => 'DELETE',
        'path' => 'library/%d/collections/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    public const GET_COLLECTION_LIST = [
        'method' => 'GET',
        'path' => 'library/%d/collections',
        'headers' => [
            Header::ACCEPT_JSON,
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

    public const CREATE_COLLECTION = [
        'method' => 'POST',
        'path' => 'library/%d/collections/%s',
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
