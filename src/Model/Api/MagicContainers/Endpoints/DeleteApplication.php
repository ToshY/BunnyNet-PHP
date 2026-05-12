<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteApplication implements ModelInterface
{
    /**
     * @param string $appId
     * @param string $endpointId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
        #[PathProperty]
        public readonly string $endpointId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'apps/%s/endpoints/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
