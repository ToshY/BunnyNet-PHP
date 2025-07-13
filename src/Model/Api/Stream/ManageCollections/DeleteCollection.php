<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageCollections;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteCollection implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'library/%d/collections/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
