<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class ListVideos implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'library/%d/videos';
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
            'page' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'itemsPerPage' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'search' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'collection' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'orderBy' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}