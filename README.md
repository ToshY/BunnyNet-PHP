<br />
<a href="https://bunny.net?ref=pji59zr7a4">
    <img alt="Bunny CDN Logo" src="https://bunny.net/v2/images/bunnynet-logo-dark.svg" width="300" />
</a>

# BunnyNet API client for PHP

<div align="left">
    <img src="https://img.shields.io/packagist/v/toshy/bunnynet-php?label=Packagist" alt="Current bundle version" />
    <img src="https://img.shields.io/packagist/dt/toshy/bunnynet-php?label=Downloads" alt="Packagist Total Downloads" />
    <img src="https://img.shields.io/packagist/php-v/toshy/bunnynet-php?label=PHP" alt="PHP version requirement" />
    <img src="https://img.shields.io/badge/PSR-7%2F18-brightgreen" alt="PHP-FIG PSR-7" />
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpcs.yml?branch=master&label=PHPCS" alt="Code style">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpmd.yml?branch=master&label=PHPMD" alt="Mess detector">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/phpstan.yml?branch=master&label=PHPStan" alt="Static analysis">
    <img src="https://img.shields.io/github/actions/workflow/status/toshy/bunnynet-php/security.yml?branch=master&label=Security check" alt="Security check">
</div>

<a href="https://bunny.net?ref=pji59zr7a4">Bunny.net<a/> is content delivery platform that truly hops: providing CDN,
edge storage, video streaming and image optimizers.

<small>
<b>Note</b>: This is a non-official library for the <a href="https://docs.bunny.net/docs">bunny.net API</a>.
</small>

## Installation

```bash
composer require toshy/bunnynet-php
```

### Versions

| PHP             | Release  |
|-----------------|----------|
| ~~^7.4 / ^8.0~~ | ~~^2.0~~ |
| ^8.1            | ^3.0     |

> Note: The `2.x` branch will no longer be actively maintained after the initial `3.0` release.


## Quickstart

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\BaseRequest;
use ToshY\BunnyNet\EdgeStorageRequest;
use ToshY\BunnyNet\ImageOptimizer;
use ToshY\BunnyNet\PricingCalculator;
use Toshy\BunnyNet\PullZoneLogRequest;
use ToshY\BunnyNet\SecureUrlGenerator;
use ToshY\BunnyNet\VideoStreamRequest;

// Create a BunnyClient using any HTTP client implementing Psr\Http\Client\ClientInterface
$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\HttpClient()
)

// API endpoints
$bunnyBase = new BaseRequest(
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    client: $bunnyClient
);

$bunnyEdgeStorage = new EdgeStorageRequest(
    apiKey: '6bf3d93a-5078-4d65-a437-501c44576fe6',
    regionCode: Region::FS,
    client: $bunnyClient
);

$bunnyStream = new VideoStreamRequest(
    apiKey: '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
    client: $bunnyClient
);

$bunnyLog = new PullZoneLogRequest(
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    client: $bunnyClient
);

// Secure URL with token authentication.
$bunnySecureUrl = new SecureUrlGenerator(
    token: '5509f27d-9103-4de6-8370-8bd68db859c9',
    hostname: 'https://custom-pullzone.b-cdn.net'
);

// Image optimizer
$bunnyImageOptimizer = new ImageOptimizer();
```

## Documentation

Examples for each type of request can be found in the [docs](./docs) directory.

* [Base](docs/BaseRequest.md)
* [Edge Storage](docs/EdgeStorageRequest.md)
* [Video Stream](docs/VideoStreamRequest.md)
* [Pull Zone Log](docs/PullZoneLogRequest.md)
* [Secure Url Generator](docs/SecureUrlGenerator.md)
* [Image Optimizer](docs/ImageOptimizer.md)

## Reference

This library was created with the hand of the
available [bunny.net API docs](https://docs.bunny.net/reference/bunnynet-api-overview). <br />
Special thanks to the bunny.net support team for answering my questions regarding the API.

## Notes

* Tried to keep the naming conventions as close as possible to the original API.
* Tested the majority of the endpoints myself to validate if they are working correctly. If you happen to
  come across a bug, just submit an issue, and I'll take a look at it.

## Contribute

Features and bugfixes should be based on the master branch.

### Prerequisites

* [Docker Compose](https://docs.docker.com/compose/install/)
* [Task (optional)](https://taskfile.dev/installation/)

### Up service

```shell
task composer:install 
```

### Run checks

Run `phpcs`, `phpmd` and `phpstan`.

```shell
task contribute
```

## Licence

The BunnyNet PHP library is licensed under [MIT](LICENSE).
