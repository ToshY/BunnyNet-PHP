<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class UpdateDNSZone implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'dnszone/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    /**
     * LogAnonymizationType:
     * 0 = Remove one octet
     * 1 = Drop IP
     */
    public function getBody(): array
    {
        return [
            'CustomNameserversEnabled' => [
                'type' => 'bool',
            ],
            'Nameserver1' => [
                'type' => 'string',
            ],
            'Nameserver2' => [
                'type' => 'string',
            ],
            'SoaEmail' => [
                'type' => 'string',
            ],
            'LoggingEnabled' => [
                'type' => 'bool',
            ],
            'LogAnonymizationType' => [
                'type' => 'int',
            ],
            'LoggingIPAnonymizationEnabled' => [
                'type' => 'bool',
            ],
        ];
    }
}
