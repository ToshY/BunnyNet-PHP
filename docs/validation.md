# Validation

The library ships with an optional validator that can be used to (pre-)validate your query and body parameters against the model schema before sending the actual API request. The validator allows for fine-grained control by using model-based strategies.

## Example

The following will demonstrate how to use the `BunnyValidator` to validate the query and body parameters for the `TranscribeVideo` model. 

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyHttpClient;
use ToshY\BunnyNet\BunnyValidator;
use ToshY\BunnyNet\Enum\Endpoint;
use ToshY\BunnyNet\Enum\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\TranscribeVideo;

// Default - Using STRICT strategy when applicable for both query and body parameters
$bunnyValidator = new BunnyValidator();

// Using the "STRICT_QUERY" strategy performs strict validation on just the query parameters
$bunnyValidator = new BunnyValidator(
    strategyOverride: [
        TranscribeVideo::class => ModelValidationStrategy::STRICT_QUERY,
    ]
);

// Using the "STRICT_BODY" strategy performs strict validation on just the body parameters
$bunnyValidator = new BunnyValidator(
    strategyOverride: [
        TranscribeVideo::class => ModelValidationStrategy::STRICT_BODY,
    ]
);

// Using the "LAX" strategy allows unofficial query and body parameters to be sent in the request
$bunnyValidator = new BunnyValidator(
    strategyOverride: [
        TranscribeVideo::class => ModelValidationStrategy::LAX,
    ]
);

// Using the "NONE" strategy will skip validation
$bunnyValidator = new BunnyValidator(
    strategyOverride: [
        TranscribeVideo::class => ModelValidationStrategy::NONE,
    ]
);

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

// Send a request to API if pre-validation was OK
$bunnyHttpClient = new BunnyHttpClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
    // Provide the specific video library API key.
    apiKey: '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
    baseUrl: Endpoint::STREAM
);

$response = $bunnyHttpClient->request($payload);
```

!!! question
    While the `BunnyValidator` can be useful for development and testing purposes as it will prematurely validate the payload request data before sending the actual API request, the API itself will also validate the submitted request data.