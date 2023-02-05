<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;

class UploadVideo implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'enabledResolutions', type: Type::STRING_TYPE),
        ];
    }
}
