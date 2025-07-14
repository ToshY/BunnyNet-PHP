# Logging API

### About Logging
Bunny CDN provides a raw logging service giving you access to raw request logs.

### Privacy & GDPR
To comply with GDPR and privacy regulations all logs are provided with anonymized IP addresses. To enable full IP logging, you will first need to accept and sign the Data Processing Agreement (DPA) in your account settings. After that, a new setting will be enabled in your pull zone logging settings to disable anonymization.

### Log Retention
Searchable logs are stored for up to 3 days. If long-term log storage is required, an additional Permanent Log Storage feature is available. If enabled, the logs will be automatically uploaded to your selected Edge Storage zone at the end of each day.

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
    baseUrl: Endpoint::LOGGING
);
```

## Usage

```php
// Logging of yesterday.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Logging\GetLog(
        pullZoneId: 1,
        dateTime: (new \DateTime('-1 day'))->format('m-d-y'),
    )
);

// Logging of yesterday narrowed down by additional query parameters.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Logging\GetLog(
        pullZoneId: 1,
        dateTime: (new \DateTime('-1 day'))->format('m-d-y'),
        query: [
            'start' => 10,
            'end' => 20,
            'order' => 'asc',
            'status' => '100,200,300,400,500',
            'search' => 'bunny.jpg',
        ],
    )
);

```

!!! note

    - The key `status` consists of comma separated status codes.

## Reference

* [Logging API](https://docs.bunny.net/docs/cdn-logging)
