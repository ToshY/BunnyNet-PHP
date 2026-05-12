<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateContainerRegistry implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $registryId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $registryId,
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'registries/%d';
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
            new AbstractParameter(name: 'type', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'passwordCredentials', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'userName', type: Type::STRING_TYPE, required: true),
                new AbstractParameter(name: 'password', type: Type::STRING_TYPE, required: true),
            ]),
        ];
    }
}
