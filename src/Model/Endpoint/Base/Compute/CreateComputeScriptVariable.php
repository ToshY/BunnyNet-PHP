<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class CreateComputeScriptVariable implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script/%d/variables/add';
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
            'Name' => [
                'required' => true,
                'type' => 'string',
            ],
            'Required' => [
                'required' => true,
                'type' => 'bool',
            ],
            'DefaultValue' => [
                'required' => true,
                'type' => 'string',
            ],
        ];
    }
}
