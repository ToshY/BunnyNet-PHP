<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Logging;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class GetPullZoneLogging implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return '%s/%d.log';
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
            'start' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'end' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'order' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'status' => [
                'required' => false,
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::INT_TYPE->value,
                ],
            ],
            'search' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
