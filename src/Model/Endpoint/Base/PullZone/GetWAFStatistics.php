<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

/**
 * Undocumented
 */
class GetWAFStatistics implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/waf/statistics';
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
            'hourly' => [
                'required' => false,
                'type' => 'bool',
            ],
        ];
    }
}
