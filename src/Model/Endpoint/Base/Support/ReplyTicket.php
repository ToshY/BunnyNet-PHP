<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Support;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class ReplyTicket implements GenericEndpointInterface
{
    public function getMethod(): string
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
                'type' => 'string',
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
