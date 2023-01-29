<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class GetTheCoinifyBtcExchangeRate implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'billing/coinify/exchangerate';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
