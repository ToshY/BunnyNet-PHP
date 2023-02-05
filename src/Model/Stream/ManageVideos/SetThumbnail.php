<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;

class SetThumbnail implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/thumbnail';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'thumbnailUrl', type: Type::STRING_TYPE, required: true),
        ];
    }
}
