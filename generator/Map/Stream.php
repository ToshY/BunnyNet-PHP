<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\API\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\AddOutputCodecToVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteUnconfiguredResolutions;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoPlayData;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoResolutionsInfo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ListVideoStatistics;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\RepackageVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\TranscribeVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Model\API\Stream\OEmbed\GetOEmbed;

final class Stream
{
    /** @var array<string,array<string,class-string|null>> */
    public static array $endpoints = [
        '/library/{libraryId}/collections/{collectionId}' => [
            'get' => GetCollection::class,
            'post' => UpdateCollection::class,
            'delete' => DeleteCollection::class,
        ],
        '/library/{libraryId}/collections' => [
            'get' => ListCollections::class,
            'post' => CreateCollection::class,
        ],
        '/library/{libraryId}/videos/{videoId}' => [
            'get' => GetVideo::class,
            'put' => UploadVideo::class,
            'post' => UpdateVideo::class,
            'delete' => DeleteVideo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/heatmap' => [
            'get' => GetVideoHeatmap::class,
        ],
        '/library/{libraryId}/videos/{videoId}/play' => [
            'get' => GetVideoPlayData::class,
        ],
        '/library/{libraryId}/statistics' => [
            'get' => ListVideoStatistics::class,
        ],
        '/library/{libraryId}/videos/{videoId}/reencode' => [
            'post' => ReEncodeVideo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/outputs/{outputCodecId}' => [
            'put' => AddOutputCodecToVideo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/repackage' => [
            'post' => RepackageVideo::class,
        ],
        '/library/{libraryId}/videos' => [
            'get' => ListVideos::class,
            'post' => CreateVideo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/thumbnail' => [
            'post' => SetThumbnail::class,
        ],
        '/library/{libraryId}/videos/fetch' => [
            'post' => FetchVideo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/captions/{srclang}' => [
            'post' => AddCaption::class,
            'delete' => DeleteCaption::class,
        ],
        '/library/{libraryId}/videos/{videoId}/transcribe' => [
            'post' => TranscribeVideo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/resolutions' => [
            'get' => GetVideoResolutionsInfo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/resolutions/cleanup' => [
            'post' => DeleteUnconfiguredResolutions::class,
        ],
        '/OEmbed' => [
            'get' => GetOEmbed::class,
        ],
    ];
}
