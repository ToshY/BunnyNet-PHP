<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;

class AddDNSRecord implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'dnszone/%d/records';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    /**
     * Type:
     * 0 = A
     * 1 = AAAA
     * 2 = CNAME
     * 3 = TXT
     * 4 = MX
     * 5 = RDR (Redirect)
     * 6 = -
     * 7 = PZ (Pull Zone)
     * 8 = SRV
     * 9 = CAA
     * 10 = PTR
     * 11 = SCR (Script)
     * 12 = NS
     *
     * TTL: in seconds gets rounded to the nearest possible value in UI.
     * - 15 seconds
     * - 30 seconds
     * - 1 minute
     * - 2 minutes
     * - 5 minutes
     * - 15 minutes
     * - 30 minutes
     * - 1 hour
     * - 5 hours
     * - 12 hours
     * - 1 day
     */
    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'Type', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Ttl', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Value', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
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
                new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'Value', type: Type::STRING_TYPE),
            ]),
        ];
    }
}
