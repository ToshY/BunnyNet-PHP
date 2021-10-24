<br />
<a href="https://bunny.net?ref=pji59zr7a4">
    <img alt="Bunny CDN Logo" src="https://bunny.net/v2/images/bunnynet-logo-dark.svg" width="300" />
</a>

# BunnyNet API client for PHP
<a href="https://bunny.net?ref=pji59zr7a4">Bunny.net<a/> is content delivery platform that truly hops: providing CDN,
edge storage, video streaming and image optimizers.

<small>Note: This is a non-official library for the Bunny.net API.</small>

## Installation

```bash
composer require toshy/bunnynet
```

## Usage

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\ContentDeliveryNetwork;
use ToshY\BunnyNet\EdgeStorage;
use ToshY\BunnyNet\Stream;
use ToshY\BunnyNet\SecureUrl;

$bunnyCdn = new ContentDeliveryNetwork(
    '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989'
);

$bunnyEdgeStorage = new EdgeStorage(
    '6bf3d93a-5078-4d65-a437-501c44576fe6',
    'fs'
);

$bunnyStream = new Stream(
    '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
);

$bunnySecureUrl = new SecureUrl(
    'https://custom-pullzone.b-cdn.net',
    '5509f27d-9103-4de6-8370-8bd68db859c9'
);
```

## Licence

The BunnyNet PHP library is licensed under [MIT](https://github.com/ToshY/BunnyNet/blob/master/LICENSE). 