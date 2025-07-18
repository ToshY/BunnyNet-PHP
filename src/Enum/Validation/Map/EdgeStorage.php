<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadZip;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile;

final class EdgeStorage
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        DownloadFile::class => ModelValidationStrategy::NONE,
        UploadFile::class => ModelValidationStrategy::NONE,
        DeleteFile::class => ModelValidationStrategy::NONE,
        ListFiles::class => ModelValidationStrategy::NONE,
        DownloadZip::class => ModelValidationStrategy::STRICT_BODY,
    ];
}
