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
use Nette\InvalidStateException;
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
use ToshY\BunnyNet\Model\ModelInterface;

class MapGenerator
{
    private string $apiSpecPath;

    private string $outputDir;

    private string $outputFileName;

    private string $baseApiDir;

    /** @var string[] */
    private array $ignoreEndpoints;

    /** @var array<string,array<string,class-string>> */
    private array $keepUndocumentedEndpoints;

    /**
     * @param string $apiSpecPath
     * @param string $outputDir
     * @param string $outputFileName
     * @param string $baseApiDir
     * @param string[] $ignoreEndpoints
     * @param array<string,array<string,class-string>> $keepUndocumentedEndpoints
     */
    public function __construct(
        string $apiSpecPath,
        string $outputDir,
        string $outputFileName,
        string $baseApiDir,
        array $ignoreEndpoints,
        array $keepUndocumentedEndpoints = [],
    ) {
        $this->apiSpecPath = $apiSpecPath;
        $this->outputDir = $outputDir;
        $this->outputFileName = $outputFileName;
        $this->baseApiDir = $baseApiDir;
        $this->ignoreEndpoints = $ignoreEndpoints;
        $this->keepUndocumentedEndpoints = $keepUndocumentedEndpoints;

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
        $endpointMapping = self::createEndpointToModelClassMapping(
            $openApi,
            $classMap,
            $this->ignoreEndpoints,
            $this->keepUndocumentedEndpoints,
        );

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

        try {
            $directoryIterator = new RecursiveDirectoryIterator($directory);
        } catch (\UnexpectedValueException) {
            mkdir($directory, 0755, true);
            $directoryIterator = new RecursiveDirectoryIterator($directory);
        }

        $recursiveIteratorIterator = new RecursiveIteratorIterator($directoryIterator);
        foreach ($recursiveIteratorIterator as $file) {
            if ($file->isFile() === false || $file->getExtension() !== FileUtils::PHP_EXTENSION) {
                continue;
            }

            $fqcn = FileUtils::filePathToFqcn($file->getPathname());
            if (class_exists($fqcn) === false) {
                continue;
            }

            $reflectionClass = new ReflectionClass($fqcn);
            if (
                $reflectionClass->implementsInterface(ModelInterface::class) === false
                || $reflectionClass->isInstantiable() === false

            ) {
                continue;
            }

            $newInstance = $reflectionClass->newInstanceWithoutConstructor();
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
     * @param SpecObjectInterface|OpenApi $openApi
     * @param array<string,string> $classMap
     * @param string[] $ignoreEndpoints
     * @param array<string,array<string,class-string>> $keepUndocumentedEndpoints
     * @return array<string,array<string,class-string|null>>
     */
    private static function createEndpointToModelClassMapping(
        SpecObjectInterface|OpenApi $openApi,
        array $classMap,
        array $ignoreEndpoints = [],
        array $keepUndocumentedEndpoints = [],
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

        // Append undocumented OpenAPI endpoints that are still usable
        foreach ($keepUndocumentedEndpoints as $openApiPath => $pathItem) {
            $normPath = OpenApiModelUtils::normalizePath($openApiPath);

            foreach ($pathItem as $httpMethod => $operation) {
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
        $class->addComment('@internal');

        $property = $class->addProperty('endpoints')
            ->setType('array')
            ->setStatic()
            ->setVisibility('public')
            ->setComment('@var array<string,array<string,class-string|null>> $endpoints');

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
                try {
                    $namespace->addUse(name: $fqcn, alias: $newClassName);
                } catch (InvalidStateException) {
                    $namespace->addUse(name: $fqcn, alias: $newClassName . 'V2');
                }

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
