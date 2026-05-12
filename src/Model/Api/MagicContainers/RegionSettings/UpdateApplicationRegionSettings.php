<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\RegionSettings;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateApplicationRegionSettings implements ModelInterface, BodyModelInterface
{
    /**
     * @param string $appId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
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
        return 'apps/%s/region-settings';
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
            new AbstractParameter(name: 'allowedRegionIds', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'requiredRegionIds', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'maxAllowedRegions', type: Type::INT_TYPE),
            new AbstractParameter(name: 'nodeSelectors', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
        ];
    }
}
