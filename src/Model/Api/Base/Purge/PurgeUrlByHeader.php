<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Purge;

use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

/**
 * @note no longer in OpenAPI spec
 */
class PurgeUrlByHeader implements ModelInterface, QueryModelInterface
{
    /**
     * @param array<string,mixed> $query
     */
    public function __construct(
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
        return 'purge';
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
            new AbstractParameter(name: 'url', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'headerName', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'headerValue', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'async', type: Type::BOOLEAN_TYPE),
        ];
    }
}
