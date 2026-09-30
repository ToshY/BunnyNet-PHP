<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\LoadBalancer;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class GetLoadBalancerStatistics implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $loadBalancerId
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly int $loadBalancerId,
        #[QueryProperty]
        public readonly array $query = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'loadbalancer/%d/statistics';
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
            new AbstractParameter(name: 'from', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'to', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'hourly', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'exactRange', type: Type::BOOLEAN_TYPE),
        ];
    }
}
