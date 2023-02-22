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
    client: new \Symfony\Component\HttpClient\HttpClient() # (1)
);

$edgeStorageAPI = new EdgeStorageAPI(
    apiKey: '6bf3d93a-5078-4d65-a437-501c44576fe6', # (2)
    regionCode: Region::FS, # (3)
    client: $bunnyClient
);
```

1. Create a BunnyClient using any HTTP client implementing `Psr\Http\Client\ClientInterface`.
2. Provide the **(Read-Only) Password** available at the **FTP & API Access** section of your specific storage zone.
3. The `regionCode` can have the following values:
    - `Region::DE` / `'DE'`
    - `Region::UK` / `'UK'`
    - `Region::NY` / `'NY'`
    - `Region::LA` / `'LA'`
    - `Region::SG` / `'SG'`
    - `Region::SYD` / `'SYD'`
    - `Region::BR` / `'BR'`
    - `Region::JH` / `'JH'`

## Usage

### Manage Files

#### [Download File](https://docs.bunny.net/reference/get_-storagezonename-path-filename)

```php
<?php

// Root directory.
$edgeStorageAPI->downloadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg'
);

// Subdirectory.
$edgeStorageAPI->downloadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'custom.css',
    path: 'css'
);
```

#### [Upload File](https://docs.bunny.net/reference/put_-storagezonename-path-filename)

```php
<?php

// Root directory.
$edgeStorageAPI->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-bunny.jpg',
    localFilePath: './local-bunny.jpg'
);

// Subdirectory.
$edgeStorageAPI->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-custom.css',
    localFilePath: './local-custom.css',
    path: 'css',
);

// Subdirectory with additional SHA256 checksum header.
$edgeStorageAPI->uploadFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'remote-custom.css',
    localFilePath: './local-custom.css',
    path: 'css',
    headers: [
        'Checksum': '253852201067799f637d8bb144f32d7aaeef3182beaa61168e0aa87dbe336d7c'
    ]
);
```

#### [Delete File](https://docs.bunny.net/reference/delete_-storagezonename-path-filename)

```php
<?php

// Root directory.
$edgeStorageAPI->deleteFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg'
);

// Subdirectory.
$edgeStorageAPI->deleteFile(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'custom.css',
    path: 'css'
);
```

### Browse Files

#### [List Files](https://docs.bunny.net/reference/get_-storagezonename-path-)

```php
<?php

// Root directory.
$edgeStorageAPI->listFiles(
    storageZoneName: 'my-storage-zone-1',
    fileName: 'bunny.jpg'
);

// Subdirectory.
$edgeStorageAPI->listFiles(
    storageZoneName: 'my-storage-zone-1',
    path: 'css'
);
```

## Reference

* [Edge Storage API](https://docs.bunny.net/reference/storage-api)
