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
 * ```
 *
 * @link https://docs.bunny.net/docs/stream-image-processing
 * @link https://support.bunny.net/hc/en-us/articles/360027448392-Bunny-Optimizer-Engine-Documentation
 */
class ImageOptimizer
{
    /**
     * Generate URL with optimization parameters.
     *
     * ```php
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
     * ---
     * Notes:
     * - The `quality` argument determines the compression level of the resulting image with 0 being the lowest level of
     * compression and 100 being the highest. Higher compression means smaller files, but might visually degrade the image
     * (e.g. JPEG compression under 70 tends to produce visible artefacts). The `quality` argument is ignored if the requested
     * output image format is lossless (e.g. PNG).
     * - The `crop` argument crops the output image to the given width and height. Two formats are accepted. Format 1 one only
     * includes the width and height of the crop: `width,height`. Format 2 also includes the X and Y position of where the crop
     * should start: `width,height,x,y`. Image resizing with the width and height parameters is processed after the crop and
     * the resized measurements. If only width and height are given, the `Crop Gravity` parameter will be used.
     * ---
     *
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
