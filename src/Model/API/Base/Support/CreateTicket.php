<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Base\Support;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;

class CreateTicket implements EndpointInterface, EndpointBodyInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'support/ticket/create';
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
            new AbstractParameter(name: 'Subject', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'LinkedPullZone', type: Type::INT_TYPE),
            new AbstractParameter(name: 'LinkedVideoLibrary', type: Type::INT_TYPE),
            new AbstractParameter(name: 'LinkedDnsZone', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Message', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'LinkedStorageZone', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Attachments', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'Body', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'FileName', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'ContentType', type: Type::STRING_TYPE),
            ]),
        ];
    }
}
