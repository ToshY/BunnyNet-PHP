# Stream API

Bunny Stream was designed for developers to easily upload, process, and display videos in any type of use-case.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\StreamAPI;

// Create a BunnyClient using any HTTP client implementing "Psr\Http\Client\ClientInterface".
$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\Psr18Client()
);

// Provide the "API key" available at the "API > API Key" section of your specific video library.
$streamApi = new StreamAPI(
    apiKey: '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
    client: $bunnyClient
);
```

## Usage

### Manage Collections

#### [Get Collection](https://docs.bunny.net/reference/collection_getcollection)

```php
$streamApi->getCollection(
    libraryId: 1,
    collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
);
```

#### [Update Collection](https://docs.bunny.net/reference/collection_updatecollection)

```php
$streamApi->updateCollection(
    libraryId: 1,
    collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
    body: [
        'name' => 'Bunny Hopping Collection V2',
    ],
);
```

#### [Delete Collection](https://docs.bunny.net/reference/collection_deletecollection)

```php
$streamApi->deleteCollection(
    libraryId: 1,
    collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
);
```

#### [List Collections](https://docs.bunny.net/reference/collection_list)

```php
$streamApi->listCollections(
    libraryId: 1,
    query: [
        'page' => 1,
        'perPage' => 100,
        'search' => 'bunny',
        'orderBy' => 'date',
    ],
);
```

#### [Create Collection](https://docs.bunny.net/reference/collection_createcollection)

```php
$streamApi->createCollection(
    libraryId: 1,
    body: [
        'name' => 'Bunny Collection',
    ],
);
```

### Manage Videos

#### [Get Video](https://docs.bunny.net/reference/video_getvideo)

```php
$streamApi->getVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
);
```

#### [Update Video](https://docs.bunny.net/reference/video_updatevideo)

```php
$streamApi->updateVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    body: [
        'title' => 'Bunny Hoppers',
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
        'chapters' => [
            [
                'title' => 'Chapter 1',
                'start' => 0,
                'end' => 300,
            ],
            [
                'title' => 'Chapter 2',
                'start' => 301,
                'end' => 500,
            ],
        ],
        'moments' => [
            [
                'label' => 'Awesome Scene 1',
                'timestamp' => 70,
            ],
            [
                'label' => 'Awesome Scene 2',
                'timestamp' => 120,
            ],
        ],
        'metaTags' => [
            [
                'property' => 'description',
                'value' => 'My Video Description',
            ],
            [
                'property' => 'robots',
                'value' => 'noindex,nofollow',
            ],
        ],
    ],
);
```

#### [Delete Video](https://docs.bunny.net/reference/video_deletevideo)

```php
$streamApi->deleteVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
);
```

#### [Create Video](https://docs.bunny.net/reference/video_createvideo)

```php
$streamApi->createVideo(
    libraryId: 1,
    body: [
        'title' => 'Bunny Hoppers',
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
    ],
);
```

!!! note

    - The `title` does not need to match the video filename and/or extension you're intending to upload.
    - A `collectionId` is not required.
    - The response returns the video's GUID, which is required for video upload (see [Upload Video](#upload-video)).


#### [Upload Video](https://docs.bunny.net/reference/video_uploadvideo)

```php
/*
 * File contents read into string from the local filesystem.
 */
$content = file_get_contents('./bunny-hop.mp4');

/*
 * File contents handle from a `$filesystem` (Flysystem FtpAdapter).
 */
$content = $filesystem->readStream('./bunny-hop.mp4');

// Upload video.
$streamApi->uploadVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    body: $content,
    query: [
        'enabledResolutions' => '240p,360p,480p,720p,1080p,1440p,2160p',
    ],
);
```

#### [Get Video Heatmap](https://docs.bunny.net/reference/video_getvideoheatmap)

```php
$streamApi->getVideoHeatmap(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
);
```

!!! warning

    - This endpoint currently returns a `500` status code with the following response: 
    ```
    Internal Server Error
    ```
    A support ticket has been created at bunny.net regarding this issue.

#### [Get Video Statistics](https://docs.bunny.net/reference/video_getvideostatistics)

```php
$streamApi->getVideoStatistics(
    libraryId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false,
        'videoGuid' => 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    ],
);
```

#### [Re-encode Video](https://docs.bunny.net/reference/video_reencodevideo)

```php
$streamApi->reEncodeVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
);
```

#### [List Videos](https://docs.bunny.net/reference/video_list)

```php
$streamApi->listVideos(
    libraryId: 1,
    query: [
        'page' => 1,
        'itemsPerPage' => 100,
        'search' => 'bunny',
        'collection' => '97f20caa-649b-4302-9f6e-1d286e0da144',
        'orderBy' => 'date',
    ],
);
```

#### [Set Thumbnail](https://docs.bunny.net/reference/video_setthumbnail)

```php
$streamApi->setThumbnail(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    query: [
        'thumbnailUrl' => 'https://cdn.example.com/thumbnail.jpg',
    ],
);
```

#### Set Thumbnail (by body)

```php
/*
 * File contents read into string from the local filesystem.
 */
$content = file_get_contents('./thumbnail.jpg');

/*
 * File contents handle from a `$filesystem` (Flysystem FtpAdapter).
 */
$content = $filesystem->readStream('./thumbnail.jpg');

// Set video thumbnail by body contents.
$streamApi->setThumbnailByBody(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    body: $content,
    headers: [
        'Content-Type' => 'image/jpeg',
    ],
);
```

!!! note

    - This method allows for uploading a thumbnail based on body contents.

!!! warning

    - Adding a thumbnail by uploading body contents is not documented in the official Bunny.net API specification for the [Set Thumbnail](https://docs.bunny.net/reference/video_setthumbnail) endpoint.

#### [Fetch Video](https://docs.bunny.net/reference/video_fetchnewvideo)

```php
$streamApi->fetchVideo(
    libraryId: 1,
    body: [
        'url' => 'https://example.com/bunny-hop.mp4',
        'headers' => [
            'newKey' => 'New Value',
            'newKey-1' => 'New Value 1',
            'newKey-2' => 'New Value 2',
        ],
    ],
    query: [
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
    ],
);
```

#### [Add Caption](https://docs.bunny.net/reference/video_addcaption)

```php
$streamApi->addCaption(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    sourceLanguage: 'jp',
    body: [
        'srclang' => 'jp',
        'label' => 'Subtitles (Japanese)',
        'captionsFile' => 'MQowMDowMDowMCwwMDAgLS0+IDAwOjAxOjAwLDAwMApOZXZlciBnb25uYSBnaXZlIHlvdSB1cC4K',
    ],
);
```

!!! note

    - The `sourceLanguage` / `srclang` is the [language shortcode](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) for the caption.
    - The `captionsFile` requires the file contents to be sent as a base64 encoded string.

#### [Delete Caption](https://docs.bunny.net/reference/video_deletecaption)

```php
$streamApi->deleteCaption(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    sourceLanguage: 'jp',
);
```

!!! note

    - The `sourceLanguage` is the [language shortcode](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) for the caption.

## Reference

* [Stream API](https://docs.bunny.net/reference/api-overview)
