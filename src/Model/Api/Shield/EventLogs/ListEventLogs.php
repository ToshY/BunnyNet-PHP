<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\EventLogs;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class ListEventLogs implements ModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param string $date
     * @param string $continuationToken
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
        #[PathProperty]
        public readonly string $date,
        #[PathProperty]
        public readonly string $continuationToken,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/event-logs/%d/%s/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
