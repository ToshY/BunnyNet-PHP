# Stream API

Bunny Stream was designed for developers to easily upload, process, and display videos in any type of use-case.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\StreamAPI;

$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\HttpClient() # (1)
);

$streamAPI = new StreamAPI(
    apiKey: '710d5fb6-d923-43d6-87f8-ea65c09e76dc', # (2)
    client: $bunnyClient
);
```

1. Create a BunnyClient using any HTTP client implementing `Psr\Http\Client\ClientInterface`.
2. Provide the **API key** available at the **API > API Key** section of your specific video library.

## Usage

### Manage Collections

#### [Get Collection](https://docs.bunny.net/reference/collection_getcollection)

```php
<?php

$streamAPI->getCollection(
    libraryId: 1,
    collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144'
);
```

#### [Update Collection](https://docs.bunny.net/reference/collection_updatecollection)

```php
<?php

$streamAPI->updateCollection(
    libraryId: 1,
    collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
    body: [
        'name' => 'Bunny Hopping Collection V2'
    ]
);
```

#### [Delete Collection](https://docs.bunny.net/reference/collection_deletecollection)

```php
<?php

$streamAPI->deleteCollection(
    libraryId: 1,
    collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144'
);
```

#### [List Collections](https://docs.bunny.net/reference/collection_list)

```php
<?php

$streamAPI->listCollections(
    libraryId: 1,
    query: [
        'page' => 1,
        'perPage' => 100,
        'search' => 'bunny',
        'orderBy' => 'date'
    ]
);
```

#### [Create Collection](https://docs.bunny.net/reference/collection_createcollection)

```php
<?php

$streamAPI->createCollection(
    libraryId: 1,
    body: [
        'name' => 'Bunny Collection'
    ]
);
```

### Manage Videos

#### [Get Video](https://docs.bunny.net/reference/video_getvideo)

```php
<?php

$streamAPI->getVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
);
```

#### [Update Video](https://docs.bunny.net/reference/video_updatevideo)

```php
<?php

$streamAPI->updateVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    body: [
        'title' => 'Bunny Hoppers',
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
        'chapters' => [
            [
                'title' => 'Chapter 1',
                'start' => 0,
                'end' => 300
            ],
            [
                'title' => 'Chapter 2',
                'start' => 301,
                'end' => 500
            ],
        ]
        'moments' => [
            [
                'label' => 'Awesome Scene 1',
                'timestamp' => 70
            ],
            [
                'title' => 'Awesome Scene 2',
                'timestamp' => 120
            ],
        ]
        'metaTags' => [
            [
                'property' => 'description',
                'value' => 'My Video Description'
            ],
            [
                'property' => 'robots',
                'value' => 'noindex,nofollow'
            ]
        ]
    ]
);
```

#### [Delete Video](https://docs.bunny.net/reference/video_deletevideo)

```php
<?php

$streamAPI->deleteVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
);
```

#### [Create Video](https://docs.bunny.net/reference/video_createvideo)

```php
<?php

$streamAPI->createVideo(
    libraryId: 1,
    body: [
        'title' => 'Bunny Hoppers',
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144'
    ]
);
```

!!! note

    - The `title` does not need to match or require a file extension.
    - A `collectionId` is not required.
    - The response returns the video's GUID, which is required for video upload (see [uploadVideo](#upload-video)).


#### [Upload Video](https://docs.bunny.net/reference/video_uploadvideo)

```php
<?php

$streamAPI->uploadVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    localFilePath: './bunny-hop.mp4',
    query: [
        'enabledResolutions' => '240p,360p,480p,720p,1080p,1440p,2160p'
    ]
);
```

#### [Get Video Heatmap](https://docs.bunny.net/reference/video_getvideoheatmap)

```php
<?php

$streamAPI->getVideoHeatmap(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
);
```

#### [Get Video Statistics](https://docs.bunny.net/reference/video_getvideostatistics)

```php
<?php

$streamAPI->getVideoStatistics(
    libraryId: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'hourly' => false,
        'videoGuid' => 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
    ]
);
```

#### [Re-encode Video](https://docs.bunny.net/reference/video_reencodevideo)

```php
<?php

$streamAPI->reEncodeVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
);
```

#### [List Videos](https://docs.bunny.net/reference/video_list)

```php
<?php

$streamAPI->listVideos(
    libraryId: 1,
    query: [
        'page' => 1,
        'itemsPerPage' => 100,
        'search' => 'bunny',
        'collection' => '97f20caa-649b-4302-9f6e-1d286e0da144',
        'orderBy' => 'date'
    ]
);
```

#### [Set Thumbnail](https://docs.bunny.net/reference/video_setthumbnail)

```php
<?php

$streamAPI->setThumbnail(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
    query: [
        'thumbnailUrl' => 'https://cdn.example.com/thumbnail.jpg'
    ]
);
```

#### [Fetch Video](https://docs.bunny.net/reference/video_fetchnewvideo)

```php
<?php

$streamAPI->fetchVideo(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
    query: [
        'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144'
    ],
    body: [
        'url' =>'https://example.com/bunny-hop.mp4',
        'headers' => [
            'newKey' => 'New Value',
            'newKey-1' => 'New Value',
            'newKey-2' => 'New Value'
        ]
    ]
);
```

#### [Add Caption](https://docs.bunny.net/reference/video_addcaption)

```php
<?php

$streamAPI->addCaption(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    sourceLanguage: 'jp',
    body: [
        'srclang' =>'https://example.com/bunny-hop.mp4',
        'label' =>'Subtitles (Japanese)',
        'captionsFile' =>'MQowMDowMDowMCwwMDAgLS0+IDAwOjAxOjAwLDAwMApOZXZlciBnb25uYSBnaXZlIHlvdSB1cC4K'
    ]
);
```

!!! note

    - The `sourceLanguage` / `srclang` is the [language shortcode](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) for the caption.
    - The `captionsFile` requires the file contents to be sent as a base64 encoded string.

#### [Delete Caption](https://docs.bunny.net/reference/video_deletecaption)

```php
<?php

$streamAPI->deleteCaption(
    libraryId: 1,
    videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    sourceLanguage: 'jp'
);
```

!!! note

    - The `sourceLanguage` / `srclang` is the [language shortcode](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) for the caption.

## Reference

* [Stream API](https://docs.bunny.net/reference/api-overview)