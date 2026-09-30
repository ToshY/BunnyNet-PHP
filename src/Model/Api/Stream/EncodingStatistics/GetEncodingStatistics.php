<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\EncodingStatistics;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class GetEncodingStatistics implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $libraryId
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
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
        return 'library/%d/statistics/encoding';
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
            new AbstractParameter(name: 'dateFrom', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'dateTo', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'hourly', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'videoCodecs', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'resolutions', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::INT_TYPE),
            ]),
            new AbstractParameter(name: 'jit', type: Type::BOOLEAN_TYPE),
        ];
    }
}
