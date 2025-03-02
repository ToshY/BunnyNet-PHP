<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\EndpointInterface;

class AddOutputCodecToVideo implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/outputs/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
