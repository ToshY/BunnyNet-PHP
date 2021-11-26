<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\Optimizer;

/**
 * Class ImageOptimizer
 * @link https://support.bunny.net/hc/en-us/articles/360027448392-Bunny-Optimizer-Engine-Documentation
 */
final class ImageOptimizer
{
    /**
     * @param string $url
     * @param array $optimizationCollection
     * @return string
     */
    public function generate(string $url, array $optimizationCollection = []): string
    {
        if (empty($optimizationCollection) === true) {
            return $url;
        }

        $optimizationCollection = $this->validateOptimizationParameters($optimizationCollection);

        $query = http_build_query($optimizationCollection, '', '&', PHP_QUERY_RFC3986);

        return sprintf('%s?%s', $url, $query);
    }

    /**
     * @param array $optimalisationCollection
     * @return array
     */
    private function validateOptimizationParameters(array $optimalisationCollection): array
    {
        $parameterValueCollection = [];
        foreach ($optimalisationCollection as $parameterName => $parameterValue) {
            if (in_array($parameterName, Optimizer::OPTIMIZATION_PARAMETER_COLLECTION, true) === true) {
                $parameterValueCollection[$parameterName] = $parameterValue;
            }
        }

        return $parameterValueCollection;
    }
}
