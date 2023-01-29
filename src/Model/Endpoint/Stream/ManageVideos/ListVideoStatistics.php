<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class ListVideoStatistics implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'library/%d/statistics';
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
            'dateFrom' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'dateTo' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'hourly' => [
                'required' => false,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'videoGuid' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
