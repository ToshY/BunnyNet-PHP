<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\Metrics;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class GetMetricsOverviewDetailed implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
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
        return 'shield/metrics/overview/%d/detailed';
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
            new AbstractParameter(name: 'StartDate', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'EndDate', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Resolution', type: Type::INT_TYPE),
        ];
    }
}
