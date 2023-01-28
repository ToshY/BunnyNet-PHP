<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class UpdateDNSRecord implements GenericEndpointInterface
{
    public function getMethod(): string
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
                'type' => 'int',
            ],
            'Ttl' => [
                'required' => false,
                'type' => 'int',
            ],
            'Value' => [
                'required' => false,
                'type' => 'string',
            ],
            'Name' => [
                'required' => false,
                'type' => 'string',
            ],
            'Flags' => [
                'required' => false,
                'type' => 'int',
            ],
            'Tag' => [
                'required' => false,
                'type' => 'string',
            ],
            'Port' => [
                'required' => false,
                'type' => 'int',
            ],
            'PullZoneId' => [
                'required' => false,
                'type' => 'int',
            ],
            'ScriptId' => [
                'required' => false,
                'type' => 'int',
            ],
            'Accelerated' => [
                'required' => false,
                'type' => 'bool',
            ],
            'MonitorType' => [
                'required' => false,
                'type' => 'int',
            ],
            'GeolocationLatitude' => [
                'required' => false,
                'type' => 'numeric',
            ],
            'GeolocationLongitude' => [
                'required' => false,
                'type' => 'numeric',
            ],
            'LatencyZone' => [
                'required' => false,
                'type' => 'string',
            ],
            'SmartRoutingType' => [
                'required' => false,
                'type' => 'int',
            ],
            'Disabled' => [
                'required' => false,
                'type' => 'bool',
            ],
            'EnviromentalVariables' => [
                'required' => false,
                'type' => 'array',
                'options' => [
                    'Name' => 'string',
                    'Value' => 'string',
                ],
            ],
        ];
    }
}
