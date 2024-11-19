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

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\LoggingAPI;

$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
);

// Provide the account API key.
$loggingApi = new LoggingAPI(
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    client: $bunnyClient,
);
```

## Usage

```php
// Logging of yesterday.
$loggingApi->getLog(
    pullZoneId: 1,
    dateTime: new \DateTime('-1 day'),
);

// Logging of yesterday narrowed down by additional query parameters.
$loggingApi->getLog(
    pullZoneId: 1,
    dateTime: new \DateTime('-1 day'),
    query: [
        'start' => 10,
        'end' => 20,
        'order' => 'asc',
        'status' => '100,200,300,400,500',
        'search' => 'bunny.jpg',
    ],
);
```

!!! note

    - The key `status` consists of comma separated status codes.

## Reference

* [Logging API](https://docs.bunny.net/docs/cdn-logging)
