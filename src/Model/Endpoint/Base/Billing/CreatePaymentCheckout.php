<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class CreatePaymentCheckout implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'billing/payment/checkout';
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
            'RechargeAmount' => [
                'required' => true,
                'type' => Type::NUMERIC_TYPE->value,
            ],
            'PaymentAmount' => [
                'required' => true,
                'type' => Type::NUMERIC_TYPE->value,
            ],
            'PaymentRequestId' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'Nonce' => [
                'required' => true,
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
