<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeScripting\Variable;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class AddVariable implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $id,
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
        return 'compute/script/%d/variables/add';
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'Required', type: Type::BOOLEAN_TYPE, required: true),
            new AbstractParameter(name: 'DefaultValue', type: Type::STRING_TYPE),
        ];
    }
}
