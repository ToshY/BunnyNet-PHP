<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\User;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;

class Verify2FACode implements EndpointInterface, EndpointBodyInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'user/2fa/verify';
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
            new AbstractParameter(name: 'SecretValidator', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Secret', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'TestPin', type: Type::STRING_TYPE),
        ];
    }
}
