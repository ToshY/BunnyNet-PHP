<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Utils;

use ReflectionClass;
use ReflectionException;
use RuntimeException;

final class ClassUtils
{
    /**
     * @throws ReflectionException
     * @return array<mixed>
     * @param string $class
     */
    public static function getOriginalClassNameAndNamespace(string $class): array
    {
        $reflectionClass = new ReflectionClass($class);
        $className = $reflectionClass->getShortName();
        $originalNamespace = $reflectionClass->getNamespaceName();

        return [$className, $originalNamespace];
    }

    /**
     * Extracts short class name from fully qualified class name
     */
    public static function getShortClassName(string $fqcn): string
    {
        $parts = explode('\\', $fqcn);

        return end($parts);
    }


    /**
     * @throws ReflectionException
     */
    public static function getShortClassNameReflection(string $class): string
    {
        return (new ReflectionClass($class))->getShortName();
    }

    /**
     * Returns the previous part of the namespace. Used for aliases.
     */
    public static function getNamespacePart(string $fqcn, int $previousPart = 1): string
    {
        $parts = explode('\\', $fqcn);

        return $parts[count($parts) - $previousPart - 1];
    }

    /**
     * @return array{namespace:string,path:string}
     */
    public static function getPsr4RootNamespace(): array
    {
        $filePath = __DIR__ . '/../../composer.json';
        $composer = FileUtils::getFileJsonDecoded($filePath);

        $psr4 = $composer['autoload']['psr-4'] ?? [];

        return [
            'namespace' => key($psr4),
            'path' => current($psr4),
        ];
    }

    /**
     * @return array{namespace:string,path:string}
     */
    public static function getPsr4DevRootNamespace(string $search): array
    {
        $filePath = __DIR__ . '/../../composer.json';
        $composer = FileUtils::getFileJsonDecoded($filePath);

        $psr4 = $composer['autoload-dev']['psr-4'] ?? [];

        foreach ($psr4 as $namespace => $path) {
            if ($path !== $search) {
                continue;
            }

            return [
                'namespace' => $namespace,
                'path' => $path,
            ];
        }

        throw new RuntimeException(
            sprintf(
                'Could not find path for namespace `%s`.',
                $search,
            ),
        );
    }

    public static function forwardSlashToBackwardSlash(string $path): string
    {
        return str_replace('/', '\\', $path);
    }
}
