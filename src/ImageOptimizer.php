<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\Optimizer;

/**
 * On the fly image manipulation and optimization.
 *
 * ```php
 * <?php
 *
 * require 'vendor/autoload.php';
 *
 * use ToshY\BunnyNet\ImageOptimizer;
 *
 * $bunnyImageOptimizer = new ImageOptimizer();
 *
 * $bunnyImageOptimizer->generate(
 *     'https://myzone.b-cdn.net/bunny.jpg',
 *     [
 *         'width' => 200,
 *         'height' => 300,
 *         'aspect_ratio' => '16:9',
 *         'quality' => 85,
 *         'sharpen' => false,
 *         'blur' => 0,
 *         'crop' => '50,50',
 *         'crop_gravity' => 'center',
 *         'flip' => false,
 *         'flop' => false,
 *         'brightness' => 0,
 *         'saturation' => 0,
 *         'hue' => 0,
 *         'contrast' => 0,
 *         'sepia' => 0,
 *         'auto_optimize' => 'medium',
 *         'class' => 'my-custom-class',
 *     ]
 * );
 * ```
 *
 * @link https://docs.bunny.net/docs/stream-image-processing
 * @link https://support.bunny.net/hc/en-us/articles/360027448392-Bunny-Optimizer-Engine-Documentation
 */
class ImageOptimizer
{
    /**
     * @param string $url
     * @param array<string,mixed> $optimizationCollection
     * @return string
     */
    public function generate(
        string $url,
        array $optimizationCollection = [],
    ): string {
        if (true === empty($optimizationCollection)) {
            return $url;
        }

        $query = http_build_query(
            data: $optimizationCollection,
            arg_separator: '&',
            encoding_type: PHP_QUERY_RFC3986
        );

        return sprintf('%s?%s', $url, $query);
    }
}
