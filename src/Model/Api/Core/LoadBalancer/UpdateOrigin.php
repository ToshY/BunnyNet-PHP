<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\LoadBalancer;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateOrigin implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $loadBalancerId
     * @param int $originGroupId
     * @param int $originId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $loadBalancerId,
        #[PathProperty]
        public readonly int $originGroupId,
        #[PathProperty]
        public readonly int $originId,
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
        return 'loadbalancer/%d/origingroup/%d/origin/%d';
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Weight', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'OriginType', type: Type::INT_TYPE),
            new AbstractParameter(name: 'EdgeScriptId', type: Type::INT_TYPE),
            new AbstractParameter(name: 'StorageZoneId', type: Type::INT_TYPE),
            new AbstractParameter(name: 'StandardOrigin', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'OriginUrl', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'HostHeader', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'VerifySsl', type: Type::BOOLEAN_TYPE),
            ]),
            new AbstractParameter(name: 'MagicContainersOrigin', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'AppId', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'EndPointId', type: Type::STRING_TYPE),
            ]),
        ];
    }
}
