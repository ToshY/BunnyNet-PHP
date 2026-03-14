<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\ApiGuardian;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateApiGuardian implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param int $endpointId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
        #[PathProperty]
        public readonly int $endpointId,
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::PATCH;
    }

    public function getPath(): string
    {
        return 'shield/shield-zone/%d/api-guardian/endpoint/%d';
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
            new AbstractParameter(name: 'enabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'validateRequestBodySchema', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'validateResponseBodySchema', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'validateAuthorization', type: Type::BOOLEAN_TYPE),
        ];
    }
}
