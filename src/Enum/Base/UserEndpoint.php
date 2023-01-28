<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

final class UserEndpoint
{
    public const GET_USER_DETAILS = [
        'method' => 'GET',
        'path' => 'user',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    public const UPDATE_USER_DETAILS = [
        'method' => 'POST',
        'path' => 'user',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'FirstName' => [
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
        ],
    ];

    public const RESET_API_KEY = [
        'method' => 'POST',
        'path' => 'user/resetApiKey',
        'headers' => [],
        'query' => [],
        'body' => [],
    ];

    public const CLOSE_ACCOUNT = [
        'method' => 'POST',
        'path' => 'user/closeaccount',
        'headers' => [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ],
        'query' => [],
        'body' => [
            'Password' => [
                'type' => 'string',
            ],
            'Reason' => [
                'type' => 'string',
            ],
        ],
    ];

    public const GET_DPA_DETAILS = [
        'method' => 'GET',
        'path' => 'user/dpa',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];
}
