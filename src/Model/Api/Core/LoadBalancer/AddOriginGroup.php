<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\LoadBalancer;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class AddOriginGroup implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $loadBalancerId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $loadBalancerId,
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
        return 'loadbalancer/%d/origingroup';
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'HealthCheckSettings', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'Path', type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'OriginLoadBalancingMethod', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Latitude', type: Type::NUMERIC_TYPE),
            new AbstractParameter(name: 'Longitude', type: Type::NUMERIC_TYPE),
            new AbstractParameter(name: 'Weight', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Priority', type: Type::INT_TYPE),
        ];
    }
}
