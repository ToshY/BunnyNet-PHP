<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\CDN;

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
    public const ADD_PULL_ZONE = [
        'method' => 'POST',
        'path' => 'pullzone',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Name' => [
                'type' => 'string'
            ],
            'OriginUrl' => [
                'type' => 'string',
            ],
            'StorageZoneId' => [
                'type' => 'int'
            ],
            'Type' => [
                'type' => 'int'
            ],
        ],
    ];

    /** @var array */
    public const GET_PULL_ZONE = [
        'method' => 'GET',
        'path' => 'pullzone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const UPDATE_PULL_ZONE = [
        'method' => 'GET',
        'path' => 'pullzone/%d',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [
            'OriginUrl' => [
                'type' => 'string'
            ],
            'AllowedReferrers' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'BlockedIps' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'EnableGeoZoneUS' => [
                'type' => 'bool'
            ],
            'EnableGeoZoneEU' => [
                'type' => 'bool'
            ],
            'EnableGeoZoneASIA' => [
                'type' => 'bool'
            ],
            'EnableGeoZoneSA' => [
                'type' => 'bool'
            ],
            'EnableGeoZoneAF' => [
                'type' => 'bool'
            ],
            'BlockRootPathAccess' => [
                'type' => 'bool'
            ],
            'BlockPostRequests' => [
                'type' => 'bool'
            ],
            'EnableQueryStringOrdering' => [
                'type' => 'bool'
            ],
            'EnableWebpVary' => [
                'type' => 'bool'
            ],
            'EnableAvifVary' => [
                'type' => 'bool'
            ],
            'EnableMobileVary' => [
                'type' => 'bool'
            ],
            'EnableCountryCodeVary' => [
                'type' => 'bool'
            ],
            'EnableHostnameVary' => [
                'type' => 'bool'
            ],
            'EnableCacheSlice' => [
                'type' => 'bool'
            ],
            'ZoneSecurityEnabled' => [
                'type' => 'bool'
            ],
            'ZoneSecurityIncludeHashRemoteIP' => [
                'type' => 'bool'
            ],
            'IgnoreQueryStrings' => [
                'type' => 'bool'
            ],
            'MonthlyBandwidthLimit' => [
                'type' => 'int'
            ],
            'AccessControlOriginHeaderExtensions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'EnableAccessControlOriginHeader' => [
                'type' => 'bool'
            ],
            'DisableCookies' => [
                'type' => 'bool'
            ],
            'BudgetRedirectedCountries' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'BlockedCountries' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'CacheControlMaxAgeOverride' => [
                'type' => 'int'
            ],
            'CacheControlBrowserMaxAgeOverride' => [
                'type' => 'int'
            ],
            'AddHostHeader' => [
                'type' => 'bool'
            ],
            'AddCanonicalHeader' => [
                'type' => 'bool'
            ],
            'EnableLogging' => [
                'type' => 'bool'
            ],
            'LoggingIPAnonymizationEnabled' => [
                'type' => 'bool'
            ],
            'PermaCacheStorageZoneId' => [
                'type' => 'int'
            ],
            'AWSSigningEnabled' => [
                'type' => 'bool'
            ],
            'AWSSigningKey' => [
                'type' => 'string'
            ],
            'AWSSigningRegionName' => [
                'type' => 'string'
            ],
            'AWSSigningSecret' => [
                'type' => 'string'
            ],
            'EnableOriginShield' => [
                'type' => 'bool'
            ],
            'OriginShieldZoneCode' => [
                'type' => 'string'
            ],
            'EnableTLS1' => [
                'type' => 'bool'
            ],
            'EnableTLS1_1' => [
                'type' => 'bool'
            ],
            'CacheErrorResponses' => [
                'type' => 'bool'
            ],
            'VerifyOriginSSL' => [
                'type' => 'bool'
            ],
            'LogForwardingEnabled' => [
                'type' => 'bool'
            ],
            'LogForwardingHostname' => [
                'type' => 'string'
            ],
            'LogForwardingPort' => [
                'type' => 'int'
            ],
            'LogForwardingToken' => [
                'type' => 'string'
            ],
            'LoggingSaveToStorage' => [
                'type' => 'bool'
            ],
            'LoggingStorageZoneId' => [
                'type' => 'int'
            ],
            'FollowRedirects' => [
                'type' => 'bool'
            ],
            'ConnectionLimitPerIPCount' => [
                'type' => 'int'
            ],
            'RequestLimit' => [
                'type' => 'int'
            ],
            'WAFEnabled' => [
                'type' => 'bool'
            ],
            'WAFEnabledRules' => [
                'type' => 'array',
                'options' => [
                    'type' => 'int',
                ],
            ],
            'ErrorPageEnableCustomCode' => [
                'type' => 'bool'
            ],
            'ErrorPageCustomCode' => [
                'type' => 'string'
            ],
            'ErrorPageEnableStatuspageWidget' => [
                'type' => 'bool'
            ],
            'ErrorPageStatuspageCode' => [
                'type' => 'string'
            ],
            'ErrorPageWhitelabel' => [
                'type' => 'bool'
            ],
            'OptimizerEnabled' => [
                'type' => 'bool'
            ],
            'OptimizerDesktopMaxWidth' => [
                'type' => 'int'
            ],
            'OptimizerMobileMaxWidth' => [
                'type' => 'int'
            ],
            'OptimizerImageQuality' => [
                'type' => 'int'
            ],
            'OptimizerMobileImageQuality' => [
                'type' => 'int'
            ],
            'OptimizerEnableWebP' => [
                'type' => 'bool'
            ],
            'OptimizerEnableManipulationEngine' => [
                'type' => 'bool'
            ],
            'OptimizerMinifyCSS' => [
                'type' => 'bool'
            ],
            'OptimizerMinifyJavaScript' => [
                'type' => 'bool'
            ],
            'OptimizerWatermarkEnabled' => [
                'type' => 'bool'
            ],
            'OptimizerWatermarkUrl' => [
                'type' => 'string'
            ],
            'OptimizerWatermarkPosition' => [
                'type' => 'int'
            ],
            'OptimizerWatermarkOffset' => [
                'type' => 'int'
            ],
            'OptimizerWatermarkMinImageSize' => [
                'type' => 'int'
            ],
            'OptimizerAutomaticOptimizationEnabled' => [
                'type' => 'bool'
            ],
            'Type' => [
                'type' => 'bool'
            ],
        ],
    ];

    /** @var array */
    public const DELETE_PULL_ZONE = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const DELETE_EDGE_RULE = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d/edgerules/%s',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const ADD_UPDATE_EDGE_RULE = [
        'method' => 'POST',
        'path' => 'pullzone/%d/edgerules/addOrUpdate',
        'headers' => [
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Guid' => [
                'type' => 'string',
            ],
            'ActionType' => [
                'type' => 'int',
            ],
            'ActionParameter1' => [
                'type' => 'string',
            ],
            'ActionParameter2' => [
                'type' => 'string',
            ],
            'Triggers' => [
                'type' => 'array',
                'options' => [
                    'Type' => [
                        'type' => 'int',
                    ],
                    'PatternMatches' => [
                        'type' => 'array',
                        'options' => [
                            'type' => 'string',
                        ]
                    ],
                    'PatternMatchingType' => [
                        'type' => 'int',
                    ],
                    'Parameter1' => [
                        'type' => 'string',
                    ],
                ],
            ],
            'TriggerMatchingType' => [
                'type' => 'int',
            ],
            'Description' => [
                'type' => 'string',
            ],
            'Enabled' => [
                'type' => 'bool',
            ],
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
        'query' => [],
        'body' => [
            'Id' => [
                'type' => 'int',
            ],
            'Value' => [
                'type' => 'bool',
            ],
        ],
    ];

    /** @var array */
    public const GET_STATISTICS = [
        'method' => 'GET',
        'path' => 'pullzone/%d/waf/statistics',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'dateFrom' => [
                'required' => false,
                'type' => 'datetime',
            ],
            'dateTo' => [
                'required' => false,
                'type' => 'datetime',
            ],
            'hourly' => [
                'required' => false,
                'type' => 'bool',
            ],
        ],
        'body' => [],
    ];

    /** @var array */
    public const LOAD_FREE_CERTIFICATE = [
        'method' => 'GET',
        'path' => 'pullzone/loadFreeCertificate',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'hostname' => [
                'required' => true,
                'type' => 'string',
            ],
        ],
        'body' => [],
    ];

    /** @var array */
    public const PURGE_CACHE = [
        'method' => 'POST',
        'path' => 'pullzone/%d/purgeCache',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const ADD_CUSTOM_CERTIFICATE = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addCertificate',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
            'Certificate' => [
                'type' => 'string',
            ],
            'CertificateKey' => [
                'type' => 'string',
            ],
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
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
        ],
    ];

    /** @var array */
    public const ADD_CUSTOM_HOSTNAME = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addHostname',
        'headers' => [
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
    public const REMOVE_CUSTOM_HOSTNAME = [
        'method' => 'DELETE',
        'path' => 'pullzone/%d/removeHostname',
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
    public const SET_FORCE_SSL = [
        'method' => 'POST',
        'path' => 'pullzone/%d/setForceSSL',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Hostname' => [
                'type' => 'string',
            ],
            'ForceSSL' => [
                'type' => 'bool',
            ],
        ],
    ];

    /** @var array */
    public const RESET_TOKEN_KEY = [
        'method' => 'POST',
        'path' => 'pullzone/%d/resetSecurityKey',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const ADD_ALLOWED_REFERER = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addAllowedReferrer',
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
        'path' => 'pullzone/%d/removeAllowedReferrer',
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
        'path' => 'pullzone/%d/addBlockedReferrer',
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
        'path' => 'pullzone/%d/removeBlockedReferrer',
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
    public const ADD_BLOCKED_IP = [
        'method' => 'POST',
        'path' => 'pullzone/%d/addBlockedIp',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'BlockedIp' => [
                'type' => 'string',
            ],
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
        'query' => [],
        'body' => [
            'BlockedIp' => [
                'type' => 'string',
            ],
        ],
    ];
}
