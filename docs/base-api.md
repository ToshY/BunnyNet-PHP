# Base API

Base endpoint for pull zones, video libraries, storage zones, billing, support, and more. 
<br />
Everything that can be done with the control panel can also be achieved with the API.

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

#### [List Abuse Cases](https://docs.bunny.net/reference/abusecasepublic_index)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Base\AbuseCase\ListAbuseCases(
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
)
```

#### [Get DMCA Case](https://docs.bunny.net/reference/abusecasepublic_getabusecase)

```php
$baseApi->getDmcaCase(
    id: 1,
);
```

!!! warning

    - This endpoint currently returns a `401` status code.

#### [Get Abuse Case](https://docs.bunny.net/reference/abusecasepublic_getabusecase2)

```php
$baseApi->getAbuseCase(
    id: 1,
);
```

!!! warning

    - This endpoint currently returns a `401` status code.

#### [Resolve DMCA Case](https://docs.bunny.net/reference/abusecasepublic_resolveabusecase)

```php
$baseApi->resolveDmcaCase(
    id: 1,
);
```

#### [Resolve Abuse Case](https://docs.bunny.net/reference/abusecasepublic_resolveabusecase2)

```php
$baseApi->resolveAbuseCase(
    id: 1,
);
```

#### [Check Abuse Case](https://docs.bunny.net/reference/abusecasepublic_checkabusecase)

```php
$baseApi->checkAbuseCase(
    id: 1,
);
```

### Auth

#### [Auth JWT 2FA](https://docs.bunny.net/reference/authpublic_authjwt2fa)

```php
$baseApi->authJwtTwoFactorAuthentication(
    body: [
        'Code' => 'abc',
    ],
);
```

#### [Refresh JWT](https://docs.bunny.net/reference/authpublic_refreshjwt)

```php
$baseApi->refreshJwt();
```

### Countries

#### [List Countries](https://docs.bunny.net/reference/countriespublic_getcountrylist)

```php
$baseApi->listCountries();
```

### API Keys

#### [List API Keys](https://docs.bunny.net/reference/apikeypublic_listapikeys)

```php
$baseApi->listApiKeys(
    query: [
        'page' => 1,
        'perPage' => 1000,
    ],
);
```

!!! warning

    - This endpoint currently returns a `500` status code with the following response: 
    ```
    {"Message":"Authorization has been denied for this request."}
    ```

### Billing

#### [Get Billing Details](https://docs.bunny.net/reference/billingpublic_index)

```php
$baseApi->getBillingDetails();
```

#### [Configure Auto Recharge](https://docs.bunny.net/reference/billingpublic_configureautorecharge)

```php
$baseApi->configureAutoRecharge(
    body: [
        'AutoRechargeEnabled' => true,
        'PaymentMethodToken' => 1000,
        'PaymentAmount' => 10,
        'RechargeTreshold' => 2,
    ],
);
```

!!! note

    - The key `RechargeTreshold` (misspelled) has a value range of 2-2000.
    - The key `PaymentAmount` has a value range of 10-2000.

#### [Create Payment Checkout](https://docs.bunny.net/reference/billingpublic_checkout)

```php
$baseApi->createPaymentCheckout(
    body: [
        'RechargeAmount' => 10,
        'PaymentAmount' => 10,
        'PaymentRequestId' => 123456,
        'Nonce' => 'ab',
    ],
);
```

!!! note

    - The key `PaymentAmount` has a value range of 10-2000.

#### [Prepare Payment Authorization](https://docs.bunny.net/reference/billingpublic_paymentsprepareauthorization)

```php
$baseApi->preparePaymentAuthorization();
```

#### [Get Affiliate Details](https://docs.bunny.net/reference/billingpublic_affiliatedetails)

```php
$baseApi->getAffiliateDetails();
```

#### [Claim Affiliate Credits](https://docs.bunny.net/reference/billingpublic_affiliateclaim)

```php
$baseApi->claimAffiliateCredits();
```

#### [Get The Coinify Bitcoin exchange rate](https://docs.bunny.net/reference/billingpublic_coinifyexchangerate)

```php
$baseApi->getCoinifyBitcoinExchangeRate();
```

#### [Create Coinify payment](https://docs.bunny.net/reference/billingpublic_createcoinifypayment)

```php
$baseApi->createCoinifyPayment(
    query: [
        'amount' => 123,
    ],
);
```

#### [Get Billing Summary](https://docs.bunny.net/reference/billingpublic_summary)

```php
$baseApi->getBillingSummary();
```

#### [Get Billing Summary PDF](https://docs.bunny.net/reference/billingpublic_summarypdf)

```php
$baseApi->getBillingSummaryPdf(
    billingRecordId: 1,
);
```

#### [Apply Promo Code](https://docs.bunny.net/reference/billingpublic_applycode)

```php
$baseApi->applyPromoCode(
    query: [
        'CouponCode' => 'YOUFOUNDME',
    ],
);
```

### Support

#### [List Tickets](https://docs.bunny.net/reference/supportpublic_index)

```php
$baseApi->listTickets(
    query: [
        'page' => 1,
        'perPage' => 1000,
    ],
);
```

#### [Get Ticket Details](https://docs.bunny.net/reference/supportpublic_index2)

```php
$baseApi->getTicketDetails(
    id: 1,
);
```

#### [Close Ticket](https://docs.bunny.net/reference/supportpublic_close)

```php
$baseApi->closeTicket(
    id: 1,
);
```

#### [Reply Ticket](https://docs.bunny.net/reference/supportpublic_reply)

```php
$baseApi->closeTicket(
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
);
```

!!! note

    - The key `Body` requires its contents to be base64 encoded.

#### [Create Ticket](https://docs.bunny.net/reference/supportpublic_createticket)

```php
$baseApi->createTicket(
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
);
```

!!! note

    - The keys `LinkedPullZone` and `LinkedStorageZone` are not required unlike stated in the API specifications.
    - The key `Body` requires its contents to be base64 encoded.

### DRM Certificate

#### [List DRM Certificates](https://docs.bunny.net/reference/drmcertificatepublic_index)

```php
$baseApi->listDrmCertificates(
    query: [
        'page' => 1,
        'perPage' => 1000,
    ],
);
```

!!! warning

    - This endpoint currently returns a `500` status code with the following response: 
    ```
    {"Message":"An error has occurred."}
    ```
    A support ticket has been created at bunny.net regarding this issue.

### Integrations

#### Get GitHub Integration

```php
$baseApi->getGitHubIntegration();
```

!!! warning

    This endpoint is (currently) undocumented. 

!!! info

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
$baseApi->listRegions();
```

### Stream Video Library

#### [List Video Libraries](https://docs.bunny.net/reference/videolibrarypublic_index)

```php
$baseApi->listVideoLibraries(
    query: [
        'page' => 0,
        'perPage' => 1000,
        'search' => 'bunny',
    ],
);
```

!!! note

    - The key `search` is currently not functional.

#### [Add Video Library](https://docs.bunny.net/reference/videolibrarypublic_add)

```php
$baseApi->addVideoLibrary(
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
    ],
);
```

!!! note
    
    - The key `ReplicationRegions` has the following possible values:
        - `UK` = London (United Kingdom)
        - `SE` = Norway (Stockholm)
        - `NY` = New York (United States East)
        - `LA` = Los Angeles (United States West)
        - `SG` = Singapore (Singapore)
        - `SYD` = Sydney (Oceania)
        - `BR` = Sao Paulo (Brazil)
        - `JH` = Johannesburg (Africa)

#### [Get Video Library](https://docs.bunny.net/reference/videolibrarypublic_index2)

```php
$baseApi->getVideoLibrary(
    id: 1,
);
```

#### [Update Video Library](https://docs.bunny.net/reference/videolibrarypublic_update)

```php
$baseApi->updateVideoLibrary(
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
        'Controls' => 'play,progress,current-time,mute,volume,pip,fullscreen',
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
        'TranscribingCaptionLanguages' => [],
        'RememberPlayerPosition' => true,
        'EnableMultiAudioTrackSupport' => true,
        'UseSeparateAudioStream' => true,
        'JitEncodingEnabled' => true,
        'OutputCodecs' => 'x264,vp9,hevc,av1',
        'AppleFairPlayDrm' => [
            'Enabled' => false,
        ],
        'GoogleWidevineDrm' => [
            'Enabled' => false,
            'SdOnlyForL3' => false,
            'WidevineMinClientSecurityLevel' => 1,
        ],
        'EncodingTier' => 0
    ],
);
```

!!! note

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
    - To get a full list of possible value options for key `TranscribingCaptionLanguages`, see the [Get Languages](#get-languages) endpoint.
    - The key `EncodingTier` has the following possible values:
        - `0` = Free
        - `1` = Premium

#### [Delete Video Library](https://docs.bunny.net/reference/videolibrarypublic_delete)

```php
$baseApi->deleteVideoLibrary(
    id: 1,
);
```

#### [Get Languages](https://docs.bunny.net/reference/videolibrarypublic_index3)

```php
$baseApi->getLanguages();
```

#### [Reset Password](https://docs.bunny.net/reference/videolibrarypublic_resetpassword)

```php
$baseApi->resetVideoLibraryPassword(
    query: [
        'id' => 1,
    ],
);
```

#### [Reset Password (by path parameter)](https://docs.bunny.net/reference/videolibrarypublic_resetpassword2)

```php
$baseApi->resetVideoLibraryPasswordByPathParameter(
    id: 1,
);
```

#### [Add Watermark](https://docs.bunny.net/reference/videolibrarypublic_addwatermark)

```php
$baseApi->addWatermark(
    id: 1,
);
```

#### [Delete Watermark](https://docs.bunny.net/reference/videolibrarypublic_deletewatermark)

```php
$baseApi->deleteWatermark(
    id: 1,
);
```

#### [Add Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer)

```php
$baseApi->addVideoLibraryAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com,*.example.org',
    ],
);
```

!!! note

    - The key `Hostname` allows multiple values through comma separated values.

#### [Remove Allowed Referer](https://docs.bunny.net/reference/videolibrarypublic_removeallowedreferrer)

```php
$baseApi->removeVideoLibraryAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com',
    ],
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked Referer](ttps://docs.bunny.net/reference/videolibrarypublic_addblockedreferrer)

```php
$baseApi->addVideoLibraryBlockedReferer(
    id: 1,
    body: [
        'Hostname' => 'evil.org',
    ],
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Remove Blocked Referer](https://docs.bunny.net/reference/videolibrarypublic_removeblockedreferrer)

```php
$baseApi->removeVideoLibraryBlockedReferer(
    id: 1,
    body: [
        'Hostname' => 'evil.org',
    ],
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

### DNS Zone

#### [List DNS Zones](https://docs.bunny.net/reference/dnszonepublic_index)

```php
$baseApi->listDnsZones(
    query: [
        'page' => 1,
        'perPage' => 1000,
        'search' => 'bunny.net',
    ],
);
```

!!! note

    - The key `search` can be used to filter on `Id` or `Domain`. A search value with an `Id` value will perform an exact match,
    whereas a search value with a `Domain` will perform a wildcard search: `bunny`, `nny` and `.net` will all match the DNS zone for `bunny.net`.

#### [Add DNS Zone](https://docs.bunny.net/reference/dnszonepublic_add)

```php
$baseApi->addDnsZone(
    body: [
        'Domain' => 'example.com',
    ],
);
```

#### [Get DNS Zone](https://docs.bunny.net/reference/dnszonepublic_index2)

```php
$baseApi->getDnsZone(
    id: 1,
);
```

#### [Update DNS Zone](https://docs.bunny.net/reference/dnszonepublic_update)

```php
$baseApi->updateDnsZone(
    id: 1,
    body: [
        'CustomNameserversEnabled' => true,
        'Nameserver1' => 'abbby.ns.cloudflare.com',
        'Nameserver2' => 'jonah.ns.cloudflare.com',
        'SoaEmail' => 'admin@example.com',
        'LoggingEnabled' => true,
        'LogAnonymizationType' => true,
        'LoggingIPAnonymizationEnabled' => true,
    ],
);
```

!!! note

    - The key `LogAnonymizationType` has the following possible values (undocumented):
        - `0` = Remove one octet
        - `1` = Drop IP
    - In order to disable `LoggingIPAnonymizationEnabled` you first need to agree to the DPA agreement (GDPR).

#### [Delete DNS Zone](https://docs.bunny.net/reference/dnszonepublic_delete)

```php
$baseApi->deleteDnsZone(
    id: 1,
);
```

#### [Enable DNSSEC on DNS Zone](https://docs.bunny.net/reference/managednszonednssecendpoint_enablednssecdnszone)

```php
$baseApi->enableDnssecOnDnsZone(
    id: 1,
);
```

#### [Disable DNSSEC on DNS Zone](https://docs.bunny.net/reference/managednszonednssecendpoint_disablednssecdnszone)

```php
$baseApi->disableDnssecOnDnsZone(
    id: 1,
);
```

#### [Export DNS Zone](https://docs.bunny.net/reference/dnszonepublic_export)

```php
$baseApi->exportDnsZone(
    id: 1,
);
```

#### [Get DNS Query Statistics](https://docs.bunny.net/reference/dnszonepublic_statistics)

```php
$baseApi->getDnsZoneQueryStatistics(
    id: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
    ],
);
```

#### [Check DNS Zone Availability](https://docs.bunny.net/reference/dnszonepublic_checkavailability)

```php
$baseApi->checkDnsZoneAvailability(
    body: [
        'Name' => 'example.com',
    ],
);
```

#### [Add DNS Record](https://docs.bunny.net/reference/dnszonepublic_addrecord)

```php
$baseApi->addDnsRecord(
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
    ],
);
```

!!! note

    - The key `EnviromentalVariables` is misspelled in the API specifications.
    - The key `Type` has the following possible values:
        - `0` = A
        - `1` = AAAA
        - `2` = CNAME
        - `3` = TXT
        - `4` = MX
        - `5` = RDR (Redirect)
        - `6` = Flatten
        - `7` = PZ (Pull Zone)
        - `8` = SRV
        - `9` = CAA
        - `10` = PTR
        - `11` = SCR (Script)
        - `12` = NS
    - The key `TTL` has the following possible values (in seconds):
        - `15`
        - `30`
        - `60` =  1 minute
        - `120` = 2 minutes
        - `300` = 5 minutes
        - `900` = 15 minutes
        - `1800` = 30 minutes
        - `3600` = 1 hour
        - `18000` = 5 hours
        - `43200` = 12 hours
        - `86400` = 1 day
    - The key `ScriptId` is not returned in the response.
    - The key `MonitorType` has the following possible values:
        - `0` = None
        - `1` = Ping
        - `2` = HTTP
        - `3` = Monitor
    - The key `SmartRoutingType` has the following possible values:
        - `0` = None
        - `1` = Latency
        - `2` = Geolocation

#### [Update DNS Record](https://docs.bunny.net/reference/dnszonepublic_updaterecord)

```php
$baseApi->updateDnsRecord(
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
        'Id' => 1,
    ],
);
```

!!! note

    - The key `EnviromentalVariables` is misspelled in the API specifications.
    - The key `Type` has the following possible values:
        - `0` = A
        - `1` = AAAA
        - `2` = CNAME
        - `3` = TXT
        - `4` = MX
        - `5` = RDR (Redirect)
        - `6` = Flatten
        - `7` = PZ (Pull Zone)
        - `8` = SRV
        - `9` = CAA
        - `10` = PTR
        - `11` = SCR (Script)
        - `12` = NS
    - The key `TTL` has the following possible values (in seconds):
        - `15`
        - `30`
        - `60` =  1 minute
        - `120` = 2 minutes
        - `300` = 5 minutes
        - `900` = 15 minutes
        - `1800` = 30 minutes
        - `3600` = 1 hour
        - `18000` = 5 hours
        - `43200` = 12 hours
        - `86400` = 1 day
    - The key `ScriptId` is not returned in the response.
    - The key `MonitorType` has the following possible values:
        - `0` = None
        - `1` = Ping
        - `2` = HTTP
        - `3` = Monitor
    - The key `SmartRoutingType` has the following possible values:
        - `0` = None
        - `1` = Latency
        - `2` = Geolocation

#### [Delete DNS Record](https://docs.bunny.net/reference/dnszonepublic_deleterecord)

```php
$baseApi->deleteDnsRecord(
    zoneId: 1,
    id: 2,
);
```

#### [Recheck DNS Configuration](https://docs.bunny.net/reference/dnszonepublic_recheckdns)

```php
$baseApi->recheckDNSConfiguration(
    id: 1,
);
```

#### [Dismiss DNS Configuration Notice](https://docs.bunny.net/reference/dnszonepublic_dismissnameservercheck)

```php
$baseApi->dismissDnsConfigurationNotice(
    id: 1,
);
```

#### [Import DNS Records](https://docs.bunny.net/reference/dnszonepublic_import)

```php
/*
 * File contents read into string from the local filesystem.
 */
$content = file_get_contents('./example.com.2023-08-20.bind');

/*
 * File contents handle from a `$filesystem` (Flysystem FtpAdapter).
 */
$content = $filesystem->readStream('./example.com.2023-08-20.bind');

// Import DNS records.
$baseApi->importDnsRecords(
    zoneId: 1,
    body: $content,
);
```

### Pull Zone

#### [List Pull Zones](https://docs.bunny.net/reference/pullzonepublic_index)

```php
$baseApi->listPullZones(
    query: [
        'page' => 0,
        'perPage' => 1000,
        'search' => 'bunny',
        'includeCertificate' => false,
    ],
);
```

!!! note

    - The key `search` is currently not functional.

#### [Add Pull Zone](https://docs.bunny.net/reference/pullzonepublic_add)

```php
$baseApi->addPullZone(
    body: [
        'OriginUrl' => 'https://my-bucket-2.service.com',
        'AllowedReferrers' => [],
        'BlockedReferrers' => [],
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
        'WAFEnabled' => false,
        'WAFDisabledRuleGroups' => [],
        'WAFDisabledRules' => [],
        'WAFEnableRequestHeaderLogging' => false,
        'WAFRequestHeaderIgnores' => [],
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
        'DnsOriginPort' => 0,
        'DnsOriginScheme' => '',
        'QueryStringVaryParameters' => [],
        'OriginShieldEnableConcurrencyLimit' => false,
        'OriginShieldMaxConcurrentRequests' => 5000,
        'EnableCookieVary' => false,
        'CookieVaryParameters' => [],
        'EnableSafeHop' => false,
        'OriginShieldQueueMaxWaitTime' => 30,
        'UseBackgroundUpdate' => false,
        'OriginShieldMaxQueuedRequests' => 5000,
        'UseBackgroundUpdate' => true,
        'EnableAutoSSL' => false,
        'LogAnonymizationType' => 0,
        'StorageZoneId' => 0,
        'EdgeScriptId' => 0,
        'OriginType' => 0,
        'MagicContainersAppId' => '',
        'LogFormat' => 0,
        'LogForwardingFormat' => 0,
        'ShieldDDosProtectionType' => 1,
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
        'PreloadingScreenTheme' => 0,
        'PreloadingScreenCodeEnabled' => false,
        'PreloadingScreenDelay' => 700,
        'RoutingFilters' => [],
        'Name' => 'New Pull Zone',
    ],
);
```

!!! note

    - The key `Type` has the following possible values:
        - `0` = Premium
        - `1` = Volume
    - The key `OriginType` has the following possible values:
        - `0` = OriginUrl
        - `1` = DnsAccelerate
        - `2` = StorageZone
        - `3` = LoadBalancer
        - `4` = EdgeScript
        - `5` = MagicContainers
        - `6` = PushZone
    - The key `LogFormat` has the following possible values:
        - `0` = Plain
        - `1` = JSON
    - The key `LogForwardingFormat` has the following possible values:
        - `0` = Plain
        - `1` = JSON
    - The key `ShieldDDosProtectionType` has the following possible values:
        - `0` = DetectOnly
        - `1` = ActiveStandard
        - `2` = ActiveAggressive
    - The key `LogAnonymizationType` has the following possible values:
        - `0` = Remove one octet
        - `1` = Drop IP
    - The key `LogForwardingProtocol` has the following possible values:
        - `0` = UDP
        - `1` = TCP
        - `2` = TCPEncrypted
        - `3` = DataDog
    - The key `OptimizerWatermarkPosition` has the following possible values:
        - `0` = BottomLeft
        - `1` = BottomRight
        - `2` = TopLeft
        - `4` = Center
        - `5` = CenterStretch
    - The keys `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The Bunny dashboard will
    show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
    - The key `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
    - The `WAF` related settings are not implemented yet. This feature is currently being worked on and does not have an ETA.
      It is advised **not** to update these values until the feature is implemented, therefore these options
      are removed from the example above.

#### [Get Pull Zone](https://docs.bunny.net/reference/pullzonepublic_index2)

```php
$baseApi->getPullZone(
    id: 1,
    query: [
        'includeCertificate' => false,
    ],
);
```

#### [Update Pull Zone](https://docs.bunny.net/reference/pullzonepublic_updatepullzone)

```php
$baseApi->updatePullZone(
    id: 1,
    body: [
        'OriginUrl' => 'https://my-bucket-2.service.com',
        'AllowedReferrers' => [],
        'BlockedReferrers' => [],
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
        'WAFEnabled' => false,
        'WAFDisabledRuleGroups' => [],
        'WAFDisabledRules' => [],
        'WAFEnableRequestHeaderLogging' => false,
        'WAFRequestHeaderIgnores' => [],
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
        'DnsOriginPort' => 0,
        'DnsOriginScheme' => '',
        'QueryStringVaryParameters' => [],
        'OriginShieldEnableConcurrencyLimit' => false,
        'OriginShieldMaxConcurrentRequests' => 5000,
        'EnableCookieVary' => false,
        'CookieVaryParameters' => [],
        'EnableSafeHop' => false,
        'OriginShieldQueueMaxWaitTime' => 30,
        'UseBackgroundUpdate' => false,
        'OriginShieldMaxQueuedRequests' => 5000,
        'UseBackgroundUpdate' => true,
        'EnableAutoSSL' => false,
        'LogAnonymizationType' => 0,
        'StorageZoneId' => 0,
        'EdgeScriptId' => 0,
        'OriginType' => 0,
        'MagicContainersAppId' => '',
        'LogFormat' => 0,
        'LogForwardingFormat' => 0,
        'ShieldDDosProtectionType' => 1,
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
        'PreloadingScreenTheme' => 0,
        'PreloadingScreenCodeEnabled' => false,
        'PreloadingScreenDelay' => 700,
        'RoutingFilters' => [],
    ],
);
```

!!! note

    - The key `Type` has the following possible values:
        - `0` = Premium
        - `1` = Volume
    - The key `OriginType` has the following possible values:
        - `0` = OriginUrl
        - `1` = DnsAccelerate
        - `2` = StorageZone
        - `3` = LoadBalancer
        - `4` = EdgeScript
        - `5` = MagicContainers
        - `6` = PushZone
    - The key `LogFormat` has the following possible values:
        - `0` = Plain
        - `1` = JSON
    - The key `LogForwardingFormat` has the following possible values:
        - `0` = Plain
        - `1` = JSON
    - The key `ShieldDDosProtectionType` has the following possible values:
        - `0` = DetectOnly
        - `1` = ActiveStandard
        - `2` = ActiveAggressive
    - The key `LogAnonymizationType` has the following possible values:
        - `0` = Remove one octet
        - `1` = Drop IP
    - The key `LogForwardingProtocol` has the following possible values:
        - `0` = UDP
        - `1` = TCP
        - `2` = TCPEncrypted
        - `3` = DataDog
    - The key `OptimizerWatermarkPosition` has the following possible values:
        - `0` = BottomLeft
        - `1` = BottomRight
        - `2` = TopLeft
        - `4` = Center
        - `5` = CenterStretch
    - The keys `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The Bunny dashboard will
    show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
    - The key `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
    - The `WAF` related settings are not implemented yet. This feature is currently being worked on and does not have an ETA.
      It is advised **not** to update these values until the feature is implemented, therefore these options
      are removed from the example above.

#### [Delete Pull Zone](https://docs.bunny.net/reference/pullzonepublic_delete)

```php
$baseApi->deletePullZone(
    id: 1,
);
```

#### [Add Edge Rule](https://docs.bunny.net/reference/pullzonepublic_addedgerule)

```php
$baseApi->addOrUpdateEdgeRule(
    pullZoneId: 1,
    body: [
        'Guid' => 'c71d9594-3bc6-4639-9896-ba3e96217587', // required for update, not add
        'ActionType' => 4,
        'ActionParameter1' => '',
        'ActionParameter2' => '',
        'Triggers' => [
            [
                'Type' => 0,
                'PatternMatches' => [
                    'https://example.b-cdn.net/images/*',
                    'https://example.b-cdn.net/videos/*',
                ]
                'PatternMatchingType' => 0,
                'Parameter1' => '',
            ],
        ],
        'TriggerMatchingType' => 0,
        'Description' => '',
        'Enabled' => true
    ],
);
```

!!! note

    - The key `ActionType` has the following possible values:
        - `0` = Force SSL
        - `1` = Redirect To URL
        - `2` = Change Origin URL
        - `3` = Override Cache Time
        - `4` = Block Request
        - `5` = Set Response header
        - `6` = Set Request Header
        - `7` = Force Download
        - `8` = Disable Token Authentication
        - `9` = Enable Token Authentication
        - `10` = Override Cache Time Public
        - `11` = Ignore Query String (Cache Vary)
        - `12` = Disable Bunny Optimizer
        - `13` = Force Compression
        - `14` = Set Status Code
        - `15` = Bypass Perma-Cache
        - `16` = Override Browser Cache Time
        - `17` = Origin Storage
        - `18` = Set Network Rate Limit
        - `19` = Set Connection Limit
        - `20` = Set Requests Per Second Limit
    - The key `Type` in a `Trigger` object has the following possible values:
        - `0` = URL
        - `1` = Request Header
        - `2` = Response Header
        - `3` = File/URL Extension
        - `4` = Country Code (2 letter)
        - `5` = Remote IP
        - `6` = Query String
        - `7` = Random Chance (%)
        - `8` = Status Code
        - `9` = Request method
        - `10` = Cookie Value
        - `11` = Country State Code
    - The key `TriggerMatchingType` has the following possible values:
        - `0` = Match Any
        - `1` = Match All
        - `2` = Match None
    - The keys `Guid`, `Type` and `PatternMatchingType` in the body are required parameters when updating an edge rule.

#### [Set Edge Rule Enabled](https://docs.bunny.net/reference/pullzonepublic_setedgeruleenabled)

```php
$baseApi->setEdgeRuleEnabled(
    pullZoneId: 1,
    edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587',
    body: [
        'Id' => 1,
        'Value' => true,
    ],
);
```

!!! note

    -  The key `Id` in the body denotes the pull zone ID (the same as the first argument) and is (for some reason) a required parameter.

#### [Delete Edge Rule](https://docs.bunny.net/reference/pullzonepublic_deleteedgerule)

```php
$baseApi->deleteEdgeRule(
    pullZoneId: 1,
    edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587',
);
```

#### Set Zone Security Enabled

```php
$baseApi->setZoneSecurityEnabled(
    Id: 1,
    Value: true
);
```

!!! note

    - This endpoint corresponds to toggling the **Enable Token Authentication** switch in the **Token Authentication > Security** section of your pull zone.

!!! warning
    
    - This endpoint is currently not documented in the API specifications.

#### Set Zone Security Include Hash Remote IP Enabled

```php
$baseApi->setZoneSecurityIncludeHashRemoteIPEnabled(
    Id: 1,
    Value: true
);
```

!!! note

    - This endpoint corresponds to toggling the **Token IP Validation** switch in the **Token Authentication > Security** section of your pull zone.

!!! warning

    - This endpoint is currently not documented in the API specifications.

#### [Get Origin Shield Queue Statistics](https://docs.bunny.net/reference/pullzonepublic_originshieldconcurrencystatistics)

```php
$baseApi->getOriginShieldQueueStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false,
    ],
);
```

#### [Get SafeHop Statistics](https://docs.bunny.net/reference/pullzonepublic_safehopstatistics)

```php
$baseApi->getSafeHopStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false,
    ],
);
```

#### [Get Optimizer Statistics](https://docs.bunny.net/reference/pullzonepublic_optimizerstatistics)

```php
$baseApi->getOptimizerStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false,
    ],
);
```

#### Get WAF Statistics

```php
$baseApi->getWafStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false,
    ],
);
```

!!! warning

    - This endpoint is currently not documented in the API specifications.

#### [Load Free Certificate](https://docs.bunny.net/reference/pullzonepublic_loadfreecertificate)

```php
$baseApi->loadFreeCertificate(
    query: [
        'hostname' => 'cdn.example.com',
    ],
);
```

#### [Purge Cache (by tag)](https://docs.bunny.net/reference/pullzonepublic_purgecachepostbytag)

```php
$baseApi->purgePullZoneCache(
    id: 1,
    body: [
        'CacheTag' => 'mytag-region-*',
    ],
);
```

#### [Check Pull Zone Availability](https://docs.bunny.net/reference/pullzonepublic_checkavailability)

```php
$baseApi->checkPullZoneAvailability(
    body: [
        'Name' => 'test',
    ],
);
```

#### [Add Certificate](https://docs.bunny.net/reference/pullzonepublic_addcertificate)

```php
$baseApi->addCertificate(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
        'Certificate' => 'LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tCk5ldmVyIGdvbm5hIGdpdmUgeW91IHVwLgotLS0tLUVORCBDRVJUSUZJQ0FURS0tLS0t',
        'CertificateKey' => 'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpOZXZlciBnb25uYSBsZXQgeW91IGRvd24uCi0tLS0tRU5EIFJTQSBQUklWQVRFIEtFWS0tLS0t',
    ],
);
```

!!! note

    - The keys `Certificate` and `CertificateKey` require the file contents to be sent as base64 encoded strings.

#### [Remove Certificate](https://docs.bunny.net/reference/pullzonepublic_removecertificate)

```php
$baseApi->removeCertificate(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
    ],
);
```

#### [Add Custom Hostname](https://docs.bunny.net/reference/pullzonepublic_addhostname)

```php
$baseApi->addCustomHostname(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
    ],
);
```

#### [Remove Custom Hostname](https://docs.bunny.net/reference/pullzonepublic_removehostname)

```php
$baseApi->removeCustomHostname(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
    ],
);
```

#### [Set Force SSL](https://docs.bunny.net/reference/pullzonepublic_setforcessl)

```php
$baseApi->setForceSsl(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
        'ForceSSL' => true,
    ],
);
```

#### [Reset Token Key](https://docs.bunny.net/reference/pullzonepublic_resetsecuritykey)

```php
$baseApi->resetPullZoneTokenKey(
    id: 1,
);
```

#### [Add Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer)

```php
$baseApi->addPullZoneAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com,*.example.org',
    ],
);
```

!!! note

    - The key `Hostname` allows multiple values through comma separated values.

#### [Remove Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_removeallowedreferrer)

```php
$baseApi->removePullZoneAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com',
    ],
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked Referer](https://docs.bunny.net/reference/pullzonepublic_addblockedreferrer)

```php
$baseApi->addPullZoneBlockedReferer(
    id: 1,
    body: [
        'Hostname' => '*.evil.org',
    ],
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Remove Blocked Referer](https://docs.bunny.net/reference/pullzonepublic_removeblockedreferrer)

```php
$baseApi->removePullZoneBlockedReferer(
    id: 1,
    body: [
        'Hostname' => '*.evil.org',
    ],
);
```

#### [Add Blocked IP](https://docs.bunny.net/reference/pullzonepublic_addblockedip)

```php
$baseApi->addPullZoneBlockedIp(
    id: 1,
    body: [
        'BlockedIp' => '12.345.67.89',
    ],
);
```

#### [Remove Blocked IP](https://docs.bunny.net/reference/pullzonepublic_removeblockedip)

```php
$baseApi->removePullZoneBlockedIp(
    id: 1,
    body: [
        'BlockedIp' => '12.345.67.89',
    ],
);
```

### Purge

#### [Purge URL](https://docs.bunny.net/reference/purgepublic_indexpost)

```php
$baseApi->purgeUrl(
    query: [
        'url' => 'https://example.b-cdn.net/images/*',
        'async' => false,
    ],
);
```

#### [Purge URL (by header)](https://docs.bunny.net/reference/purgepublic_index)

```php
$baseApi->purgeUrlByHeader(
    query: [
        'url' => 'https://example.b-cdn.net/images/*',
        'headerName' => '',
        'headerValue' => '',
        'async' => false,
    ],
);
```

### Search

#### [Global Search](https://docs.bunny.net/reference/searchpublic_globalsearch)

```php
$baseApi->getGlobalSearch(
    query: [
        'search' => 'bunny',
        'from' => 0,
        'size' => 20,
    ],
);
```

!!! warning

    - It is unclear from the current API specifications what you can actually search for with this endpoint.

### Statistics

#### [Get Statistics (traffic, cache hit & bandwidth)](https://docs.bunny.net/reference/statisticspublic_index)

```php
$baseApi->getStatistics(
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'pullZone' => -1,
        'serverZoneId' => -1,
        'loadErrors' => false,
        'hourly' => false,
    ],
);
```

### Storage Zone

#### [List Storage Zones](https://docs.bunny.net/reference/storagezonepublic_index)

```php
$baseApi->listStorageZones(
    query: [
        'page' => 0,
        'perPage' => 1000,
        'search' => 'bunny',
        'includeDeleted' => 1000,
    ],
);
```

!!! note

    - The key `search` is currently not functional.

#### [Add Storage Zone](https://docs.bunny.net/reference/storagezonepublic_add)

```php
$baseApi->addStorageZone(
    body: [
        'OriginUrl' => '',
        'Name' => 'Test',
        'Region' => 'DE',
        'ReplicationRegions' => '',
        'ZoneTier' => 0,
    ],
);
```

!!! note

    - The key `OriginUrl` allows you to specify a backup data source, in case the file does not exist on the Storage Zone.
    So for example, you would request `/image.png`. Assuming `image.png` doesn't exist on the storage zone,
    the system will try to proxy and fetch it from the `OriginUrl` instead. You can omit it unless needed.
    - The key `ZoneTier` has the following possible values (undocumented):
        - `0` = Standard = HDD
        - `1` = Edge = SSD
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

#### [Check Storage Zone Availability](https://docs.bunny.net/reference/storagezonepublic_checkavailability)

```php
$baseApi->checkStorageZoneAvailability(
    body: [
        'Name' => 'Test',
    ],
);
```

#### [Get Storage Zone](https://docs.bunny.net/reference/storagezonepublic_index2)

```php
$baseApi->getStorageZone(
    id: 1,
);
```

#### [Get Storage Zone](https://docs.bunny.net/reference/storagezonepublic_index2)

```php
$baseApi->getStorageZone(
    id: 1,
);
```

#### [Update Storage Zone](https://docs.bunny.net/reference/storagezonepublic_update)

```php
$baseApi->updateStorageZone(
    id: 1,
    body: [
        'ReplicationZones' => '',
        'OriginUrl' => '',
        'Custom404FilePath' => 'my-custom-404.html',
        'Rewrite404To200' => false,
    ],
);
```

!!! note

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
$baseApi->deleteStorageZone(
    id: 1,
);
```

#### [Get Storage Zone Statistics](https://docs.bunny.net/reference/storagezonepublic_storagezonestatistics)

```php
$baseApi->getStorageZoneStatistics(
    id: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
    ],
);
```

#### [Get Storage Zone Connections](https://docs.bunny.net/reference/storagezonepublic_connections)

```php
$baseApi->getStorageZoneConnections(
    id: 1,
);
```

#### [Reset Password](https://docs.bunny.net/reference/storagezonepublic_resetpassword)

```php
$baseApi->resetStorageZonePassword(
    id: 1,
);
```

#### [Reset Read-Only Password](https://docs.bunny.net/reference/storagezonepublic_resetreadonlypassword)

```php
$baseApi->resetStorageZoneReadOnlyPassword(
    query: [
        'id' => 1,
    ],
);
```

### User

#### [Get Home Feed](ttps://docs.bunny.net/reference/userpublic_homefeed)

```php
$baseApi->getHomeFeed();
```

#### [Get User Details](https://docs.bunny.net/reference/userpublic_index)

```php
$baseApi->getUserDetails();
```

#### [Update User Details](https://docs.bunny.net/reference/userpublic_updateuser)

```php
$baseApi->updateUserDetails(
    body: [
        'FirstName' => 'John',
        'Email' => 'john.doe@example.com',
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
    ],
);
```

#### [Resend Email Confirmation](https://docs.bunny.net/reference/userpublic_resendemailconfirmation)

```php
$baseApi->resendEmailConfirmation();
```

#### [Reset API Key](https://docs.bunny.net/reference/userpublic_resetapikey)

```php
$baseApi->resetUserApiKey();
```

#### [List Close Account Reasons](https://docs.bunny.net/reference/userpublic_listcloseaccountreasons)

```php
$baseApi->listCloseAccountReasons();
```

#### [Close Account](https://docs.bunny.net/reference/userpublic_closeaccount)

```php
$baseApi->closeAccount(
    body: [
        'Password' => 'Abcd1234',
        'Reason' => 'No longer needed.',
    ],
);
```

#### [Get DPA Details](https://docs.bunny.net/reference/userpublic_dpa)

```php
$baseApi->getDpaDetails();
```

#### [Accept DPA](https://docs.bunny.net/reference/userpublic_dpaaccept)

```php
$baseApi->acceptDpa();
```

#### [Get DPA Details (HTML)](https://docs.bunny.net/reference/userpublic_dpapdfhhtml)

```php
$baseApi->getDpaDetailsHtml();
```

#### [List Notifications](https://docs.bunny.net/reference/userpublic_notificationslist)

```php
$baseApi->listNotifications();
```

#### [Set Notifications Opened](https://docs.bunny.net/reference/userpublic_setnotificationsopened)

```php
$baseApi->setNotificationsOpened();
```

#### [Get Marketing Details](https://docs.bunny.net/reference/userpublic_marketingdetails)

```php
$baseApi->getMarketingDetails();
```

#### [Get What's New Items](https://docs.bunny.net/reference/userpublic_whatsnew)

```php
$baseApi->getWhatsNewItems();
```

#### [Reset What's New](https://docs.bunny.net/reference/userpublic_whatsnewreset)

```php
$baseApi->resetWhatsNew();
```

#### [Generate 2FA Verification](https://docs.bunny.net/reference/userpublic_twofactorgenerateverification)

```php
$baseApi->generateTwoFactorAuthenticationVerification();
```

#### [Disable 2FA](https://docs.bunny.net/reference/userpublic_twofactordisable)

```php
$baseApi->disableTwoFactorAuthentication(
    body: [
        'Password' => 'LoremIpsumDolor',
    ],
);
```

#### [Enable 2FA](https://docs.bunny.net/reference/userpublic_twofactorenable)

```php
$baseApi->enableTwoFactorAuthentication(
    body: [
        'SecretValidator' => '',
        'Secret' => '',
        'TestPin' => '123456',
    ],
);
```

#### [Verify 2FA Code](https://docs.bunny.net/reference/userpublic_twofactorverify)

```php
$baseApi->verifyTwoFactorAuthenticationCode(
    body: [
        'SecretValidator' => '',
        'Secret' => '',
        'TestPin' => '123456',
    ],
);
```

## Reference

* [Base API](https://docs.bunny.net/reference/bunnynet-api-overview)
