<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Support;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class CloseTicket implements GenericEndpointInterface
{
    public function getMethod(): string
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
