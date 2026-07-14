<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\EventLogs;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class SearchEventLogs implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
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
        return 'shield/event-logs/%d/search';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'from', type: Type::INT_TYPE),
            new AbstractParameter(name: 'to', type: Type::INT_TYPE),
            new AbstractParameter(name: 'query', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'filters', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'field', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'op', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'value', type: Type::ARRAY_TYPE, children: [
                        new AbstractParameter(name: null, type: Type::STRING_TYPE),
                    ]),
                ]),
            ]),
            new AbstractParameter(name: 'groupBy', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'page', type: Type::INT_TYPE),
            new AbstractParameter(name: 'pageSize', type: Type::INT_TYPE),
        ];
    }
}
