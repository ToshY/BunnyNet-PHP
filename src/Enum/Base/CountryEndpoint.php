<?php

/**
 * Written by ToshY, <18-4-2022>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class CountryEndpoint
 */
final class CountryEndpoint
{
    /** @var array */
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
