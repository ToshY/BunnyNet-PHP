<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class ConfigureAutoRecharge implements EndpointInterface
{
    public function getMethod(): Method
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
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'PaymentMethodToken' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'PaymentAmount' => [
                'required' => false,
                'type' => Type::NUMERIC_TYPE->value,
            ],
            'RechargeTreshold' => [
                'required' => false,
                'type' => Type::NUMERIC_TYPE->value,
            ],
        ];
    }
}
