# Stream API

Bunny Stream was designed for developers to easily upload, process, and display videos in any type of use-case.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyHttpClient;
use ToshY\BunnyNet\Enum\Endpoint;

$bunnyHttpClient = new BunnyHttpClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
    // Provide the specific video library API key.
    apiKey: '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
    baseUrl: Endpoint::STREAM
);
```

## Usage

### Manage Collections

#### [Get Collection](https://docs.bunny.net/reference/collection_getcollection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageCollections\GetCollection(
        libraryId: 1,
        collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
        query: [
            'includeThumbnails' => true,
        ],
    )
);
```

!!! note

    - If the query parameter `includeThumbnails` is set to `true`, the response item(s) will include a non-empty array key `previewImageUrls` containing the URLs for the corresponding image thumbnails.

#### [Update Collection](https://docs.bunny.net/reference/collection_updatecollection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageCollections\UpdateCollection(
        libraryId: 1,
        collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
        body: [
            'name' => 'Bunny Hopping Collection V2',
        ],
    )
);
```

#### [Delete Collection](https://docs.bunny.net/reference/collection_deletecollection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageCollections\DeleteCollection(
        libraryId: 1,
        collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
    )
);
```

#### [List Collections](https://docs.bunny.net/reference/collection_list)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageCollections\ListCollections(
        libraryId: 1,
        query: [
            'page' => 1,
            'perPage' => 100,
            'search' => 'bunny',
            'orderBy' => 'date',
            'includeThumbnails' => true,
        ],
    )
);
```

!!! note

    - If the query parameter `includeThumbnails` is set to `true`, the response item(s) will include a non-empty array key `previewImageUrls` containing the URLs for the corresponding image thumbnails.

#### [Create Collection](https://docs.bunny.net/reference/collection_createcollection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageCollections\CreateCollection(
        libraryId: 1,
        body: [
            'name' => 'Bunny Collection',
        ],
    )
);
```

### Manage Videos

#### [Get Video](https://docs.bunny.net/reference/video_getvideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    )
);
```

#### [Update Video](https://docs.bunny.net/reference/video_updatevideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UpdateVideo(
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
    )
);
```

#### [Delete Video](https://docs.bunny.net/reference/video_deletevideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    )
);
```

#### [Create Video](https://docs.bunny.net/reference/video_createvideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\CreateVideo(
        libraryId: 1,
        body: [
            'title' => 'Bunny Hoppers',
            'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
            'thumbnailTime' => 10000,
        ],
    )
);
```

!!! note

    - The `title` does not need to match the video filename and/or extension you're intending to upload.
    - A `collectionId` is not required.
    - The response returns the video's GUID, which is required for video upload (see [Upload Video](#upload-video)).
    - The `thumbnailTime` denotes the video time in milliseconds to extract the main video thumbnail.

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
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UploadVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        body: $content,
        query: [
            'jitEnabled' => true,
            'enabledResolutions' => '240p,360p,480p,720p,1080p,1440p,2160p',
            'enabledOutputCodecs' => 'x264,vp9',
            'transcribeEnabled' => true,
            'transcribeLanguages' => 'fi,jp',
            'sourceLanguage' => 'en',
        ],
    )
);
```

#### [Get Video Heatmap](https://docs.bunny.net/reference/video_getvideoheatmap)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoHeatmap(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    )
);
```

!!! warning

    - This endpoint currently returns a `500` status code with the following response: 
    ```
    Internal Server Error
    ```
    A support ticket has been created at bunny.net regarding this issue.

#### [Get Video Play Data](https://docs.bunny.net/reference/video_getvideoplaydata)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoPlayData(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        query: [
            'token' => 'ead85f9a-578b-42b7-985f-9a578b12b776',
            'expires' => 3600,
        ],
    )
);
```

#### [Get Video Statistics](https://docs.bunny.net/reference/video_getvideostatistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoStatistics(
        libraryId: 1,
        query: [
            'dateFrom' => 'm-d-Y',
            'dateTo' => 'm-d-Y',
            'hourly' => false,
            'videoGuid' => 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        ],
    )
);
```

#### [Re-encode Video](https://docs.bunny.net/reference/video_reencodevideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ReEncodeVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    )
);
```

#### [Add output codec to video](https://docs.bunny.net/reference/video_reencodeusingcodec)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\AddOutputCodecToVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        outputCodecId: 2,
    )
);
```

!!! note

    - The argument `outputCodecId` has the following possible values:
        - `0` = x264
        - `1` = vp9 (premium)
        - `2` = hevc (premium)
        - `3` = av1 (premium)

!!! warning

    This endpoint will return a `400` status code if premium encoding is not enabled (even if the `outputCodecId` value `0` is given).

#### [Repackage Video](https://docs.bunny.net/reference/video_repackage)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\RepackageVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        query: [
            'keepOriginalFiles' => true,
        ],
    )
);
```

!!! note

    - This method allows repackaging of videos for libraries that have [Enterprise DRM](https://docs.bunny.net/docs/stream-drm#mediacage-enterprise-drm) enabled.

#### [List Videos](https://docs.bunny.net/reference/video_list)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ListVideos(
        libraryId: 1,
        query: [
            'page' => 1,
            'itemsPerPage' => 100,
            'search' => 'bunny',
            'collection' => '97f20caa-649b-4302-9f6e-1d286e0da144',
            'orderBy' => 'date',
        ],
    )
);
```

#### [Set Thumbnail](https://docs.bunny.net/reference/video_setthumbnail)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\SetThumbnail(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        query: [
            'thumbnailUrl' => 'https://cdn.example.com/thumbnail.jpg',
        ],
    )
);
```

#### [Fetch Video](https://docs.bunny.net/reference/video_fetchnewvideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\FetchVideo(
        libraryId: 1,
        body: [
            'url' => 'https://example.com/bunny-hop.mp4',
            'headers' => [
                'newKey' => 'New Value',
                'newKey-1' => 'New Value 1',
                'newKey-2' => 'New Value 2',
            ],
            'title' => 'Title for the video',
        ],
        query: [
            'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
            'thumbnailTime' => 10000,
        ],
    )
);
```

!!! note

    - The `thumbnailTime` denotes the video time in milliseconds to extract the main video thumbnail.

#### [Add Caption](https://docs.bunny.net/reference/video_addcaption)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\AddCaption(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        sourceLanguage: 'ja',
        body: [
            'srclang' => 'ja',
            'label' => 'Subtitles (Japanese)',
            'captionsFile' => 'MQowMDowMDowMCwwMDAgLS0+IDAwOjAxOjAwLDAwMApOZXZlciBnb25uYSBnaXZlIHlvdSB1cC4K',
        ],
    )
);
```

!!! note

    - The `sourceLanguage` / `srclang` should be an [**ISO 639-1** / **ISO 639-3** language abbreviation](https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes).
    - The `captionsFile` requires the file contents to be sent as a base64 encoded string.

#### [Delete Caption](https://docs.bunny.net/reference/video_deletecaption)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteCaption(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        sourceLanguage: 'ja',
    )
);
```

!!! note

    - The `sourceLanguage` should be an [**ISO 639-1** / **ISO 639-3** language abbreviation](https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes).

!!! warning

    - If a caption was created with a specific ISO standard for the `sourceLanguage`, then you have to delete it with the same standard. Example: a caption created with `sourceLanguage` **ISO 639-1** can only be deleted by sending a request with `sourceLanguage` **ISO 639-1**.
    - This endpoint will always return a `200` status code, even if the subtitle with specificied `sourceLanguage` does not exist.

!!! tip

    - If you (regularly) update captions make sure to purge the captions directory associated with the video. If it's not purged you might notice
    outdated subtitles displayed on the video. You can get the URL for the captions directory by using the [Get Video Play Data](#get-video-play-data) endpoint.


#### [Transcribe Video](https://docs.bunny.net/reference/video_transcribevideo)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\TranscribeVideo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        query: [
            'language' => 'fi',
            'force' => true,
        ],
        body: [
            'targetLanguages' => [
                'fi',
                'jp'
            ],
            'generateTitle' => true,
            'generateDescription' => true,
            'sourceLanguage' => 'en',
        ],   
    )
);
```

!!! note

    - The `language` is a [two-letter (set 1) language abbreviation](https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes) for transcribing the video.
    - Once a video has transcribed you need to set `force` to `true` in order to force a new transcription to be added.
    - The body parameter `sourceLanguage` takes precedence over the query parameter `language`.

#### [Video resolutions info](https://docs.bunny.net/reference/video_getvideoresolutions)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\VideoResolutionsInfo(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
    )
);
```

!!! warning

    - This endpoint returns a `500` status code if the video has not been fully processed yet.

#### [Cleanup unconfigured resolutions](https://docs.bunny.net/reference/video_deleteresolutions)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\ManageVideos\CleanupUnconfiguredResolutions(
        libraryId: 1,
        videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
        query: [
            'resolutionsToDelete' => '240p,360p',
            'deleteNonConfiguredResolutions' => false,
            'deleteOriginal' => false,
            'deleteMp4Files' => false,
            'dryRun' => false,
        ],
    )
);
```

!!! note

    - The key `resolutionsToDelete` consists of comma separated resolutions.

!!! tip

    Use the [Video Resolutions Info](#video-resolutions-info) endpoint to retrieve the resolutions for the video.

!!! warning

    This endpoint will return a `400` status code if all available resolutions for the video are passed to `resolutionsToDelete`, as there must be at least one resolution available after cleanup.

#### [Get OEmbed](https://docs.bunny.net/reference/oembed_getoembed)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Stream\OEmbed\GetOEmbed(
        query: [
            'url' => 'https://iframe.mediadelivery.net/embed/182595/8a800e53-c949-46d0-8818-af566f032ec1',
            'maxWidth' => 1280,
            'maxHeight' => 720,
            'token' => 'ead85f9a-578b-42b7-985f-9a578b12b776',
            'expires' => 3600,
        ],
    )
);
```

!!! note

    - The `url` is a required query parameter.

## Reference

* [Stream API](https://docs.bunny.net/reference/api-overview)
