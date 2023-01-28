<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class AddDNSZone implements GenericEndpointInterface
{
    public function getMethod(): string
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
            'Domain' => [
                'required' => true,
                'type' => 'string',
            ],
        ];
    }
}
