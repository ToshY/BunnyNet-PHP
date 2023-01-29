<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class CreateVideo implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ];
    }

    public function getBody(): array
    {
        return [
            'title' => [
                'required' => true,
                'type' => Type::STRING_TYPE->value,
            ],
            'collectionId' => [
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
