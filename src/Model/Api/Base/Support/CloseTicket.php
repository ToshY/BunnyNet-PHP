<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Support;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class CloseTicket implements ModelInterface
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
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'support/ticket/%d/close';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
