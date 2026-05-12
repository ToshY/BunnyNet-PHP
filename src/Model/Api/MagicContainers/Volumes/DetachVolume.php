<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Volumes;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DetachVolume implements ModelInterface
{
    /**
     * @param string $appId
     * @param string $volumeId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
        #[PathProperty]
        public readonly string $volumeId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'apps/%s/volumes/%s/detach';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
