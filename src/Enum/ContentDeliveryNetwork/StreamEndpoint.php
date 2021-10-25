<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class StreamEndpoint
 */
final class StreamEndpoint
{
    /** @var array */
    public const LIST_VIDEO_LIBRARIES = [
        'method' => 'GET',
        'path' => 'videolibrary',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const ADD_VIDEO_LIBRARY = [
        'method' => 'POST',
        'path' => 'videolibrary',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const GET_VIDEO_LIBRARY = [
        'method' => 'GET',
        'path' => 'videolibrary/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const UPDATE_VIDEO_LIBRARY = [
        'method' => 'POST',
        'path' => 'videolibrary/%d',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const DELETE_VIDEO_LIBRARY = [
        'method' => 'DELETE',
        'path' => 'videolibrary/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const RESET_PASSWORD_QUERY = [
        'method' => 'POST',
        'path' => 'videolibrary/resetApiKey',
        'headers' => [],
    ];

    /** @var array */
    public const RESET_PASSWORD_PATH = [
        'method' => 'POST',
        'path' => 'videolibrary/%d/resetApiKey',
        'headers' => [],
    ];

    /** @var array */
    public const ADD_WATERMARK = [
        'method' => 'PUT',
        'path' => 'videolibrary/%d/watermark',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const DELETE_WATERMARK = [
        'method' => 'DELETE',
        'path' => 'videolibrary/%d/watermark',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const ADD_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => 'videolibrary/%d/addAllowedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => 'videolibrary/%d/removeAllowedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const ADD_BLOCKED_REFERER = [
        'method' => 'POST',
        'path' => 'videolibrary/%d/addBlockedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_BLOCKED_REFERER = [
        'method' => 'POST',
        'path' => 'videolibrary/%d/removeBlockedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

}
