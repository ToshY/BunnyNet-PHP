<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Logging;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class GetLogV2 implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $pullZoneId
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly int $pullZoneId,
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
        return 'v2/pullzones/%d/logs';
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
            new AbstractParameter(name: 'status', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'cacheStatus', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'country', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'edgeLocation', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'remoteIp', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'urlContains', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'userAgentContains', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'refererContains', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'search', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'includeOriginShield', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'limit', type: Type::INT_TYPE),
            new AbstractParameter(name: 'offset', type: Type::INT_TYPE),
            new AbstractParameter(name: 'order', type: Type::STRING_TYPE),
        ];
    }
}
