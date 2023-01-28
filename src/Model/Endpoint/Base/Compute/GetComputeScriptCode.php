<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class GetComputeScriptCode implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'compute/script/%d/code';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
