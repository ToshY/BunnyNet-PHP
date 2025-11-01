<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
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
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\TranscribeVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\TriggerSmartActions;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\VideoResolutionsInfo;
use ToshY\BunnyNet\Model\Api\Stream\OEmbed\GetOEmbed;

final class Stream
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        GetCollection::class => ModelValidationStrategy::STRICT_QUERY,
        UpdateCollection::class => ModelValidationStrategy::STRICT_BODY,
        DeleteCollection::class => ModelValidationStrategy::NONE,
        ListCollections::class => ModelValidationStrategy::STRICT_QUERY,
        CreateCollection::class => ModelValidationStrategy::STRICT_BODY,
        GetVideo::class => ModelValidationStrategy::NONE,
        UploadVideo::class => ModelValidationStrategy::STRICT_QUERY,
        UpdateVideo::class => ModelValidationStrategy::STRICT_BODY,
        DeleteVideo::class => ModelValidationStrategy::NONE,
        GetVideoHeatmap::class => ModelValidationStrategy::NONE,
        GetVideoPlayData::class => ModelValidationStrategy::STRICT_QUERY,
        GetVideoHeatmapData::class => ModelValidationStrategy::STRICT_QUERY,
        GetVideoStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        ReEncodeVideo::class => ModelValidationStrategy::NONE,
        AddOutputCodecToVideo::class => ModelValidationStrategy::NONE,
        RepackageVideo::class => ModelValidationStrategy::STRICT_QUERY,
        ListVideos::class => ModelValidationStrategy::STRICT_QUERY,
        CreateVideo::class => ModelValidationStrategy::STRICT_BODY,
        SetThumbnail::class => ModelValidationStrategy::STRICT_QUERY,
        FetchVideo::class => ModelValidationStrategy::STRICT,
        AddCaption::class => ModelValidationStrategy::STRICT_BODY,
        DeleteCaption::class => ModelValidationStrategy::NONE,
        TranscribeVideo::class => ModelValidationStrategy::STRICT,
        TriggerSmartActions::class => ModelValidationStrategy::STRICT_BODY,
        VideoResolutionsInfo::class => ModelValidationStrategy::NONE,
        CleanupUnconfiguredResolutions::class => ModelValidationStrategy::STRICT_QUERY,
        GetOEmbed::class => ModelValidationStrategy::STRICT_QUERY,
    ];
}
