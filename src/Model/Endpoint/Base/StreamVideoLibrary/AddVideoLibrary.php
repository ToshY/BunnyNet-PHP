<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class AddVideoLibrary implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'videolibrary/%d';
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
            'Name' => [
                'required' => true,
                'type' => 'string',
            ],
            'ReplicationRegions' => [
                'type' => 'array',
                'options' => [
                    'type' => 'string',
                ],
            ],
        ];
    }
}
