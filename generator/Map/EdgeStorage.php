<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile;

final class EdgeStorage
{
    /** @var array<string,array<string,class-string|null>> */
    public static array $endpoints = [
        '/{storageZoneName}/{path}/{fileName}' => [
            'get' => DownloadFile::class,
            'put' => UploadFile::class,
            'delete' => DeleteFile::class,
        ],
        '/{storageZoneName}/{path}/' => [
            'get' => ListFiles::class,
        ],
    ];
}
