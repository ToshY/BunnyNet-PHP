<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\User;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateUserDetails implements EndpointInterface
{
    public function getMethod(): Method
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
                'type' => Type::STRING_TYPE->value,
            ],
            'Email' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'BillingEmail' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'LastName' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'StreetAddress' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'City' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ZipCode' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Country' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'CompanyName' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'VATNumber' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ReceiveNotificationEmails' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ReceivePromotionalEmails' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'Password' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'OldPassword' => [
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
