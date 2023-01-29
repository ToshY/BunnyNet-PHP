<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateDNSZone implements EndpointInterface
{
    public function getMethod(): Method
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
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'Nameserver1' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Nameserver2' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'SoaEmail' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'LoggingEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'LogAnonymizationType' => [
                'type' => Type::INT_TYPE->value,
            ],
            'LoggingIPAnonymizationEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
        ];
    }
}
