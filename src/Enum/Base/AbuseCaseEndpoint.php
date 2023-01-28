<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

final class AbuseCaseEndpoint
{
    public const LIST_ABUSE_CASES = [
        'method' => 'GET',
        'path' => 'abusecase',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'page' => [
                'required' => false,
                'type' => 'int',
            ],
            'perPage' => [
                'required' => false,
                'type' => 'int',
            ],
        ],
        'body' => [],
    ];

    public const CHECK_ABUSE_CASE = [
        'method' => 'POST',
        'path' => 'abusecase/%d/check',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];
}
