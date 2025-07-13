<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\StorageZone;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteStorageZone implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'storagezone/%d';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
