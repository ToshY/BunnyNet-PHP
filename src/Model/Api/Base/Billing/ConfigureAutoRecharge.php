<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Billing;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class ConfigureAutoRecharge implements ModelInterface, BodyModelInterface
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
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'AutoRechargeEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'PaymentMethodToken', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'PaymentAmount', type: Type::NUMERIC_TYPE),
            new AbstractParameter(name: 'RechargeTreshold', type: Type::NUMERIC_TYPE),
        ];
    }
}
