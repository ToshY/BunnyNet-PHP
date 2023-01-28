<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class PreparePaymentAuthorization implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'billing/payment/prepare-authorization';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
