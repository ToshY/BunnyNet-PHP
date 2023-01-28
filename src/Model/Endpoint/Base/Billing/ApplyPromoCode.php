<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class ApplyPromoCode implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'billing/applycode';
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
            'CouponCode' => [
                'required' => true,
                'type' => 'string',
            ],
        ];
    }
}
