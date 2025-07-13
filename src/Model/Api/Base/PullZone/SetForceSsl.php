<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class SetForceSsl implements ModelInterface, BodyModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/setForceSSL';
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
            new AbstractParameter(name: 'Hostname', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'ForceSSL', type: Type::BOOLEAN_TYPE, required: true),
        ];
    }
}
