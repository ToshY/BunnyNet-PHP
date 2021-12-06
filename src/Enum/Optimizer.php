<?php

/**
 * Written by ToshY, <26-11-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

/**
 * Class Optimizer
 */
final class Optimizer
{
    /** @var string[] Optimizer parameters */
    public const OPTIMIZATION_PARAMETER_COLLECTION = [
        'width',
        'height',
        'aspect_ratio',
        'quality',
        'sharpen',
        'blur',
        'crop',
        'crop_gravity',
        'flip',
        'flop',
        'brightness',
        'saturation',
        'hue',
        'contrast',
        'sepia',
        'auto_optimize',
        'class',
    ];
}
