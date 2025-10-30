<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\ShieldZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetShieldZonesPullzoneMapping implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/shield-zones/pullzone-mapping';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
