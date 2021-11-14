# Video Stream Request

Manage videos and collections through the Stream API.

## Usage

Provide the **Token Authentication Key** available from the **Security** section of your video library.

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\VideoStreamRequest;

$bunnyStream = new VideoStreamRequest(
    '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
);
```

---

## Endpoints

The edge storage request has the following endpoints available:

* [Video](#video)
    * [List](#list-videos)
    * [Create](#create-video)
    * [Upload](#upload-video)
    * [Get](#get-video)
    * [Update](#update-video)
    * [Delete](#delete-video)
    * [Re-encode](#re-encode-video)
    * [Set thumbnail](#set-thumbnail)
    * [Fetch](#fetch-video)
    * [Fetch to collection](#fetch-video-to-collection)
    * [Add caption](#add-caption)
    * [Delete caption](#delete-caption)
* [Collection](#collection)
    * [List](#get-collection-list)
    * [Create](#create-collection)
    * [Get](#get-collection)
    * [Update](#update-collection)
    * [Delete](#delete-collection)

---

### Video

#### List videos.

```php
$bunnyStream->listVideos(1234, [
    'page' => 1,
    'itemsPerPage' => 100,
    'search' => 'bunny-hop.mp4',
    'collection' => 'custom-collection',
    'orderBy' => 'date',
]);
```

---

#### Create video.

```php
$bunnyStream->createVideo(1234, [
    'title' => 'Bunny Hop',
    'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144'
]);
```

*Note*:

* The response returns the video's GUID, which is needed to upload the video.
* The title does not need a file extension.

---

#### Upload video.

```php
$bunnyStream->uploadVideo(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd', '/var/www/html/bunny-hop.mp4');
```

---

#### Get video.

```php
$bunnyStream->getVideo(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd');
```

---

#### Update video.

```php
$bunnyStream->updateVideo(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd', [
    'title' => 'Bunny Hop v2',
    'collectionId' => '12996949-d816-4126-8a4a-73cef3fb8c47',
]);
```

---

#### Delete video.

```php
$bunnyStream->deleteVideo(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd');
```

---

#### Re-encode video.

```php
$bunnyStream->reencodeVideo(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd');
```

---

#### Set thumbnail.

```php
$bunnyStream->setThumbnail(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd', [
    'thumbnailUrl' => 'https://example.org/bunny.jpg',
]);
```

---

#### Fetch video.

```php
$bunnyStream->fetchVideo(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd', [
    'url' => 'https://example.org/bunny-hop.mp4',
    'headers' => [
        'key1' => 'value1',    
        'key2' => 'value2',
        'keyN' => 'valueN',    
    ]
]);
```

---

#### Fetch video to collection.

```php
$bunnyStream->fetchVideoToCollection(1234, [
    'url' => 'https://example.org/bunny-hop.mp4',
    'headers' => [
            'key1' => 'value1',    
          'key2' => 'value2',
          'keyN' => 'valueN',    
        ],
    ],
    [
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
    ]
);
```

---

#### Add caption.

```php
$bunnyStream->addCaption(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd', 'EN', [
    'srclang' => 'EN',
    'label' => 'English',
    'captionsFile' => 'V0VCVlRUCgoxCjAwOjAwOjAzLjQwMCAtLT4gMDA6MDA6MDUuMTc3Ck5ldmVyIGdvbm5hIGdpdmUgeW91IHVwCgoyCjAwOjAwOjA1LjE3NyAtLT4gMDA6MDA6MDcuMDA5Ck5ldmVyIGdvbm5hIGxldCB5b3UgZG93bgoKMwowMDowMDowNy4wMDkgLS0+IDAwOjAwOjEzLjY1NQpOZXZlciBnb25uYSBydW4gYXJvdW5kIGFuZCBkZXNlcnQgeW91',
]);
```

*Note*:

* The `captionFile` needs to be a base64 encoded [VTT file](https://developer.mozilla.org/en-US/docs/Web/API/WebVTT_API)
  .

---

#### Delete caption.

```php
$bunnyStream->deleteCaption(1234, 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd', 'EN');
```

---

### Collection

#### Get collection list.

```php
$bunnyStream->getCollectionList(1234, [
    'page' => 1,
    'itemsPerPage' => 100,
    'search' => 'Bunny Collection',
    'orderBy' => 'date',
]);
```

---

#### Create collection.

```php
$bunnyStream->createCollection(1234, [
    'name' => 'Bunny Hopping Collection'
]);
```

---

#### Get collection.

```php
$bunnyStream->getCollection(1234, '97f20caa-649b-4302-9f6e-1d286e0da144');
```

---

#### Update collection.

```php
$bunnyStream->updateCollection(1234, '97f20caa-649b-4302-9f6e-1d286e0da144', [
    'name' => 'Bunny Hopping Collection V2',
]);
```

---

#### Delete collection.

```php
$bunnyStream->deleteCollection(1234, '97f20caa-649b-4302-9f6e-1d286e0da144');
```