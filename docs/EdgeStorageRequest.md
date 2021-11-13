# Edge Storage Request

## Usage

Provide the (read-only) password, from the **FTP & API Access** panel, and the 
location of the storage zone, which can be `FS` (Falkenstein), `NY` (New York), `LA` Los Angeles, 
`SG` (Singapore).
```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\EdgeStorageRequest;

$bunnyBase = new EdgeStorageRequest(
    '6bf3d93a-5078-4d65-a437-501c44576fe6',
    'FS'
);
```

## Endpoints

The edge storage request has the following endpoints available:

* [Browse](#browse)
* [Manage](#manage)
    * [Details](#get-billing-details)
    * [Summary](#get-billing-summary)
    * [Apply promo code](#apply-promo-code)

### Browse
```php
// Root
$bunnyBase->listFiles('my-storage-zone-1');

// Directory, e.g. /css
$bunnyBase->listFiles('my-storage-zone-1', 'css');
```
---
### Manage
#### Upload file
```php
// Root
$bunnyBase->uploadFile('my-storage-zone-1', '', 'new-bunny.jpg', '/var/www/html/bunny.jpg');

// Directory
$bunnyBase->uploadFile('my-storage-zone-1', 'css', 'new-custom.css', '/var/www/html/custom.css');
```
---
#### Download file.
```php
// Root
$bunnyBase->downloadFile('my-storage-zone-1', '', 'new-bunny.jpg');

// Directory
$bunnyBase->downloadFile('my-storage-zone-1', 'css', 'new-custom.css');
```
---
#### Delete file.
```php
// Root
$bunnyBase->deleteFile('my-storage-zone-1', '', 'new-bunny.jpg');

// Directory
$bunnyBase->deleteFile('my-storage-zone-1', 'css', 'new-custom.css');
```