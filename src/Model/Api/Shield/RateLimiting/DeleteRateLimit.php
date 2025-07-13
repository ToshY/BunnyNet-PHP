<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\RateLimiting;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteRateLimit implements ModelInterface
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
