<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class DeleteEdgeRule implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/edgerules/%d';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
