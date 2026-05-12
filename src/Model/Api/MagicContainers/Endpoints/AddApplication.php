<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class AddApplication implements ModelInterface, BodyModelInterface
{
    /**
     * @param string $appId
     * @param string $containerId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
        #[PathProperty]
        public readonly string $containerId,
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
        return 'apps/%s/containers/%s/endpoints';
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
            new AbstractParameter(name: 'displayName', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'cdn', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'isSslEnabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'stickySessions', type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'enabled', type: Type::BOOLEAN_TYPE),
                    new AbstractParameter(name: 'sessionHeaders', type: Type::ARRAY_TYPE, required: true, children: [
                        new AbstractParameter(name: null, type: Type::STRING_TYPE),
                    ]),
                    new AbstractParameter(name: 'cookieName', type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'pullZoneId', type: Type::INT_TYPE),
                new AbstractParameter(name: 'portMappings', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'containerPort', type: Type::INT_TYPE, required: true),
                        new AbstractParameter(name: 'exposedPort', type: Type::INT_TYPE),
                        new AbstractParameter(name: 'protocols', type: Type::ARRAY_TYPE, children: [
                            new AbstractParameter(name: null, type: Type::STRING_TYPE),
                        ]),
                    ]),
                ]),
            ]),
            new AbstractParameter(name: 'anycast', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'type', type: Type::STRING_TYPE, required: true),
                new AbstractParameter(name: 'portMappings', type: Type::ARRAY_TYPE, required: true, children: [
                    new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'containerPort', type: Type::INT_TYPE, required: true),
                        new AbstractParameter(name: 'exposedPort', type: Type::INT_TYPE),
                        new AbstractParameter(name: 'protocols', type: Type::ARRAY_TYPE, children: [
                            new AbstractParameter(name: null, type: Type::STRING_TYPE),
                        ]),
                    ]),
                ]),
            ]),
        ];
    }
}
