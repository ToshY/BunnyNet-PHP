<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Purge;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class PurgeURL implements GenericEndpointInterface
{
    public function getMethod(): string
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
                'type' => 'string',
            ],
            'async' => [
                'required' => false,
                'type' => 'bool',
            ],
        ];
    }
}
