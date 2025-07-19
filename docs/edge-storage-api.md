# Edge Storage API

Edge Storage is a cloud storage solution provided by bunny.net that automatically replicates your data to multiple regions around the world. It integrates tightly with the bunny.net CDN and was designed to be the fastest performing global storage solution thanks to smart geographical load balancing.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyHttpClient;
use ToshY\BunnyNet\Enum\Endpoint;

$bunnyHttpClient = new BunnyHttpClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
    // Provide the password of the specific storage zone.
    apiKey: '6bf3d93a-5078-4d65-a437-501c44576fe6',
    // Use the Edge Storage endpoint for your storage zone.
    baseUrl: Endpoint::EDGE_STORAGE_FS
);
```

## Usage

### Manage Files

#### [Download File](https://docs.bunny.net/reference/get_-storagezonename-path-filename)

```php
// Root directory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadFile(
        storageZoneName: 'my-storage-zone-1',
        fileName: 'bunny.jpg',
    )
);

// Subdirectory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadFile(
        storageZoneName: 'my-storage-zone-1',
        fileName: 'custom.css',
        path: 'css',
    )
);
```

#### Download Zip

```php
// Root directory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadZip(
        storageZoneName: 'my-storage-zone-1',
        body: [
            'RootPath' => '/my-storage-zone-1/',
            'Paths' => [
                '/my-storage-zone-1/',
            ],
        ],
    )
);

// Subdirectory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadZip(
        storageZoneName: 'my-storage-zone-1',
        body: [
            'RootPath' => '/my-storage-zone-1/',
            'Paths' => [
                '/my-storage-zone-1/images/',
            ],
        ],
    )
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
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile(
        storageZoneName: 'my-storage-zone-1',
        path: '',
        fileName: 'remote-bunny.jpg',
        body: $content,
    )
);

// Subdirectory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile(
        storageZoneName: 'my-storage-zone-1',
        path: 'css',
        fileName: 'remote-custom.css',
        body: $content,
    )
);

// Subdirectory with additional SHA256 checksum header.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile(
        storageZoneName: 'my-storage-zone-1',
        path: 'css',
        fileName: 'remote-custom.css',
        body: $content,
        headers: [
            'Checksum' => '253852201067799F637D8BB144F32D7AAEEF3182BEAA61168E0AA87DBE336D7C',
        ],
    )
);
```

!!! warning

    - While a hash value in hexidecimal string representation is case insensitive, the value for the `Checksum` header must be in **uppercase** characters to ensure a successful upload.
    - If an incorrect `Checksum` is provided, the response will still be `201` but the file will not be uploaded.

#### [Delete File](https://docs.bunny.net/reference/delete_-storagezonename-path-filename)

```php
// Root directory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DeleteFile(
        storageZoneName: 'my-storage-zone-1',
        path: '',
        fileName: 'bunny.jpg',
    )
);

// Subdirectory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DeleteFile(
        storageZoneName: 'my-storage-zone-1',
        path: 'css',
        fileName: 'custom.css',
    )
);
```

### Browse Files

#### [List Files](https://docs.bunny.net/reference/get_-storagezonename-path-)

```php
// Root directory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\BrowseFiles\ListFiles(
        storageZoneName: 'my-storage-zone-1',
        path: '',
    )
);

// Subdirectory.
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\EdgeStorage\BrowseFiles\ListFiles(
        storageZoneName: 'my-storage-zone-1',
        path: 'css',
    )
);
```

## Reference

* [Edge Storage API](https://docs.bunny.net/reference/storage-api)
