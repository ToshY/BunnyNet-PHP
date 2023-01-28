<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class DeleteCertificate implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/removeCertificate';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            'Hostname' => [
                'required' => true,
                'type' => 'string',
            ],
        ];
    }
}
