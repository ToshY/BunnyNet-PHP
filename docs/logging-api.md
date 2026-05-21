# Logging API

Access raw request logs via API or dashboard with a 3 day log retention policy.

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

### Logging API v2 (recommended)

```php
// Last 24 hours of logs for a pull zone.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Logging\GetLogV2(
        pullZoneId: 1,
    )
);

// Narrowed down by additional query parameters.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Logging\GetLogV2(
        pullZoneId: 1,
        query: [
            'from' => '2026-05-20T00:00:00Z',
            'to' => '2026-05-21T00:00:00Z',
            'status' => '4xx,5xx',
            'cacheStatus' => 'HIT,MISS',
            'country' => 'EE,DE',
            'edgeLocation' => 'WA',
            'remoteIp' => '123.456.78.9',
            'urlContains' => 'video',
            'userAgentContains' => 'Mozilla',
            'refererContains' => 'example.com',
            'search' => 'bunny.jpg',
            'includeOriginShield' => false,
            'limit' => 100,
            'offset' => 0,
            'order' => 'desc',
        ],
    )
);
```

??? note

    - `from` defaults to `to - 24h` and `to` defaults to `now`; both must fall within the 3-day retention window.
    - `status` accepts exact codes (e.g. `200`, `404`) or classes (e.g. `2xx`, `5xx`) as a comma-separated list.
    - `limit` defaults to `100` and is capped at `10000`.
    - `order` is either `asc` or `desc` (default).

### Logging API v1 (legacy)

!!! warning

    The v1 API is preserved for existing integrations. New work should use the
    [v2 API](#logging-api-v2-recommended), which returns structured JSON, supports rich
    filtering and pagination, and avoids the pipe-injection issues inherent to the v1 format.

```php
// Logging of yesterday.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Logging\GetLog(
        date: (new \DateTime('-1 day'))->format('m-d-y'),
        pullZoneId: 1,
    )
);

// Logging of yesterday narrowed down by additional query parameters.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Logging\GetLog(
        date: (new \DateTime('-1 day'))->format('m-d-y'),
        pullZoneId: 1,
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

??? note

    - The key `status` consists of comma separated status codes.

??? warning

    - Sending the `date` key with an incorrect format (should be `m-d-y`) results in `403` status code.

## Reference

* [Logging API](https://docs.bunny.net/cdn/logging)
