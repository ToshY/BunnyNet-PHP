## 3.x

### ‼️ Breaking changes

- Return type for public methods changed from `array` to `Psr\Http\Message\ResponseInterface` model.
    - `$response['content']` => `$response->getBody()->getContents()`
    - `$response['headers']` => `$response->getHeaders()`
    - `$response['status']['code']` => `$response->getStatusCode()`
    - `$response['status']['info']` => `$response->getReasonPhrase()`
- The class `PullZoneLogRequest` was renamed to `LoggingRequest`.
- The class `VideoStreamRequest` was renamed to `StreamRequest`.
- The class `SecureUrlGenerator` was renamed to `TokenAuthentication`.
    - The method `generate` was renamed to `sign`.
- The class `ImageOptimizer` was renamed to `ImageProcessor`.
- The class `PricingCalculator` was removed (as deemed unrelated to API).
- The method `fetchVideoToCollection` was removed as it's no longer in Stream API specs.
- The method `listStorageZone` was renamed to `listStorageZones`.
- The method `resetStorageZonePasswordByPath` was renamed to `resetStorageZonePassword`.
- The method `getCollectionList` was renamed to `listCollections`.
- Methods having `the` in the name have been renamed.
    - `closeTheAccount` => `closeAccount`
- Method having lowercase abbreviations have been renamed to uppercase abbreviations.
    - `getDpaDetails` => `getDPADetails`

> Note: Please take in consideration that due to the impact of this release I cannot fully guarantee this list of
> breaking changes is complete. Thank you for your understanding.

### Updates

- Base API
    - Notes:
        - Updates and additions of endpoints to be up-to-date with the latest API specifications.
- Edge Storage API
    - Notes:
        - For the `$hostCode` in the construction and `setHost` method can now accept either `Region` or `string`
          values.
            - Example: For `Falkenstein` region either `Region::FS` (new/preferred way) or `'FS'` (old way) both work.
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
        - Multiple changes/additions to endpoints.
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
        - Added optional argument `limit`. Limits download speed (in kB/s).

### Noteworthy

- Migration to PHP 8.1.
    - Addition of (backed) enum types.
    - Internal usage of named arguments.
    - Transforming from old "enum" classes to more explicit endpoint specific classes.
        - Internal changes of array for query/body parameter templates to `AbstractParameter` class.
- Added issue templates for creating bug/feature reports.
- Updated/added phpmd, phpcs, phpstan, phpunit for contributions and in pipelines.
- Added documentation to GitHub pages with [mkdocs (material)](https://hub.docker.com/r/squidfunk/mkdocs-material).