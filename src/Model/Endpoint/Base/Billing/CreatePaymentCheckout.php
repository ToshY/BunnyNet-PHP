<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class CreatePaymentCheckout implements GenericEndpointInterface
{
    public function getMethod(): string
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
                'type' => 'numeric',
            ],
            'PaymentAmount' => [
                'required' => true,
                'type' => 'numeric',
            ],
            'PaymentRequestId' => [
                'required' => false,
                'type' => 'int',
            ],
            'Nonce' => [
                'required' => true,
                'type' => 'string',
            ],
        ];
    }
}
