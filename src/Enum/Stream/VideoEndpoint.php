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
        'path' => [
            'url' => 'library/%d/videos/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
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
    public const UPDATE_VIDEO = [
        'method' => 'POST',
        'path' => [
            'url' => 'library/%d/videos/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
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
        'path' => [
            'url' => 'library/%d/videos/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
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
    public const UPLOAD_VIDEO = [
        'method' => 'PUT',
        'path' => [
            'url' => 'library/%d/videos/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON
        ],
        'query' => [],
        'body' => [
        ],
    ];

    /** @var array */
    public const REENCODE_VIDEO = [
        'method' => 'POST',
        'path' => [
            'url' => 'library/%d/videos/%s/reencode',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
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
    public const LIST_VIDEOS = [
        'method' => 'GET',
        'path' => [
            'url' => 'library/%d/videos',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
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
        'path' => [
            'url' => 'library/%d/videos',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
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
        'path' => [
            'url' => 'library/%d/videos/%s/thumbnail',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
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
        'path' => [
            'url' => 'library/%d/videos/fetch',
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
    public const FETCH_VIDEO_ID = [
        'method' => 'POST',
        'path' => [
            'url' => 'library/%d/videos/%s/fetch',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
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
        'path' => [
            'url' => 'library/%d/videos/%s/captions/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'srclang' => [
                    'required' => true,
                    'type' => 'string',
                ]
            ],
        ],
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
        'path' => [
            'url' => 'library/%d/videos/%s/captions/%s',
            'params' => [
                'libraryId' => [
                    'required' => true,
                    'type' => 'int',
                ],
                'videoId' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'srclang' => [
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
