<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteFile implements ModelInterface
{
    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     */
    public function __construct(
        #[PathProperty]
        public readonly string $storageZoneName,
        #[PathProperty]
        public readonly string $path,
        #[PathProperty]
        public readonly string $fileName,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return '%s/%s/%s';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
