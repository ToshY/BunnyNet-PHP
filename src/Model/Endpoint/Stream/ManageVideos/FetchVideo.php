<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class FetchVideo implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/fetch';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ];
    }

    public function getQuery(): array
    {
        return [
            'collectionId' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }

    public function getBody(): array
    {
        return [
            'url' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'headers' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::ARRAY_TYPE->value,
                ],
            ],
        ];
    }
}
