<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;

class DeleteCertificate implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/removeCertificate';
    }

    /**
     * @return array<array<string,string>>
     */
    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    /**
     * @return array<AbstractParameter>
     */
    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'Hostname', type: Type::STRING_TYPE, required: true),
        ];
    }
}
