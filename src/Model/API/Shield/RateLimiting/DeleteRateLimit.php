<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Shield\RateLimiting;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\EndpointInterface;

class DeleteRateLimit implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'shield/rate-limit/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
