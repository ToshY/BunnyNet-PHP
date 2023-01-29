<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateVideo implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s';
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
                'type' => Type::STRING_TYPE->value,
            ],
            'collectionId' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'chapters' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'title' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                    'start' => [
                        'type' => Type::INT_TYPE->value,
                    ],
                    'end' => [
                        'type' => Type::INT_TYPE->value,
                    ],
                ],
            ],
            'moments' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'label' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                    'timestamp' => [
                        'type' => Type::INT_TYPE->value,
                    ],
                ],
            ],
            'metaTags' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'property' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                    'value' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                ],
            ],
        ];
    }
}
