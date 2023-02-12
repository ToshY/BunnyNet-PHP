<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;

class UpdateComputeScript implements EndpointInterface, EndpointBodyInterface
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ScriptType', type: Type::INT_TYPE, required: true),
        ];
    }
}
