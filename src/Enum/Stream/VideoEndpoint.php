<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Stream;

use ToshY\BunnyNet\Enum\Header;

final class VideoEndpoint
{
    /** @var array */
    public const GET_VIDEO = [
        'method' => 'GET',
        'path' => 'library/%d/videos/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPDATE_VIDEO = [
        'method' => 'POST',
        'path' => 'library/%d/videos/%s',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [],
        'body' => [
            'title' => [
                'type' => 'string',
            ],
            'collectionId' => [
                'type' => 'string',
            ],
        ],
    ];

    /** @var array */
    public const DELETE_VIDEO = [
        'method' => 'DELETE',
        'path' => 'library/%d/videos/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPLOAD_VIDEO = [
        'method' => 'PUT',
        'path' => 'library/%d/videos/%s',
        'headers' => [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const REENCODE_VIDEO = [
        'method' => 'POST',
        'path' => 'library/%d/videos/%s/reencode',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const LIST_VIDEOS = [
        'method' => 'GET',
        'path' => 'library/%d/videos',
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
            'collection' => [
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
    public const CREATE_VIDEO = [
        'method' => 'POST',
        'path' => 'library/%d/videos',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [],
        'body' => [
            'title' => [
                'type' => 'string',
            ],
            'collectionId' => [
                'type' => 'string'
            ],
        ],
    ];

    /** @var array */
    public const SET_THUMBNAIL = [
        'method' => 'POST',
        'path' => 'library/%d/videos/%s/thumbnail',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'thumbnailUrl' => [
                'required' => true,
                'type' => 'string',
            ],
        ],
        'body' => [],
    ];

    /** @var array */
    public const FETCH_VIDEO_TO_COLLECTION = [
        'method' => 'POST',
        'path' => 'library/%d/videos/fetch',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [
            'collectionId' => [
                'required' => false,
                'type' => 'string',
            ],
        ],
        'body' => [
            'url' => [
                'type' => 'string',
            ],
            'headers' => [
                'type' => 'array',
                'options' => [
                    'type' => 'array',
                ],
            ],
        ],
    ];

    /** @var array */
    public const FETCH_VIDEO = [
        'method' => 'POST',
        'path' => 'library/%d/videos/%s/fetch',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [],
        'body' => [
            'url' => [
                'type' => 'string',
            ],
            'headers' => [
                'type' => 'array',
                'options' => [
                    'type' => 'array',
                ],
            ],
        ],
    ];

    /** @var array */
    public const ADD_CAPTION = [
        'method' => 'POST',
        'path' => 'library/%d/videos/%s/captions/%s',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ],
        'query' => [],
        'body' => [
            'url' => [
                'type' => 'string',
            ],
            'headers' => [
                'type' => 'array',
                'options' => [
                    'type' => 'array',
                ],
            ],
        ],
    ];

    /** @var array */
    public const DELETE_CAPTION = [
        'method' => 'POST',
        'path' => 'library/%d/videos/%s/captions/%s',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];
}
