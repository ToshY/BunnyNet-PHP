<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Shield\Metrics;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\EndpointInterface;

class GetRateLimitMetrics implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/metrics/rate-limit/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
