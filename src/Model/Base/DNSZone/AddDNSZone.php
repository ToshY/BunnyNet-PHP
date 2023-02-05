<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;

class AddDNSZone implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'dnszone';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'Domain', type: Type::STRING_TYPE, required: true),
        ];
    }
}
