<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\OriginErrors;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetOriginErrorLogs implements ModelInterface
{
    /**
     * @param int $pullZoneId
     * @param string $dateTime
     */
    public function __construct(
        #[PathProperty]
        public readonly int $pullZoneId,
        #[PathProperty]
        public readonly string $dateTime,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return '%d/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
