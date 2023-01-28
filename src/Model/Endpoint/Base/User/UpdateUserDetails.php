<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\User;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class UpdateUserDetails implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'user';
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
            'FirstName' => [
                'type' => 'string',
            ],
            'Email' => [
                'type' => 'string',
            ],
            'BillingEmail' => [
                'type' => 'string',
            ],
            'LastName' => [
                'type' => 'string',
            ],
            'StreetAddress' => [
                'type' => 'string',
            ],
            'City' => [
                'type' => 'string',
            ],
            'ZipCode' => [
                'type' => 'string',
            ],
            'Country' => [
                'type' => 'string',
            ],
            'CompanyName' => [
                'type' => 'string',
            ],
            'VATNumber' => [
                'type' => 'string',
            ],
            'ReceiveNotificationEmails' => [
                'type' => 'bool',
            ],
            'ReceivePromotionalEmails' => [
                'type' => 'bool',
            ],
            'Password' => [
                'type' => 'string',
            ],
            'OldPassword' => [
                'type' => 'string',
            ],
        ];
    }
}
