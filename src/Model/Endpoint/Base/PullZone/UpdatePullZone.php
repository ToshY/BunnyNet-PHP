<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdatePullZone implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'pullzone/%d';
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
     * 4 = Script (hidden in UI)
     *
     * LogAnonymizationType (undocumented):
     * 0 = Remove one octet
     * 1 = Drop IP
     */
    public function getBody(): array
    {
        return [
            'OriginUrl' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'AllowedReferrers' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'BlockedReferrers' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'BlockedIps' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'EnableGeoZoneUS' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableGeoZoneEU' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableGeoZoneASIA' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableGeoZoneSA' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableGeoZoneAF' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'BlockRootPathAccess' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'BlockPostRequests' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableQueryStringOrdering' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableWebpVary' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableAvifVary' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableMobileVary' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableCountryCodeVary' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableHostnameVary' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableCacheSlice' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ZoneSecurityEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ZoneSecurityIncludeHashRemoteIP' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'IgnoreQueryStrings' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'MonthlyBandwidthLimit' => [
                'type' => Type::INT_TYPE->value,
            ],
            'AccessControlOriginHeaderExtensions' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'EnableAccessControlOriginHeader' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'DisableCookies' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'BudgetRedirectedCountries' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'BlockedCountries' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'CacheControlMaxAgeOverride' => [
                'type' => Type::INT_TYPE->value,
            ],
            'CacheControlBrowserMaxAgeOverride' => [
                'type' => Type::INT_TYPE->value,
            ],
            'AddHostHeader' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'AddCanonicalHeader' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableLogging' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'LoggingIPAnonymizationEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'PermaCacheStorageZoneId' => [
                'type' => Type::INT_TYPE->value,
            ],
            'AWSSigningEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'AWSSigningKey' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'AWSSigningRegionName' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'AWSSigningSecret' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'EnableOriginShield' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginShieldZoneCode' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'EnableTLS1' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableTLS1_1' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'CacheErrorResponses' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'VerifyOriginSSL' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'LogForwardingEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'LogForwardingHostname' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'LogForwardingPort' => [
                'type' => Type::INT_TYPE->value,
            ],
            'LogForwardingToken' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'LogForwardingProtocol' => [
                'type' => Type::INT_TYPE->value,
            ],
            'LoggingSaveToStorage' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'LoggingStorageZoneId' => [
                'type' => Type::INT_TYPE->value,
            ],
            'FollowRedirects' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ConnectionLimitPerIPCount' => [
                'type' => Type::INT_TYPE->value,
            ],
            'RequestLimit' => [
                'type' => Type::INT_TYPE->value,
            ],
            'LimitRateAfter' => [
                'type' => Type::NUMERIC_TYPE->value,
            ],
            'LimitRatePerSecond' => [
                'type' => Type::INT_TYPE->value,
            ],
            'BurstSize' => [
                'type' => Type::INT_TYPE->value,
            ],
            'WAFEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'WAFDisabledRuleGroups' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'WAFDisabledRules' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'WAFEnableRequestHeaderLogging' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'WAFRequestHeaderIgnores' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'ErrorPageEnableCustomCode' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ErrorPageCustomCode' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ErrorPageEnableStatuspageWidget' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ErrorPageStatuspageCode' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ErrorPageWhitelabel' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerDesktopMaxWidth' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerMobileMaxWidth' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerImageQuality' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerMobileImageQuality' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerEnableWebP' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerEnableManipulationEngine' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerMinifyCSS' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerMinifyJavaScript' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerWatermarkEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerWatermarkUrl' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'OptimizerWatermarkPosition' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerWatermarkOffset' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerWatermarkMinImageSize' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OptimizerAutomaticOptimizationEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OptimizerClasses' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'Name' => [
                        'type' => Type::INT_TYPE->value,
                    ],
                    'Properties' => [
                        'type' => Type::ARRAY_TYPE->value,
                        'options' => [
                            'type' => Type::ARRAY_TYPE->value,
                        ],
                    ],
                ],
            ],
            'OptimizerForceClasses' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'Type' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginRetries' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OriginConnectTimeout' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OriginResponseTimeout' => [
                'type' => Type::INT_TYPE->value,
            ],
            'UseStaleWhileUpdating' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'UseStaleWhileOffline' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginRetry5XXResponses' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginRetryConnectionTimeout' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginRetryResponseTimeout' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginRetryDelay' => [
                'type' => Type::INT_TYPE->value,
            ],
            'DnsOriginPort' => [
                'type' => Type::INT_TYPE->value,
            ],
            'DnsOriginScheme' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'QueryStringVaryParameters' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'OriginShieldEnableConcurrencyLimit' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginShieldMaxConcurrentRequests' => [
                'type' => Type::INT_TYPE->value,
            ],
            'EnableCookieVary' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'CookieVaryParameters' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'EnableSafeHop' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginShieldQueueMaxWaitTime' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OriginShieldMaxQueuedRequests' => [
                'type' => Type::INT_TYPE->value,
            ],
            'UseBackgroundUpdate' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableAutoSSL' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'LogAnonymizationType' => [
                'type' => Type::INT_TYPE->value,
            ],
            'StorageZoneId' => [
                'type' => Type::INT_TYPE->value,
            ],
            'EdgeScriptId' => [
                'type' => Type::INT_TYPE->value,
            ],
            'OriginType' => [
                'type' => Type::INT_TYPE->value,
            ],
            'LogFormat' => [
                'type' => Type::INT_TYPE->value,
            ],
            'LogForwardingFormat' => [
                'type' => Type::INT_TYPE->value,
            ],
            'ShieldDDosProtectionType' => [
                'type' => Type::INT_TYPE->value,
            ],
            'ShieldDDosProtectionEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'OriginHostHeader' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'EnableSmartCache' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableRequestCoalescing' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'RequestCoalescingTimeout' => [
                'type' => Type::INT_TYPE->value,
            ],
        ];
    }
}
