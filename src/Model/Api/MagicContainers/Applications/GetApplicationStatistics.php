<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Applications;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class GetApplicationStatistics implements ModelInterface, QueryModelInterface
{
    /**
     * @param string $appId
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
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
        return 'apps/%s/statistics';
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
            new AbstractParameter(name: 'fromDate', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'toDate', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'granularity', type: Type::STRING_TYPE, required: true),
        ];
    }
}
