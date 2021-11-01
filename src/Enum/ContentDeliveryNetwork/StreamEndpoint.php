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
        'path' => [
            'url' => 'videolibrary',
            'params' => [],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'page' => [
                'required' => false,
                'type' => 'int',
            ],
            'perPage' => [
                'required' => false,
                'type' => 'int',
            ],
        ],
        'body' => [],
    ];

    /** @var array */
    public const ADD_VIDEO_LIBRARY = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary',
            'params' => [],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Id' => [
                'type' => 'int',
            ],
            'Name' => [
                'type' => 'string'
            ],
            'ReplicationRegions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
        ]
    ];

    /** @var array */
    public const GET_VIDEO_LIBRARY = [
        'method' => 'GET',
        'path' => [
            'url' => 'videolibrary/%d',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
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
    public const UPDATE_VIDEO_LIBRARY = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/%d',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Name' => [
                'type' => 'string',
            ],
            'CustomHTML' => [
                'type' => 'string'
            ],
            'PlayerKeyColor' => [
                'type' => 'string'
            ],
            'EnableTokenAuthentication' => [
                'type' => 'bool'
            ],
            'EnableTokenIPVerification' => [
                'type' => 'bool'
            ],
            'ResetToken' => [
                'type' => 'bool'
            ],
            'WatermarkPositionLeft' => [
                'type' => 'int'
            ],
            'WatermarkPositionTop' => [
                'type' => 'int'
            ],
            'WatermarkWidth' => [
                'type' => 'int'
            ],
            'EnabledResolutions' => [
                'type' => 'string'
            ],
            'ViAiPublisherId' => [
                'type' => 'string'
            ],
            'VastTagUrl' => [
                'type' => 'string'
            ],
            'WebhookUrl' => [
                'type' => 'string'
            ],
            'CaptionsFontSize' => [
                'type' => 'int'
            ],
            'CaptionsFontColor' => [
                'type' => 'string'
            ],
            'UILanguage' => [
                'type' => 'string'
            ],
            'AllowEarlyPlay' => [
                'type' => 'bool'
            ],
            'PlayerTokenAuthenticationEnabled' => [
                'type' => 'bool'
            ],
            'BlockNoneReferrer' => [
                'type' => 'bool'
            ],
            'EnableMP4Fallback' => [
                'type' => 'bool'
            ],
            'KeepOriginalFiles' => [
                'type' => 'bool'
            ],
            'AllowDirectPlay' => [
                'type' => 'bool'
            ],
            'EnableDRM' => [
                'type' => 'bool'
            ],
            'Controls' => [
                'type' => 'string'
            ],
            'Bitrate240p' => [
                'type' => 'int'
            ],
            'Bitrate360p' => [
                'type' => 'int'
            ],
            'Bitrate480p' => [
                'type' => 'int'
            ],
            'Bitrate720p' => [
                'type' => 'int'
            ],
            'Bitrate1080p' => [
                'type' => 'int'
            ],
            'Bitrate1440p' => [
                'type' => 'int'
            ],
            'Bitrate2160p' => [
                'type' => 'int'
            ],
        ],
    ];

    /** @var array */
    public const DELETE_VIDEO_LIBRARY = [
        'method' => 'DELETE',
        'path' => [
            'url' => 'videolibrary/%d',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
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
    public const RESET_PASSWORD_QUERY = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/resetApiKey',
            'params' => [],
        ],
        'headers' => [],
        'query' => [
            'id' => [
                'required' => true,
                'type' => 'int',
            ]
        ],
        'body' => [],
    ];

    /** @var array */
    public const RESET_PASSWORD_PATH = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/%d/resetApiKey',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const ADD_WATERMARK = [
        'method' => 'PUT',
        'path' => [
            'url' => 'videolibrary/%d/watermark',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
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
    public const DELETE_WATERMARK = [
        'method' => 'DELETE',
        'path' => [
            'url' => 'videolibrary/%d/watermark',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
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
    public const ADD_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/%d/addAllowedReferrer',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
        ],
    ];

    /** @var array */
    public const REMOVE_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/%d/removeAllowedReferrer',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
        ],
    ];

    /** @var array */
    public const ADD_BLOCKED_REFERER = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/%d/addBlockedReferrer',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
        ],
    ];

    /** @var array */
    public const REMOVE_BLOCKED_REFERER = [
        'method' => 'POST',
        'path' => [
            'url' => 'videolibrary/%d/removeBlockedReferrer',
            'params' => [
                'id' => [
                    'required' => true,
                    'type' => 'int',
                ],
            ],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
        ],
    ];
}
