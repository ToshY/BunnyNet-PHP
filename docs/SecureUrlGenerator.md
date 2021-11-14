# Secure Url Generator

## Usage

The pricing calculator is just a basic tool to calculate the possible storage costs.

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\SecureUrlGenerator;

$bunnySecureUrl = new SecureUrlGenerator(
    'https://custom-pullzone.b-cdn.net',
    '5509f27d-9103-4de6-8370-8bd68db859c9'
);
```
---
## Options
The edge storage request has the following endpoints available:
* [Generate](#generate)
---
### Generate
```php
// Root
$bunnySecureUrl->generate(
    '/bunny.jpg',
    3600,
    null,
    false,
    null,
    null,
    null,
    null,
    true  
);

// Directory
$bunnySecureUrl->generate(
    '/css/custom.css',
    3600,
    null,
    false,
    null,
    null,
    null,
    null,
    true  
);

// With IPv4
$bunnySecureUrl->generate(
    '/css/custom.css',
    3600,
    '12.345.67.89',
    false,
    null,
    null,
    null,
    null,
    true  
);

// With directory token enabled and path specified for video streaming
$bunnySecureUrl->generate(
    '/videos/awesome.m3u8',
    3600,
    '12.345.67.89',
    true,
    '/videos',
    null,
    null,
    null,
    true  
);

// Allow or block certain countries, e.g. allow "US" and block "RU".
$bunnySecureUrl->generate(
    '/videos/awesome.m3u8',
    3600,
    '12.345.67.89',
    true,
    '/videos',
    'US',
    'RU',
    null,
    true  
);

// Allow certain referers, e.g. allow "example.com".
$bunnySecureUrl->generate(
    '/videos/awesome.m3u8',
    3600,
    '12.345.67.89',
    true,
    '/videos',
    null,
    null,
    'example.com',
    true  
);
```
*Note*:
* Token authentication only supports IPv4.
* In order to reduce the false negatives (and increase privacy) for token authentication with IPv4, the default is to
allow the full /24 subnet. In practice this means allowing instead `12.345.67.0` instead of `12.345.67.89` (user's actual IPv4).