# Edge Storage API

Edge Storage is a cloud storage solution provided by bunny.net that automatically replicates your data to multiple regions around the world. It integrates tightly with the bunny.net CDN and was designed to be the fastest performing global storage solution thanks to smart geographical load balancing.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\EdgeStorageAPI;
use ToshY\BunnyNet\Enum\Region;

$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
);

// Provide the password of the specific storage zone.
$edgeStorageApi = new EdgeStorageAPI(
    apiKey: '6bf3d93a-5078-4d65-a437-501c44576fe6',
    client: $bunnyClient,
    region: Region::FS,
);
```

!!! note 
    - The argument `region` has the following possible values:
        - `Region::DE` = Falkenstein / Frankfurt (Germany)
        - `Region::UK` = London (United Kingdom)
        - `Region::NY` = New York (United States East)
        - `Region::LA` = Los Angeles (United States West)
        - `Region::SG` = Singapore (Singapore)
        - `Region::SYD` = Sydney (Oceania)
        - `Region::BR` = Sao Paolo (Brazil)
        - `Region::JH` = Johannesburg (Africa)
    - The `Region` is a backed enum, so you can supply a value to the `Region::from` or `Region::tryFrom` method to retrieve the corresponding case.

## Usage

### Manage Files

#### [Download File](https://docs.bunny.net/reference/get_-storagezonename-path-filename)

```php
// Root directory.
$edgeStorageApi->downloadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg',
);

// Subdirectory.
$edgeStorageApi->downloadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'custom.css',
    path: 'css',
);
```

#### Download Zip

```php
// Root directory.
$edgeStorageApi->downloadZip(
    storageZoneName: 'my-storage-zone-1',
    body: [
        'RootPath' => '/my-storage-zone-1/',
        'Paths' => [
            '/my-storage-zone-1/',
        ]
    ],
);

// Subdirectory.
$edgeStorageApi->downloadZip(
    storageZoneName: 'my-storage-zone-1',
    body: [
        'RootPath' => '/my-storage-zone-1/',
        'Paths' => [
            '/my-storage-zone-1/images/',
        ]
    ],
);
```

!!! note
    - Make sure your `RootPath` and `Paths` contain **leading** and **trailing** slashes.
        - If you omit the slashes in `RootPath` this will result in a `400` status code.
        - If you omit the slashes in `Paths` this will result in a `200` status code with an empty ZIP file.

!!! warning

    - This endpoint (with method `POST`) is currently not documented in the API specifications.
    - This request may fail or timeout if the requested directory has too many files or is too big.

#### [Upload File](https://docs.bunny.net/reference/put_-storagezonename-path-filename)

```php
/*
 * File contents read into string from the local filesystem.
 */
$content = file_get_contents('./local-bunny.jpg');

/*
 * File contents handle from a `$filesystem` (e.g. Flysystem FtpAdapter).
 */
$content = $filesystem->readStream('./remote-custom.css');

// Root directory.
$edgeStorageApi->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-bunny.jpg',
    body: $content,
);

// Subdirectory.
$edgeStorageApi->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-custom.css',
    body: $content,
    path: 'css',
);

// Subdirectory with additional SHA256 checksum header.
$edgeStorageApi->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-custom.css',
    body: $content,
    path: 'css',
    headers: [
        'Checksum' => '253852201067799F637D8BB144F32D7AAEEF3182BEAA61168E0AA87DBE336D7C',
    ],
);
```

!!! warning

    - While a hash value in hexidecimal string representation is case insensitive, the value for the `Checksum` header must be in **uppercase** characters to ensure a successful upload.

#### [Delete File](https://docs.bunny.net/reference/delete_-storagezonename-path-filename)

```php
// Root directory.
$edgeStorageApi->deleteFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg',
);

// Subdirectory.
$edgeStorageApi->deleteFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'custom.css',
    path: 'css',
);
```

### Browse Files

#### [List Files](https://docs.bunny.net/reference/get_-storagezonename-path-)

```php
// Root directory.
$edgeStorageApi->listFiles(
    storageZoneName: 'my-storage-zone-1',
);

// Subdirectory.
$edgeStorageApi->listFiles(
    storageZoneName: 'my-storage-zone-1',
    path: 'css',
);
```

## Reference

* [Edge Storage API](https://docs.bunny.net/reference/storage-api)
