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

/**
 * @note undocumented
 */
class GetLog implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $pullZoneId
     * @param string $date
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly string $date,
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
        return '%s/%d.log';
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
            new AbstractParameter(name: 'start', type: Type::INT_TYPE),
            new AbstractParameter(name: 'end', type: Type::INT_TYPE),
            new AbstractParameter(name: 'order', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'status', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'search', type: Type::STRING_TYPE),
        ];
    }
}
