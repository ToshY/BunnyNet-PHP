<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Statistics;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class GetStatistics implements EndpointInterface
{
    public function getMethod(): Method
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
                'type' => Type::STRING_TYPE->value,
            ],
            'dateTo' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'pullZone' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'serverZoneId' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'loadErrors' => [
                'required' => false,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'hourly' => [
                'required' => false,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
        ];
    }
}
