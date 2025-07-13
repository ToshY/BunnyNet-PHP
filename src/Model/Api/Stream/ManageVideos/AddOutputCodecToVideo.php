<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class AddOutputCodecToVideo implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/outputs/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
