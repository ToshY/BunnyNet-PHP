<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\UploadScanning;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetShieldZoneUploadScanning implements ModelInterface
{
    /**
     * @param int $shieldZoneId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/shield-zone/%d/upload-scanning';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
