<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StorageZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateStorageZone implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'storagezone/%d';
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
            'ReplicationZones' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'type' => Type::STRING_TYPE->value,
                ],
            ],
            'OriginUrl' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Custom404FilePath' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Rewrite404To200' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
        ];
    }
}
