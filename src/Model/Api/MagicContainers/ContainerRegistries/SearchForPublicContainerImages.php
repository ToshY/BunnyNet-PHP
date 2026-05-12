<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class SearchForPublicContainerImages implements ModelInterface, BodyModelInterface
{
    /**
     * @param array<string,mixed> $body
     */
    public function __construct(
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
        return 'registries/public-images/search';
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
            new AbstractParameter(name: 'registryId', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'prefix', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'size', type: Type::INT_TYPE),
            new AbstractParameter(name: 'page', type: Type::INT_TYPE),
        ];
    }
}
