<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class DeleteWatermark implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'videolibrary/%d/watermark';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
