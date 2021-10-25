<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class PullZoneEndpoint
 */
final class PullZoneEndpoint
{
    /** @var array */
    public const LIST_PULL_ZONES = [
        'method' => 'GET',
        'path' => 'pullzone',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const ADD_PULL_ZONE = [
        'method' => 'POST',
        'path' => 'pullzone',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const GET_PULL_ZONE = [
        'method' => 'GET',
        'path' => 'pullzone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const UPDATE_PULL_ZONE = [
        'method' => 'POST',
        'path' => 'pullzone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const DELETE_PULL_ZONE = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d',
        'headers' => [],
    ];

    /** @var array */
    public const DELETE_EDGE_RULE = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d/edgerules/%s',
        'headers' => [],
    ];

    /** @var array */
    public const ADD_UPDATE_EDGE_RULE = [
        'method' => 'POST',
        'path' => 'pullzone/%d/edgerules/addOrUpdate',
        'headers' => [
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const SET_EDGE_RULE_ENABLED = [
        'method' => 'POST',
        'path' => 'pullzone/%d/edgerules/%s/setEdgeRuleEnabled',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const GET_STATISTICS = [
        'method' => 'GET',
        'path' => 'pullzone/%d/waf/statistics',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const LOAD_FREE_CERTIFICATE = [
        'method' => 'GET',
        'path' => 'pullzone/loadFreeCertificate',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const PURGE_CACHE = [
        'method' => 'POST',
        'path' => 'pullzone/%d/purgeCache',
        'headers' => [],
    ];

    /** @var array */
    public const ADD_CUSTOM_CERTIFICATE = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addCertificate',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_CERTIFICATE = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d/removeCertificate',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const ADD_CUSTOM_HOSTNAME = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addHostname',
        'headers' => [
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_CUSTOM_HOSTNAME = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d/removeHostname',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const SET_FORCE_SSL = [
        'method' => 'POST',
        'path' => 'pullzone/%d/setForceSSL',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const RESET_TOKEN_KEY = [
        'method' => 'POST',
        'path' => 'pullzone/%d/resetSecurityKey',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
    ];

    /** @var array */
    public const ADD_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addAllowedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => 'pullzone/%d/removeAllowedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const ADD_BLOCKED_REFERER = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addBlockedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_BLOCKED_REFERER = [
        'method' => 'POST',
        'path' => 'pullzone/%d/removeBlockedReferrer',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const ADD_BLOCKED_IP = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addBlockedIp',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];

    /** @var array */
    public const REMOVE_BLOCKED_IP = [
        'method' => 'POST',
        'path' => 'pullzone/%d/removeBlockedIp',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
    ];
}
