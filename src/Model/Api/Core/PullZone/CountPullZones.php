<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class CountPullZones implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'pullzone/count';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
