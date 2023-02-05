<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\Compute;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\EndpointInterface;

class CreateComputeScriptReleaseByPathParameter implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script/%d/publish/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }
}
