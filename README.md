<br />
<a href="https://bunny.net?ref=pji59zr7a4">
    <img alt="Bunny CDN Logo" src="https://bunny.net/v2/images/bunnynet-logo-dark.svg" width="300" />
</a>

# BunnyNet API client for PHP
[![PHPCS](https://github.com/ToshY/BunnyNet/actions/workflows/phpcs.yml/badge.svg)](https://github.com/ToshY/BunnyNet/actions/workflows/phpcs.yml)

<a href="https://bunny.net?ref=pji59zr7a4">Bunny.net<a/> is content delivery platform that truly hops: providing CDN,
edge storage, video streaming and image optimizers.

<sub>Note: This is a non-official library for the [bunny.net API](https://docs.bunny.net/docs).</sub>

## Installation

```bash
composer require toshy/bunnynet
```

## Usage

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\BaseRequest;
use ToshY\BunnyNet\EdgeStorageRequest;
use ToshY\BunnyNet\VideoStreamRequest;
use Toshy\BunnyNet\PullZoneLogRequest;
use ToshY\BunnyNet\SecureUrlGenerator;
use ToshY\BunnyNet\PricingCalculator;

// Classes for API endpoints.
$bunnyBase = new BaseRequest(
    '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989'
);

$bunnyEdgeStorage = new EdgeStorageRequest(
    '6bf3d93a-5078-4d65-a437-501c44576fe6',
    'FS'
);

$bunnyStream = new VideoStreamRequest(
    '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
);

$bunnyLog = new PullZoneLogRequest(
    '986d288a-dd9b-4e79-9794-0a3ed1acd144',
);

// Secure URL with token authentication.
$bunnySecureUrl = new SecureUrlGenerator(
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
* I've tried to keep the naming conventions as close as possible to the original API so 
  passing arguments to the underlying methods should be kind of straightforward.
* Only tested the storage zone endpoints for listing, uploading, downloading and deleteting, but I'm fairly confident
  the other endpoints should work just fine. If not, just submit an issue and I'll have a look at it.

## Licence
The BunnyNet PHP library is licensed under [MIT](https://github.com/ToshY/BunnyNet/blob/master/LICENSE). 