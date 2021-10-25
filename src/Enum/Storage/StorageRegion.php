<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Storage;

use ToshY\BunnyNet\Enum\Host;

/**
 * Class StorageRegion
 */
final class StorageRegion
{
    /** @var array[] */
    public const LOCATION = [
        'FS' => [
            'city' => 'Falkenstein',
            'url' => Host::STORAGE_ENDPOINT,
            'cost' => 0.01,
        ],
        'NY' => [
            'city' => 'New York',
            'url' => 'ny' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.02,
        ],
        'LA' => [
            'city' => 'Los Angeles',
            'url' => 'la' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.02,
        ],
        'SG' => [
            'city' => 'Singapore',
            'url' => 'sg' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.03,
        ],
        'SYD' => [
            'city' => 'Sydney',
            'url' => 'syd' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.03,
        ],
    ];
}
