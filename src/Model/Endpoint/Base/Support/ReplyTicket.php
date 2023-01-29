<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Support;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class ReplyTicket implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'support/ticket/%d/reply';
    }

    public function getHeaders(): array
    {
        return [
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            'Message' => [
                'required' => false,
                'type' => Type::STRING_TYPE->value,
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
