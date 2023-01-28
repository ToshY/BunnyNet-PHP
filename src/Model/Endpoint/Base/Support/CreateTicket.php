<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Support;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class CreateTicket implements GenericEndpointInterface
{
    public function getMethod(): string
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
            'Subject' => [
                'required' => false,
                'type' => 'string',
            ],
            'LinkedPullZone' => [
                'required' => true,
                'type' => 'int',
            ],
            'Message' => [
                'required' => false,
                'type' => 'string',
            ],
            'LinkedStorageZone' => [
                'required' => true,
                'type' => 'int',
            ],
            'Attachments' => [
                'required' => false,
                'type' => 'array',
                'options' => [
                    'Body' => 'string',
                    'FileName' => 'string',
                    'ContentType' => 'string',
                ],
            ],
        ];
    }
}
