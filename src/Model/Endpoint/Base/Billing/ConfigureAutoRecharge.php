<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class ConfigureAutoRecharge implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'billing/payment/autorecharge';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            'AutoRechargeEnabled' => [
                'required' => true,
                'type' => 'bool',
            ],
            'PaymentMethodToken' => [
                'required' => false,
                'type' => 'string',
            ],
            'PaymentAmount' => [
                'required' => false,
                'type' => 'numeric',
            ],
            'RechargeTreshold' => [
                'required' => false,
                'type' => 'numeric',
            ],
        ];
    }
}
