<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\PullZone;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class AddOrUpdateEdgeRule implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $pullZoneId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $pullZoneId,
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
        return 'pullzone/%d/edgerules/addOrUpdate';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'Guid', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ActionType', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ActionParameter1', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ActionParameter2', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ActionParameter3', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Triggers', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Type', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'PatternMatches', type: Type::ARRAY_TYPE, children: [
                        new AbstractParameter(name: null, type: Type::STRING_TYPE),
                    ]),
                    new AbstractParameter(name: 'PatternMatchingType', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'Parameter1', type: Type::STRING_TYPE),
                ]),
            ]),
            new AbstractParameter(name: 'ExtraActions', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'ActionType', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ActionParameter1', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ActionParameter2', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ActionParameter3', type: Type::STRING_TYPE),
                ]),
            ]),
            new AbstractParameter(name: 'TriggerMatchingType', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Description', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'OrderIndex', type: Type::INT_TYPE),
        ];
    }
}
