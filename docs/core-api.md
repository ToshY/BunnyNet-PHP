# Core Platform API

The Core Platform API provides a RESTful interface for managing your bunny.net account and all associated resources. Create and configure pull zones, manage storage, set up DNS, and access billing and statistics.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyHttpClient;
use ToshY\BunnyNet\Enum\Endpoint;

$bunnyHttpClient = new BunnyHttpClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
    // Provide the account API key.
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    baseUrl: Endpoint::BASE
);
```

## Usage

### Abuse Case

#### List Abuse Cases

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\AbuseCase\ListAbuseCases(
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
)
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get DMCA Case

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\AbuseCase\GetDmcaCase(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Abuse Case

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\AbuseCase\GetAbuseCase(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Resolve DMCA Case

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\AbuseCase\ResolveDmcaCase(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Resolve Abuse Case

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\AbuseCase\ResolveAbuseCase(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Check Abuse Case

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\AbuseCase\CheckAbuseCase(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### Auth

#### Auth JWT 2FA

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Auth\AuthJwt2fa(
        body: [
            'Code' => 'abc',
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Refresh JWT

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Auth\RefreshJwt()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### Countries

#### [List Countries](https://docs.bunny.net/reference/countriespublic_getcountrylist)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Countries\ListCountries()
);
```

### API Keys

#### [List API Keys](https://docs.bunny.net/reference/apikeypublic_listapikeys)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\ApiKeys\ListApiKeys(
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

### Billing

#### Get Billing Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingDetails()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Configure Auto Recharge

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\ConfigureAutoRecharge(
        body: [
            'AutoRechargeEnabled' => true,
            'PaymentMethodToken' => 1000,
            'PaymentAmount' => 10,
            'RechargeTreshold' => 2,
        ],
    )
);
```

??? note

    - The key `RechargeTreshold` (misspelled) has a value range of 2-2000.
    - The key `PaymentAmount` has a value range of 10-2000.

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Create Payment Checkout

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\CreatePaymentCheckout(
        body: [
            'RechargeAmount' => 10,
            'PaymentAmount' => 10,
            'PaymentRequestId' => 123456,
            'Nonce' => 'ab',
        ],
    )
);
```

??? note

    - The key `PaymentAmount` has a value range of 10-2000.

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Prepare Payment Authorization

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\PreparePaymentAuthorization()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Affiliate Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\GetAffiliateDetails()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Claim Affiliate Credits

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\ClaimAffiliateCredits()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get The Coinify Bitcoin exchange rate

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\GetCoinifyBitcoinExchangeRate()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Create Coinify payment

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\CreateCoinifyPayment(
        query: [
            'amount' => 123,
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Billing Summary

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingSummary()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Billing Summary PDF

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingSummaryPDF(
        billingRecordId: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Apply Promo Code

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Billing\ApplyPromoCode(
        query: [
            'CouponCode' => 'YOUFOUNDME',
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### Support

#### List Tickets

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Support\ListTickets(
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Ticket Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Support\GetTicketDetails(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Close Ticket

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Support\CloseTicket(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Reply Ticket

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Support\ReplyTicket(
        id: 1,
        body: [
            'Message' => 'Hope you are having a nice day!\n\nThe weather is nice outside.',
            'Attachments' => [
                [
                    'Body' => 'aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1kUXc0dzlXZ1hjUQ==',
                    'FileName' => 'details.txt',
                    'ContentType' => 'text/plain',
                ],
            ],
        ],
    )
);
```

??? note

    - The key `Body` requires its contents to be base64 encoded.

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Create Ticket

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Support\CreateTicket(
        id: 1,
        body: [
            'Subject' => 'Good day!',
            'LinkedPullZone' => 1,
            'LinkedVideoLibrary' => 3,
            'LinkedDnsZone' => 4,
            'Message' => 'Hope you are having a nice day!\n\nThe weather is nice outside.',
            'LinkedStorageZone' => 2,
            'Attachments' => [
                [
                    'Body' => 'aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1kUXc0dzlXZ1hjUQ==',
                    'FileName' => 'details.txt',
                    'ContentType' => 'text/plain',
                ],
            ],
        ],
    )
);
```

??? note

    - The keys `LinkedPullZone` and `LinkedStorageZone` are not required unlike stated in the API specifications.
    - The key `Body` requires its contents to be base64 encoded.

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### DRM Certificate

#### List DRM Certificates

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DrmCertificate\ListDrmCertificates(	
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### Integrations

#### Get GitHub Integration

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Integration\GetGitHubIntegration()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

??? info

    This endpoint returns the following response:
    ```json
    {
      "Accounts": [
        {
          "Id": 1,
          "Name": "MyConnectedGitHubUsername"
        }
      ]
    }
    ```
    The `id` can be used as `IntegrationId` for the [Add Edge Script](edge-scripting-api.md#add-edge-script) endpoint.

### Region

#### [List Regions](https://docs.bunny.net/reference/regionpublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Region\ListRegions()
);
```

### Stream Video Library

#### [List Video Libraries](https://docs.bunny.net/reference/videolibrarypublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ListVideoLibraries(
        query: [
            'page' => 0,
            'perPage' => 1000,
            'search' => 'bunny',
        ],
    )
);
```

??? note

    - The key `search` is currently not functional.

#### [Add Video Library](https://docs.bunny.net/reference/videolibrarypublic_add)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddVideoLibrary(
        body: [
            'Name' => 'New Video Library',
            'ReplicationRegions' => [
                'UK',
                'SE',
                'NY',
                'LA',
                'SG',
                'SYD',
                'BR',
                'JH',
            ],
            'PlayerVersion' => 1,
        ],
    )
);
```

??? note

    - The key `ReplicationRegions` has the following possible values:
        - `UK` = London (United Kingdom)
        - `SE` = Norway (Stockholm)
        - `NY` = New York (United States East)
        - `LA` = Los Angeles (United States West)
        - `SG` = Singapore (Singapore)
        - `SYD` = Sydney (Oceania)
        - `BR` = Sao Paulo (Brazil)
        - `JH` = Johannesburg (Africa)
    - The key `PlayerVersion` has the following possible values:
        - `1` = Default video player
        - `2` = Beta video player

#### [Get Video Library](https://docs.bunny.net/reference/videolibrarypublic_index2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetVideoLibrary(	
        id: 1,
    ),
);
```

#### [Update Video Library](https://docs.bunny.net/reference/videolibrarypublic_update)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\UpdateVideoLibrary(
        id: 1,
        body: [
            'Name' => 'New Video Library V2',
            'CustomHTML' => '<style>.plyr--full-ui input[type=range]{color: purple}</style>',
            'PlayerKeyColor' => '6a329f',
            'EnableTokenAuthentication' => true,
            'EnableTokenIPVerification' => false,
            'ResetToken' => false,
            'WatermarkPositionLeft' => 0,
            'WatermarkPositionTop' => 0,
            'WatermarkWidth' => 0,
            'WatermarkHeight' => 0,
            'EnabledResolutions' => '720p,1080p,1440p,2160p',
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
            'DrmVersion' => 0,
            'Controls' => 'play,progress,current-time,mute,volume,pip,fullscreen',
            'PlaybackSpeeds' => '0.25,0.5,0.75,1.0,1.25,1.5,1.75,2.0,2.5,3,3.5,4',
            'Bitrate240p' => 600,
            'Bitrate360p' => 800,
            'Bitrate480p' => 1400,
            'Bitrate720p' => 2800,
            'Bitrate1080p' => 5000,
            'Bitrate1440p' => 8000,
            'Bitrate2160p' => 25000,
            'ShowHeatmap' => false,
            'EnableContentTagging' => true,
            'FontFamily' => 'Arial',
            'EnableTranscribing' => false,
            'EnableTranscribingTitleGeneration' => false,
            'EnableTranscribingDescriptionGeneration' => false,
            'EnableTranscribingChaptersGeneration' => false,
            'EnableTranscribingMomentsGeneration' => false,
            'TranscribingCaptionLanguages' => [],
            'EnableCaptionsInPlaylist' => true,
            'RememberPlayerPosition' => true,
            'EnableMultiAudioTrackSupport' => true,
            'UseSeparateAudioStream' => true,
            'JitEncodingEnabled' => true,
            'EncodingTier' => 0,
            'OutputCodecs' => 'x264,vp9,hevc,av1',
            'AppleFairPlayDrm' => [
                'Enabled' => false,
            ],
            'GoogleWidevineDrm' => [
                'Enabled' => false,
                'SdOnlyForL3' => false,
                'MinClientSecurityLevel' => 0,
            ],
            'PlayerVersion' => 1,
            'RemoveMetadataFromFallbackVideos' => false,
            'ScaleVideoUsingBothDimensions' => true,
            'ExposeOriginals' => false,
            'ExposeVideoMetadata' => false,
        ],
    )
);
```

??? note

    - The key `EnabledResolutions` has the following possible values (comma separated):
        - `240p`
        - `360p`
        - `480p`
        - `720p`
        - `1080p`
        - `1440p`
        - `2160p`
    - The key `Controls` has the following possible values (comma separated):
        - `play-large`
        - `play`
        - `progress`
        - `current-time`
        - `mute`
        - `volume`
        - `captions`
        - `settings`
        - `pip`
        - `airplay`
        - `fullscreen`
    - The key `MinClientSecurityLevel` has the following possible values:
        - `0` = `None`
        - `1` = `L1`
        - `2` = `L2`
        - `3` = `L3`
    - The key `DrmVersion` has the following possible values:
        - `0` = `Basic`
        - `1` = `Enterprise`
        - `2` = `BasicV2`
    - To get a full list of possible value options for key `TranscribingCaptionLanguages`, see the [Get Languages](#get-languages) endpoint.
    - The key `EncodingTier` has the following possible values:
        - `0` = `Free`
        - `1` = `Premium`

#### [Delete Video Library](https://docs.bunny.net/reference/videolibrarypublic_delete)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteVideoLibrary(
        id: 1,
    )
);
```

#### [Get Video Library Transcribing Statistics](https://docs.bunny.net/reference/gettranscribingstatistics_statistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetTranscribingStatistics(
        id: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
        ],
    )
);
```

#### [Get Video Library DRM Statistics](https://docs.bunny.net/reference/getdrmstatisticsendpoint_statistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetDrmStatistics(
        id: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
        ],
    )
);
```

#### [Get Languages](https://docs.bunny.net/reference/videolibrarypublic_index3)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetLanguages()
);
```

#### [Reset Password](https://docs.bunny.net/reference/videolibrarypublic_resetpassword)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ResetPassword(
        query: [
            'id' => 1,
        ],
    )
);
```

#### [Reset Password (by path parameter)](https://docs.bunny.net/reference/videolibrarypublic_resetpassword2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ResetPasswordByPathParameter(
        id: 1,
    )
);
```

#### [Add Watermark](https://docs.bunny.net/reference/videolibrarypublic_addwatermark)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddWatermark(   		
        id: 1,
    )
);
```

#### [Delete Watermark](https://docs.bunny.net/reference/videolibrarypublic_deletewatermark)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteWatermark(
        id: 1,
    )
);
```

#### [Add Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddAllowedReferer(
        id: 1,
        body: [
            'Hostname' => '*.example.com,*.example.org',
        ],
    )
);
```

??? note

    - The key `Hostname` allows multiple values through comma separated values.

#### [Remove Allowed Referer](https://docs.bunny.net/reference/videolibrarypublic_removeallowedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\RemoveAllowedReferer(
        id: 1,
        body: [
            'Hostname' => '*.example.com',
        ],
    )
);
```

??? note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked Referer](https://docs.bunny.net/reference/videolibrarypublic_addblockedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddBlockedReferer(
        id: 1,
        body: [
            'Hostname' => 'evil.org',
        ],
    )
);
```

??? note

    - The key `Hostname` does *not* allow multiple values.

#### [Remove Blocked Referer](https://docs.bunny.net/reference/videolibrarypublic_removeblockedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\RemoveBlockedReferer(
        id: 1,
        body: [
            'Hostname' => 'evil.org',
        ],
    )
);
```

??? note

    - The key `Hostname` does *not* allow multiple values.

#### Add Live Watermark

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddLiveWatermark(
        id: 1,
    )
);
```

#### Add Live Thumbnail

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddLiveThumbnail(
        id: 1,
    )
);
```

#### Delete Live Watermark

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteLiveWatermark(
        id: 1,
    )
);
```

#### Delete Live Thumbnail

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteLiveThumbnail(
        id: 1,
    )
);
```

#### Reset Read-Only API Key

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ResetReadOnlyApiKey(
        query: [
            'id' => 1,
        ],
    )
);
```

#### Reset Read-Only API Key (by path parameter)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ResetReadOnlyApiKeyByPath(
        id: 1,
    )
);
```

### DNS Zone

#### [List DNS Zones](https://docs.bunny.net/reference/dnszonepublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\ListDnsZones(
        query: [
            'page' => 1,
            'perPage' => 1000,
            'search' => 'bunny.net',
        ],
    )
);
```

??? note

    - The key `search` can be used to filter on `Id` or `Domain`. A search value with an `Id` value will perform an exact match,
    whereas a search value with a `Domain` will perform a wildcard search: `bunny`, `nny` and `.net` will all match the DNS zone for `bunny.net`.

#### [Add DNS Zone](https://docs.bunny.net/reference/dnszonepublic_add)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\AddDnsZone(	
        body: [
            'Domain' => 'example.com',
            'Records' => [
                [
                    'Type' => 3,
                    'Ttl' => 15,
                    'Value' => 'My TXT Value',
                    'Name' => '',
                    'Weight' => 0,
                    'Priority' => 0,
                    'Flags' => 0,
                    'Tag' => '',
                    'Port' => 0,
                    'PullZoneId' => 0,
                    'ScriptId' => 0,
                    'Accelerated' => false,
                    'MonitorType' => 0,
                    'GeolocationLatitude' => 0,
                    'GeolocationLongitude' => 0,
                    'LatencyZone' => null,
                    'SmartRoutingType' => 0,
                    'Disabled' => false,
                    'EnviromentalVariables' => [
                        [
                            'Name' => 'Hello',
                            'Value' => 'World',
                        ],
                    ],
                    'Comment' => '',
                    'AutoSslIssuance' => true
                ],
            ],
        ],
    )
);
```

??? note

    - The key `EnviromentalVariables` is misspelled in the API specifications.
    - The key `Type` has the following possible values:
        - `0` = `A`
        - `1` = `AAAA`
        - `2` = `CNAME`
        - `3` = `TXT`
        - `4` = `MX`
        - `5` = `RDR` (Redirect)
        - `6` = `Flatten`
        - `7` = `PZ` (Pull Zone)
        - `8` = `SRV`
        - `9` = `CAA`
        - `10` = `PTR`
        - `11` = `SCR` (Script)
        - `12` = `NS`
    - The key `ScriptId` is not returned in the response.
    - The key `MonitorType` has the following possible values:
        - `0` = `None`
        - `1` = `Ping`
        - `2` = `HTTP`
        - `3` = `Monitor`
    - The key `SmartRoutingType` has the following possible values:
        - `0` = `None`
        - `1` = `Latency`
        - `2` = `Geolocation`
    - The key `AutoSslIssuance` controls whether automatic SSL certificates should be issued for this record.

#### [Get DNS Zone](https://docs.bunny.net/reference/dnszonepublic_index2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\GetDnsZone(
        id: 1,
    )
);
```

#### [Update DNS Zone](https://docs.bunny.net/reference/dnszonepublic_update)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\UpdateDnsZone(
        id: 1,
        body: [
            'CustomNameserversEnabled' => true,
            'Nameserver1' => 'abbby.ns.cloudflare.com',
            'Nameserver2' => 'jonah.ns.cloudflare.com',
            'SoaEmail' => 'admin@example.com',
            'LoggingEnabled' => true,
            'LogAnonymizationType' => 0,
            'CertificateKeyType' => 0,
            'LoggingIPAnonymizationEnabled' => true,
        ],
    )
);
```

??? note

    - The key `LogAnonymizationType` has the following possible values:
        - `0` = `OneDigit`
        - `1` = `Drop`
    - The key `CertificateKeyType` has the following possible values:
        - `0` = `Ecdsa`
        - `1` = `Rsa`
    - In order to disable `LoggingIPAnonymizationEnabled` you first need to agree to the DPA agreement (GDPR).

#### [Delete DNS Zone](https://docs.bunny.net/reference/dnszonepublic_delete)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\DeleteDnsZone(
        id: 1,
    )
);
```

#### [Enable DNSSEC on DNS Zone](https://docs.bunny.net/reference/managednszonednssecendpoint_enablednssecdnszone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\EnableDnssecOnDnsZone(
        id: 1,
    )
);
```

#### [Disable DNSSEC on DNS Zone](https://docs.bunny.net/reference/managednszonednssecendpoint_disablednssecdnszone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\DisableDnssecOnDnsZone(
        id: 1,
    )
);
```

#### [Export DNS Zone](https://docs.bunny.net/reference/dnszonepublic_export)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\ExportDnsRecords(
        id: 1,
    )
);
```

#### [Check DNS Zone Availability](https://docs.bunny.net/reference/dnszonepublic_checkavailability)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\CheckDnsZoneAvailability(
        body: [
            'Name' => 'example.com',
        ],
    )
);
```

#### [Add DNS Record](https://docs.bunny.net/reference/dnszonepublic_addrecord)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\AddDnsRecord(
        zoneId: 1,
        body: [
            'Type' => 3,
            'Ttl' => 15,
            'Value' => 'My TXT Value',
            'Name' => '',
            'Weight' => 0,
            'Priority' => 0,
            'Flags' => 0,
            'Tag' => '',
            'Port' => 0,
            'PullZoneId' => 0,
            'ScriptId' => 0,
            'Accelerated' => false,
            'MonitorType' => 0,
            'GeolocationLatitude' => 0,
            'GeolocationLongitude' => 0,
            'LatencyZone' => null,
            'SmartRoutingType' => 0,
            'Disabled' => false,
            'EnviromentalVariables' => [
                [
                    'Name' => 'Hello',
                    'Value' => 'World',
                ],
            ],
            'Comment' => '',
            'AutoSslIssuance' => true
        ],
    )
);
```

??? note

    - The key `EnviromentalVariables` is misspelled in the API specifications.
    - The key `Type` has the following possible values:
        - `0` = `A`
        - `1` = `AAAA`
        - `2` = `CNAME`
        - `3` = `TXT`
        - `4` = `MX`
        - `5` = `RDR` (Redirect)
        - `6` = `Flatten`
        - `7` = `PZ` (Pull Zone)
        - `8` = `SRV`
        - `9` = `CAA`
        - `10` = `PTR`
        - `11` = `SCR` (Script)
        - `12` = `NS`
    - The key `ScriptId` is not returned in the response.
    - The key `MonitorType` has the following possible values:
        - `0` = `None`
        - `1` = `Ping`
        - `2` = `HTTP`
        - `3` = `Monitor`
    - The key `SmartRoutingType` has the following possible values:
        - `0` = `None`
        - `1` = `Latency`
        - `2` = `Geolocation`
    - The key `AutoSslIssuance` controls whether automatic SSL certificates should be issued for this record.

#### [Update DNS Record](https://docs.bunny.net/reference/dnszonepublic_updaterecord)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\UpdateDnsRecord(
        zoneId: 1,
        id: 2,
        body: [
            'Type' => 3,
            'Ttl' => 15,
            'Value' => 'My TXT Value',
            'Name' => '',
            'Weight' => 0,
            'Priority' => 0,
            'Flags' => 0,
            'Tag' => '',
            'Port' => 0,
            'PullZoneId' => 0,
            'ScriptId' => 0,
            'Accelerated' => false,
            'MonitorType' => 0,
            'GeolocationLatitude' => 0,
            'GeolocationLongitude' => 0,
            'LatencyZone' => null,
            'SmartRoutingType' => 0,
            'Disabled' => false,
            'EnviromentalVariables' => [
                [
                    'Name' => 'Hello',
                    'Value' => 'World',
                ],
            ],
            'Comment' => '',
            'AutoSslIssuance' => true
            'Id' => 1,
        ],
    )
);
```

??? note

    - The key `EnviromentalVariables` is misspelled in the API specifications.
    - The key `Type` has the following possible values:
        - `0` = `A`
        - `1` = `AAAA`
        - `2` = `CNAME`
        - `3` = `TXT`
        - `4` = `MX`
        - `5` = `Redirect`
        - `6` = `Flatten`
        - `7` = `PullZone`
        - `8` = `SRV`
        - `9` = `CAA`
        - `10` = `PTR`
        - `11` = `Script`
        - `12` = `NS`
    - The key `ScriptId` is not returned in the response.
    - The key `MonitorType` has the following possible values:
        - `0` = `None`
        - `1` = `Ping`
        - `2` = `HTTP`
        - `3` = `Monitor`
    - The key `SmartRoutingType` has the following possible values:
        - `0` = `None`
        - `1` = `Latency`
        - `2` = `Geolocation`

#### [Delete DNS Record](https://docs.bunny.net/reference/dnszonepublic_deleterecord)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\DeleteDnsRecord(
        zoneId: 1,
        id: 2,
    )
);
```

#### Recheck DNS Configuration

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\RecheckDnsConfiguration(	
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Dismiss DNS Configuration Notice

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\DismissDnsConfigurationNotice(		
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Latest Scan

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\GetLatestScan(
        zoneId: 1,
    )
);
```

#### Issue Wildcard Certificate

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\IssueWildcardCertificate(
        zoneId: 1,
        body: [
            'Domain' => '*.example.com',
        ],
    )
);
```

#### Trigger Scan

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\DnsZone\TriggerScan(
        body: [
            'ZoneId' => 1,
            'Domain' => 'example.com',
        ],
    )
);
```

??? note

    - Only one of `ZoneId` or `Domain` can be provided, not both.

### Pull Zone

#### [List Pull Zones](https://docs.bunny.net/reference/pullzonepublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\ListPullZones(
        query: [
            'page' => 0,
            'perPage' => 1000,
            'search' => 'bunny',
            'includeCertificate' => false,
        ],
    )
);
```

??? note

    - The key `search` is currently not functional.

#### [Add Pull Zone](https://docs.bunny.net/reference/pullzonepublic_add)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddPullZone(
        body: [
            'OriginUrl' => 'https://my-bucket-2.service.com',
            'AllowedReferrers' => [],
            'BlockedReferrers' => [],
            'BlockNoneReferrer' => false,
            'BlockedIps' => [],
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
            'EnableCountryStateCodeVary' => false,
            'EnableHostnameVary' => false,
            'EnableCacheSlice' => false,
            'ZoneSecurityEnabled' => false,
            'ZoneSecurityIncludeHashRemoteIP' => false,
            'IgnoreQueryStrings' => true,
            'MonthlyBandwidthLimit' => 0,
            'AccessControlOriginHeaderExtensions' => [],
            'EnableAccessControlOriginHeader' => true,
            'DisableCookies' => true,
            'BudgetRedirectedCountries' => [],
            'BlockedCountries' => [],
            'CacheControlMaxAgeOverride' => -1,
            'CacheControlPublicMaxAgeOverride' => -1,
            'CacheControlBrowserMaxAgeOverride' => 157784760,
            'AddHostHeader' => false,
            'AddCanonicalHeader' => false,
            'EnableLogging' => true,
            'LoggingIPAnonymizationEnabled' => true,
            'PermaCacheStorageZoneId' => 0,
            'PermaCacheType' => 0,
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
            'LimitRateAfter' => 0,
            'LimitRatePerSecond' => 0,
            'BurstSize' => 0,
            'ErrorPageEnableCustomCode' => false,
            'ErrorPageCustomCode' => null,
            'ErrorPageEnableStatuspageWidget' => false,
            'ErrorPageStatuspageCode' => null,
            'ErrorPageWhitelabel' => false,
            'OptimizerEnabled' => false,
            'OptimizerTunnelEnabled' => false,
            'OptimizerDesktopMaxWidth' => 1600,
            'OptimizerMobileMaxWidth' => 800,
            'OptimizerImageQuality' => 85,
            'OptimizerMobileImageQuality' => 70,
            'OptimizerEnableWebP' => true,
            'OptimizerPrerenderHtml' => false,
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
            'OptimizerStaticHtmlEnabled' => false,
            'OptimizerStaticHtmlWordPressPath' => '',
            'OptimizerStaticHtmlWordPressBypassCookie' => '',
            'OptimizerEnableUpscaling' => false,
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
            'DnsOriginPort' => 0,
            'DnsOriginScheme' => '',
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
            'LogAnonymizationType' => 0,
            'StorageZoneId' => 0,
            'EdgeScriptId' => 0,
            'MiddlewareScriptId' => 0,
            'EdgeScriptExecutionPhase' => 0,
            'OriginType' => 0,
            'MagicContainersAppId' => '',
            'MagicContainersEndpointId' => '',
            'LogFormat' => 0,
            'LogForwardingFormat' => 0,
            'ShieldDDosProtectionType' => 0,
            'ShieldDDosProtectionEnabled' => false,
            'OriginHostHeader' => '',
            'EnableSmartCache' => false,
            'EnableRequestCoalescing' => false,
            'RequestCoalescingTimeout' => 30,
            'DisableLetsEncrypt' => false,
            'EnableBunnyImageAi' => false,
            'BunnyAiImageBlueprints' => [],
            'PreloadingScreenEnabled' => false,
            'PreloadingScreenCode' => '',
            'PreloadingScreenLogoUrl' => null,
            'PreloadingScreenShowOnFirstVisit' => false,
            'PreloadingScreenTheme' => 1,
            'PreloadingScreenCodeEnabled' => false,
            'PreloadingScreenDelay' => 700,
            'RoutingFilters' => [],
            'StickySessionType' => 0,
            'StickySessionCookieName' => '',
            'StickySessionClientHeaders' => '',
            'EnableWebSockets' => false,
            'MaxWebSocketConnections' => 0,
            'Name' => 'New Pull Zone',
        ],
    )
);
```

??? note

    - The key `Type` has the following possible values:
        - `0` = Premium
        - `1` = Volume
    - The key `OriginType` has the following possible values:
        - `0` = `OriginUrl`
        - `1` = `DnsAccelerate`
        - `2` = `StorageZone`
        - `3` = `LoadBalancer`
        - `4` = `EdgeScript`
        - `5` = `MagicContainers`
        - `6` = `PushZone`
    - The key `LogFormat` has the following possible values:
        - `0` = `Plain`
        - `1` = `JSON`
    - The key `LogForwardingFormat` has the following possible values:
        - `0` = `Plain`
        - `1` = `JSON`
    - The key `LogAnonymizationType` has the following possible values:
        - `0` = `OneDigit`
        - `1` = `Drop`
    - The key `LogForwardingProtocol` has the following possible values:
        - `0` = `UDP`
        - `1` = `TCP`
        - `2` = `TCPEncrypted`
        - `3` = `DataDog`
    - The key `ShieldDDosProtectionType` has the following possible values:
        - `0` = `DetectOnly`
        - `1` = `ActiveStandard`
        - `2` = `ActiveAggresive`
    - The key `OptimizerWatermarkPosition` has the following possible values:
        - `0` = `BottomLeft`
        - `1` = `BottomRight`
        - `2` = `TopLeft`
        - `4` = `Center`
        - `5` = `CenterStretch`
    - The key `PreloadingScreenTheme` has the following possible values:
        - `0` = `Light`
        - `1` = `Dark`
    - The key `StickySessionType` has the following possible values:
        - `0` = `Off`
        - `1` = `On`
    - The key `PreloadingScreenShowOnFirstVisit` is required when using preloading screen features.
    - The keys `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The Bunny dashboard will
    show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
    - The key `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
    - The keys `OptimizerClasses` and `BunnyAiImageBlueprints` accept arrays of objects with `Name` and `Properties` fields.
    - The API accepts both the integer as well as enum value for the `Type`, `OriginType`, `LogFormat`, `LogForwardingFormat`, `LogAnonymizationType`, `LogForwardingProtocol`, `ShieldDDosProtectionType`, `PreloadingScreenTheme` and `StickySessionType`.

#### [Get Pull Zone](https://docs.bunny.net/reference/pullzonepublic_index2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\GetPullZone(
        id: 1,
        query: [
            'includeCertificate' => false,
        ],
    )
);
```

#### [Update Pull Zone](https://docs.bunny.net/reference/pullzonepublic_updatepullzone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\UpdatePullZone(
        id: 1,
        body: [
            'OriginUrl' => 'https://my-bucket-2.service.com',
            'AllowedReferrers' => [],
            'BlockedReferrers' => [],
            'BlockNoneReferrer' => false,
            'BlockedIps' => [],
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
            'EnableCountryStateCodeVary' => false,
            'EnableHostnameVary' => false,
            'EnableCacheSlice' => false,
            'ZoneSecurityEnabled' => false,
            'ZoneSecurityIncludeHashRemoteIP' => false,
            'IgnoreQueryStrings' => true,
            'MonthlyBandwidthLimit' => 0,
            'AccessControlOriginHeaderExtensions' => [],
            'EnableAccessControlOriginHeader' => true,
            'DisableCookies' => true,
            'BudgetRedirectedCountries' => [],
            'BlockedCountries' => [],
            'CacheControlMaxAgeOverride' => -1,
            'CacheControlPublicMaxAgeOverride' => -1,
            'CacheControlBrowserMaxAgeOverride' => 157784760,
            'AddHostHeader' => false,
            'AddCanonicalHeader' => false,
            'EnableLogging' => true,
            'LoggingIPAnonymizationEnabled' => true,
            'PermaCacheStorageZoneId' => 0,
            'PermaCacheType' => 0,
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
            'LimitRateAfter' => 0,
            'LimitRatePerSecond' => 0,
            'BurstSize' => 0,
            'ErrorPageEnableCustomCode' => false,
            'ErrorPageCustomCode' => null,
            'ErrorPageEnableStatuspageWidget' => false,
            'ErrorPageStatuspageCode' => null,
            'ErrorPageWhitelabel' => false,
            'OptimizerEnabled' => false,
            'OptimizerTunnelEnabled' => false,
            'OptimizerDesktopMaxWidth' => 1600,
            'OptimizerMobileMaxWidth' => 800,
            'OptimizerImageQuality' => 85,
            'OptimizerMobileImageQuality' => 70,
            'OptimizerEnableWebP' => true,
            'OptimizerPrerenderHtml' => false,
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
            'OptimizerStaticHtmlEnabled' => false,
            'OptimizerStaticHtmlWordPressPath' => '',
            'OptimizerStaticHtmlWordPressBypassCookie' => '',
            'OptimizerEnableUpscaling' => false,
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
            'DnsOriginPort' => 0,
            'DnsOriginScheme' => '',
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
            'LogAnonymizationType' => 0,
            'StorageZoneId' => 0,
            'EdgeScriptId' => 0,
            'MiddlewareScriptId' => 0,
            'EdgeScriptExecutionPhase' => 0,
            'OriginType' => 0,
            'MagicContainersAppId' => '',
            'MagicContainersEndpointId' => '',
            'LogFormat' => 0,
            'LogForwardingFormat' => 0,
            'ShieldDDosProtectionType' => 0,
            'ShieldDDosProtectionEnabled' => false,
            'OriginHostHeader' => '',
            'EnableSmartCache' => false,
            'EnableRequestCoalescing' => false,
            'RequestCoalescingTimeout' => 30,
            'DisableLetsEncrypt' => false,
            'EnableBunnyImageAi' => false,
            'BunnyAiImageBlueprints' => [],
            'PreloadingScreenEnabled' => false,
            'PreloadingScreenCode' => '',
            'PreloadingScreenLogoUrl' => null,
            'PreloadingScreenShowOnFirstVisit' => false,
            'PreloadingScreenTheme' => 1,
            'PreloadingScreenCodeEnabled' => false,
            'PreloadingScreenDelay' => 700,
            'RoutingFilters' => [],
            'StickySessionType' => 0,
            'StickySessionCookieName' => '',
            'StickySessionClientHeaders' => '',
            'OptimizerEnableUpscaling' => false,
            'EnableWebSockets' => false,
            'MaxWebSocketConnections' => 0,
        ],
    )
);
```

??? note

    - The key `Type` has the following possible values:
        - `0` = Premium
        - `1` = Volume
    - The key `OriginType` has the following possible values:
        - `0` = `OriginUrl`
        - `1` = `DnsAccelerate`
        - `2` = `StorageZone`
        - `3` = `LoadBalancer`
        - `4` = `EdgeScript`
        - `5` = `MagicContainers`
        - `6` = `PushZone`
    - The key `LogFormat` has the following possible values:
        - `0` = `Plain`
        - `1` = `JSON`
    - The key `LogForwardingFormat` has the following possible values:
        - `0` = `Plain`
        - `1` = `JSON`
    - The key `LogAnonymizationType` has the following possible values:
        - `0` = `OneDigit`
        - `1` = `Drop`
    - The key `LogForwardingProtocol` has the following possible values:
        - `0` = `UDP`
        - `1` = `TCP`
        - `2` = `TCPEncrypted`
        - `3` = `DataDog`
    - The key `ShieldDDosProtectionType` has the following possible values:
        - `0` = `DetectOnly`
        - `1` = `ActiveStandard`
        - `2` = `ActiveAggresive`
    - The key `OptimizerWatermarkPosition` has the following possible values:
        - `0` = `BottomLeft`
        - `1` = `BottomRight`
        - `2` = `TopLeft`
        - `4` = `Center`
        - `5` = `CenterStretch`
    - The key `PreloadingScreenTheme` has the following possible values:
        - `0` = `Light`
        - `1` = `Dark`
    - The key `StickySessionType` has the following possible values:
        - `0` = `Off`
        - `1` = `On`
    - The key `PreloadingScreenShowOnFirstVisit` is required when using preloading screen features.
    - The keys `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The Bunny dashboard will
    show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
    - The key `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
    - The keys `OptimizerClasses` and `BunnyAiImageBlueprints` accept arrays of objects with `Name` and `Properties` fields.
    - The API accepts both the integer as well as enum value for the `Type`, `OriginType`, `LogFormat`, `LogForwardingFormat`, `LogAnonymizationType`, `LogForwardingProtocol`, `ShieldDDosProtectionType`, `PreloadingScreenTheme` and `StickySessionType`.

#### [Delete Pull Zone](https://docs.bunny.net/reference/pullzonepublic_delete)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\DeletePullZone(
        id: 1,
    )
);
```

#### [Add/Update Edge Rule](https://docs.bunny.net/reference/pullzonepublic_addedgerule)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddOrUpdateEdgeRule(
        pullZoneId: 1,
        body: [
            'Guid' => 'c71d9594-3bc6-4639-9896-ba3e96217587', // required for update, not add
            'ActionType' => 'BlockRequest',
            'ActionParameter1' => '',
            'ActionParameter2' => '',
            'ActionParameter3' => '',
            'Triggers' => [
                [
                    'Type' => 'URL',
                    'PatternMatches' => [
                        'https://example.b-cdn.net/images/*',
                        'https://example.b-cdn.net/videos/*',
                    ]
                    'PatternMatchingType' => 'MatchAny',
                    'Parameter1' => '',
                ],
            ],
            'ExtraActions' => [
                [
                    'ActionType' => 'SetStatusCode',
                    'ActionParameter1' => '',
                    'ActionParameter2' => '',
                    'ActionParameter3' => '',
                ],
            ],
            'TriggerMatchingType' => 'MatchAny',
            'Description' => '',
            'Enabled' => true,
            'OrderIndex' => 1,
        ],
    )
);
```

??? note

    - The key `ActionType` has the following possible values:
        - `0` = `ForceSSL`
        - `1` = `Redirect`
        - `2` = `OriginUrl`
        - `3` = `OverrideCacheTime`
        - `4` = `BlockRequest`
        - `5` = `SetResponseHeader`
        - `6` = `SetRequestHeader`
        - `7` = `ForceDownload`
        - `8` = `DisableTokenAuthentication`
        - `9` = `EnableTokenAuthentication`
        - `10` = `OverrideCacheTimePublic`
        - `11` = `IgnoreQueryString`
        - `12` = `DisableOptimizer`
        - `13` = `ForceCompression`
        - `14` = `SetStatusCode`
        - `15` = `BypassPermaCache`
        - `16` = `OverrideBrowserCacheTime`
        - `17` = `OriginStorage`
        - `18` = `SetNetworkRateLimit`
        - `19` = `SetConnectionLimit`
        - `20` = `SetRequestsPerSecondLimit`
        - `21` = `RunEdgeScript`
        - `22` = `OriginMagicContainers`
        - `23` = `DisableWAF`
        - `24` = `RetryOrigin`
        - `25` = `OverrideBrowserCacheResponseHeader`
        - `26` = `RemoveBrowserCacheResponseHeader`
        - `27` = `DisableShieldChallenge`
        - `28` = `DisableShield`
        - `29` = `DisableShieldBotDetection`
        - `30` = `BypassAwsS3Authentication`
        - `31` = `DisableShieldAccessLists`
        - `32` = `DisableShieldRateLimiting`
    - The key `Type` in a `Trigger` object has the following possible values:
        - `0` = `URL`
        - `1` = `RequestHeader`
        - `2` = `ResponseHeader`
        - `3` = `URLExtension`
        - `4` = `CountryCode`
        - `5` = `RemoteIP`
        - `6` = `UrlQueryString`
        - `7` = `RandomChance`
        - `8` = `StatusCode`
        - `9` = `RequestMethod`
        - `10` = `CookieValue`
        - `11` = `CountryStateCode`
        - `12` = `OriginRetryAttemptCount`
        - `13` = `OriginConnectionError`
    - The key `TriggerMatchingType` has the following possible values:
        - `0` = `MatchAny`
        - `1` = `MatchAll`
        - `2` = `MatchNone`
    - The API accepts both the integer as well as enum value for the `ActionType`, `Type` and `TriggerMatchingType`.
    - The keys `Guid`, `Type` and `PatternMatchingType` in the body are required parameters when updating an edge rule.

#### [Set Edge Rule Enabled](https://docs.bunny.net/reference/pullzonepublic_setedgeruleenabled)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\SetEdgeRuleEnabled(
        pullZoneId: 1,
        edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587',
        body: [
            'Id' => 1,
            'Value' => true,
        ],
    )
);
```

??? note

    -  The key `Id` in the body denotes the pull zone ID (the same as the first argument) and is (for some reason) a required parameter.

#### [Delete Edge Rule](https://docs.bunny.net/reference/pullzonepublic_deleteedgerule)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\DeleteEdgeRule(
        pullZoneId: 1,
        edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587',
    )
);
```

#### Set Zone Security Enabled

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\SetZoneSecurityEnabled(
        Id: 1,
        Value: true,
    )
);
```

??? note

    - This endpoint corresponds to toggling the **Enable Token Authentication** switch in the **Token Authentication > Security** section of your pull zone.

??? warning "Undocumented endpoint"

    This endpoint is not documented in the OpenAPI specifications but can still be used indefinitely.

#### Set Zone Security Include Hash Remote IP Enabled

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\SetZoneSecurityIncludeHashRemoteIpEnabled(
        Id: 1,
        Value: true,
    )
);
```

??? note

    - This endpoint corresponds to toggling the **Token IP Validation** switch in the **Token Authentication > Security** section of your pull zone.

??? warning "Undocumented endpoint"

    This endpoint is not documented in the OpenAPI specifications but can still be used indefinitely.

#### [Get Origin Shield Queue Statistics](https://docs.bunny.net/reference/pullzonepublic_originshieldconcurrencystatistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\GetOriginShieldQueueStatistics(
        pullZoneId: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
            'hourly' => false,
        ],
    )
);
```

#### [Get SafeHop Statistics](https://docs.bunny.net/reference/pullzonepublic_safehopstatistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\GetSafeHopStatistics(
        pullZoneId: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
            'hourly' => false,
        ],
    )
);
```

#### [Get Optimizer Statistics](https://docs.bunny.net/reference/pullzonepublic_optimizerstatistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\GetOptimizerStatistics(
        pullZoneId: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
            'hourly' => false,
        ],
    )
);
```

#### Get WAF Statistics

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\GetWafStatistics(
        pullZoneId: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
            'hourly' => false,
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is not documented in the OpenAPI specifications but can still be used indefinitely.

#### [Load Free Certificate](https://docs.bunny.net/reference/pullzonepublic_loadfreecertificate)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\LoadFreeCertificate(
        query: [
            'hostname' => 'cdn.example.com',
            'useOnlyHttp01' => false,
        ],
    )
);
```

#### [Purge Cache (by tag)](https://docs.bunny.net/reference/pullzonepublic_purgecachepostbytag)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\PurgeCache(
        id: 1,
        body: [
            'CacheTag' => 'mytag-region-*',
        ],
    )
);
```

#### [Check Pull Zone Availability](https://docs.bunny.net/reference/pullzonepublic_checkavailability)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\CheckPullZoneAvailability(
        body: [
            'Name' => 'test',
        ],
    )
);
```

#### [Add Custom Certificate](https://docs.bunny.net/reference/pullzonepublic_addcertificate)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddCustomCertificate(
        id: 1,
        body: [
            'Hostname' => 'cdn.example.com',
            'Certificate' => 'LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tCk5ldmVyIGdvbm5hIGdpdmUgeW91IHVwLgotLS0tLUVORCBDRVJUSUZJQ0FURS0tLS0t',
            'CertificateKey' => 'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpOZXZlciBnb25uYSBsZXQgeW91IGRvd24uCi0tLS0tRU5EIFJTQSBQUklWQVRFIEtFYS0tLS0t',
        ],
    )
);
```

??? note

    - The keys `Certificate` and `CertificateKey` require the file contents to be sent as base64 encoded strings.

#### [Remove Certificate](https://docs.bunny.net/reference/pullzonepublic_removecertificate)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveCertificate(
        id: 1,
        body: [
            'Hostname' => 'cdn.example.com',
        ],
    )
);
```

#### [Add Custom Hostname](https://docs.bunny.net/reference/pullzonepublic_addhostname)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddCustomHostname(
        id: 1,
        body: [
            'Hostname' => 'cdn.example.com',
        ],
    )
);
```

#### [Remove Custom Hostname](https://docs.bunny.net/reference/pullzonepublic_removehostname)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveCustomHostname(
        id: 1,
        body: [
            'Hostname' => 'cdn.example.com',
        ],
    )
);
```

#### [Set Force SSL](https://docs.bunny.net/reference/pullzonepublic_setforcessl)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\SetForceSsl(
        id: 1,
        body: [
            'Hostname' => 'cdn.example.com',
            'ForceSSL' => true,
        ],
    )
);
```

#### [Reset Token Key](https://docs.bunny.net/reference/pullzonepublic_resetsecuritykey)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\ResetTokenKey(
        id: 1,
        body: [
            'SecurityKey' => '',
        ],
    )
);
```

#### [Add Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddAllowedReferer(
        id: 1,
        body: [
            'Hostname' => '*.example.com,*.example.org',
        ],
    )
);
```

??? note

    - The key `Hostname` allows multiple values through comma separated values.

#### [Remove Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_removeallowedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveAllowedReferer(	
        id: 1,
        body: [
            'Hostname' => '*.example.com',
        ],
    )
);
```

??? note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked Referer](https://docs.bunny.net/reference/pullzonepublic_addblockedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddBlockedReferer(
        id: 1,
        body: [
            'Hostname' => '*.evil.org',
        ],
    )
);
```

??? note

    - The key `Hostname` does *not* allow multiple values.

#### [Remove Blocked Referer](https://docs.bunny.net/reference/pullzonepublic_removeblockedreferrer)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveBlockedReferer(
        id: 1,
        body: [
            'Hostname' => '*.evil.org',
        ],
    )
);
```

??? note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked IP](https://docs.bunny.net/reference/pullzonepublic_addblockedip)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\AddBlockedIp(
        id: 1,
        body: [
            'BlockedIp' => '12.345.67.89',
        ],
    )
);
```

#### [Remove Blocked IP](https://docs.bunny.net/reference/pullzonepublic_removeblockedip)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveBlockedIp(
        id: 1,
        body: [
            'BlockedIp' => '12.345.67.89',
        ],
    )
);
```

#### Update Private Key Type

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\PullZone\UpdatePrivateKeyType(
        id: 1,
        body: [
            'Hostname' => 'cdn.example.com',
            'KeyType' => 0,
        ],
    )
);
```

### Purge

#### [Purge URL](https://docs.bunny.net/reference/purgepublic_indexpost)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Purge\PurgeUrl(
        query: [
            'url' => 'https://example.b-cdn.net/images/*',
            'async' => false,
        ],
    )
);
```

#### Purge URL (by header)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Purge\PurgeUrlByHeader(
        query: [
            'url' => 'https://example.b-cdn.net/images/*',
            'headerName' => '',
            'headerValue' => '',
            'async' => false,
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### Search

#### Global Search

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Search\GlobalSearch(
        query: [
            'search' => 'bunny',
            'from' => 0,
            'size' => 20,
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

### Statistics

#### [Get Statistics (traffic, cache hit & bandwidth)](https://docs.bunny.net/reference/statisticspublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\Statistics\GetStatistics(
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
            'pullZone' => -1,
            'serverZoneId' => -1,
            'loadErrors' => false,
            'hourly' => false,
            'loadOriginResponseTimes' => false,
            'loadOriginTraffic' => false,
            'loadRequestsServed' => false,
            'loadBandwidthUsed' => false,
            'loadOriginShieldBandwidth' => false,
            'loadGeographicTrafficDistribution' => false,
            'loadUserBalanceHistory' => false,
        ],
    )
);
```

### Storage Zone

#### [List Storage Zones](https://docs.bunny.net/reference/storagezonepublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\ListStorageZones(
        query: [
            'page' => 0,
            'perPage' => 1000,
            'search' => 'bunny',
            'includeDeleted' => 1000,
        ],
    )
);
```

??? note

    - The key `search` is currently not functional.

#### [Add Storage Zone](https://docs.bunny.net/reference/storagezonepublic_add)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\AddStorageZone(
        body: [
            'Name' => 'Test',
            'Region' => 'DE',
            'ReplicationRegions' => '',
            'ZoneTier' => 0,
            'StorageZoneType' => 0,
        ],
    )
);
```

??? note

    - The key `ZoneTier` has the following possible values (undocumented):
        - `0` = `Standard` (HDD)
        - `1` = `Edge` (SSD)
    - The key `Region` has the following possible values:
        - `DE` = Falkenstein / Frankfurt (Germany) | HDD + SSD
        - `UK` = London (United Kingdom) | HDD
        - `SE` = Norway (Stockholm) | HDD
        - `NY` = New York (United States) | HDD
        - `LA` = Los Angeles (United States) | HDD
        - `SG` = Singapore (Singapore) | HDD
        - `SYD` = Sydney (Oceania) | HDD
        - `BR` = Sao Paolo (Brazil) | HDD
        - `JH` = Johannesburg (Africa) | HDD
    - The key `ReplicationRegions` has the following possible values:
        - `DE` = Frankfurt (Germany) | SSD
        - `UK` = London (United Kingdom) | HDD + SSD
        - `SE` = Norway (Stockholm) | HDD + SSD
        - `CZ` = Prague (Czech Republic) | SSD
        - `ES` = Madrid (Spain) | SSD
        - `NY` = New York (United States East) | HDD + SSD
        - `LA` = Los Angeles (United States West) | HDD + SSD
        - `WA` = Seattle (United States West) | SSD
        - `MI` = Miami (United States East) | SSD
        - `SG` = Singapore (Singapore) | HDD + SSD
        - `HK` = Hong Kong (SAR of China) | SSD
        - `JP` = Tokyo (Japan) | SSD
        - `SYD` = Sydney (Oceania) | HDD + SSD
        - `BR` = Sao Paolo (Brazil) | HDD + SSD
        - `JH` = Johannesburg (Africa) | HDD + SSD
    - The API accepts both the integer as well as enum value for the `ZoneTier`.

??? warning

    - The key `StorageZoneType` is related to an upcoming feature and currently does not serve any purpose.

#### [Check Storage Zone Availability](https://docs.bunny.net/reference/storagezonepublic_checkavailability)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\CheckStorageZoneAvailability(
        body: [
            'Name' => 'Test',
        ],
    )
);
```

#### [Get Storage Zone](https://docs.bunny.net/reference/storagezonepublic_index2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZone(
        id: 1,
    )
);
```

#### [Update Storage Zone](https://docs.bunny.net/reference/storagezonepublic_update)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\UpdateStorageZone(
        id: 1,
        body: [
            'ReplicationZones' => '',
            'OriginUrl' => '',
            'Custom404FilePath' => 'my-custom-404.html',
            'Rewrite404To200' => false,
        ],
    )
);
```

??? note

    - The key `OriginUrl` allows you to specify a backup data source, in case the file does not exist on the Storage Zone.
    So for example, you would request `/image.png`. Assuming `image.png` doesn't exist on the storage zone,
    the system will try to proxy and fetch it from the `OriginUrl` instead. You can omit it unless needed.
    - The key `ReplicationZones` has the following possible values:
        - `DE` = Frankfurt (Germany) | SSD
        - `UK` = London (United Kingdom) | HDD + SSD
        - `SE` = Norway (Stockholm) | HDD + SSD
        - `CZ` = Prague (Czech Republic) | SSD
        - `ES` = Madrid (Spain) | SSD
        - `NY` = New York (United States East) | HDD + SSD
        - `LA` = Los Angeles (United States West) | HDD + SSD
        - `WA` = Seattle (United States West) | SSD
        - `MI` = Miami (United States East) | SSD
        - `SG` = Singapore (Singapore) | HDD + SSD
        - `HK` = Hong Kong (SAR of China) | SSD
        - `JP` = Tokyo (Japan) | SSD
        - `SYD` = Sydney (Oceania) | HDD + SSD
        - `BR` = Sao Paolo (Brazil) | HDD + SSD
        - `JH` = Johannesburg (Africa) | HDD + SSD

#### [Delete Storage Zone](https://docs.bunny.net/reference/storagezonepublic_delete)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\DeleteStorageZone(	
        id: 1,
        query: [
            'deleteLinkedPullZones' => true,
        ],   
    )
);
```

#### [Get Storage Zone Statistics](https://docs.bunny.net/reference/storagezonepublic_storagezonestatistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZoneStatistics(
        id: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
        ],
    )
);
```

#### Get Storage Zone Connections

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZoneConnections(
        id: 1,
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### [Reset Password](https://docs.bunny.net/reference/storagezonepublic_resetpassword)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\ResetPassword(
        id: 1,
    )
);
```

#### [Reset Read-Only Password](https://docs.bunny.net/reference/storagezonepublic_resetreadonlypassword)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\StorageZone\ResetReadOnlyPassword(		
        query: [
            'id' => 1,
        ],
    )
);
```

### User

#### Get Home Feed

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetHomeFeed()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get User Audit Log

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetUserAuditLog(
        date: (new \DateTime('-1 day'))->format('m-d-y'),
        query: [
            'Product' => [
                'BunnyShield',
            ],      
            'ResourceType' => [
                'Access Lists',
            ], 
            'ResourceId' => [
                '1',
            ], 
            'ActorId' => [
                '53c6cf29-c7cc-4d82-8187-56938c5e0734',
            ], 
            'Order' => '<value>',
            'ContinuationToken' => 'MWRiMjM0MTItMzM4Yy00NmFiLWEwYzEtN2E2ZGE2N2FiYzc4LTE3NjE4NjA0ODE4ODM=',
            'Limit' => 10000,
        ],   
    )
);
```

??? note

    - The key `Limit` has a value range of 1-10000.

??? warning

    - The key `Limit` is currently not functional.
    - The key `Order` has unknown key-value usage.

#### Get User Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetUserDetails()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Update User Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\UpdateUserDetails(
        body: [
            'FirstName' => 'John',
            'Email' => 'john.doe@example.com',
            'BillingEmail' => 'john.doe@example.com',
            'DmcaEmail' => 'john.doe@example.com',
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
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Resend Email Confirmation

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\ResendEmailConfirmation()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Reset API Key

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\ResetApiKey()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### List Close Account Reasons

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\ListCloseAccountReasons()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Close Account

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\CloseAccount(
        body: [
            'Password' => 'Abcd1234',
            'Reason' => 'No longer needed.',
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get DPA Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetDpaDetails()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Accept DPA

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\AcceptDpa()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get DPA Details (HTML)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetDpaDetailsHtml()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### List Notifications

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\ListNotifications()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Set Notifications Opened

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\SetNotificationsOpened()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get Marketing Details

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetMarketingDetails()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Get What's New Items

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GetWhatsNewItems()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### [Reset What's New](https://docs.bunny.net/reference/userpublic_whatsnewreset)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\ResetWhatsNew()
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Generate 2FA Verification

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\GenerateTwoFactorAuthenticationVerification();
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Disable 2FA

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\DisableTwoFactorAuthentication(
        body: [
            'Password' => 'LoremIpsumDolor',
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Enable 2FA

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\EnableTwoFactorAuthentication(	
        body: [
            'SecretValidator' => '',
            'Secret' => '',
            'TestPin' => '123456',
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

#### Verify 2FA Code

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Core\User\VerifyTwoFactorAuthenticationCode(
        body: [
            'SecretValidator' => '',
            'Secret' => '',
            'TestPin' => '123456',
        ],
    )
);
```

??? warning "Undocumented endpoint"

    This endpoint is no longer in the OpenAPI specifications but can still be used indefinitely.

## Reference

* [Core Platform API](https://docs.bunny.net/api-reference/core)
