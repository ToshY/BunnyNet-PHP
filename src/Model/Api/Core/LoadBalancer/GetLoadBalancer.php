<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\LoadBalancer;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetLoadBalancer implements ModelInterface
{
    /**
     * @param int $loadBalancerId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $loadBalancerId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'loadbalancer/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
