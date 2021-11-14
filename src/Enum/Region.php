<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

/**
 * Class StorageRegion
 */
final class Region
{
    /** @var array[] Storage plan for each location in $/GB */
    public const STORAGE_STANDARD = [
        'FS' => [
            'location' => 'Falkenstein',
            'url' => Host::STORAGE_ENDPOINT,
            'cost' => 0.01,
        ],
        'NY' => [
            'location' => 'New York',
            'url' => 'ny' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.02,
        ],
        'LA' => [
            'location' => 'Los Angeles',
            'url' => 'la' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.02,
        ],
        'SG' => [
            'location' => 'Singapore',
            'url' => 'sg' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.03,
        ],
        'SYD' => [
            'location' => 'Sydney',
            'url' => 'syd' . '.' . Host::STORAGE_ENDPOINT,
            'cost' => 0.03,
        ],
    ];

    /** @var float[] Standard plan for each location in $/GB */
    public const CDN_STANDARD = [
        'EUROPE_NORTH_AMERICA' => [
            'location' => 'Europe & North America',
            'cost' => 0.01,
        ],
        'ASIA_OCEANIA' => [
            'location' => 'Asia & Oceania',
            'cost' => 0.03,
        ],
        'SOUTH_AMERICA' => [
            'location' => 'South America',
            'cost' => 0.045,
        ],
        'MIDDLE_EAST_AFRICA' => [
            'location' => 'Middle East & Africa',
            'cost' => 0.06,
        ],
    ];

    /** @var float[] Volume plan for each TB tier in $/GB */
    public const CDN_VOLUME = [
        'TIER_01' => [
            'location' => 'Tier 1',
            'cost' => 0.005,
            'storage' => [
                'min' => 0,
                'max' => 500,
                'unit' => 'TB',
            ]
        ],
        'TIER_02' => [
            'location' => 'Tier 2',
            'cost' => 0.004,
            'storage' => [
                'min' => 500,
                'max' => 1000,
                'unit' => 'TB',
            ]
        ],
        'TIER_03' => [
            'location' => 'Tier 3',
            'cost' => 0.002,
            'storage' => [
                'min' => 1000,
                'max' => 2000,
                'unit' => 'TB',
            ]
        ],
    ];
}
