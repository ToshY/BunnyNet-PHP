<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class ListApplicationEndpoints implements ModelInterface
{
    /**
     * @param string $appId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'apps/%s/endpoints';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
