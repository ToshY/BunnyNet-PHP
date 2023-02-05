<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;

class ResetPassword implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'videolibrary/resetApiKey';
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'id', type: Type::INT_TYPE, required: true),
        ];
    }
}
