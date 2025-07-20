<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class VideoResolutionsInfo implements ModelInterface
{
    /**
     * @param int $libraryId
     * @param string $videoId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
        #[PathProperty]
        public readonly string $videoId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/resolutions';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
