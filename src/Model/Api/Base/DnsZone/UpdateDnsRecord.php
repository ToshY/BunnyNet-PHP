<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\DnsZone;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateDnsRecord implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $zoneId
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $zoneId,
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
        return 'dnszone/%d/records/%d';
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
            new AbstractParameter(name: 'Type', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Ttl', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Value', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Weight', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Priority', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Flags', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Tag', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Port', type: Type::INT_TYPE),
            new AbstractParameter(name: 'PullZoneId', type: Type::INT_TYPE),
            new AbstractParameter(name: 'ScriptId', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Accelerated', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'MonitorType', type: Type::INT_TYPE),
            new AbstractParameter(name: 'GeolocationLatitude', type: Type::NUMERIC_TYPE),
            new AbstractParameter(name: 'GeolocationLongitude', type: Type::NUMERIC_TYPE),
            new AbstractParameter(name: 'LatencyZone', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'SmartRoutingType', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Disabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnviromentalVariables', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'Value', type: Type::STRING_TYPE),
                ]),
            ]),
            new AbstractParameter(name: 'Comment', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'AutoSslIssuance', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'Id', type: Type::INT_TYPE, required: true),
        ];
    }
}
