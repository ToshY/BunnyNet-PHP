<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Log;

use ToshY\BunnyNet\Enum\Header;

final class LogEndpoint
{
    /** @var array */
    public const GET_LOGGING = [
        'method' => 'GET',
        'path' => '%s/%d.log',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'start' => [
                'required' => false,
                'type' => 'int',
            ],
            'end' => [
                'required' => false,
                'type' => 'int',
            ],
            'order' => [
                'required' => false,
                'type' => 'string',
            ],
            'status' => [
                'required' => false,
                'type' => 'array',
                'options' => [
                    'type' => 'int',
                ],
            ],
            'search' => [
                'required' => false,
                'type' => 'string',
            ]
        ],
        'body' => [],
    ];
}
