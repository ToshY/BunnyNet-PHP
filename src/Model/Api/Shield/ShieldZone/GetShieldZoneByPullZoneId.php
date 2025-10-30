<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\ShieldZone;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetShieldZoneByPullZoneId implements ModelInterface
{
    /**
     * @param int $pullZoneId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $pullZoneId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/shield-zone/get-by-pullzone/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
