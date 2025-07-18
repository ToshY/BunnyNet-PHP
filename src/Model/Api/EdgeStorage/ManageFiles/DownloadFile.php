<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DownloadFile implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return '%s/%s/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_ALL,
        ];
    }
}
