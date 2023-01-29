<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Support;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class CreateTicket implements EndpointInterface
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
            'Subject' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'LinkedPullZone' => [
                'required' => true,
                'type' => Type::INT_TYPE->value,
            ],
            'Message' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
            ],
            'LinkedStorageZone' => [
                'required' => true,
                'type' => Type::INT_TYPE->value,
            ],
            'Attachments' => [
                'required' => false,
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'Body' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                    'FileName' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                    'Contenttype' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                ],
            ],
        ];
    }
}
