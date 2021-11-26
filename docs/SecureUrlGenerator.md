# Secure Url Generator

Generate a secure url using token authentication (with IP validation).

## Usage

Provide the (custom) hostname (including scheme `http://` or `https://`) from the **General** section in **Pull Zones**,
along with the **Url Token Authentication Key** found in the **Security** section of the same pull zone.

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

The secure url generator has the following methods available:

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

* Token IP validation only supports IPv4.
* In order to reduce the false negatives (and increase privacy) for Token IP validation, the default is to
  allow the full /24 subnet. 
  * Example: A token generated for an user with IPv4 `12.345.67.89` will allow the subnet `12.345.67.0`, to watch the content.
* Both `countries` and `referers` accept comma separated input, meaning you could allow or block multiple countries like
  so: `US,DE,JP`. Same for referers: `example.com,example.org`.
* An edge case occurs when you add a blocked country to the Traffic Manager, and allow that same country for 
  token authentication. This will result in a standard "Unable to connect" page. According to support *"The reason for 
  that would be is due to the fact that the Traffic manager doesn't resolve 
  the DNS from that country and in turn, we start returning 127.0.0.1 queries towards the hostnames in use instead 
  of the standard CDN routing. The traffic essentially doesn't even touch our servers in such a case."*