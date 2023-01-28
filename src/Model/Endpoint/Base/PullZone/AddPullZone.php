<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class AddPullZone implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'pullzone';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    /**
     * OriginType (undocumented):
     * 0 = URL
     * 1 = -
     * 2 = Storage Zone
     * 3 = -
     * 4 = Script
     *
     * LogAnonymizationType (undocumented):
     * 0 = Remove one octet
     * 1 = Drop IP
     */
    public function getBody(): array
    {
        return [
            'OriginUrl' => [
                'type' => 'string',
            ],
            'AllowedReferrers' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'BlockedReferrers' => [
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
                'type' => 'bool',
            ],
            'EnableGeoZoneEU' => [
                'type' => 'bool',
            ],
            'EnableGeoZoneASIA' => [
                'type' => 'bool',
            ],
            'EnableGeoZoneSA' => [
                'type' => 'bool',
            ],
            'EnableGeoZoneAF' => [
                'type' => 'bool',
            ],
            'BlockRootPathAccess' => [
                'type' => 'bool',
            ],
            'BlockPostRequests' => [
                'type' => 'bool',
            ],
            'EnableQueryStringOrdering' => [
                'type' => 'bool',
            ],
            'EnableWebpVary' => [
                'type' => 'bool',
            ],
            'EnableAvifVary' => [
                'type' => 'bool',
            ],
            'EnableMobileVary' => [
                'type' => 'bool',
            ],
            'EnableCountryCodeVary' => [
                'type' => 'bool',
            ],
            'EnableHostnameVary' => [
                'type' => 'bool',
            ],
            'EnableCacheSlice' => [
                'type' => 'bool',
            ],
            'ZoneSecurityEnabled' => [
                'type' => 'bool',
            ],
            'ZoneSecurityIncludeHashRemoteIP' => [
                'type' => 'bool',
            ],
            'IgnoreQueryStrings' => [
                'type' => 'bool',
            ],
            'MonthlyBandwidthLimit' => [
                'type' => 'int',
            ],
            'AccessControlOriginHeaderExtensions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'EnableAccessControlOriginHeader' => [
                'type' => 'bool',
            ],
            'DisableCookies' => [
                'type' => 'bool',
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
                'type' => 'int',
            ],
            'CacheControlBrowserMaxAgeOverride' => [
                'type' => 'int',
            ],
            'AddHostHeader' => [
                'type' => 'bool',
            ],
            'AddCanonicalHeader' => [
                'type' => 'bool',
            ],
            'EnableLogging' => [
                'type' => 'bool',
            ],
            'LoggingIPAnonymizationEnabled' => [
                'type' => 'bool',
            ],
            'PermaCacheStorageZoneId' => [
                'type' => 'int',
            ],
            'AWSSigningEnabled' => [
                'type' => 'bool',
            ],
            'AWSSigningKey' => [
                'type' => 'string',
            ],
            'AWSSigningRegionName' => [
                'type' => 'string',
            ],
            'AWSSigningSecret' => [
                'type' => 'string',
            ],
            'EnableOriginShield' => [
                'type' => 'bool',
            ],
            'OriginShieldZoneCode' => [
                'type' => 'string',
            ],
            'EnableTLS1' => [
                'type' => 'bool',
            ],
            'EnableTLS1_1' => [
                'type' => 'bool',
            ],
            'CacheErrorResponses' => [
                'type' => 'bool',
            ],
            'VerifyOriginSSL' => [
                'type' => 'bool',
            ],
            'LogForwardingEnabled' => [
                'type' => 'bool',
            ],
            'LogForwardingHostname' => [
                'type' => 'string',
            ],
            'LogForwardingPort' => [
                'type' => 'int',
            ],
            'LogForwardingToken' => [
                'type' => 'string',
            ],
            'LogForwardingProtocol' => [
                'type' => 'int',
            ],
            'LoggingSaveToStorage' => [
                'type' => 'bool',
            ],
            'LoggingStorageZoneId' => [
                'type' => 'int',
            ],
            'FollowRedirects' => [
                'type' => 'bool',
            ],
            'ConnectionLimitPerIPCount' => [
                'type' => 'int',
            ],
            'RequestLimit' => [
                'type' => 'int',
            ],
            'LimitRateAfter' => [
                'type' => 'numeric',
            ],
            'LimitRatePerSecond' => [
                'type' => 'int',
            ],
            'BurstSize' => [
                'type' => 'int',
            ],
            'WAFEnabled' => [
                'type' => 'bool',
            ],
            'WAFDisabledRuleGroups' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'WAFDisabledRules' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'WAFEnableRequestHeaderLogging' => [
                'type' => 'bool',
            ],
            'WAFRequestHeaderIgnores' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'ErrorPageEnableCustomCode' => [
                'type' => 'bool',
            ],
            'ErrorPageCustomCode' => [
                'type' => 'string',
            ],
            'ErrorPageEnableStatuspageWidget' => [
                'type' => 'bool',
            ],
            'ErrorPageStatuspageCode' => [
                'type' => 'string',
            ],
            'ErrorPageWhitelabel' => [
                'type' => 'bool',
            ],
            'OptimizerEnabled' => [
                'type' => 'bool',
            ],
            'OptimizerDesktopMaxWidth' => [
                'type' => 'int',
            ],
            'OptimizerMobileMaxWidth' => [
                'type' => 'int',
            ],
            'OptimizerImageQuality' => [
                'type' => 'int',
            ],
            'OptimizerMobileImageQuality' => [
                'type' => 'int',
            ],
            'OptimizerEnableWebP' => [
                'type' => 'bool',
            ],
            'OptimizerEnableManipulationEngine' => [
                'type' => 'bool',
            ],
            'OptimizerMinifyCSS' => [
                'type' => 'bool',
            ],
            'OptimizerMinifyJavaScript' => [
                'type' => 'bool',
            ],
            'OptimizerWatermarkEnabled' => [
                'type' => 'bool',
            ],
            'OptimizerWatermarkUrl' => [
                'type' => 'string',
            ],
            'OptimizerWatermarkPosition' => [
                'type' => 'int',
            ],
            'OptimizerWatermarkOffset' => [
                'type' => 'int',
            ],
            'OptimizerWatermarkMinImageSize' => [
                'type' => 'int',
            ],
            'OptimizerAutomaticOptimizationEnabled' => [
                'type' => 'bool',
            ],
            'OptimizerClasses' => [
                'type' => 'array',
                'options' => [
                    'Name' => [
                        'type' => 'int',
                    ],
                    'Properties' => [
                        'type' => 'array',
                        'options' => [
                            'type' => 'array',
                        ],
                    ],
                ],
            ],
            'OptimizerForceClasses' => [
                'type' => 'bool',
            ],
            'Type' => [
                'type' => 'bool',
            ],
            'OriginRetries' => [
                'type' => 'int',
            ],
            'OriginConnectTimeout' => [
                'type' => 'int',
            ],
            'OriginResponseTimeout' => [
                'type' => 'int',
            ],
            'UseStaleWhileUpdating' => [
                'type' => 'bool',
            ],
            'UseStaleWhileOffline' => [
                'type' => 'bool',
            ],
            'OriginRetry5XXResponses' => [
                'type' => 'bool',
            ],
            'OriginRetryConnectionTimeout' => [
                'type' => 'bool',
            ],
            'OriginRetryResponseTimeout' => [
                'type' => 'bool',
            ],
            'OriginRetryDelay' => [
                'type' => 'int',
            ],
            'DnsOriginPort' => [
                'type' => 'int',
            ],
            'DnsOriginScheme' => [
                'type' => 'string',
            ],
            'QueryStringVaryParameters' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'OriginShieldEnableConcurrencyLimit' => [
                'type' => 'bool',
            ],
            'OriginShieldMaxConcurrentRequests' => [
                'type' => 'int',
            ],
            'EnableCookieVary' => [
                'type' => 'bool',
            ],
            'CookieVaryParameters' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'EnableSafeHop' => [
                'type' => 'bool',
            ],
            'OriginShieldQueueMaxWaitTime' => [
                'type' => 'int',
            ],
            'OriginShieldMaxQueuedRequests' => [
                'type' => 'int',
            ],
            'UseBackgroundUpdate' => [
                'type' => 'bool',
            ],
            'EnableAutoSSL' => [
                'type' => 'bool',
            ],
            'LogAnonymizationType' => [
                'type' => 'int',
            ],
            'StorageZoneId' => [
                'type' => 'int',
            ],
            'EdgeScriptId' => [
                'type' => 'int',
            ],
            'OriginType' => [
                'type' => 'int',
            ],
            'LogFormat' => [
                'type' => 'int',
            ],
            'LogForwardingFormat' => [
                'type' => 'int',
            ],
            'ShieldDDosProtectionType' => [
                'type' => 'int',
            ],
            'ShieldDDosProtectionEnabled' => [
                'type' => 'bool',
            ],
            'OriginHostHeader' => [
                'type' => 'string',
            ],
            'EnableSmartCache' => [
                'type' => 'bool',
            ],
            'EnableRequestCoalescing' => [
                'type' => 'bool',
            ],
            'RequestCoalescingTimeout' => [
                'type' => 'int',
            ],
            'Name' => [
                'required' => true,
                'type' => 'string',
            ],
        ];
    }
}
