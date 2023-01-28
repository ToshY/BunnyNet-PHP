<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StorageZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class CheckStorageZoneAvailability implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'storagezone/checkavailability';
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
            'Name' => [
                'type' => 'string',
            ],
        ];
    }
}
