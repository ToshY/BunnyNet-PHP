<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StorageZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class AddStorageZone implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'storagezone';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    /**
     * ZoneTier (undocumented):
     * 0 = Standard (HDD)
     * 1 = Edge (SSD)
     */
    public function getBody(): array
    {
        return [
            'OriginUrl' => [
                'type' => 'string',
            ],
            'Name' => [
                'type' => 'string',
            ],
            'Region' => [
                'type' => 'string',
            ],
            'ReplicationRegions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
            'ZoneTier' => [
                'required' => true,
                'type' => 'int',
            ],
        ];
    }
}
