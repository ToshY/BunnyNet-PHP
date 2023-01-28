<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StorageZone;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class ResetReadOnlyPassword implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'storagezone/resetReadOnlyPassword';
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getQuery(): array
    {
        return [
            'id' => [
                'required' => true,
                'type' => 'int',
            ],
        ];
    }
}
