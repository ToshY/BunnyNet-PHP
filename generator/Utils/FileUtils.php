<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Utils;

final class FileUtils
{
    public const PHP_EXTENSION = 'php';

    /**
     * Normalizes path segments manually if realpath() fails (e.g. file not present yet)
     * Removes '.' and properly resolves '..'
     */
    public static function getAbsoluteRealPath(string $path): string
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        $parts = [];
        $segments = explode(DIRECTORY_SEPARATOR, $path);

        foreach ($segments as $segment) {
            if ($segment === '' || $segment === '.') {
                continue;
            }
            if ($segment === '..') {
                array_pop($parts);
                continue;
            }
            $parts[] = $segment;
        }

        // If path was absolute, make sure it starts with a slash
        $isAbsolute = strlen($path) > 0 && $path[0] === DIRECTORY_SEPARATOR;

        return ($isAbsolute ? DIRECTORY_SEPARATOR : '') . implode(DIRECTORY_SEPARATOR, $parts);
    }

    public static function getOutputDirectoryFromNamespace(
        string $baseNameSpace,
        string $newNamespace,
        string $outputDirectory,
    ): string {
        // Remove the base namespace prefix
        $relativeNamespace = preg_replace('/^' . preg_quote($baseNameSpace, '/') . '\\\\/', '', $newNamespace);

        // Convert namespace separators to directory separators
        $relativePath = FileUtils::backslashToForwardSlash($relativeNamespace);

        // Check for duplicated segments
        $segments = explode('/', $relativePath);
        $deduplicatedSegments = [];
        $lastSegment = null;

        foreach ($segments as $segment) {
            if ($segment !== $lastSegment) {
                $deduplicatedSegments[] = $segment;
                $lastSegment = $segment;
            }
        }

        $finalPath = implode('/', $deduplicatedSegments);

        return rtrim($outputDirectory, '/') . '/' . $finalPath;
    }

    public static function backslashToForwardSlash(string $path): string
    {
        return str_replace('\\', '/', $path);
    }

    public static function getRelativePathWithoutSource(string $path, string $source): string
    {
        $sourcePosition = strpos($path, $source);

        return substr($path, $sourcePosition + strlen($source));
    }

    public static function removePhpExtension(string $path): string
    {
        return substr($path, 0, -4);
    }

    /**
     * @param array<string> $items
     * @return string
     */
    public static function getPhpFilePath(array $items): string
    {
        return implode(DIRECTORY_SEPARATOR, $items) . '.' . self::PHP_EXTENSION;
    }

    public static function realPath(string $path): bool|string
    {
        return realpath($path);
    }

    public static function getFile(string $filename): false|string
    {
        return file_get_contents($filename);
    }

    /**
     * @param string $json
     * @return array<mixed>
     */
    public static function jsonDecode(string $json): array
    {
        return json_decode($json, true);
    }

    /**
     * @param string $filename
     * @return array<mixed>
     */
    public static function getFileJsonDecoded(string $filename): array
    {
        $content = self::getFile($filename);

        return self::jsonDecode($content);
    }

    public static function saveFile(string $filename, mixed $data): void
    {
        file_put_contents($filename, $data);
    }

    public static function createDirectory(string $directory): void
    {
        if (is_dir($directory) === true) {
            return;
        }

        mkdir($directory, 0755, true);
    }
}
