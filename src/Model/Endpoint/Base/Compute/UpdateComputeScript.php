<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateComputeScript implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    /**
     * ScriptType:
     * 0 = DNS
     * 1 = CDN
     */
    public function getBody(): array
    {
        return [
            'Name' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'ScriptType' => [
                'required' => true,
                'type' => Type::INT_TYPE->value,
            ],
        ];
    }
}
