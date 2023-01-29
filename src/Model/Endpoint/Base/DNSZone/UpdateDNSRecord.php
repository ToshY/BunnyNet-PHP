<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateDNSRecord implements EndpointInterface
{
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
            'Type' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'Ttl' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'Value' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'Name' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'Flags' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'Tag' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'Port' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'PullZoneId' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'ScriptId' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'Accelerated' => [
                'required' => false,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'MonitorType' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'GeolocationLatitude' => [
                'required' => false,
                'type' => Type::NUMERIC_TYPE->value,
            ],
            'GeolocationLongitude' => [
                'required' => false,
                'type' => Type::NUMERIC_TYPE->value,
            ],
            'LatencyZone' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'SmartRoutingType' => [
                'required' => false,
                'type' => Type::INT_TYPE->value,
            ],
            'Disabled' => [
                'required' => false,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnviromentalVariables' => [
                'required' => false,
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'Name' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                    'Value' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                ],
            ],
        ];
    }
}
