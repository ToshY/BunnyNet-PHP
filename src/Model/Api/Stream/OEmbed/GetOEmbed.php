<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\OEmbed;

use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class GetOEmbed implements ModelInterface, QueryModelInterface
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
        return 'OEmbed';
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
            new AbstractParameter(name: 'url', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'maxWidth', type: Type::INT_TYPE),
            new AbstractParameter(name: 'maxHeight', type: Type::INT_TYPE),
            new AbstractParameter(name: 'token', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'expires', type: Type::INT_TYPE),
        ];
    }
}
