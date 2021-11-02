<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\CDN;

/**
 * Class Pricing
 */
final class Pricing
{
    /** @var float[] Standard plan for each location in $/GB */
    public const STANDARD_PER_GB = [
        'EUROPE_NORTH_AMERICA' => 0.01,
        'ASIA_OCEANIA' => 0.03,
        'SOUTH_AMERICA' => 0.045,
        'MIDDLE_EAST_AFRICA' => 0.06,
    ];

    /** @var float[] Volume plan for each tier in $/TB */
    public const VOLUME_PER_TB = [
        '0-500' => 0.005,
        '500-1000' => 0.004,
        '1000-2000' => 0.002,
    ];
}
