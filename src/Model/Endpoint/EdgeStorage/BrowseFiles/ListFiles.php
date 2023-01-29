<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\EdgeStorage\BrowseFiles;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class ListFiles implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    /**
     * Note: second %s should be replaced by '' for root directory.
     */
    public function getPath(): string
    {
        return '%s/%s/';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_ALL,
        ];
    }
}
