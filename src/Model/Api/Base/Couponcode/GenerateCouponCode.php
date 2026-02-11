<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Couponcode;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class GenerateCouponCode implements ModelInterface, BodyModelInterface
{
    /**
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'coupon-codes/generate';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_OCTET_STREAM,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'CouponCodeFormat', type: Type::OBJECT_TYPE, required: true, children: [
                new AbstractParameter(name: 'Prefix', type: Type::STRING_TYPE, required: true),
                new AbstractParameter(name: 'RandomPartLength', type: Type::INT_TYPE),
            ]),
            new AbstractParameter(name: 'CreditAmount', type: Type::NUMERIC_TYPE, required: true),
            new AbstractParameter(name: 'ExpiryDate', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'MaxUses', type: Type::INT_TYPE),
            new AbstractParameter(name: 'IsTimeLimited', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'TimeLimitedDays', type: Type::INT_TYPE),
        ];
    }
}
