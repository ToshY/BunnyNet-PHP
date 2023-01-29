<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StorageZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class AddStorageZone implements EndpointInterface
{
    public function getMethod(): Method
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
                'type' => Type::STRING_TYPE->value,
            ],
            'Name' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Region' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ReplicationRegions' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'ZoneTier' => [
                'required' => true,
                'type' => Type::INT_TYPE->value,
            ],
        ];
    }
}
