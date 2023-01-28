<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StorageZone;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class ResetPassword implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'storagezone/%d/resetPassword';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
