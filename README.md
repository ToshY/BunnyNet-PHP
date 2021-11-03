<br />
<a href="https://bunny.net?ref=pji59zr7a4">
    <img alt="Bunny CDN Logo" src="https://bunny.net/v2/images/bunnynet-logo-dark.svg" width="300" />
</a>

# BunnyNet API client for PHP
[![PHPCS](https://github.com/ToshY/BunnyNet/actions/workflows/phpcs.yml/badge.svg)](https://github.com/ToshY/BunnyNet/actions/workflows/phpcs.yml)

<a href="https://bunny.net?ref=pji59zr7a4">Bunny.net<a/> is content delivery platform that truly hops: providing CDN,
edge storage, video streaming and image optimizers.

<sub>Note: This is a non-official library for the Bunny.net API.</sub>

## Installation

```bash
composer require toshy/bunnynet
```

## Usage

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\Base;
use ToshY\BunnyNet\EdgeStorage;
use ToshY\BunnyNet\VideoStream;
use Toshy\BunnyNet\PullZoneLog;
use ToshY\BunnyNet\SecureUrl;
use \ToshY\BunnyNet\PricingCalculator;

// Classes for API endpoints.
$bunnyBase = new Base(
    '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989'
);

$bunnyEdgeStorage = new EdgeStorage(
    '6bf3d93a-5078-4d65-a437-501c44576fe6',
    'FS'
);

$bunnyStream = new VideoStream(
    '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
);

$bunnyLog = new PullZoneLog(
    '986d288a-dd9b-4e79-9794-0a3ed1acd144',
);

// Secure URL with token authentication.
$bunnySecureUrl = new SecureUrl(
    'https://custom-pullzone.b-cdn.net',
    '5509f27d-9103-4de6-8370-8bd68db859c9'
);

// Pricing calculator for CDN and storage tiers.
$bunnyPricingCalculator = new PricingCalculator();
```

## Reference

This library was created with the hand of the available [bunny.net API docs](https://docs.bunny.net/reference/bunnynet-api-overview). <br />
Special thanks to the bunny.net support team for answering my questions regarding the API.

## Notes
I've tried to keep the naming conventions as close as possible to the original API so
passing arguments to the underlying methods should be kind of straightforward.

## Licence
The BunnyNet PHP library is licensed under [MIT](https://github.com/ToshY/BunnyNet/blob/master/LICENSE). 