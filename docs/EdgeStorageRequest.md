# Edge Storage Request

## Usage

Provide the (read-only) password, from the **FTP & API Access** panel, and the 
location of the storage zone, which can be `FS` (Falkenstein), `NY` (New York), `LA` Los Angeles, 
`SG` (Singapore).
```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\EdgeStorageRequest;

$bunnyEdgeStorage = new EdgeStorageRequest(
    '6bf3d93a-5078-4d65-a437-501c44576fe6',
    'FS'
);
```
---
## Endpoints

The edge storage request has the following endpoints available:

* [Browse](#browse)
* [Manage](#manage)
    * [Details](#get-billing-details)
    * [Summary](#get-billing-summary)
    * [Apply promo code](#apply-promo-code)
---
### Browse
```php
// Root
$bunnyEdgeStorage->listFiles('my-storage-zone-1');

// Directory, e.g. /css
$bunnyEdgeStorage->listFiles('my-storage-zone-1', 'css');
```
---
### Manage
#### Upload file
```php
// Root
$bunnyEdgeStorage->uploadFile('my-storage-zone-1', '', 'new-bunny.jpg', '/var/www/html/bunny.jpg');

// Directory
$bunnyEdgeStorage->uploadFile('my-storage-zone-1', 'css', 'new-custom.css', '/var/www/html/custom.css');
```
---
#### Download file.
```php
// Root
$bunnyEdgeStorage->downloadFile('my-storage-zone-1', '', 'new-bunny.jpg');

// Directory
$bunnyEdgeStorage->downloadFile('my-storage-zone-1', 'css', 'new-custom.css');
```
---
#### Delete file.
```php
// Root
$bunnyEdgeStorage->deleteFile('my-storage-zone-1', '', 'new-bunny.jpg');

// Directory
$bunnyEdgeStorage->deleteFile('my-storage-zone-1', 'css', 'new-custom.css');
```