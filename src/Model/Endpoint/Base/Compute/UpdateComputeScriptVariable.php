<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class UpdateComputeScriptVariable implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script/%d/variables/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            'DefaultValue' => [
                'required' => false,
                'type' => 'string',
            ],
            'Required' => [
                'required' => false,
                'type' => 'bool',
            ],
        ];
    }
}
