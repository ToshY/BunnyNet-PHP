<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

final class CountryEndpoint
{
    public const GET_COUNTRY_LIST = [
        'method' => 'GET',
        'path' => 'country',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];
}
