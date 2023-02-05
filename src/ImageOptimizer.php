<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\Optimizer;

/**
 * @link https://support.bunny.net/hc/en-us/articles/360027448392-Bunny-Optimizer-Engine-Documentation
 */
class ImageOptimizer
{
    public function generate(
        string $url,
        array $optimizationCollection = [],
    ): string {
        if (true === empty($optimizationCollection)) {
            return $url;
        }

        $optimizationCollection = $this->validateOptimizationParameters($optimizationCollection);

        $query = http_build_query(
            data: $optimizationCollection,
            arg_separator: '&',
            encoding_type: PHP_QUERY_RFC3986
        );

        return sprintf('%s?%s', $url, $query);
    }

    private function validateOptimizationParameters(array $optimizationCollection): array
    {
        $parameterValueCollection = [];
        foreach ($optimizationCollection as $parameterName => $parameterValue) {
            if (false === in_array($parameterName, Optimizer::OPTIMIZATION_PARAMETER_COLLECTION, true)) {
                continue;
            }

            $parameterValueCollection[$parameterName] = $parameterValue;
        }

        return $parameterValueCollection;
    }
}
