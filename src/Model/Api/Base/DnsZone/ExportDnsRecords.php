<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\DnsZone;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class ExportDnsRecords implements ModelInterface
{
    /**
     * @param int $id
     */
    public function __construct(
        #[PathProperty]
        public readonly int $id,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'dnszone/%d/export';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
