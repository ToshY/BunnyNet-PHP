<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class ListComputeScripts implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'compute/script';
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
            'perPage' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
        ];
    }
}
