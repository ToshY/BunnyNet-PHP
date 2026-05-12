<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteContainerRegistry implements ModelInterface
{
    /**
     * @param int $registryId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $registryId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'registries/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
