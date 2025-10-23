<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\AddOutputCodecToVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\CleanupUnconfiguredResolutions;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoHeatmapData;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoPlayData;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoStatistics;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\RepackageVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\SmartGenerate;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\TranscribeVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\VideoResolutionsInfo;
use ToshY\BunnyNet\Model\Api\Stream\OEmbed\GetOEmbed;

/**
 * @internal
 */
final class Stream
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
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
        '/library/{libraryId}/videos/{videoId}/play/heatmap' => [
            'get' => GetVideoHeatmapData::class,
        ],
        '/library/{libraryId}/statistics' => [
            'get' => GetVideoStatistics::class,
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
        '/library/{libraryId}/videos/{videoId}/smart' => [
            'post' => SmartGenerate::class,
        ],
        '/library/{libraryId}/videos/{videoId}/resolutions' => [
            'get' => VideoResolutionsInfo::class,
        ],
        '/library/{libraryId}/videos/{videoId}/resolutions/cleanup' => [
            'post' => CleanupUnconfiguredResolutions::class,
        ],
        '/OEmbed' => [
            'get' => GetOEmbed::class,
        ],
    ];
}
