<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteLiveThumbnail implements ModelInterface
{
    /**
     * @param int $id
     */
    public function __construct(
        #[PathProperty]
        public readonly int $id,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'videolibrary/%d/live/thumbnail';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
