<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class GetPullZone implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'pullzone/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            'includeCertificate' => [
                'required' => false,
                'type' => 'bool',
            ],
        ];
    }
}
