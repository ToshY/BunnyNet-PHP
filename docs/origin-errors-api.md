# Origin Errors API

When your origin stops responding, you shouldn’t have to dig through layers of logs or guess whether it’s DNS, timeouts, or misconfiguration.

Origin Errors Monitoring gives you full visibility into failed origin requests, directly in the dashboard or via API.

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
    baseUrl: Endpoint::ORIGIN_ERRORS
);
```

## Usage

### Fetch Origin Errors

#### [Get Origin Errors for PullZone Id and Date](https://docs.bunny.net/reference/get-cdn-origin-errors)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\OriginErrors\GetOriginErrorLogs(
        pullZoneId: 1,    
        dateTime: (new \DateTime('-1 day'))->format('m-d-y')
    )
);
```

## Reference

* [Origin Errors Blog Post](https://bunny.net/blog/no-more-502-guesswork-all-users-can-now-monitor-origin-errors/)
* [Origin Errors Docs](https://docs.bunny.net/reference/get_shield-shield-zones)
* [Origin Errors API](https://docs.bunny.net/reference/get-cdn-origin-errors)
