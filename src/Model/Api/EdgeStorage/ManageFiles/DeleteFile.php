<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteFile implements ModelInterface
{
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
