# BaseRequest

## Usage

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\BaseRequest;

$bunnyBase = new BaseRequest(
    '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989'
);
```

## Endpoints

The base request has the following endpoints available:

* [User](#user)
  * [Details](#get-user-details)
* [Billing](#billing)
  * [Details](#get-billing-details)
  * [Summary](#get-billing-summary)
  * [Apply promo code](#apply-promo-code)
* [Statistics](#statistics)
* [Pull Zone](#pull-zone)
    * [](#)
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

### User

#### Get user details.
```php
$bunnyBase->getUserDetails();
```

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
]);
```

### Billing

#### Get billing details.
```php
$bunnyBase->getBillingDetails();
```

#### Get billing summary.
```php
$bunnyBase->getBillingSummary();
```

#### Apply promo code.
```php
$bunnyBase->applyPromoCode([
    'CouponCode' => 'XXXYYYZZZ'
]);
```

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

### Pull Zone

```php

```

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
### Storage Zone

#### List storage zones.

```php
$bunnyBase->listStorageZone([
    'page' => 1,
    'perPage' => 1000,
]);
```

#### Add storage zone.

```php
$bunnyBase->addStorageZone([
    'OriginUrl' => 'https://my-bucket.service.com',
    'Name' => 'My Custom Storage Zone',
    'Region' => 'DE',
    'ReplicationRegions' => [
        'NY',
        'SY',
    ],
]);
```

#### Get storage zone.

```php
$bunnyBase->getStorageZone(1);
```

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

#### Delete storage zone.

```php
$bunnyBase->deleteStorageZone(1);
```

#### Reset storage zone password by path parameter.

```php
$bunnyBase->resetStorageZonePasswordByPath(1);
```

#### Reset storage zone password by query parameter.

```php
$bunnyBase->resetStorageZonePasswordByQuery([
    'id' => 1,
]);
```

#### Reset storage zone ready only password by query parameter.

```php
$bunnyBase->resetStorageZoneReadOnlyPassword([
    'id' => 1,
]);
```


### Stream Video Library

#### List video libraries.

```php
$bunnyBase->listVideoLibraries([
    'page' => 1,
    'perPage' => 1000,
]);
```

#### Add video library.

```php
$bunnyBase->addVideoLibrary([
    'id' => 1,
    'Name' => 'Awesome Video Library',
    'ReplicationRegions' => [
        'SY',
    ]
]);
```

#### Get video library.

```php
$bunnyBase->getVideoLibrary(1);
```

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
]);
```

#### Delete video library.

```php
$bunnyBase->deleteVideoLibrary(1);
```

#### Reset video library password by path parameter.

```php
$bunnyBase->resetVideoLibraryPasswordByPath(1);
```

#### Reset video library password by query parameter.

```php
$bunnyBase->resetVideoLibraryPasswordByQuery([
    'id' => 1,
]);
```

#### Add watermark.

```php
$bunnyBase->addWatermark(1);
```

#### Delete watermark.

```php
$bunnyBase->deleteWatermark(1);
```

#### Add allowed referer.

```php
$bunnyBase->addVideoLibraryAllowedReferer(1, [
    'Hostname' => 'example.com,example.org',
]);
```

#### Remove allowed referer.

```php
$bunnyBase->removeVideoLibraryAllowedReferer(1, [
    'Hostname' => 'example.com',
]);
```

#### Add blocked referer.

```php
$bunnyBase->addVideoLibraryBlockedReferer(1, [
    'Hostname' => 'evil.org',
]);
```

#### Remove blocked referer.

```php
$bunnyBase->removeVideoLibraryBlockedReferer(1, [
    'Hostname' => 'evil.org',
])
```