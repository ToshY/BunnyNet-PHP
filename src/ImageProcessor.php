<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

class ImageProcessor
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
