## 8.x

This release comes with minor breaking changes due to changing namespaces for 5 Shield API models.

### ‼️ Breaking changes

| **7.x**                                                          | **8.x**                                                                |
|------------------------------------------------------------------|------------------------------------------------------------------------|
| `ToshY\BunnyNet\Model\Api\Shield\Zone\CreateShieldZone`          | `ToshY\BunnyNet\Model\Api\Shield\ShieldZone\CreateShieldZone`          |
| `ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZone`             | `ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZone`             |
| `ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZoneByPullZoneId` | `ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZoneByPullZoneId` |
| `ToshY\BunnyNet\Model\Api\Shield\Zone\ListShieldZones`           | `ToshY\BunnyNet\Model\Api\Shield\ShieldZone\ListShieldZones`           |
| `ToshY\BunnyNet\Model\Api\Shield\Zone\UpdateShieldZone`          | `ToshY\BunnyNet\Model\Api\Shield\ShieldZone\UpdateShieldZone`          |

### 🐛 Bug fixes

#### Generator

- Fixed generated classnames when missing the `operationId` property in the OpenAPI specs.
- Fixed path parameter ordering when the `parameters` property in the OpenAPI specs is unordered.

### 🚀 Enhancements

| **API**       | **Action** | **Class**                                                                                                                                 | **Notes**                    |
|---------------|------------|-------------------------------------------------------------------------------------------------------------------------------------------|------------------------------|
| Origin Errors | ADD        | [`GetOriginErrorLogs`](https://toshy.github.io/BunnyNet-PHP/origin-errors-api/#get-origin-errors-for-pullzone-id-and-date)                | [OpenAPI] Updated API models |
| Base          | UPDATE     | [`AddOrUpdateEdgeRule`](https://toshy.github.io/BunnyNet-PHP/base-api/#addupdate-edge-rule)                                               | [OpenAPI] Updated API models |
| Base          | UPDATE     | [`AddStorageZone`](https://toshy.github.io/BunnyNet-PHP/base-api/#add-storage-zone)                                                       | [OpenAPI] Updated API models |
| Base          | UPDATE     | [`AddVideoLibrary`](https://toshy.github.io/BunnyNet-PHP/base-api/#add-video-library)                                                     | [OpenAPI] Updated API models |
| Base          | UPDATE     | [`UpdateVideoLibrary`](https://toshy.github.io/BunnyNet-PHP/base-api/#update-video-library)                                               | [OpenAPI] Updated API models |
| Base          | ADD        | [`GetUserAuditLog`](https://toshy.github.io/BunnyNet-PHP/base-api/#get-user-audit-log)                                                    | [OpenAPI] Updated API models |
| Shield        | ADD        | [`ListShieldZoneAccessLists`](https://toshy.github.io/BunnyNet-PHP/shield-api/#list-shield-zone-access-lists)                             | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetShieldZoneAccessList`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone-access-list)                                 | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetShieldZoneAccessListEnums`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone-access-list-enums)                      | [OpenAPI] Updated API models |
| Shield        | ADD        | [`CreateShieldZoneAccessList`](https://toshy.github.io/BunnyNet-PHP/shield-api/#create-shield-zone-access-list)                           | [OpenAPI] Updated API models |
| Shield        | ADD        | [`UpdateShieldZoneAccessList`](https://toshy.github.io/BunnyNet-PHP/shield-api/#update-shield-zone-access-list)                           | [OpenAPI] Updated API models |
| Shield        | ADD        | [`UpdateShieldZoneCuratedThreatList`](https://toshy.github.io/BunnyNet-PHP/shield-api/#update-shield-zone-curated-threat-list)            | [OpenAPI] Updated API models |
| Shield        | ADD        | [`DeleteShieldZoneAccessList`](https://toshy.github.io/BunnyNet-PHP/shield-api/#delete-shield-zone-access-list)                           | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetShieldZoneBotDetection`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone-bot-detection)                             | [OpenAPI] Updated API models |
| Shield        | ADD        | [`CreateOrUpdateShieldZoneBotDetection`](https://toshy.github.io/BunnyNet-PHP/shield-api/#create-or-update-shield-zone-bot-detection)     | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetBotDetectionMetrics`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-bot-detection-metrics)                                    | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetUploadScanningMetrics`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-upload-scanning-metrics)                                | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetCurrentPromotions`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone-current-promotions)                             | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`CreateRateLimit`](https://toshy.github.io/BunnyNet-PHP/shield-api/#create-rate-limit)                                                   | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`UpdateRateLimit`](https://toshy.github.io/BunnyNet-PHP/shield-api/#update-rate-limit)                                                   | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`CreateShieldZone`](https://toshy.github.io/BunnyNet-PHP/shield-api/#create-shield-zone)                                                 | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`GetShieldZone`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone)                                                       | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`GetShieldZoneByPullZoneId`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone-by-pullzoneid)                             | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`ListShieldZones`](https://toshy.github.io/BunnyNet-PHP/shield-api/#list-shield-zones)                                                   | [OpenAPI] Updated API models |
| Shield        | ADD        | [`ListShieldZonesPullzoneMapping`](https://toshy.github.io/BunnyNet-PHP/shield-api/#list-shield-zones-pull-zone-mapping)                  | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`UpdateShieldZone`](https://toshy.github.io/BunnyNet-PHP/shield-api/#update-shield-zone)                                                 | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetShieldZoneUploadScanning`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-shield-zone-upload-scanning)                         | [OpenAPI] Updated API models |
| Shield        | ADD        | [`CreateOrUpdateShieldZoneUploadScanning`](https://toshy.github.io/BunnyNet-PHP/shield-api/#create-or-update-shield-zone-upload-scanning) | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`CreateCustomWafRule`](https://toshy.github.io/BunnyNet-PHP/shield-api/#create-custom-waf-rule)                                          | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetWafRules`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-waf-rules)                                                           | [OpenAPI] Updated API models |
| Shield        | ADD        | [`GetWafRulesPlanSegmentation`](https://toshy.github.io/BunnyNet-PHP/shield-api/#get-waf-rules-plan-segmentation)                         | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`UpdateCustomWafRule`](https://toshy.github.io/BunnyNet-PHP/shield-api/#update-custom-waf-rule)                                          | [OpenAPI] Updated API models |
| Shield        | UPDATE     | [`UpdateCustomWafRuleByPatch`](https://toshy.github.io/BunnyNet-PHP/shield-api/#update-custom-waf-rule-patch)                             | [OpenAPI] Updated API models |
| Stream        | UPDATE     | [`TranscribeVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#transcribe-video)                                                    | [OpenAPI] Updated API models |
| Stream        | ADD        | [`TriggerSmartActions`](https://toshy.github.io/BunnyNet-PHP/stream-api/#trigger-smart-actions)                                           | [OpenAPI] Updated API models |
| Stream        | UPDATE     | [`UploadVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#upload-video)                                                            | [OpenAPI] Updated API models |

## 7.x

This release comes with breaking changes for the usability of the library.

Back in release [`6.0`](https://github.com/ToshY/BunnyNet-PHP/releases/tag/6.0.0) I introduced compatibility with OpenAPI specifications. After further research and consideration, I realised that the models that were generated should be enough for the end user to create a request with, making the existing API classes (`BaseAPI`, `EdgeScriptingAPI`, `EdgeStorageAPI`, `LoggingAPI`, `ShieldAPI` and `StreamAPI`) obsolete if the users have a single entrypoint that could be used instead, which eventually became the `BunnyHttpClient`.

> [!CAUTION]  
> Due to the nature of this release, I cannot guarantee this list of breaking changes is complete. Thank you for your understanding.

### ‼️ Breaking changes

#### `BunnyHttpClient`

All requests will now have to be made using the `ToshY\BunnyNet\BunnyHttpClient` (previously `ToshY\BunnyNet\Client\BunnyClient`), which now requires the `apiKey` and
`baseUrl` to be set when constructing.

**Example**
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

| **6.x**                             | **7.x**                          | **7.x signature notes**                   |
|-------------------------------------|----------------------------------|-------------------------------------------|
| `ToshY\BunnyNet\Client\BunnyClient` | `ToshY\BunnyNet\BunnyHttpClient` | Requires `apiKey` and `baseUrl` to be set |


#### Removed `Region` in favor of `Endpoint`

With the change of the `BunnyHttpClient` which now requires the user to supply a `baseUrl`, the  `ToshY\BunnyNet\Enum\Region` that was previously used explicitly
by the **Edge Storage API class**, has been removed in favor of the (new) `ToshY\BunnyNet\Enum\Endpoint`.

| **6.x**                           | **7.x**                                          | **7.x signature notes**                     |
|-----------------------------------|--------------------------------------------------|---------------------------------------------|
| -                                 | `ToshY\BunnyNet\Enum\Endpoint::BASE`             | Set by API class in  `6.x`; Public in `7.x` |
| -                                 | `ToshY\BunnyNet\Enum\Endpoint::EDGE_SCRIPTING`   | Set by API class in  `6.x`; Public in `7.x` |
| -                                 | `ToshY\BunnyNet\Enum\Endpoint::SHIELD`           | Set by API class in  `6.x`; Public in `7.x` |
| -                                 | `ToshY\BunnyNet\Enum\Endpoint::STREAM`           | Set by API class in  `6.x`; Public in `7.x` |
| -                                 | `ToshY\BunnyNet\Enum\Endpoint::LOGGING`          | Set by API class in  `6.x`; Public in `7.x` |
| -                                 | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE`     | New in `7.x` (same as `DE` / `FS`)          |
| `ToshY\BunnyNet\Enum\Region::DE`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_DE`  | Default value `Endpoint::EDGE_STORAGE`      |
| `ToshY\BunnyNet\Enum\Region::FS`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_FS`  | Default value `Endpoint::EDGE_STORAGE`      |
| `ToshY\BunnyNet\Enum\Region::UK`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_UK`  |                                             |
| `ToshY\BunnyNet\Enum\Region::SE`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_SE`  |                                             |
| `ToshY\BunnyNet\Enum\Region::CZ`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_CZ`  |                                             |
| `ToshY\BunnyNet\Enum\Region::ED`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_ED`  |                                             |
| `ToshY\BunnyNet\Enum\Region::NY`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_NY`  |                                             |
| `ToshY\BunnyNet\Enum\Region::LA`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_LA`  |                                             |
| `ToshY\BunnyNet\Enum\Region::WA`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_WA`  |                                             |
| `ToshY\BunnyNet\Enum\Region::MI`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_MI`  |                                             |
| `ToshY\BunnyNet\Enum\Region::SG`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_SG`  |                                             |
| `ToshY\BunnyNet\Enum\Region::HK`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_HK`  |                                             |
| `ToshY\BunnyNet\Enum\Region::JP`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_JP`  |                                             |
| `ToshY\BunnyNet\Enum\Region::SYD` | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_SYD` |                                             |
| `ToshY\BunnyNet\Enum\Region::BR`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_BR`  |                                             |
| `ToshY\BunnyNet\Enum\Region::JH`  | `ToshY\BunnyNet\Enum\Endpoint::EDGE_STORAGE_JH`  |                                             |

#### Models

The `BunnyHttpClient` now has a public `request` method that accepts any model implementing `ModelInterface`.

**Example**
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

All publicly usable models can be found under the [`\ToshY\BunnyNet\Model\Api`](https://github.com/ToshY/BunnyNet-PHP/blob/master/src/Model/Api) namespace.

> [!NOTE]  
> Examples have been updated in the [documentation](https://toshy.github.io/BunnyNet-PHP/).

#### `ImageProcessor` & `TokenAuthenitcation`

The `ImageProcessor` and `TokenAuthentication` have been renamed by prefixing it with `Bunny`.

| **6.x**                              | **7.x**                              | **7.x signature notes**     |
|--------------------------------------|--------------------------------------|-----------------------------|
| `ToshY\BunnyNet\ImageProcessor`      | `ToshY\BunnyNet\BunnyImageProcessor` | `generate` method is static |
| `ToshY\BunnyNet\TokenAuthentication` | `ToshY\BunnyNet\BunnyTokenAuthentication` |                             |

#### `BunnyValidator`

The `BunnyValidator` was introduced in [`6.1`](https://github.com/ToshY/BunnyNet-PHP/releases/tag/6.1.0) as an initial way of making validation optional and/or more flexible. Up until now, the validator was always used by the API classes.

With this release, the `BunnyValidator` has become optional, no longer is used by default and separated from the formerly known API classes.

**Example**
```php
$bunnyValidator = new BunnyValidator();

// Construct the payload
$payload = new TranscribeVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    query: [
        'language' => 'fi',
        'force' => true,
    ],
    body: [
        'targetLanguages' => [
            'fi',
            'jp'
        ],
        'generateTitle' => true,
        'generateDescription' => true,
        'sourceLanguage' => 'en',
    ],   
);

// Perform validation and catch if necessary
try {
    $bunnyValidator->query($payload);
    $bunnyValidator->body($payload);
} catch (BunnyValidatorExceptionInterface) {
    // ...
}
```

| **6.x**                                    | **7.x**                         |
|--------------------------------------------|---------------------------------|
| `ToshY\BunnyNet\Validation\BunnyValidator` | `ToshY\BunnyNet\BunnyValidator` |


> [!NOTE]  
> Usage examples for the `BunnyValidator` have been added to the [documentation](https://toshy.github.io/BunnyNet-PHP/validation/).

#### Naming coding standards

All classes (and namespaces) have been updated according to the latest [coding standards](https://github.com/php/policies/blob/06ef24434942f3b09241ccbde124b83ca8a18042/coding-standards-and-naming.rst?plain=1#L26), where abbreviations/acronyms/initialisms have been renamed to be treated like regular words (camelcasing).

> [!IMPORTANT]  
> The `6.x` branch will now no longer be maintained.

## 6.x

This release comes with minor breaking changes for public methods that have been removed to ensure OpenAPI specifications compatibility.

### ‼️ Breaking changes

| **5.x**                         | **6.x**                        | **6.x signature notes** |
|---------------------------------|--------------------------------|-------------------------|
| `BaseAPI::addEdgeRule`          | `BaseAPI::addOrUpdateEdgeRule` |                         |
| `BaseAPI::updateEdgeRule`       | `BaseAPI::addOrUpdateEdgeRule` |                         |
| `StreamAPI::setThumbnailByBody` | -                              |                         |

### 🐛 Bug fixes

The following bugs were discovered after the generator scripts recreated the models based on the OpenAPI specs.

| **Endpoint**       | **Action** | **Method**                                                                                                    | **Notes**                                                                                                                                                                                                                                                                 |
|--------------------|------------|---------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Base API           | UPDATE     | [`resolveAbuseCase`](https://toshy.github.io/BunnyNet-PHP/base-api/#resolve-abuse-case)                       | Fixes path                                                                                                                                                                                                                                                                |
| Base API           | UPDATE     | [`resolveDmcaCase`](https://toshy.github.io/BunnyNet-PHP/base-api/#resolve-dmca-case)                         | Fixes path                                                                                                                                                                                                                                                                |
| Base API           | UPDATE     | [`configureAutoRecharge`](https://toshy.github.io/BunnyNet-PHP/base-api/#configure-auto-recharge)             | Body parameter `AutoRechargeEnabled` required                                                                                                                                                                                                                             |
| Base API           | UPDATE     | [`createPaymentCheckout`](https://toshy.github.io/BunnyNet-PHP/base-api/#create-payment-checkout)             | Body parameter `PaymentAmount` required                                                                                                                                                                                                                                   |
| Base API           | UPDATE     | [`checkDnsZoneAvailability`](https://toshy.github.io/BunnyNet-PHP/base-api/#check-dns-zone-availability)      | Body parameter `Name` required                                                                                                                                                                                                                                            |
| Base API           | UPDATE     | [`addPullZone`](https://toshy.github.io/BunnyNet-PHP/base-api/#add-pull-zone)                                 | Body parameter `OptimizerWatermarkOffset` changed to type `NUMERIC_TYPE`; Body parameter `Type` changed to type `INT_TYPE`; Body parameter `OriginShieldMaxQueuedRequests` changed to type `INT_TYPE`; Body parameter `DisableLetsEncrypt` changed to type `BOOLEAN_TYPE` |
| Base API           | UPDATE     | [`updatePullZone`](https://toshy.github.io/BunnyNet-PHP/base-api/#update-pull-zone)                           | Body parameter `OptimizerWatermarkOffset` changed to type `NUMERIC_TYPE`; Body parameter `Type` changed to type `INT_TYPE`; Body parameter `OriginShieldMaxQueuedRequests` changed to type `INT_TYPE`; Body parameter `DisableLetsEncrypt` changed to type `BOOLEAN_TYPE` |
| Base API           | UPDATE     | [`setEdgeRuleEnabled`](https://toshy.github.io/BunnyNet-PHP/base-api/#add-pull-zone)                          | Body parameter `Enabled` changed to `Value`                                                                                                                                                                                                                               |
| Base API           | UPDATE     | [`getGlobalSearch`](https://toshy.github.io/BunnyNet-PHP/base-api/#global-search)                             | Body parameter `search` required                                                                                                                                                                                                                                          |
| Base API           | UPDATE     | [`addStorageZone`](https://toshy.github.io/BunnyNet-PHP/base-api/#add-storage-zone)                           | Body parameter `Name` required; Body parameter `Region` required; Fixed duplicate body parameter `Region` to `ZoneTier`                                                                                                                                                   |
| Base API           | UPDATE     | [`resetStorageZoneReadOnlyPassword`](https://toshy.github.io/BunnyNet-PHP/base-api/#reset-read-only-password) | Query parameter `id` changed to type `INT_TYPE`                                                                                                                                                                                                                           |
| Base API           | UPDATE     | [`updateStorageZone`](https://toshy.github.io/BunnyNet-PHP/base-api/#update-storage-zone)                     | Body parameter `CacheTag` changed to `ReplicationZones`                                                                                                                                                                                                                   |
| Base API           | UPDATE     | [`getVideoLibrary`](https://toshy.github.io/BunnyNet-PHP/base-api/#get-video-library)                         | Removed all query parameters (`includeAccessKey`)                                                                                                                                                                                                                         |
| Base API           | UPDATE     | [`listVideoLibraries`](https://toshy.github.io/BunnyNet-PHP/base-api/#list-video-libraries)                   | Removed query parameter `includeAccessKey`                                                                                                                                                                                                                                |
| Base API           | UPDATE     | [`updateVideoLibrary`](https://toshy.github.io/BunnyNet-PHP/base-api/#update-video-library)                   | Body parameters `RememberPlayerPosition`, `EnableMultiAudioTrackSupport`, `UseSeparateAudioStream`, `JitEncodingEnabled`, `OutputCodecs`, `AppleFairPlayDrm`, `GoogleWidevineDrm`, `EncodingTier` added                                                                   |
| Base API           | UPDATE     | [`createTicket`](https://toshy.github.io/BunnyNet-PHP/base-api/#create-ticket)                                | Body parameters `LinkedVideoLibrary`, `LinkedDnsZone` added                                                                                                                                                                                                               |
| Edge Scripting API | UPDATE     | [`listEdgeScripts`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#list-edge-scripts)               | Query parameter `type` added                                                                                                                                                                                                                                              |
| Edge Scripting API | UPDATE     | [`updateEdgeScript`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#update-edge-script)             | Body parameter `ScriptType` not required                                                                                                                                                                                                                                  |
| Edge Scripting API | UPDATE     | [`addSecret`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#add-secret)                            | Body parameter `Name` not required                                                                                                                                                                                                                                        |
| Edge Scripting API | UPDATE     | [`upsertSecret`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#upsert-secret)                      | Body parameter `Name` not required                                                                                                                                                                                                                                        |
| Edge Scripting API | UPDATE     | [`addVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#add-variable)                        | Body parameter `Required` required                                                                                                                                                                                                                                        |
| Edge Scripting API | UPDATE     | [`updateVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#update-variable)                  | Body parameter `DefaultValue` changed to type `STRING_TYPE`                                                                                                                                                                                                               |
| Stream API         | UPDATE     | [`addCaption`](https://toshy.github.io/BunnyNet-PHP/stream-api/#add-caption)                                  | Body parameter `hostname` to `srclang`                                                                                                                                                                                                                                    |
| Stream API         | UPDATE     | [`addOutputCodecToVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#add-output-codec-to-video)         | Fixes path                                                                                                                                                                                                                                                                |
| Stream API         | UPDATE     | [`createVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#create-video)                                | Body parameter `thumbnailTime` added                                                                                                                                                                                                                                      |
| Stream API         | UPDATE     | [`deleteCaption`](https://toshy.github.io/BunnyNet-PHP/stream-api/#delete-caption)                            | Header `CONTENT_TYPE_JSON_ALL` removed                                                                                                                                                                                                                                    |
| Stream API         | UPDATE     | [`fetchVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#fetch-video)                                  | Query parameter `thumbnailTime` added; Body parameter `url` required; Body parameter `title` added                                                                                                                                                                        |
| Stream API         | UPDATE     | [`setThumbnail`](https://toshy.github.io/BunnyNet-PHP/stream-api/#set-thumbnail)                              | Query parameter `thumbnailUrl` not required                                                                                                                                                                                                                               |
| Stream API         | UPDATE     | [`transcribeVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#transcribe-video)                        | Header `CONTENT_TYPE_JSON` added; Query parameter `language` not required; Body parameters `targetLanguages`, `generateTitle`, `generateDescription`, `sourceLanguage` added                                                                                              |
| Stream API         | UPDATE     | [`getOEmbed`](https://toshy.github.io/BunnyNet-PHP/stream-api/#get-oembed)                                    | Query parameter `url` not required                                                                                                                                                                                                                                        |


The `5.x` branch will now no longer be maintained.

### 🚀 Enhancements

| **Endpoint** | **Action** | **Method**                                                                                      | **Notes** |
|--------------|------------|-------------------------------------------------------------------------------------------------|-----------|
| Base API     | ADD        | [`authJwtTwoFactorAuthentication`](https://toshy.github.io/BunnyNet-PHP/base-api/#auth-jwt-2fa) | -         |
| Base API     | ADD        | [`refreshJwt`](https://toshy.github.io/BunnyNet-PHP/base-api/#refresh-jwt)                      | -         |

## 5.x

This release comes with breaking changes to what was previously known as "Compute scripts". The endpoints for compute scripts
were historically only publicly visible in the official API specs for a short amount of time after which they became undocumented (exact timeline unknown).

With the [announcement](https://bunny.net/blog/introducing-bunny-edge-scripting-a-better-way-to-build-and-deploy-applications-at-the-edge/) of "Edge Scripting" on November 7th (2024),
it became apparent (in hindsight) that the new edge scripts are basically compute scripts (with some minor adaptations).

As edge scripts are now part of what is referred as the "Edge Scripting API" (even though it still uses the same domain of `api.bunny.net`),
this release reflects (signature) changes in the BunnyNet-PHP library that refactors the previously known compute scripts from the `BaseAPI` to edge scripts in the `EdgeScriptingAPI`.

The `4.x` branch will now no longer be maintained.

### ‼️ Breaking changes

The signature changes are displayed in the table below.

| **4.x**                                        | **5.x**                                                                                                                                | **5.x signature notes**   |
|------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------|---------------------------|
| `BaseAPI::listComputeScripts`                  | [`EdgeScriptingAPI::listEdgeScripts`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#list-edge-scripts)                      |                           |
| `BaseAPI::addComputeScript`                    | [`EdgeScriptingAPI::addEdgeScript`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#add-edge-script)                          |                           |
| `BaseAPI::getComputeScript`                    | [`EdgeScriptingAPI::getEdgeScript`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#get-edge-script)                          |                           |
| -                                              | [`EdgeScriptingAPI::getEdgeScriptStatistics`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#get-edge-script-statistics)     |                           |
| `BaseAPI::updateComputeScript`                 | [`EdgeScriptingAPI::updateEdgeScript`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#update-edge-script)                    |                           |
| `BaseAPI::deleteComputeScript`                 | [`EdgeScriptingAPI::deleteEdgeScript`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#delete-edge-script)                    | Added `query` argument.   |
| `BaseAPI::getComputeScriptCode`                | [`EdgeScriptingAPI::getCode`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#get-code)                                       |                           |
| `BaseAPI::updateComputeScriptCode`             | [`EdgeScriptingAPI::setCode`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#set-code)                                       |                           |
| `BaseAPI::listComputeScriptReleases`           | [`EdgeScriptingAPI::getReleases`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#get-releases)                               |                           |
| -                                              | [`EdgeScriptingAPI::getActiveRelease`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#get-active-release)                    |                           |
| `BaseAPI::publishComputeScript`                | [`EdgeScriptingAPI::publishRelease`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#publish-release)                         | Removed `query` argument. |
| `BaseAPI::publishComputeScriptByPathParameter` | [`EdgeScriptingAPI::publishReleaseByUuid`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#publish-release-by-path-parameter) |                           |
| `BaseAPI::getComputeScriptVariable`            | [`EdgeScriptingAPI::getVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#get-variable)                               |                           |
| `BaseAPI::addComputeScriptVariable`            | [`EdgeScriptingAPI::addVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#add-variable)                               |                           |
| `BaseAPI::updateComputeScriptVariable`         | [`EdgeScriptingAPI::updateVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#update-variable)                         |                           |
| -                                              | [`EdgeScriptingAPI::upsertVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#upsert-variable)                         |                           |
| `BaseAPI::deleteComputeScriptVariable`         | [`EdgeScriptingAPI::deleteVariable`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#delete-variable)                         |                           |
| -                                              | [`EdgeScriptingAPI::listSecrets`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#list-secrets)                               |                           |
| -                                              | [`EdgeScriptingAPI::addSecret`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#add-secret)                                   |                           |
| -                                              | [`EdgeScriptingAPI::updateSecret`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#update-secret)                             |                           |
| -                                              | [`EdgeScriptingAPI::upsertSecret`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#upsert-secret)                             |                           |
| -                                              | [`EdgeScriptingAPI::deleteSecret`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#delete-secret)                             |                           |

Further usage examples can be found in the documentation website: [toshy.github.io/BunnyNet-PHP/edge-scripting-api](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/).

### 🚀 Enhancements

| **Endpoint** | **Action** | **Method**                                                                                      | **Notes**                                                                                                                                                             |
|--------------|------------|-------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Base API     | ADD        | [`getGitHubIntegration`](https://toshy.github.io/BunnyNet-PHP/base-api/#get-github-integration) | Retrieves `id` that can be used as `integrationId` for [`EdgeScriptingAPI::addEdgeScript`](https://toshy.github.io/BunnyNet-PHP/edge-scripting-api/#add-edge-script). |

## 4.x

This release comes with breaking changes to a couple of methods regarding uploading of files. To allow
for more flexibility when uploading file contents, instead of passing the path to the local file,
you are now required to read in the file contents before passing it to these methods. This change grants users more
freedom on how to read file contents/streams (e.g. external sources) as it will now allow any of the following
types `string|resource|StreamInterface|null` as `$body` parameter (previously `$localFilePath`).

The `3.x` branch will now no longer be maintained.

### ‼️ Breaking changes

- File contents/stream should now be explicitly read before passing to the following methods. Examples in
  the documentation have been updated.
    - [`BaseAPI::importDnsRecords`](https://toshy.github.io/BunnyNet-PHP/base-api/#import-dns-records)
      - Changed `$localFilePath` to `$body`.
    - [`EdgeStorageAPI::uploadFile`](https://toshy.github.io/BunnyNet-PHP/edge-storage-api/#upload-file)
        - Changed `$localFilePath` to `$body`.
    - [`StreamAPI::uploadVideo`](https://toshy.github.io/BunnyNet-PHP/stream-api/#upload-video)
        - Changed `$localFilePath` to `$body`.
- `BodyContentHelper::openFileStream` and `FileDoesNotExistException::class` have been removed.
    - While previously only used internally for the above-mentioned methods, the `openFileStream` was a public
      static method and could've theoretically been used by users, which is the reason for explicitly stating it here.

## 3.x

This release reworks (almost) the entire codebase, and therefore results in quite some breaking changes. Please
read the following notes carefully before upgrading.

The `2.x` branch will now no longer be maintained.

### ‼️ Breaking changes

- Request (PSR-18)
  - Addition of `Psr\Http\Client\ClientInterface` requires the user to construct a `BunnyClient`, and supply
  the `BunnyClient` to the API classes. Examples can be found in the [documentation website](https://ToshY.github.io/BunnyNet-PHP/base-api/).
- Response
  - Return type for public API methods changed from `array` to `ToshY\BunnyNet\Model\Client\BunnyClientResponse`:
      - Change from `$response['content']` to `$response->getContents()`
      - Change from `$response['headers']` to `$response->getHeaders()`
      - Change from `$response['status']['code']` to `$response->getStatusCode()`
      - Change from `$response['status']['info']` to `$response->getReasonPhrase()`
      - A new method `getBody()` was added.
- Endpoints
  - The following public classes have been **renamed**:
    - The class `BaseRequest` was renamed to `BaseAPI`.
    - The class `EdgeStorageRequest` was renamed to `EdgeStorageAPI`.
    - The class `PullZoneLogRequest` was renamed to `LoggingAPI`.
    - The class `VideoStreamRequest` was renamed to `StreamAPI`.
    - The class `SecureUrlGenerator` was renamed to `TokenAuthentication`.
        - The method `generate` was renamed to `sign`.
    - The class `ImageOptimizer` was renamed to `ImageProcessor`.
        - The argument `$optimizationCollection` was renamed to `$optimization`.
    - The class `PricingCalculator` was removed.
  - The following public methods have been **renamed**:
    - The method `listStorageZone` was renamed to `listStorageZones`.
    - The method `resetStorageZonePasswordByPath` was renamed to `resetStorageZonePassword`.
    - The method `getCollectionList` was renamed to `listCollections`.
    - The method `purgeCache` was renamed to `purgePullZoneCache`.
    - The method `addCustomCertificate` was renamed to `addCertificate`.
    - The method(s) having `the` in the name have been renamed.
        - `closeTheAccount` => `closeAccount`
    - The method(s) having lowercase abbreviations have been renamed to uppercase abbreviations.
        - `getDpaDetails` => `getDPADetails`
  - The following public methods have been **changed**:
    - The method `fetchVideoToCollection` was renamed to `fetchVideo`, therefore removing the original `fetchVideo` method.
      - The new `fetchVideo` method has the same arguments `fetchVideoToCollection` used to have.
  - Base API
    - The argument `$accountApiKey` was renamed to `$apiKey`.
  - Logging API
    - The argument `$accountApiKey` was renamed to `$apiKey`.
  - Edge Storage API
    - The argument `$hostCode` was changed to `$region` and now only accepts a `Region` case.
      - Example: For the `Falkenstein` region (previously `'FS'` code) this would now be `Region::FS` (default).
      - For a complete list of available `Region` cases, see the example in the [documentation website](https://ToshY.github.io/BunnyNet-PHP/edge-storage-api/#setup).

> Note: Please take in consideration that due to the impact of this release I cannot fully guarantee this list of
> breaking changes is complete. Thank you for your understanding.

### General Updates

- Styleguide
    - Regarding [PHP RFC: Class Naming](https://wiki.php.net/rfc/class-naming), class names with initialism, e.g. `API`,
      will be uppercase for the initialism part.
        - Variable names for instances of these classes will follow the camelCase naming convention.
            - E.g. `$baseApi` for the `BaseAPI` class.
        - Method names including an initialism will (still) follow the camelCase naming convention.
            - Example: get DPA details => `getDpaDetails`.
            - Example: get DNS zone => `getDnsZone`.
- Base API
    - Notes:
        - Updating to the latest API specifications.
- Edge Storage API
    - Notes:
        - Updating to the latest API specifications.
    - Changes:
        - Manage Files
            - Updated:
                - Download File
                    - The arguments `$path` and `$fileName` switched order to `$fileName` and `$path`; The `$path` argument now has a default value `''`, denoting the root directory.
                - Upload File
                    - The arguments `$path`, `$fileName` and `$localFilePath` switched order to `$fileName`, `$path` and `$localFilePath`; The `$path` argument now has a default value `''`, denoting the root directory.
                    - Additional headers argument added (e.g SHA256).
                - Download File
                    - The arguments `$path` and `$fileName` switched order to `$fileName` and `$path`; The `$path` argument now has a default value `''`, denoting the root directory.
- Stream API
    - Notes:
        - Updating to the latest API specifications.
    - Changes:
        - Manage Videos
            - Added:
                - Get Video Heatmap
                - Get Video Statistics
            - Updated:
                - Update Video
                    - Body parameters
                - Upload Video
                    - Query parameters
                - Fetch Video
                    - Input arguments
                - Add Caption
                    - Body parameters
            - Deleted:
                - Fetch Video (to Collection)
- Token Authentication
    - Notes:
        - Added optional argument `$speedLimit`. Limits download speed in kB/s.
- Image Processor
    - Notes:
        - Bug fix when supplying boolean values (e.g. flip/flop) were converted to integers.

### Noteworthy

- Migration to PHP 8.1.
    - Addition of (backed) enum types.
    - Internal usage of named arguments.
    - Transforming from old "enum" classes to more explicit endpoint specific classes.
        - Internal changes of array for query/body parameter templates to `AbstractParameter` class.
- Decided on composition over inheritance when implementing PSR feature.
- Added issue templates for creating bug/feature reports.
- Updated/added phpmd, phpcs, phpstan, phpunit for contributions and in pipelines.
- Added [documentation website](https://ToshY.github.io/BunnyNet-PHP) to GitHub pages with the help of [mkdocs (material)](https://hub.docker.com/r/squidfunk/mkdocs-material).
