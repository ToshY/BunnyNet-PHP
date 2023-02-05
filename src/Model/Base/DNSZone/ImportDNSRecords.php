<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\DNSZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\EndpointInterface;

/**
 * TODO: keep in mind needs body content for file import!
 */
class ImportDNSRecords implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'dnszone/%d/import';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
