<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Purge;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class PurgeURL implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'purge';
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getQuery(): array
    {
        return [
            'url' => [
                'required' => true,
                'type' => Type::STRING_TYPE->value,
            ],
            'async' => [
                'required' => false,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
        ];
    }
}
