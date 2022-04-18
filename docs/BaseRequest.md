# Base Request

Manage settings for pull zones, storage, and video libraries through the bunny.net API.

## Usage

Provide the API key available from the **Account Settings** section.

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\BaseRequest;

$bunnyBase = new BaseRequest(
    '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989'
);
```

---

## Endpoints

The base request has the following endpoints available:

* [Abuse Case](#abuse-case)
  * [List](#list-abuse-cases)
  * [Check](#check-abuse-case)
* [Countries](#countries)
* [Regions](#regions)
* [User](#user)
    * [Details](#get-user-details)
    * [Update](#get-user-details)
    * [Reset API key](#reset-api-key)
    * [Close Account](#close-the-account)
    * [DPA](#get-dpa-details)
* [Billing](#billing)
    * [Details](#get-billing-details)
    * [Summary](#get-billing-summary)
    * [Apply promo code](#apply-promo-code)
* [Statistics](#statistics)
* [Pull Zone](#pull-zone)
    * [List](#list-pull-zones)
    * [Add](#add-pull-zone)
    * [Get](#get-pull-zone)
    * [Update](#update-pull-zone)
    * [Delete](#delete-pull-zone)
    * [Delete edge rule](#delete-edge-rule)
    * [Add/Update edge rule](#add-or-update-edge-rule)
    * [Origin Shield statistics](#get-origin-shield-queue-statistics)
    * [SafeHop statistics](#get-safehop-statistics)
    * [Optimizer statistics](#get-optimizer-statistics)
    * [Enable edge rule](#set-edge-rule-enabled)
    * [Statistics](#get-statistics)
    * [Load free certificate](#load-free-certificate)
    * [Purge cache](#purge-cache)
    * [Add custom certificate](#add-custom-certificate-needs-further-testing)
    * [Remove certificate](#remove-certificate)
    * [Add custom Hostname](#add-custom-hostname)
    * [Remove custom Hostname](#remove-custom-hostname)
    * [Force SSL](#set-force-ssl)
    * [Reset token key](#reset-token-key)
    * [Add allowed referer](#add-allowed-referer)
    * [Remove allowed referer](#remove-allowed-referer)
    * [Add blocked referer](#add-blocked-referer)
    * [Remove blocked referer](#remove-blocked-referer)
    * [Add blocked IP](#add-blocked-ip)
    * [Remove blocked IP](#remove-blocked-ip)
* [Purge](#purge)
    * [URL](#purge-url)
    * [URL by headers](#purge-url-by-headers)
* [Storage Zone](#storage-zone)
    * [List](#list-storage-zones)
    * [Add](#add-storage-zone)
    * [Get](#get-storage-zone)
    * [Update](#update-storage-zone)
    * [Delete](#delete-storage-zone)
    * [Reset password by path](#reset-storage-zone-password-by-path-parameter)
    * [Reset password by query](#reset-storage-zone-password-by-query-parameter)
    * [Reset read only password by query](#reset-storage-zone-ready-only-password-by-query-parameter)
* [Stream Video Library](#stream-video-library)
    * [List](#list-video-libraries)
    * [Add](#add-video-library)
    * [Get](#get-video-library)
    * [Update](#update-video-library)
    * [Delete](#delete-video-library)
    * [Reset password by path](#reset-video-library-password-by-path-parameter)
    * [Reset password by query](#reset-video-library-password-by-query-parameter)
    * [Add watermark](#add-watermark)
    * [Delete watermark](#delete-watermark)
    * [Add allowed referer](#add-allowed-referer)
    * [Remove allowed referer](#remove-allowed-referer)
    * [Add blocked referer](#add-blocked-referer)
    * [Remove allowed referer](#remove-allowed-referer)

---

### Abuse Case

#### List abuse cases

```php
$bunnyBase->listAbuseCases([
    'page' => 1,
    'perPage' => 1000,
]);
```

---

#### Check abuse case

```php
$bunnyBase->checkAbuseCase(1);
```

---

### Countries

```php
$bunnyBase->getCountryList();
```

---

### Regions

```php
$bunnyBase->listRegions();
```

---

### User

#### Get user details.

```php
$bunnyBase->getUserDetails();
```

---

#### Update user details.

```php
$bunnyBase->updateUserDetails([
    'FirstName' => 'John',
    'BillingEmail' => 'john.doe@example.com',
    'LastName' => 'Doe',
    'StreetAddress' => '1985 Robinson Court',
    'City' => 'Windom',
    'ZipCode' => '75492',
    'Country' => 'US',
    'CompanyName' => '',
    'VATNumber' => '',
    'ReceiveNotificationEmails' => true,
    'ReceivePromotionalEmails' => false,
    'Password' => '1234Abcd',
    'OldPassword' => 'Abcd1234',
]);
```

---

#### Reset API key.

```php
$bunnyBase->resetUserApiKey();
```

---

#### Close the account.

```php
$bunnyBase->closeTheAccount([
    'Password' => 'Abcd1234',
    'Reason' => 'Just a test.',
]);
```

---

#### Get DPA details.

```php
$bunnyBase->getDpaDetails();
```

---

### Billing

#### Get billing details.

```php
$bunnyBase->getBillingDetails();
```

---

#### Get billing summary.

```php
$bunnyBase->getBillingSummary();
```

---

#### Apply promo code.

```php
$bunnyBase->applyPromoCode([
    'CouponCode' => 'XXXYYYZZZ'
]);
```

---

### Statistics

```php
$bunnyBase->getStatistics([
    'dateFrom' => 'Y-m-d H:i:s',
    'dateTo' => 'Y-m-d H:i:s',
    'pullZone' => 1,
    'serverZoneId' => 2,
    'loadErrors' => true,
    'hourly' => false,
]);
```

---

### Pull Zone

#### List pull zones.

```php
$bunnyBase->listPullZones([
    'page' => 1,
    'perPage' => 1000,
    'includeCertificate' => true,
]);
```

---

#### Add pull zone.

```php
// External bucket
$bunnyBase->addPullZone([
    'Name' => 'my-pullzone-1',
    'OriginUrl' => 'https://my-bucket.service.com',
    'Type' => 0,
]);

// Bunny Storage Zone
$bunnyBase->addPullZone([
    'Name' => 'my-pullzone-1',
    'StorageZoneId' => 123456,
    'Type' => 0,
    'EnableAutoSSL' => true,
]);
```

---

#### Get pull zone.

```php
$bunnyBase->getPullZone(1);
```

```php
$bunnyBase->getPullZone(1, [
    'includeCertificate' => true,
]);
```

---

#### Update pull zone.

```php
$bunnyBase->updatePullZone(1, [
  'OriginUrl' => 'https://my-bucket-2.service.com',
  'AllowedReferrers' => [
      '*.example.com',
      '*.example.org',
  ],
  'BlockedReferrers' => [
      '*.bad.com',
      '*.evil.org',
  ],
  'BlockedIps' => [
      '12.345.65.89',
      '10.111.21.31',
  ],
  'EnableGeoZoneUS' => true,
  'EnableGeoZoneEU' => true,
  'EnableGeoZoneASIA' => true,
  'EnableGeoZoneSA' => true,
  'EnableGeoZoneAF' => true,
  'BlockRootPathAccess' => false,
  'BlockPostRequests' => false,
  'EnableQueryStringOrdering' => true,
  'EnableWebpVary' => false,
  'EnableAvifVary' => false,
  'EnableMobileVary' => false,
  'EnableCountryCodeVary' => false,
  'EnableHostnameVary' => false,
  'EnableCacheSlice' => false,
  'ZoneSecurityEnabled' => false,
  'ZoneSecurityIncludeHashRemoteIP' => false,
  'IgnoreQueryStrings' => true,
  'MonthlyBandwidthLimit' => 0,
  'AccessControlOriginHeaderExtensions' => [
      'eot', 
      'ttf',
      'woff',
      'woff2',
      'css',
  ],
  'EnableAccessControlOriginHeader' => true,
  'DisableCookies' => true,
  'BudgetRedirectedCountries' => [
      'US',
      'RU',
      'JP',
  ],
  'BlockedCountries' => [
      'DE',
      'ZA',
      'AR',
  ],
  'CacheControlMaxAgeOverride' => 30,
  'CacheControlBrowserMaxAgeOverride' => 157784760,
  'AddHostHeader' => false,
  'AddCanonicalHeader' => false,
  'EnableLogging' => true,
  'LoggingIPAnonymizationEnabled' => true,
  'PermaCacheStorageZoneId' => 0,
  'AWSSigningEnabled' => false,
  'AWSSigningKey' => null,
  'AWSSigningRegionName' => null,
  'AWSSigningSecret' => null,
  'EnableOriginShield' => false,
  'OriginShieldZoneCode' => 'FR',
  'EnableTLS1' => true,
  'EnableTLS1_1' => true,
  'CacheErrorResponses' => false,
  'VerifyOriginSSL' => false,
  'LogForwardingEnabled' => false,
  'LogForwardingHostname' => null,
  'LogForwardingPort' => 0,
  'LogForwardingToken' => null,
  'LogForwardingProtocol' => 0,
  'LoggingSaveToStorage' => false,
  'LoggingStorageZoneId' => 0,
  'FollowRedirects' => false,
  'ConnectionLimitPerIPCount' => 0,
  'RequestLimit' => 0,
  'ErrorPageEnableCustomCode' => false,
  'ErrorPageCustomCode' => null,
  'ErrorPageEnableStatuspageWidget' => false,
  'ErrorPageStatuspageCode' => null,
  'ErrorPageWhitelabel' => false,
  'OptimizerEnabled' => false,
  'OptimizerDesktopMaxWidth' => 1600,
  'OptimizerMobileMaxWidth' => 800,
  'OptimizerImageQuality' => 85,
  'OptimizerMobileImageQuality' => 70,
  'OptimizerEnableWebP' => true,
  'OptimizerEnableManipulationEngine' => true,
  'OptimizerMinifyCSS' => true,
  'OptimizerMinifyJavaScript' => true,
  'OptimizerWatermarkEnabled' => true,
  'OptimizerWatermarkUrl' => '',
  'OptimizerWatermarkPosition' => 0,
  'OptimizerWatermarkOffset' => 3,
  'OptimizerWatermarkMinImageSize' => 300,
  'OptimizerAutomaticOptimizationEnabled' => true,
  'OptimizerClasses' => [],
  'OptimizerForceClasses' => false,
  'Type' => 0,
  'OriginRetries' => 0,
  'OriginConnectTimeout' => 10,
  'OriginResponseTimeout' => 60,
  'UseStaleWhileUpdating' => false,
  'UseStaleWhileOffline' => false,
  'OriginRetry5XXResponses' => false,
  'OriginRetryConnectionTimeout' => true,
  'OriginRetryResponseTimeout' => true,
  'OriginRetryDelay' => 0,
  'QueryStringVaryParameters' => [],
  'OriginShieldEnableConcurrencyLimit' => false,
  'OriginShieldMaxConcurrentRequests' => 5000,
  'EnableCookieVary' => false,
  'CookieVaryParameters' => [],
  'EnableSafeHop' => false,
  'OriginShieldQueueMaxWaitTime' => 30,
  'OriginShieldMaxQueuedRequests' => 5000,
  'UseBackgroundUpdate' => false,
  'EnableAutoSSL' => false,
  'LogFormat' => 0,
  'LogForwardingFormat' => 0,
  'ShieldDDosProtectionType' => 1,
  'ShieldDDosProtectionEnabled' => false,
]);
```

*Note*:

* `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The UI will
  show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
* `OriginShieldZoneCode` accepts either the 2 digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
* `WAFEnabled`, `WAFDisabledRuleGroups`, `WAFEnableRequestHeaderLogging` and `WAFRequestHeaderIgnores` are not yet
  implemented. This feature is currently being worked on and does not
  have an ETA. It is advised **not** to update these values until the feature is implemented, therefore these options
  are removed from the example above.

---

#### Delete pull zone.

```php
$bunnyBase->deletePullZone(1);
```

---

#### Delete edge rule.

```php
$bunnyBase->deleteEdgeRule(1, 'b697018b-a587-403f-b0d0-aa5062ff7467');
```

---

#### Add or update edge rule.

```php
$bunnyBase->addOrUpdateEdgeRule(1, [
    'Guid' => 'b697018b-a587-403f-b0d0-aa5062ff7467',
    'ActionType' => 4,
    'ActionParameter1' => '',
    'ActionParameter2' => '',
    'Triggers' => [
        [
            'Type' => 0,
            'PatternMatches' => [
                'https://example.b-cdn.net/images/*',
                'https://example.b-cdn.net/videos/*',
            ],
            'PatternMatchingType' => 0,
            'Parameter1' => '',
        ],
        [
            'Type' => 5,
            'PatternMatches' => [
                '12.345.67.89',
                '10.111.21.31',
            ],
            'PatternMatchingType' => 0,
            'Parameter1' => '',
        ],
    ],
    'TriggerMatchingType' => 0,
    'Description' => 'My new edge rule',
    'Enabled' => true,
]);
```

*Note*:

* `ActionType` can be specified as one of the following integer values:

| *Value*    | *API description* | *UI description* |
| ----------- | ----------- | ----------- |
| 0 | ForceSSL | Force SSL |
| 1 | Redirect | Redirect To URL |
| 2 | OriginUrl | Change Origin URL |
| 3 | OverrideCacheTime | Override Cache Time |
| 4 | BlockRequest | Block Request |
| 5 | SetResponseHeader | Set Response header |
| 6 | SetRequestHeader | Set Request Header |
| 7 | ForceDownload | Force Download |
| 8 | DisableTokenAuthentication | Disable Token Authentication |
| 9 | EnableTokenAuthentication | Enable Token Authentication |
| 10 | OverrideCacheTimePublic | - |
| 11 | IgnoreQueryString | Ignore Cache Vary: URL Query String |
| 12 | DisableOptimizer | Disable Bunny Optimizer |
| 13 | ForceCompression | - |
| 14 | -| Set Status Code |
| 15 | -| Bypass Perma-Cache |
| 16 | - | Override Browser Cache Time |

* `Type` in a `Trigger` object can be specified as one of the following integer values:

| *Value*    | *API description* | *UI description* |
| ----------- | ----------- | ----------- |
| 0 | Url | Request Header |
| 1 | RequestHeader | Request Header |
| 2 | ResponseHeader | Response Header |
| 3 | UrlExtension | File Extension |
| 4 | CountryCode | Country Code (2 letter) |
| 5 | RemoteIP | Remote IP |
| 6 | UrlQueryString | Query String |
| 7 | RandomChance | Random Chance (%) |
| 8 | - | Status Code |
| 9 | - | Request method |

* `TriggerMatchingType` can be specified as one of the following integer values:

| *Value*    | *API description* | *UI description* |
| ----------- | ----------- | ----------- |
| 0 | MatchAny | Match Any |
| 1 | MatchAll | Match All |
| 2 | MatchNone | Match None |

---

#### Set edge rule enabled.

```php
$bunnyBase->setEdgeRuleEnabled(1, 'b697018b-a587-403f-b0d0-aa5062ff7467', [
    'Id' => 1,
    'Value' => false,
]);
```

*Note*:

* The `Id` denotes the pull zone ID (the same as the first argument) and is a required parameter.

---

#### Get origin shield queue statistics

```php
$bunnyBase->getOriginShieldQueueStatistics(1, [
    'dateFrom' => 'Y-m-d H:i:s',
    'dateTo' => 'Y-m-d H:i:s',
    'hourly' => false,
]);
```

---

#### Get SafeHop statistics

```php
$bunnyBase->getSafeHopStatistics(1, [
    'dateFrom' => 'Y-m-d H:i:s',
    'dateTo' => 'Y-m-d H:i:s',
    'hourly' => false,
]);
```

---

#### Get Optimizer statistics

```php
$bunnyBase->getOptimizerStatistics(1, [
    'dateFrom' => 'Y-m-d H:i:s',
    'dateTo' => 'Y-m-d H:i:s',
    'hourly' => false,
]);
```

---

#### Get statistics.

```php
$bunnyBase->getStatisticsPullZone(1, [
    'dateFrom' => 'Y-m-d H:i:s',
    'dateTo' => 'Y-m-d H:i:s',
    'hourly' => false,
]);
```

---

#### Load free certificate.

```php
$bunnyBase->loadFreeCertificate([
    'hostname' => 'cdn.example.com'
]);
```

---

#### Purge cache.

```php
$bunnyBase->purgeCache(1);
```

---

#### Add custom certificate.

```php
$bunnyBase->addCustomCertificate(1, [
    'Hostname' => 'cdn.example.com',
    'Certificate' => base64_encode(file_get_contents('/certs/cert.pem')),
    'CertificateKey' => base64_encode(file_get_contents('/certs/key.pem')),
]);
```

---

#### Remove certificate.

```php
$bunnyBase->removeCertificate(1, [
    'Hostname' => 'cdn.example.com',
]);
```

---

#### Add custom hostname.

```php
$bunnyBase->addCustomHostname(1, [
    'Hostname' => 'cdn.example.com',
]);
```

---

#### Remove custom hostname.

```php
$bunnyBase->removeCustomHostname(1, [
    'Hostname' => 'cdn.example.com',
]);
```

---

#### Set force SSL.

```php
$bunnyBase->setForceSSL(1, [
    'Hostname' => 'cdn.example.com',
    'ForceSSL' => true,
]);
```

---

#### Reset token key.

```php
$bunnyBase->resetPullZoneTokenKey(1);
```

---

#### Add allowed referer.

```php
// Single
$bunnyBase->addPullZoneAllowedReferer(1, [
    'Hostname' => '*.example.com',
]);

// Multiple
$bunnyBase->addPullZoneAllowedReferer(1, [
    'Hostname' => '*.example.com,*.example.org',
]);
```

*Note*:

* Adding of allowed referer allows for multiple domains through comma separated values. Other endpoints, like removing
  the allowed referer, or adding/removing blocked referer do not support this.

---

#### Remove allowed referer.

```php
$bunnyBase->removePullZoneAllowedReferer(1, [
    'Hostname' => '*.example.com',
]);
```

---

#### Add blocked referer.

```php
$bunnyBase->addPullZoneBlockedReferer(1, [
    'Hostname' => '*.evil.org',
]);
```

---

#### Remove blocked referer.

```php
$bunnyBase->removePullZoneBlockedReferer(1, [
    'Hostname' => '*.evil.org',
]);
```

---

#### Add blocked IP.

```php
$bunnyBase->addPullZoneBlockedIP(1, [
    'BlockedIp' => '12.345.67.89',
]);
```

---

#### Remove Blocked IP.

```php
$bunnyBase->removePullZoneBlockedIP(1, [
    'BlockedIp' => '12.345.67.89',
]);
```

---

### Purge

#### Purge URL.

```php
// Single file
$bunnyBase->purgeUrl([
    'url' => 'https://myzone.b-cdn.net/css/style.css',
]);

// Wildcard
$bunnyBase->purgeUrl([
    'url' => 'https://myzone.b-cdn.net/css/*',
]);
```

---

#### Purge URL by headers.

```php
// Single file
$bunnyBase->purgeUrlbyHeader([
    'url' => 'https://myzone.b-cdn.net/css/style.css',
    'headerName' => 'CustomHeaderName',
    'headerValue' => 'CustomHeaderValue',
]);

// Wildcard
$bunnyBase->purgeUrlbyHeader([
    'url' => 'https://myzone.b-cdn.net/css/*',
    'headerName' => 'CustomHeaderName',
    'headerValue' => 'CustomHeaderValue',
]);
```

---

### Storage Zone

#### List storage zones.

```php
$bunnyBase->listStorageZone([
    'page' => 1,
    'perPage' => 1000,
]);
```

---

#### Add storage zone.

```php
$bunnyBase->addStorageZone([
    'OriginUrl' => 'https://my-backup-bucket.service.com',
    'Name' => 'My Custom Storage Zone',
    'Region' => 'DE',
    'ReplicationRegions' => [
        'NY',
        'SY',
    ],
]);
```

*Note*:

* The `OriginUrl` parameter allows you to specify a backup data source, in case the file does not exist on the Storage
  Zone.
  So for example, you would request `/image.png`. Assuming `image.png` doesn't exist on the storage zone,
  the system will try to proxy and fetch it from the `OriginUrl` instead.

---

#### Get storage zone.

```php
$bunnyBase->getStorageZone(1);
```

---

#### Update storage zone.

```php
$bunnyBase->updateStorageZone(1, [
    'ReplicationZones' => [
        'LA',
        'SG',
    ],
    'OriginUrl' => 'https://my-bucket.service.com',
    'Custom404FilePath' => '/bunnycdn_errors/404.html',
    'Rewrite404To200' => true,
]);
```

---

#### Delete storage zone.

```php
$bunnyBase->deleteStorageZone(1);
```

---

#### Reset storage zone password by path parameter.

```php
$bunnyBase->resetStorageZonePasswordByPath(1);
```

---

#### Reset storage zone password by query parameter.

```php
$bunnyBase->resetStorageZonePasswordByQuery([
    'id' => 1,
]);
```

---

#### Reset storage zone ready only password by query parameter.

```php
$bunnyBase->resetStorageZoneReadOnlyPassword([
    'id' => 1,
]);
```

---

### Stream Video Library

#### List video libraries.

```php
$bunnyBase->listVideoLibraries([
    'page' => 1,
    'perPage' => 1000,
    'includeAccessKey' => false,
]);
```

---

#### Add video library.

```php
$bunnyBase->addVideoLibrary([
    'id' => 1,
    'Name' => 'Awesome Video Library',
    'ReplicationRegions' => [
        'SY',
    ],
]);
```

---

#### Get video library.

```php
$bunnyBase->getVideoLibrary(1);
```

```php
$bunnyBase->getVideoLibrary(1, [
    'includeAccessKey' => true,
]);
```

---

#### Update video library.

```php
$bunnyBase->updateVideoLibrary(1, [
    'Name' => 'Awesome Video Library V2',
    'CustomHTML' => '<style>.plyr--full-ui input[type=range]{color: purple}</style>',
    'PlayerKeyColor' => '6a329f',
    'EnableTokenAuthentication' => true,
    'EnableTokenIPVerification' => false,
    'ResetToken' => false,
    'WatermarkPositionLeft' => 0,
    'WatermarkPositionTop' => 0,
    'WatermarkWidth' => 0,
    'WatermarkHeight' => 0,
    'EnabledResolutions' => '240p,360p,480p,720p,1080p,1440p,2160p',
    'ViAiPublisherId' => '',
    'VastTagUrl' => '',
    'WebhookUrl' => 'https://example.com/video-status',
    'CaptionsFontSize' => 20,
    'CaptionsFontColor' => 'white',
    'CaptionsBackground' => 'black',
    'UILanguage' => 'GR',
    'AllowEarlyPlay' => true,
    'PlayerTokenAuthenticationEnabled' => true,
    'BlockNoneReferrer' => true,
    'EnableMP4Fallback' => true,
    'KeepOriginalFiles' => true,
    'AllowDirectPlay' => true,
    'EnableDRM' => false,
    'Controls' => 'play-large,play,progress,current-time,mute,volume,captions,settings,pip,airplay,fullscreen',
    'Bitrate240p' => 600,
    'Bitrate360p' => 800,
    'Bitrate480p' => 1400,
    'Bitrate720p' => 2800,
    'Bitrate1080p' => 5000,
    'Bitrate1440p' => 8000,
    'Bitrate2160p' => 25000,
    'ShowHeatmap' => false,
    'EnableContentTagging' => true,    
]);
```

---

#### Delete video library.

```php
$bunnyBase->deleteVideoLibrary(1);
```

---

#### Reset video library password by path parameter.

```php
$bunnyBase->resetVideoLibraryPasswordByPath(1);
```

---

#### Reset video library password by query parameter.

```php
$bunnyBase->resetVideoLibraryPasswordByQuery([
    'id' => 1,
]);
```

---

#### Add watermark.

```php
$bunnyBase->addWatermark(1);
```

---

#### Delete watermark.

```php
$bunnyBase->deleteWatermark(1);
```

---

#### Add allowed referer.

```php
// Single
$bunnyBase->addVideoLibraryAllowedReferer(1, [
    'Hostname' => '*.example.com',
]);

// Multiple
$bunnyBase->addVideoLibraryAllowedReferer(1, [
    'Hostname' => '*.example.com,*.example.org',
]);
```

*Note*:

* Adding of allowed referer allows for multiple domains through comma separated values. Other endpoints, like removing
  the allowed referer, or adding/removing blocked referer do not support this.

---

#### Remove allowed referer.

```php
$bunnyBase->removeVideoLibraryAllowedReferer(1, [
    'Hostname' => 'example.com',
]);
```

---

#### Add blocked referer.

```php
$bunnyBase->addVideoLibraryBlockedReferer(1, [
    'Hostname' => 'evil.org',
]);
```

---

#### Remove blocked referer.

```php
$bunnyBase->removeVideoLibraryBlockedReferer(1, [
    'Hostname' => 'evil.org',
]);
```