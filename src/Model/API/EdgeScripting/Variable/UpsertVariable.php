<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\EdgeScripting\Variable;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;

class UpsertVariable implements EndpointInterface, EndpointBodyInterface
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'compute/script/%d/variables';
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'Required', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'DefaultValue', type: Type::STRING_TYPE),
        ];
    }
}
