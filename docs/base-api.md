# Base API

Base endpoint for pull zones, video libraries, storage zones, billing, support, etc. 
Basically everything that can be done with the control panel can also be achieved with the API.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BaseAPI;
use ToshY\BunnyNet\Client\BunnyClient;

$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\Psr18Client() # (1)
);

$baseAPI = new BaseAPI(
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989', # (2)
    client: $bunnyClient
);
```

1. Create a BunnyClient using any HTTP client implementing `Psr\Http\Client\ClientInterface`.
2. Provide the API key available at the **Account Settings > API** section.

## Usage

### Abuse Case

#### [List Abuse Cases](https://docs.bunny.net/reference/abusecasepublic_index)

```php
<?php

$baseAPI->listAbuseCases(
    query: [
        'page' => 1,
        'perPage' => 1000,
    ]
);
```

#### [Resolve DMCA Case](https://docs.bunny.net/reference/abusecasepublic_resolveabusecase)

```php
<?php

$baseAPI->resolveDMCACase(
    id: 1,
);
```

#### [Resolve Abuse Case](https://docs.bunny.net/reference/abusecasepublic_resolveabusecase2)

```php
<?php

$baseAPI->resolveAbuseCase(
    id: 1,
);
```

#### [Check Abuse Case](https://docs.bunny.net/reference/abusecasepublic_checkabusecase)

```php
<?php

$baseAPI->checkAbuseCase(
    id: 1,
);
```

### Countries

#### [Get Country List](https://docs.bunny.net/reference/countriespublic_getcountrylist)

```php
<?php

$baseAPI->getCountryList();
```

### Billing

#### [Get Billing Details](https://docs.bunny.net/reference/billingpublic_index)

```php
<?php

$baseAPI->getBillingDetails();
```

#### [Configure Auto Recharge](https://docs.bunny.net/reference/billingpublic_configureautorecharge)

```php
<?php

$baseAPI->configureAutoRecharge(
    body: [
        'AutoRechargeEnabled' => true,
        'PaymentMethodToken' => 1000,
        'PaymentAmount' => 10,
        'RechargeTreshold' => 2
    ]
);
```

!!! note

    - The key `RechargeTreshold` (misspelled) has a value range of 2-2000.
    - The key `PaymentAmount` has a value range of 10-2000.

#### [Create Payment Checkout](https://docs.bunny.net/reference/billingpublic_checkout)

```php
<?php

$baseAPI->createPaymentCheckout(
    body: [
        'RechargeAmount' => 10,
        'PaymentAmount' => 10,
        'PaymentRequestId' => 123456,
        'Nonce' => 'ab'
    ]
);
```

!!! note

    - The key `RechargeTreshold` (misspelled) has a value range of 2-2000.
    - The key `PaymentAmount` has a value range of 10-2000.

#### [Prepare Payment Authorization](https://docs.bunny.net/reference/billingpublic_paymentsprepareauthorization)

```php
<?php

$baseAPI->preparePaymentAuthorization();
```

#### [Get Affiliate Details](https://docs.bunny.net/reference/billingpublic_affiliatedetails)

```php
<?php

$baseAPI->getAffiliateDetails();
```

#### [Claim Affiliate Credits](https://docs.bunny.net/reference/billingpublic_affiliateclaim)

```php
<?php

$baseAPI->claimAffiliateCredits();
```

#### [ Get The Coinify BTC exchange rate](https://docs.bunny.net/reference/billingpublic_coinifyexchangerate)

```php
<?php

$baseAPI->getCoinifyBTCExchangeRate();
```

#### [Create Coinify payment](https://docs.bunny.net/reference/billingpublic_createcoinifypayment)

```php
<?php

$baseAPI->createCoinifyPayment(
    query: [
        'amount' => 123
    ]
);
```

#### [Get Billing Summary](https://docs.bunny.net/reference/billingpublic_summary)

```php
<?php

$baseAPI->getBillingSummary();
```

#### [Apply Promo Code](https://docs.bunny.net/reference/billingpublic_applycode)

```php
<?php

$baseAPI->applyPromoCode(
    query: [
        'CouponCode' => 'YOUFOUNDME'
    ]
);
```

### Compute

#### [List Compute Scripts](https://docs.bunny.net/reference/computeedgescriptpublic_index)

```php
<?php

$baseAPI->listComputeScripts(
    query: [
        'page' => 1,
        'perPage' => 1000
    ]
);
```

#### [Add Compute Script](https://docs.bunny.net/reference/computeedgescriptpublic_addscript)

```php
<?php

$baseAPI->addComputeScript(
    body: [
        'Name' => 'Test',
        'ScriptType' => 1000
    ]
);
```

!!! note

    - The key `ScriptType` has the following possible values:
        - `0` = CDN
        - `1` = DNS

#### [Get Compute Script](https://docs.bunny.net/reference/computeedgescriptpublic_index2)

```php
<?php

$baseAPI->getComputeScript(
    id: 1
);
```

#### [Update Compute Script](https://docs.bunny.net/reference/computeedgescriptpublic_update)

```php
<?php

$baseAPI->updateComputeScript(
    id: 1,
    body: [
        'Name' => 'Test',
        'ScriptType' => 1000
    ]
);
```

!!! note

    - The key `ScriptType` has the following possible values:
        - `0` = CDN
        - `1` = DNS

#### [Delete Compute Script](https://docs.bunny.net/reference/computeedgescriptpublic_delete)

```php
<?php

$baseAPI->deleteComputeScript(
    id: 1
);
```

#### [Get Compute Script Code](https://docs.bunny.net/reference/computeedgescriptpublic_getcode)

```php
<?php

$baseAPI->getComputeScriptCode(
    id: 1
);
```

#### [Update Compute Script Code](https://docs.bunny.net/reference/computeedgescriptpublic_setcode)

```php
<?php

$baseAPI->updateComputeScriptCode(
    id: 1,
    body: [
        'Code' => "export default function handleQuery(event) {\n    console.log(\"Hello world!\")\n    return new TxtRecord(\"Hello world!\");\n}",
    ]
);
```

#### [List Compute Script Releases](https://docs.bunny.net/reference/computeedgescriptpublic_getreleases)

```php
<?php

$baseAPI->listComputeScriptReleases(
    id: 1,
    query: [
        'page' => 1,
        'perPage' => 1000
    ]
);
```

#### [Publish Compute Script](https://docs.bunny.net/reference/computeedgescriptpublic_publish)

```php
<?php

$baseAPI->publishComputeScript(
    id: 1,
    query: [
        'uuid' => '173d4dfc-a8dd-42f5-a55c-cba765c75aa5'
    ],
    body: [
        'Note' => 'Initial release'
    ]
);
```

#### [Publish Compute Script (by path parameter)](https://docs.bunny.net/reference/computeedgescriptpublic_publish2)

```php
<?php

$baseAPI->publishComputeScriptByPathParameter(
    id: 1,
    uuid: '173d4dfc-a8dd-42f5-a55c-cba765c75aa5',
    body: [
        'Note' => 'Initial release'
    ]
);
```

#### [Create Compute Script Variable](https://docs.bunny.net/reference/computeedgescriptpublic_addvariable)

```php
<?php

$baseAPI->addComputeScriptVariable(
    id: 1,
    body: [
        'Name' => 'New Variable',
        'Required' => true,
        'DefaultValue' => 'Hello World'
    ]
);
```

#### [Update Compute Script Variable](https://docs.bunny.net/reference/computeedgescriptpublic_updatevariable)

```php
<?php

$baseAPI->updateComputeScriptVariable(
    id: 1,
    variableId: 2,
    body: [
        'DefaultValue' => 'Hello World the Sequel',
        'Required' => false
    ]
);
```

#### [Get Compute Script Variable](https://docs.bunny.net/reference/computeedgescriptpublic_getvariable)

```php
<?php

$baseAPI->getComputeScriptVariable(
    id: 1,
    variableId: 2
);
```

#### [Delete Compute Script Variable](https://docs.bunny.net/reference/computeedgescriptpublic_deletevariable)

```php
<?php

$baseAPI->deleteComputeScriptVariable(
    id: 1,
    variableId: 2
);
```

### Support

#### [List Tickets](https://docs.bunny.net/reference/supportpublic_index)

```php
<?php

$baseAPI->listTickets(
    query: [
        'page' => 1,
        'perPage' => 1000
    ]
);
```

#### [Get Ticket Details](https://docs.bunny.net/reference/supportpublic_index2)

```php
<?php

$baseAPI->getTicketDetails(
    id: 1
);
```

#### [Close Ticket](https://docs.bunny.net/reference/supportpublic_close)

```php
<?php

$baseAPI->closeTicket(
    id: 1
);
```

#### [Reply Ticket](https://docs.bunny.net/reference/supportpublic_reply)

```php
<?php

$baseAPI->closeTicket(
    id: 1,
    body: [
        'Message' => 'Hope you are having a nice day!\n\nThe weather is nice outside.',
        'Attachments' => [
            [
                'Body' => 'aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1kUXc0dzlXZ1hjUQ==',
                'FileName' => 'details.txt',
                'ContentType' => 'text/plain'
            ]
        ]
    ]
);
```

!!! note

    - The key `Body` requires its contents to be base64 encoded.

#### [Create Ticket](https://docs.bunny.net/reference/supportpublic_createticket)

```php
<?php

$baseAPI->createTicket(
    id: 1,
    body: [
        'Subject' => 'Good day!',
        'LinkedPullZone' => 1,
        'Message' => 'Hope you are having a nice day!\n\nThe weather is nice outside.',
        'LinkedStorageZone' => 2,
        'Attachments' => [
            [
                'Body' => 'aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1kUXc0dzlXZ1hjUQ==',
                'FileName' => 'details.txt',
                'ContentType' => 'text/plain'
            ]
        ]
    ]
);
```

!!! note

    - The keys `LinkedPullZone` and `LinkedStorageZone` are not required unlike stated in the API specifications.
    - The key `Body` requires its contents to be base64 encoded.

### DRM Certificate

#### [List DRM Certificates](https://docs.bunny.net/reference/drmcertificatepublic_index)

```php
<?php

$baseAPI->listDRMCertificates(
    query: [
        'page' => 1,
        'perPage' => 1000
    ]
);
```

### Region

#### [List Regions](https://docs.bunny.net/reference/regionpublic_index)

```php
<?php

$baseAPI->listRegions();
```

### Stream Video Library

#### [List Video Libraries](https://docs.bunny.net/reference/videolibrarypublic_index)

```php
<?php

$baseAPI->listVideoLibraries(
    query: [
        'page' => 0,
        'perPage' => 1000,
        'includeAccessKey' => false
    ]
);
```

#### [Add Video Library](https://docs.bunny.net/reference/videolibrarypublic_add)

```php
<?php

$baseAPI->addVideoLibrary(
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
            'JH'
        ]
    ]
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
        - `BR` = Sao Paolo (Brazil)
        - `JH` = Johannesburg (Africa)

#### [Get Video Library](https://docs.bunny.net/reference/videolibrarypublic_index2)

```php
<?php

$baseAPI->getVideoLibrary(
    id: 1,
    query: [
        'includeAccessKey' => false
    ]
);
```

#### [Update Video Library]()

```php
<?php

$baseAPI->updateVideoLibrary(
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
        'FontFamily' => 'Arial'
    ]
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

#### [Delete Video Library](https://docs.bunny.net/reference/videolibrarypublic_delete)

```php
<?php

$baseAPI->deleteVideoLibrary(
    id: 1
);
```

#### [Reset Password](https://docs.bunny.net/reference/videolibrarypublic_resetpassword)

```php
<?php

$baseAPI->resetVideoLibraryPassword(
    query: [
        'id' => 1
    ]
);
```

#### [Reset Password](https://docs.bunny.net/reference/videolibrarypublic_resetpassword)

```php
<?php

$baseAPI->resetVideoLibraryPassword(
    query: [
        'id' => 1
    ]
);
```

#### [Reset Password (by path parameter)](https://docs.bunny.net/reference/videolibrarypublic_resetpassword2)

```php
<?php

$baseAPI->resetVideoLibraryPasswordByPathParameter(
    id: 1
);
```

#### [Add Watermark](https://docs.bunny.net/reference/videolibrarypublic_addwatermark)

```php
<?php

$baseAPI->addWatermark(
    id: 1
);
```

#### [Delete Watermark](https://docs.bunny.net/reference/videolibrarypublic_deletewatermark)

```php
<?php

$baseAPI->deleteWatermark(
    id: 1
);
```

#### [Add Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer)

```php
<?php

$baseAPI->addVideoLibraryAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com,*.example.org'
    ]
);
```

!!! note

    - The key `Hostname` allows multiple values through comma separated values.

#### [Remove Allowed Referer](https://docs.bunny.net/reference/videolibrarypublic_removeallowedreferrer)

```php
<?php

$baseAPI->removeVideoLibraryAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com'
    ]
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked Referer](ttps://docs.bunny.net/reference/videolibrarypublic_addblockedreferrer)

```php
<?php

$baseAPI->addVideoLibraryBlockedReferer(
    id: 1,
    body: [
        'Hostname' => 'evil.org'
    ]
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Remove Blocked Referer](https://docs.bunny.net/reference/videolibrarypublic_removeblockedreferrer)

```php
<?php

$baseAPI->removeVideoLibraryBlockedReferer(
    id: 1,
    body: [
        'Hostname' => 'evil.org'
    ]
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

### DNS Zone

#### [List DNS Zones](https://docs.bunny.net/reference/dnszonepublic_index)

```php
<?php

$baseAPI->listDNSZones(
    query: [
        'page' => 1,
        'perPage' => 1000
    ]
);
```

#### [Add DNS Zone](https://docs.bunny.net/reference/dnszonepublic_add)

```php
<?php

$baseAPI->addDNSZone(
    body: [
        'Domain' => 'example.com',
    ]
);
```

#### [Get DNS Zone](https://docs.bunny.net/reference/dnszonepublic_index2)

```php
<?php

$baseAPI->getDNSZone(
    id: 1
);
```

#### [Update DNS Zone](https://docs.bunny.net/reference/dnszonepublic_update)

```php
<?php

$baseAPI->updateDNSZone(
    id: 1,
    body: [
        'CustomNameserversEnabled' => true,
        'Nameserver1' => 'abbby.ns.cloudflare.com',
        'Nameserver2' => 'jonah.ns.cloudflare.com',
        'SoaEmail' => 'admin@example.com',
        'LoggingEnabled' => true,
        'LogAnonymizationType' => true,
        'LoggingIPAnonymizationEnabled' => true,
    ]
);
```

!!! note

    - The key `LogAnonymizationType` has the following possible values (undocumented):
        - `0` = Remove one octet
        - `1` = Drop IP
    - In order to disable `LoggingIPAnonymizationEnabled` you first need to agree to the DPA agreement (GDPR).

#### [Delete DNS Zone](https://docs.bunny.net/reference/dnszonepublic_delete)

```php
<?php

$baseAPI->deleteDNSZone(
    id: 1
);
```

#### [Export DNS Zone](https://docs.bunny.net/reference/dnszonepublic_export)

```php
<?php

$baseAPI->exportDNSZone(
    id: 1
);
```

#### [Get DNS Query Statistics](https://docs.bunny.net/reference/dnszonepublic_statistics)

```php
<?php

$baseAPI->getDNSZoneQueryStatistics(
    id: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y'
    ]
);
```

#### [Check DNS Zone Availability](https://docs.bunny.net/reference/dnszonepublic_checkavailability)

```php
<?php

$baseAPI->checkDNSZoneAvailability(
    body: [
        'Name' => 'example.com',
    ]
);
```

#### [Add DNS Record](https://docs.bunny.net/reference/dnszonepublic_addrecord)

```php
<?php

$baseAPI->addDNSRecord(
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
                'Value' => 'World'
            ]
        ]
    ]
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
        - `6` = (Unknown)
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
        - (Unknown)

#### [Update DNS Record](https://docs.bunny.net/reference/dnszonepublic_updaterecord)

```php
<?php

$baseAPI->updateDNSRecord(
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
                'Value' => 'World'
            ]
        ]
    ]
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
        - `6` = (Unknown)
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
        - (Unknown)

#### [Delete DNS Record](https://docs.bunny.net/reference/dnszonepublic_deleterecord)

```php
<?php

$baseAPI->deleteDNSRecord(
    zoneId: 1,
    id: 2
);
```

#### [Delete DNS Record](https://docs.bunny.net/reference/dnszonepublic_recheckdns)

```php
<?php

$baseAPI->recheckDNSConfiguration(
    id: 1
);
```

#### [Dismiss DNS Configuration Notice](https://docs.bunny.net/reference/dnszonepublic_dismissnameservercheck)

```php
<?php

$baseAPI->dismissDNSConfigurationNotice(
    id: 1
);
```

#### [Import DNS Records](https://docs.bunny.net/reference/dnszonepublic_import)

```php
<?php

$baseAPI->importDNSRecords(
    zoneId: 1,
    localFilePath: './records.txt'
);
```

!!! note

    - The argument `localFilePath` is the path to the local file containing the DNS records for your zone.

### Pull Zone

#### [List Pull Zones](https://docs.bunny.net/reference/pullzonepublic_index)

```php
<?php

$baseAPI->listPullZones(
    query: [
        'page' => 0,
        'perPage' => 1000,
        'includeCertificate' => false
    ]
);
```

#### [Add Pull Zone](https://docs.bunny.net/reference/pullzonepublic_add)

```php
<?php

$baseAPI->addPullZone(
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
        'EnableAutoSSL' => false,
        'LogAnonymizationType' => 0,
        'StorageZoneId' => 0,
        'EdgeScriptId' => 0,
        'OriginType' => 0,
        'LogFormat' => 0,
        'LogForwardingFormat' => 0,
        'ShieldDDosProtectionType' => 1,
        'ShieldDDosProtectionEnabled' => false,
        'OriginHostHeader' => '',
        'EnableSmartCache' => false,
        'EnableRequestCoalescing' => false,
        'RequestCoalescingTimeout' => 30,
        'Name' => 'New Pull Zone'
    ]
);
```

!!! note

    - The key `Type` has the following possible values:
        - `0` = Premium
        - `1` = Volume
    - The key `Type` has the following possible values (undocumented):
        - `0` = URL
        - `1` = (Unknown)
        - `2` = Storage Zone
        - `3` = (Unknown)
        - `4` = Script
    - The key `LogAnonymizationType` has the following possible values (undocumented):
        - `0` = Remove one octet
        - `1` = Drop IP
    - The keys `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The UI will
    show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
    - The key `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
    - The `WAF` related settings are not implemented yet. This feature is currently being worked on and does not have an ETA.
      It is advised **not** to update these values until the feature is implemented, therefore these options
      are removed from the example above.

#### [Get Pull Zone](https://docs.bunny.net/reference/pullzonepublic_index2)

```php
<?php

$baseAPI->getPullZone(
    id: 1,
    query: [
        'includeCertificate' => false
    ]
);
```

#### [Update Pull Zone](https://docs.bunny.net/reference/pullzonepublic_updatepullzone)

```php
<?php

$baseAPI->updatePullZone(
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
        'EnableAutoSSL' => false,
        'LogAnonymizationType' => 0,
        'StorageZoneId' => 0,
        'EdgeScriptId' => 0,
        'OriginType' => 0,
        'LogFormat' => 0,
        'LogForwardingFormat' => 0,
        'ShieldDDosProtectionType' => 1,
        'ShieldDDosProtectionEnabled' => false,
        'OriginHostHeader' => '',
        'EnableSmartCache' => false,
        'EnableRequestCoalescing' => false,
        'RequestCoalescingTimeout' => 30
    ]
);
```

!!! note

    - The key `Type` has the following possible values:
        - `0` = Premium
        - `1` = Volume
    - The key `Type` has the following possible values (undocumented):
        - `0` = URL
        - `1` = (Unknown)
        - `2` = Storage Zone
        - `3` = (Unknown)
        - `4` = Script
    - The key `LogAnonymizationType` has the following possible values (undocumented):
        - `0` = Remove one octet
        - `1` = Drop IP
    - The keys `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The UI will
    show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
    - The key `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
    - The `WAF` related settings are not implemented yet. This feature is currently being worked on and does not have an ETA.
      It is advised **not** to update these values until the feature is implemented, therefore these options
      are removed from the example above.

#### [Delete Pull Zone](https://docs.bunny.net/reference/pullzonepublic_delete)

```php
<?php

$baseAPI->deletePullZone(
    id: 1
);
```

#### [Delete Edge Rule](https://docs.bunny.net/reference/pullzonepublic_deleteedgerule)

```php
<?php

$baseAPI->deleteEdgeRule(
    pullZoneId: 1,
    edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587'
);
```

#### [Add/Update Edge Rule](https://docs.bunny.net/reference/pullzonepublic_addedgerule)

```php
<?php

$baseAPI->addOrUpdateEdgeRule(
    pullZoneId: 1,
    body: [
        'Guid' => 'c71d9594-3bc6-4639-9896-ba3e96217587',
        'ActionType' => 4,
        'ActionParameter1' => '',
        'ActionParameter2' => '',
        'Triggers' => [
            [
                'Type' => 0,
                'PatternMatches' => [
                    'https://example.b-cdn.net/images/*',
                    'https://example.b-cdn.net/videos/*'
                ]
                'PatternMatchingType' => 0,
                'Parameter1' => ''
            ]
        ],
        'TriggerMatchingType' => 0,
        'Description' => '',
        'Enabled' => true
    ]
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
        - `11` = Ignore Cache Vary: URL Query String
        - `12` = Disable Bunny Optimizer
        - `13` = Force Compression
        - `14` = Set Status Code
        - `15` = Bypass Perma-Cache
        - `16` = Override Browser Cache Time
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
    - The key `TriggerMatchingType` has the following possible values:
        - `0` = Match Any
        - `1` = Match All
        - `2` = Match None

#### [Set Edge Rule Enabled](https://docs.bunny.net/reference/pullzonepublic_setedgeruleenabled)

```php
<?php

$baseAPI->setEdgeRuleEnabled(
    pullZoneId: 1,
    edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587',
    body: [
        'Id' => 1,
        'Value' => true
    ]
);
```

!!! note

    -  The key `Id` in the body denotes the pull zone ID (the same as the first argument) and is (for some reason) a required parameter.

#### [Get Origin Shield Queue Statistics](https://docs.bunny.net/reference/pullzonepublic_originshieldconcurrencystatistics)

```php
<?php

$baseAPI->getOriginShieldQueueStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false
    ]
);
```

#### [Get SafeHop Statistics](https://docs.bunny.net/reference/pullzonepublic_safehopstatistics)

```php
<?php

$baseAPI->getSafeHopStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false
    ]
);
```

#### [Get Optimizer Statistics](https://docs.bunny.net/reference/pullzonepublic_optimizerstatistics)

```php
<?php

$baseAPI->getOptimizerStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false
    ]
);
```

#### Get WAF Statistics (undocumented)

```php
<?php

$baseAPI->getWAFStatistics(
    pullZoneId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false
    ]
);
```

#### [Load Free Certificate](https://docs.bunny.net/reference/pullzonepublic_loadfreecertificate)

```php
<?php

$baseAPI->loadFreeCertificate(
    query: [
        'hostname' => 'cdn.example.com'
    ]
);
```

#### [Purge Cache (by tag)](https://docs.bunny.net/reference/pullzonepublic_purgecachepostbytag)

```php
<?php

$baseAPI->purgePullZoneCache(
    id: 1,
    body: [
        'CacheTag' => 'mytag-region-*'
    ]
);
```

#### [Check Pull Zone Availability](https://docs.bunny.net/reference/pullzonepublic_checkavailability)

```php
<?php

$baseAPI->checkPullZoneAvailability(
    body: [
        'Name' => 'test'
    ]
);
```

#### [Add Custom Certificate](https://docs.bunny.net/reference/pullzonepublic_addcertificate)

```php
<?php

$baseAPI->addCustomCertificate(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
        'Certificate' => 'LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tCk5ldmVyIGdvbm5hIGdpdmUgeW91IHVwLgotLS0tLUVORCBDRVJUSUZJQ0FURS0tLS0t',
        'CertificateKey' => 'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpOZXZlciBnb25uYSBsZXQgeW91IGRvd24uCi0tLS0tRU5EIFJTQSBQUklWQVRFIEtFWS0tLS0t'
    ]
);
```

!!! note

    - The keys `Certificate` and `CertificateKey` require the file contents to be sent as base64 encoded strings.

#### [Remove Custom Certificate](https://docs.bunny.net/reference/pullzonepublic_removecertificate)

```php
<?php

$baseAPI->removeCertificate(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com'
    ]
);
```

#### [Add Custom Hostname](https://docs.bunny.net/reference/pullzonepublic_addhostname)

```php
<?php

$baseAPI->addCustomHostname(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com'
    ]
);
```

#### [Remove Custom Hostname](https://docs.bunny.net/reference/pullzonepublic_removehostname)

```php
<?php

$baseAPI->removeCustomHostname(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com'
    ]
);
```

#### [Set Force SSL](https://docs.bunny.net/reference/pullzonepublic_setforcessl)

```php
<?php

$baseAPI->setForceSSL(
    id: 1,
    body: [
        'Hostname' => 'cdn.example.com',
        'ForceSSL' => true
    ]
);
```

#### [Reset Token Key](https://docs.bunny.net/reference/pullzonepublic_resetsecuritykey)

```php
<?php

$baseAPI->resetPullZoneTokenKey(
    id: 1
);
```

#### [Add Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer)

```php
<?php

$baseAPI->addPullZoneAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com,*.example.org'
    ]
);
```

!!! note

    - The key `Hostname` allows multiple values through comma separated values.

#### [Remove Allowed Referer](https://docs.bunny.net/reference/pullzonepublic_removeallowedreferrer)

```php
<?php

$baseAPI->removePullZoneAllowedReferer(
    id: 1,
    body: [
        'Hostname' => '*.example.com'
    ]
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Add Blocked Referer](https://docs.bunny.net/reference/pullzonepublic_addblockedreferrer)

```php
<?php

$baseAPI->addPullZoneBlockedReferer(
    id: 1,
    body: [
        'Hostname' => '*.evil.org'
    ]
);
```

!!! note

    - The key `Hostname` does *not* allow multiple values.

#### [Remove Blocked Referer](https://docs.bunny.net/reference/pullzonepublic_removeblockedreferrer)

```php
<?php

$baseAPI->removePullZoneBlockedReferer(
    id: 1,
    body: [
        'Hostname' => '*.evil.org'
    ]
);
```

#### [Add Blocked IP](https://docs.bunny.net/reference/pullzonepublic_addblockedip)

```php
<?php

$baseAPI->addPullZoneBlockedIP(
    id: 1,
    body: [
        'BlockedIp' => '12.345.67.89'
    ]
);
```

#### [Remove Blocked IP](https://docs.bunny.net/reference/pullzonepublic_removeblockedip)

```php
<?php

$baseAPI->removePullZoneBlockedIP(
    id: 1,
    body: [
        'BlockedIp' => '12.345.67.89'
    ]
);
```

### Purge

#### [Purge URL](https://docs.bunny.net/reference/purgepublic_indexpost)

```php
<?php

$baseAPI->purgeUrl(
    query: [
        'url' => 'https://example.b-cdn.net/images/*',
        'async' => false
    ]
);
```

#### [ Purge URL (by header)](https://docs.bunny.net/reference/purgepublic_index)

```php
<?php

$baseAPI->purgeUrlByHeader(
    query: [
        'url' => 'https://example.b-cdn.net/images/*',
        'headerName' => '',
        'headerValue' => '',
        'async' => false
    ]
);
```

### Statistics

#### [Get Statistics (traffic, cache hit & bandwidth)](https://docs.bunny.net/reference/statisticspublic_index)

```php
<?php

$baseAPI->getStatistics(
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'pullZone' => -1,
        'serverZoneId' => -1,
        'loadErrors' => false,
        'hourly' => false
    ]
);
```

### Storage Zone

#### [List Storage Zones](https://docs.bunny.net/reference/storagezonepublic_index)

```php
<?php

$baseAPI->listStorageZones(
    query: [
        'page' => 0,
        'perPage' => 1000,
        'includeDeleted' => 1000
    ]
);
```

#### [Add Storage Zone](https://docs.bunny.net/reference/storagezonepublic_add)

```php
<?php

$baseAPI->addStorageZone(
    body: [
        'OriginUrl' => '',
        'Name' => 'Test',
        'Region' => 'DE',
        'ReplicationRegions' => '',
        'ZoneTier' => 0
    ]
);
```

!!! note

    - The key `OriginUrl` allows you to specify a backup data source, in case the file does not exist on the Storage Zone
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
<?php

$baseAPI->checkStorageZoneAvailability();
```

#### [Get Storage Zone](https://docs.bunny.net/reference/storagezonepublic_index2)

```php
<?php

$baseAPI->getStorageZone(
    id: 1
);
```

#### [Get Storage Zone](https://docs.bunny.net/reference/storagezonepublic_index2)

```php
<?php

$baseAPI->getStorageZone(
    id: 1
);
```

#### [Update Storage Zone](https://docs.bunny.net/reference/storagezonepublic_update)

```php
<?php

$baseAPI->updateStorageZone(
    id: 1,
    body: [
        'ReplicationZones' => '',
        'OriginUrl' => '',
        'Custom404FilePath' => 'my-custom-404.html',
        'Rewrite404To200' => false,
    ]
);
```

!!! note

    - The key `OriginUrl` allows you to specify a backup data source, in case the file does not exist on the Storage Zone
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
<?php

$baseAPI->deleteStorageZone(
    id: 1
);
```

#### [Reset Password](https://docs.bunny.net/reference/storagezonepublic_resetpassword)

```php
<?php

$baseAPI->resetStorageZonePassword(
    id: 1
);
```

#### [Reset Read-Only Password](https://docs.bunny.net/reference/storagezonepublic_resetreadonlypassword)

```php
<?php

$baseAPI->resetStorageZoneReadOnlyPassword(
    query: [
        'id' => 1
    ]
);
```

### User

#### [Get Home Feed](ttps://docs.bunny.net/reference/userpublic_homefeed)

```php
<?php

$baseAPI->getHomeFeed();
```

#### [Get User Details](https://docs.bunny.net/reference/userpublic_index)

```php
<?php

$baseAPI->getUserDetails();
```

#### [Update User Details](https://docs.bunny.net/reference/userpublic_updateuser)

```php
<?php

$baseAPI->updateUserDetails(
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
        'OldPassword' => 'Abcd1234'
    ]
);
```

#### [Resend Email Confirmation](https://docs.bunny.net/reference/userpublic_resendemailconfirmation)

```php
<?php

$baseAPI->resendEmailConfirmation();
```

#### [Reset API Key](https://docs.bunny.net/reference/userpublic_resetapikey)

```php
<?php

$baseAPI->resetUserApiKey();
```

#### [List Close Account Reasons](https://docs.bunny.net/reference/userpublic_listcloseaccountreasons)

```php
<?php

$baseAPI->listCloseAccountReasons();
```

#### [Close Account](https://docs.bunny.net/reference/userpublic_closeaccount)

```php
<?php

$baseAPI->closeAccount(
    body: [
        'Password' => 'Abcd1234',
        'Reason' => 'No longer needed.'
    ]
);
```

#### [Get DPA Details](https://docs.bunny.net/reference/userpublic_dpa)

```php
<?php

$baseAPI->getDPADetails();
```

#### [Accept DPA](https://docs.bunny.net/reference/userpublic_dpaaccept)

```php
<?php

$baseAPI->acceptDPA();
```

#### [Get DPA Details (HTML)](https://docs.bunny.net/reference/userpublic_dpapdfhhtml)

```php
<?php

$baseAPI->getDPADetailsHTML();
```

#### [Set Notifications Opened](https://docs.bunny.net/reference/userpublic_setnotificationsopened)

```php
<?php

$baseAPI->setNotificationsOpened();
```

#### [Get What's New Items](https://docs.bunny.net/reference/userpublic_whatsnew)

```php
<?php

$baseAPI->getWhatsNewItems();
```

#### [Reset What's New](https://docs.bunny.net/reference/userpublic_whatsnewreset)

```php
<?php

$baseAPI->resetWhatsNew();
```

#### [Generate 2FA Verification](https://docs.bunny.net/reference/userpublic_twofactorgenerateverification)

```php
<?php

$baseAPI->generate2FAVerification();
```

#### [Disable 2FA](https://docs.bunny.net/reference/userpublic_twofactordisable)

```php
<?php

$baseAPI->disable2FA(
    body: [
        'Password' => 'LoremIpsumDolor'
    ]
);
```

#### [Enable 2FA](https://docs.bunny.net/reference/userpublic_twofactorenable)

```php
<?php

$baseAPI->enable2FA(
    body: [
        'SecretValidator' => '',
        'Secret' => '',
        'TestPin' => '123456'
    ]
);
```

#### [Verify 2FA Code](https://docs.bunny.net/reference/userpublic_twofactorverify)

```php
<?php

$baseAPI->verify2FACode(
    body: [
        'SecretValidator' => '',
        'Secret' => '',
        'TestPin' => '123456'
    ]
);
```

## Reference

* [Base API](https://docs.bunny.net/reference/bunnynet-api-overview)
