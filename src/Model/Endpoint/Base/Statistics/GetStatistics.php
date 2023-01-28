<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Statistics;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class GetStatistics implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'statistics';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            'dateFrom' => [
                'required' => false,
                'type' => 'string',
            ],
            'dateTo' => [
                'required' => false,
                'type' => 'string',
            ],
            'pullZone' => [
                'required' => false,
                'type' => 'int',
            ],
            'serverZoneId' => [
                'required' => false,
                'type' => 'int',
            ],
            'loadErrors' => [
                'required' => false,
                'type' => 'bool',
            ],
            'hourly' => [
                'required' => false,
                'type' => 'bool',
            ],
        ];
    }
}
