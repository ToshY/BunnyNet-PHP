# Token Authentication

Bunny CDN provides a powerful token authentication system to strictly control who, where and for how long can access
your content.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyTokenAuthentication;

// Provide the API key for the specific pull zone you want to use, available at the "Security > Token Authentication > Url Token Authentication Key" section.
$bunnyTokenAuthentication = new BunnyTokenAuthentication(
    token: '5509f27d-9103-4de6-8370-8bd68db859c9',
    hostname: 'https://custom-pullzone.b-cdn.net',
);
```

## Usage

Sign a URL.

```php
// File in root directory.
bunnyTokenAuthentication->sign(
    file: '/bunny.jpg',
    expirationTime: 3600,
    userIp: null,
    isDirectoryToken: false,
    pathAllowed: null,
    countriesAllowed: null,
    countriesBlocked: null,
    referrersAllowed: null,
    speedLimit: null,
    allowSubnet: true
);

// File in subdirectory.
$tokenAuthentication->sign(
    file: '/css/custom.css',
);

// Change expiration time.
$tokenAuthentication->sign(
    file: '/css/custom.css',
    expirationTime: 10,
);

// With IPv4 and not allowing associated subnet.
$tokenAuthentication->sign(
    file: '/css/custom.css',
    userIp: '12.345.67.89',
    allowSubnet: false
);

// With directory token enabled and path specified for video streaming.
$tokenAuthentication->sign(
    file: '/videos/cute-bunnies/playlist.m3u8',
    userIp: '12.345.67.89',
    isDirectoryToken: true,
    pathAllowed: '/videos/cute-bunnies',
);

// Allow or block certain countries, e.g. allow "US" and block "RU".
$tokenAuthentication->sign(
    file: '/videos/cute-bunnies/playlist.m3u8',
    userIp: '12.345.67.89',
    isDirectoryToken: true,
    pathAllowed: '/videos/cute-bunnies',
    countriesAllowed: 'US',
    countriesBlocked: 'RU',
);

// Allow from specific referrer.
$tokenAuthentication->sign(
    file: '/videos/cute-bunnies/playlist.m3u8',
    userIp: '12.345.67.89',
    isDirectoryToken: true,
    pathAllowed: '/videos/cute-bunnies',
    referrersAllowed: 'example.com',
);

// Limit the download speed limit to 5 Mb/s.
$tokenAuthentication->sign(
    file: '/videos/cute-bunnies/playlist.m3u8',
    userIp: '12.345.67.89',
    isDirectoryToken: true,
    pathAllowed: '/videos/cute-bunnies',
    speedLimit: 5120,
);
```

!!! note

    - The argument `expirationTime` denotes the time in seconds the resource is available after signing.
    - The argument `speedLimit` denotes the download speed limit (in kB/s) for the resource.
    - Token IP validation only supports IPv4.
    - In order to reduce the false negatives (and increase privacy) for Token IP validation, the default is to
    allow the full `/24` subnet. As an example, a token signed for a user with IPv4 `12.345.67.89` will allow 
    `12.345.67.0/24` to access the resource.
    - The arguments `countriesAllowed`, `countriesBlocked` and `referrersAllowed` accept comma separated input. This means
    you could allow or block multiple countries like so: `US,DE,JP`. Same goes for the allowed referers: `example.com,example.org`.
    - An edge case occurs when you add a blocked country to the Traffic Manager, and allow that same country for
    token authentication. This will result in a standard **"Unable to connect"** page. According to support *"The reason for
    that would be is due to the fact that the Traffic manager doesn't resolve
    the DNS from that country and in turn, we start returning `127.0.0.1` queries towards the hostnames in use instead
    of the standard CDN routing. The traffic essentially doesn't even touch our servers in such a case."*

!!! warning
    
    - The example using `speedLimit` for token authentication is currently not working as expected, as it returns a `403` status
    code. A support ticket has been created at bunny.net regarding this issue.


## Reference

* [Token Authentication Guide](https://support.bunny.net/hc/en-us/articles/360016055099-How-to-sign-URLs-for-BunnyCDN-Token-Authentication)
* [BunnyWay/BunnyCDN.TokenAuthentication](https://github.com/BunnyWay/BunnyCDN.TokenAuthentication)
