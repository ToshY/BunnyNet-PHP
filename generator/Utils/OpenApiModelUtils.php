<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Utils;

/**
 * Utils for both OpenAPI specs and generated models
 */
final class OpenApiModelUtils
{
    /**
     * Normalize API paths to canonical form to match both from OpenAPI and class getPath().
     * In essential replaces variables to a `:param`.
     */
    public static function normalizePath(string $urlPath, string $replacement = ':param'): string
    {
        $path = trim($urlPath, '/');

        $path = preg_replace('/\{\w+\}/', $replacement, $path);

        return preg_replace('/%[a-z]/i', $replacement, $path);
    }

    /**
     * @param string $value
     * @param array<string> $tags
     * @return string
     */
    public static function stripTagSuffix(string $value, array $tags = ['Public', 'Index', 'Endpoint']): string
    {
        return preg_replace(
            sprintf(
                '/(%s)$/',
                implode('|', $tags),
            ),
            '',
            $value,
        );
    }

    /**
     * @param string[] $tags
     */
    public static function extractNamespaceFromTags(array $tags): ?string
    {
        if (empty($tags) === true) {
            return null;
        }

        // The first tag has priority over other tags in case there are multiple.
        return $tags[0];
    }
}
