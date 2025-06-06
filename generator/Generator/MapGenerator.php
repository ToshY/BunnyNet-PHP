<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Generator;

use cebe\openapi\exceptions\IOException;
use cebe\openapi\exceptions\TypeErrorException;
use cebe\openapi\exceptions\UnresolvableReferenceException;
use cebe\openapi\json\InvalidJsonPointerSyntaxException;
use cebe\openapi\Reader;
use cebe\openapi\spec\OpenApi;
use cebe\openapi\SpecObjectInterface;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Generator\Utils\ClassUtils;
use ToshY\BunnyNet\Generator\Utils\FileUtils;
use ToshY\BunnyNet\Generator\Utils\OpenApiModelUtils;
use ToshY\BunnyNet\Generator\Utils\PrinterUtils;
use ToshY\BunnyNet\Model\EndpointInterface;

class MapGenerator
{
    private string $apiSpecPath;

    private string $outputDir;

    private string $outputFileName;

    private string $baseApiDir;

    /** @var string[] */
    private array $ignoreEndpoints;

    /**
     * @param string $apiSpecPath
     * @param string $outputDir
     * @param string $outputFileName
     * @param string $baseApiDir
     * @param string[] $ignoreEndpoints
     */
    public function __construct(
        string $apiSpecPath,
        string $outputDir,
        string $outputFileName,
        string $baseApiDir,
        array $ignoreEndpoints,
    ) {
        $this->apiSpecPath = $apiSpecPath;
        $this->outputDir = $outputDir;
        $this->outputFileName = $outputFileName;
        $this->baseApiDir = $baseApiDir;
        $this->ignoreEndpoints = $ignoreEndpoints;

        if (!is_dir($outputDir) && !mkdir($outputDir, 0755, true) && !is_dir($outputDir)) {
            throw new RuntimeException("Failed to create output directory: $outputDir");
        }
    }

    /**
     * @throws IOException
     * @throws TypeErrorException
     * @throws ReflectionException
     * @throws UnresolvableReferenceException
     * @throws InvalidJsonPointerSyntaxException
     */
    public function generate(): void
    {
        $openApi = Reader::readFromJsonFile($this->apiSpecPath);

        $classMap = self::scanExistingModelEndpointClasses($this->baseApiDir);
        $endpointMapping = self::createEndpointToModelClassMapping($openApi, $classMap, $this->ignoreEndpoints);

        $code = self::generateMappingCode(
            $endpointMapping,
            $this->outputFileName,
            $this->outputDir,
        );

        $outputFile = FileUtils::getPhpFilePath([$this->outputDir, $this->outputFileName]);
        FileUtils::saveFile($outputFile, $code);
    }

    /**
     * @throws ReflectionException
     * @return array<string,string>
     * @param string $directory
     */
    private static function scanExistingModelEndpointClasses(string $directory): array
    {
        $map = [];
        $recursiveIteratorIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        foreach ($recursiveIteratorIterator as $file) {
            if ($file->isFile() === false || $file->getExtension() !== FileUtils::PHP_EXTENSION) {
                continue;
            }

            $fqcn = self::filePathToFqcn($file->getPathname());
            if (class_exists($fqcn) === false) {
                continue;
            }

            $reflectionClass = new ReflectionClass($fqcn);
            if (
                $reflectionClass->implementsInterface(EndpointInterface::class) === false
                || $reflectionClass->isInstantiable() === false

            ) {
                continue;
            }

            $newInstance = $reflectionClass->newInstance();
            $path = OpenApiModelUtils::normalizePath($newInstance->getPath());
            $method = $newInstance->getMethod();
            if ($method instanceof Method === false) {
                continue;
            }

            $key = sprintf(
                '%s|%s',
                $path,
                strtolower($method->value),
            );
            $map[$key] = $fqcn;
        }

        return $map;
    }

    /**
     * Convert a full file path to fully qualified class name assuming PSR-4 and base namespace ToshY\BunnyNet\
     */
    private static function filePathToFqcn(string $fullFilepath): string
    {
        $normalizedPath = FileUtils::backslashToForwardSlash($fullFilepath);

        $realPath = match (FileUtils::realPath($normalizedPath)) {
            false => FileUtils::getAbsoluteRealPath($normalizedPath),
            default => FileUtils::backslashToForwardSlash($fullFilepath),
        };

        $psr4 = ClassUtils::getPsr4RootNamespace();
        $sourcePath = '/' . $psr4['path'];

        $relative = FileUtils::getRelativePathWithoutSource($realPath, $sourcePath);
        $relative = FileUtils::removePhpExtension($relative);

        $namespacePath = ClassUtils::forwardSlashToBackwardSlash($relative);

        return sprintf(
            '%s%s',
            $psr4['namespace'],
            $namespacePath,
        );
    }

    /**
     * @param SpecObjectInterface|OpenApi $openApi
     * @param array<string,string> $classMap
     * @param string[] $ignoreEndpoints
     * @return array<string,array<string,class-string|null>>
     */
    private static function createEndpointToModelClassMapping(
        SpecObjectInterface|OpenApi $openApi,
        array $classMap,
        array $ignoreEndpoints = [],
    ): array {
        $mapping = [];
        /* @phpstan-ignore-next-line property.notFound */
        foreach ($openApi->paths->getPaths() as $openApiPath => $pathItem) {
            $normPath = OpenApiModelUtils::normalizePath($openApiPath);

            // Ignore endpoints that are not in the ignoreEndpoints list
            foreach ($ignoreEndpoints as $ignoreEndpoint) {
                if (OpenApiModelUtils::normalizePath($ignoreEndpoint) !== $normPath) {
                    continue;
                }

                continue 2;
            }

            foreach ($pathItem->getOperations() as $httpMethod => $operation) {
                if (in_array(
                    $httpMethod,
                    ['get', 'post', 'put', 'delete', 'patch', 'options', 'head'],
                    true,
                ) === false) {
                    continue;
                }

                $key = "$normPath|$httpMethod";
                $className = $classMap[$key] ?? null;
                $mapping[$openApiPath][$httpMethod] = $className;
            }
        }

        return $mapping;
    }

    /**
     * Generates the PHP mapping class file containing public static array with path => [MethodNameString => class]
     *
     * @param array<string,array<string,class-string|null>> $mapping
     * @param string $outputFileName
     * @param string $outputDirectory
     * @return string
     */
    private static function generateMappingCode(
        array $mapping,
        string $outputFileName,
        string $outputDirectory,
    ): string {
        $file = PrinterUtils::createFile();

        $psr4 = ClassUtils::getPsr4DevRootNamespace('generator/');

        $outputNamespace = ClassUtils::getShortClassName(ClassUtils::forwardSlashToBackwardSlash($outputDirectory));
        $namespace = $file->addNamespace(rtrim($psr4['namespace'], '\\') . '\\' . $outputNamespace);

        $remappedClassnames = self::mapToUsableClassnames($namespace, $mapping);

        $class = $namespace->addClass($outputFileName);
        $class->setFinal();
        $property = $class->addProperty('endpoints')
            ->setType('array')
            ->setStatic()
            ->setVisibility('public')
            ->setComment('@var array<string,array<string,class-string|null>>');

        $arrayCode = self::generateMultilineMapping($remappedClassnames);
        $property->setValue(new Literal($arrayCode));

        return PrinterUtils::printFile($file);
    }

    /**
     * @param array<string,array<string,class-string|null>> $mapping
     * @param PhpNamespace $namespace
     * @return array<string,array<string,class-string|null>>
     */
    private static function mapToUsableClassnames(PhpNamespace $namespace, array $mapping): array
    {
        $processedClassNames = [];
        $remapping = [];
        foreach ($mapping as $path => $map) {
            foreach ($map as $method => $fqcn) {
                if ($fqcn === null) {
                    $remapping[$path][$method] = null;
                    continue;
                }

                $shortClassName = ClassUtils::getShortClassName($fqcn);

                $alias = null;
                $hasAlias = false;
                if (in_array($shortClassName, $processedClassNames, true) === true) {
                    $hasAlias = true;
                    $alias = ClassUtils::getNamespacePart($fqcn) . ClassUtils::getShortClassName($fqcn);
                }

                $newClassName = $hasAlias ? $alias : $shortClassName;
                $namespace->addUse(name: $fqcn, alias: $newClassName);

                $processedClassNames[] = $newClassName;
                $remapping[$path][$method] = $newClassName;
            }
        }

        return $remapping;
    }

    /**
     * @note For explicit multiple lines for each request method
     * @param array<string,array<string,class-string|null>> $mapping
     * @return string
     */
    private static function generateMultilineMapping(array $mapping): string
    {
        $lines = ["["];
        foreach ($mapping as $path => $methodMap) {
            $lines[] = "    '$path' => [";
            foreach ($methodMap as $methodName => $cls) {
                $value = $cls ? ClassUtils::getShortClassName($cls) . '::class' : 'null';
                $lines[] = "        '$methodName' => $value,";
            }
            $lines[] = "    ],";
        }

        $lines[] = "]";

        return implode("\n", $lines);
    }
}
