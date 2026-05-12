<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class CreateLogForwardingConfiguration implements ModelInterface, BodyModelInterface
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
        return 'log/forwarding';
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
            new AbstractParameter(name: 'app', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'type', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'endpoint', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'port', type: Type::INT_TYPE, required: true),
            new AbstractParameter(name: 'token', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'format', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'enabled', type: Type::BOOLEAN_TYPE, required: true),
        ];
    }
}
