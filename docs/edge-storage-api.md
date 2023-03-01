# Edge Storage API

Edge Storage is a cloud storage solution provided by bunny.net that automatically replicates your data to multiple regions around the world. It integrates tightly with the bunny.net CDN and was designed to be the fastest performing global storage solution thanks to smart geographical load balancing.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\EdgeStorageAPI;
use ToshY\BunnyNet\Enum\Region;

// Create a BunnyClient using any HTTP client implementing "Psr\Http\Client\ClientInterface".
$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\Psr18Client()
);

// Provide the "(Read-Only) Password" available at the "FTP & API Access" section of your specific storage zone.
$edgeStorageApi = new EdgeStorageAPI(
    apiKey: '6bf3d93a-5078-4d65-a437-501c44576fe6',
    region: Region::FS,
    client: $bunnyClient
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

## Usage

### Manage Files

#### [Download File](https://docs.bunny.net/reference/get_-storagezonename-path-filename)

```php
// Root directory.
$edgeStorageApi->downloadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg'
);

// Subdirectory.
$edgeStorageApi->downloadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'custom.css',
    path: 'css'
);
```

#### [Upload File](https://docs.bunny.net/reference/put_-storagezonename-path-filename)

```php
// Root directory.
$edgeStorageApi->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-bunny.jpg',
    localFilePath: './local-bunny.jpg'
);

// Subdirectory.
$edgeStorageApi->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-custom.css',
    localFilePath: './local-custom.css',
    path: 'css',
);

// Subdirectory with additional SHA256 checksum header.
$edgeStorageApi->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-custom.css',
    localFilePath: './local-custom.css',
    path: 'css',
    headers: [
        'Checksum' => '253852201067799f637d8bb144f32d7aaeef3182beaa61168e0aa87dbe336d7c'
    ]
);
```

!!! note

    - Supplying either a correct or incorrect `Checksum`, this endpoint currently returns a `400` status code with the following response: 
    ```
    {
      "HttpCode": 400,
      "Message": "Unable to upload file."
    }
    ```

#### [Delete File](https://docs.bunny.net/reference/delete_-storagezonename-path-filename)

```php
// Root directory.
$edgeStorageApi->deleteFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg'
);

// Subdirectory.
$edgeStorageApi->deleteFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'custom.css',
    path: 'css'
);
```

### Browse Files

#### [List Files](https://docs.bunny.net/reference/get_-storagezonename-path-)

```php
// Root directory.
$edgeStorageApi->listFiles(
    storageZoneName: 'my-storage-zone-1'
);

// Subdirectory.
$edgeStorageApi->listFiles(
    storageZoneName: 'my-storage-zone-1',
    path: 'css'
);
```

## Reference

* [Edge Storage API](https://docs.bunny.net/reference/storage-api)
