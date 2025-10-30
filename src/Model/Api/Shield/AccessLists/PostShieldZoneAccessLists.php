<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\AccessLists;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class PostShieldZoneAccessLists implements ModelInterface, BodyModelInterface
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
        return 'shield/shield-zone/%d/access-lists';
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
            new AbstractParameter(name: 'name', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'description', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'type', type: Type::INT_TYPE, required: true),
            new AbstractParameter(name: 'content', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'checksum', type: Type::STRING_TYPE),
        ];
    }
}
