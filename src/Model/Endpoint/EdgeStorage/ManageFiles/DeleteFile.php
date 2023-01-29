<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\EdgeStorage\ManageFiles;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class DeleteFile implements EndpointInterface
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
