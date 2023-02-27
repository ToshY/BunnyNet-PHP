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
    - The method(s) having `the` in the name have been renamed.
        - `closeTheAccount` => `closeAccount`
    - The method(s) having lowercase abbreviations have been renamed to uppercase abbreviations.
        - `getDpaDetails` => `getDPADetails`
  - The following public methods have been **removed**:
    - The method `fetchVideoToCollection` was removed as it's no longer in Stream API specifications.
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
