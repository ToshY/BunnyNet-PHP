<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Support;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class CloseTicket implements ModelInterface
{
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
