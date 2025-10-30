<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Generator;

use cebe\openapi\exceptions\IOException;
use cebe\openapi\exceptions\TypeErrorException;
use cebe\openapi\exceptions\UnresolvableReferenceException;
use cebe\openapi\json\InvalidJsonPointerSyntaxException;
use cebe\openapi\Reader;
use cebe\openapi\spec\OpenApi;
use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Parameter;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use cebe\openapi\SpecObjectInterface;
use Exception;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\HeaderProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\MimeType;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Generator\Helper\ModelBodyMethodHelper;
use ToshY\BunnyNet\Generator\Helper\ModelMethodHelper;
use ToshY\BunnyNet\Generator\Utils\ArrayUtils;
use ToshY\BunnyNet\Generator\Utils\ClassUtils;
use ToshY\BunnyNet\Generator\Utils\FileUtils;
use ToshY\BunnyNet\Generator\Utils\LoggerUtils;
use ToshY\BunnyNet\Generator\Utils\OpenApiModelUtils;
use ToshY\BunnyNet\Generator\Utils\PrinterUtils;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class ModelGenerator
{
    private SpecObjectInterface|OpenApi $apiSpec;

    private string $outputDirectory;

    /** @var array<string,array<mixed>> */
    private array $replacements;

    /** @var array<class-string,ModelValidationStrategy> */
    private array $validationReplacements;

    private string $mappingClass;

    private string $validationMappingClass;

    private string $validationMappingNamespace;

    private string $baseNamespace;

    /** @var string[] */
    private array $existingEndpoints;

    private LoggerUtils $logger;

    private string $validationMappingOutputDirectory;

    /**
     * @throws IOException
     * @throws InvalidJsonPointerSyntaxException
     * @throws ReflectionException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @param string $apiSpecPath
     * @param string $outputDir
     * @param string $mappingClass
     * @param string $validationMappingClass
     * @param string $validationMappingNamespace
     * @param string $validationMappingOutputDirectory
     * @param array<string,array<mixed>> $replacements
     * @param array<class-string,ModelValidationStrategy> $validationReplacements
     * @param LoggerUtils $logger
     */

    public function __construct(
        string $apiSpecPath,
        string $outputDir,
        string $mappingClass,
        string $validationMappingClass,
        string $validationMappingNamespace,
        string $validationMappingOutputDirectory,
        array $replacements = [],
        array $validationReplacements = [],
        LoggerUtils $logger = new LoggerUtils(),
    ) {
        $this->outputDirectory = $outputDir;
        $this->mappingClass = $mappingClass;
        $this->validationMappingClass = $validationMappingClass;
        $this->validationMappingNamespace = $validationMappingNamespace;
        $this->validationMappingOutputDirectory = $validationMappingOutputDirectory;
        $this->baseNamespace = $this->filePathToFqcn($outputDir);
        $this->existingEndpoints = $this->scanExistingEndpoints();
        $this->apiSpec = $this->parseApiSpec($apiSpecPath);
        $this->replacements = $replacements;
        $this->validationReplacements = $validationReplacements;
        $this->logger = $logger;
    }

    /**
     * @throws ReflectionException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @return void
     */
    public function generate(): void
    {
        // Get endpoints from the mapping class
        $endpoints = $this->getEndpointsFromMappingClass();

        $modelValidationStrategyCollection = [];
        // Process each endpoint
        foreach ($endpoints as $path => $methods) {
            foreach ($methods as $httpMethod => $endpointClass) {
                if ($endpointClass === null) {
                    // Endpoint has no class yet in mapping and should be generated instead.
                    // Can try to auto-generate an endpointClass name based on 1) summary, 2) operationId or 3) path
                    $this->logger::print(
                        "* INFO: Path '$path' with method '$httpMethod' does not have an existing API model. Will be created.\n",
                    );

                    [$newNamespaceDirectory, $className] = $this->getNamespaceFromPath($path, $httpMethod);
                    if (empty($className) === true) {
                        continue;
                    }

                    $newNamespaceDirectory = rtrim($newNamespaceDirectory, '\\');

                    $newNamespace = $this->baseNamespace . '\\' . $newNamespaceDirectory;
                    $newNamespace = rtrim($newNamespace, '\\');
                    $endpointClass = $newNamespace . '\\' . $className;
                } else {
                    $shortClassName = ClassUtils::getShortClassName($endpointClass);

                    [$className, $originalNamespace] = ClassUtils::getOriginalClassNameAndNamespace($endpointClass);
                    $newNamespace = $this->createNewNamespace($originalNamespace);
                }

                // Find the path and operation in the OpenAPI spec; should only occur if endpoint was deleted from spec but kept in mapping
                /* @phpstan-ignore-next-line property.notFound */
                $pathItem = $this->apiSpec->paths->getPath($path);
                if ($pathItem === null) {
                    $this->logger::print(
                        sprintf(
                            "* WARNING: [%s] Path '%s' not found in OpenAPI spec\n",
                            $shortClassName ?? $className,
                            $path,
                        ),
                    );
                    continue;
                }

                // Convert HTTP method to lowercase for OpenAPI spec; should only occur if method for endpoint was deleted from spec but kept in mapping
                $operation = $pathItem->getOperations()[$httpMethod] ?? null;
                if (empty($operation) === true) {
                    $this->logger::print(
                        sprintf(
                            "* WARNING: [%s] Operation '%s' not found for path '%s'\n",
                            $shortClassName ?? $className,
                            $httpMethod,
                            $path,
                        ),
                    );
                    continue;
                }

                // Generate the model
                $modelValidationStrategyCollection[] = [
                    'modelValidationStrategy' => $this->generateModel(
                        $path,
                        $httpMethod,
                        $operation,
                        $className,
                        $endpointClass,
                        $newNamespace,
                    ),
                    'namespace' => $newNamespace,
                    'className' => $className,
                ];
            }
        }
        // Write the validation strategy map files
        $this->generateValidationMapping($modelValidationStrategyCollection);
    }

    /**
     * @throws ReflectionException
     * @return array<string,array<string,class-string|null>>
     */
    private function getEndpointsFromMappingClass(): array
    {
        $fqcn = $this->mappingClass;
        if (class_exists($fqcn) === false) {
            throw new RuntimeException("Mapping class not found: $fqcn");
        }

        $reflectionClass = new ReflectionClass($fqcn);
        $staticProperty = $reflectionClass->getProperty('endpoints');

        return $staticProperty->getValue();
    }

    /**
     * @throws UnresolvableReferenceException
     * @throws TypeErrorException
     */
    private function generateModel(
        string $path,
        string $httpMethod,
        Operation $operation,
        string $className,
        string $endpointClass,
        string $newNamespace,
    ): ModelValidationStrategy {
        $existingClassHeaders = $this->getExistingModelHeaders($endpointClass);

        $newSpecsPathParameters = $this->processParametersForPath(
            operation: $operation,
        );

        $newSpecsQueryParameters = $this->processParametersForQuery(
            operation: $operation,
        );

        $newSpecsHeaderParameters = $this->processParametersForHeader(
            operation: $operation,
        );

        $bodyParameters = [];
        if ($operation->requestBody !== null) {
            $bodyParameters = $this->processBodySchema($operation);
        }

        [$code, $modelValidationStrategy] = $this->generatePhpFile(
            $className,
            $newNamespace,
            $httpMethod,
            $path,
            $existingClassHeaders,
            $newSpecsPathParameters,
            $newSpecsQueryParameters,
            $newSpecsHeaderParameters,
            $bodyParameters,
            $operation,
        );

        // Prepare output directory path
        $outputDirectoryPath = FileUtils::getOutputDirectoryFromNamespace(
            $this->baseNamespace,
            $this->baseNamespace === $newNamespace ? '' : $newNamespace,
            $this->outputDirectory,
        );
        FileUtils::createDirectory($outputDirectoryPath);

        $filePath = FileUtils::getAbsoluteRealPath($outputDirectoryPath . '/' . $className . '.php');
        FileUtils::saveFile($filePath, $code);

        echo "Generated model: $filePath\n";

        return $modelValidationStrategy;
    }

    /**
     * @param list<array{modelValidationStrategy:ModelValidationStrategy, namespace:string, className: mixed}> $modelValidationStrategyCollection
     * @return void
     */
    private function generateValidationMapping(array $modelValidationStrategyCollection): void
    {
        $mappingClassName = $this->validationMappingClass;
        $mappingNamespace = $this->validationMappingNamespace;

        $file = new PhpFile();
        $file->setStrictTypes();

        $namespace = $file->addNamespace($mappingNamespace);
        $namespace->addUse(ModelValidationStrategy::class);
        $class = $namespace->addClass($mappingClassName);
        $class->setFinal();

        $processedClassNames = [];
        $lines = ["["];
        /**
         * @var array{modelValidationStrategy: ModelValidationStrategy, namespace: string, className: mixed} $validationStrategyInfo
         */
        foreach ($modelValidationStrategyCollection as $validationStrategyInfo) {
            $subClassName = ClassUtils::getShortClassName($validationStrategyInfo['className']);
            $fqcn = $validationStrategyInfo['namespace'] . '\\' . $validationStrategyInfo['className'];

            // Replacements for model validation strategies; should normally not be needed.
            if (empty($this->validationReplacements[$fqcn]) === false) {
                $validationStrategyInfo['modelValidationStrategy'] = $this->validationReplacements[$fqcn];
            }

            $alias = null;
            $hasAlias = false;
            if (in_array($subClassName, $processedClassNames, true) === true) {
                $hasAlias = true;
                $alias = ClassUtils::getNamespacePart($fqcn) . $subClassName;
            }

            $newClassName = $hasAlias ? $alias : $subClassName;
            $namespace->addUse(name: $fqcn, alias: $newClassName);

            $processedClassNames[] = $newClassName;

            // Create the actual line
            $subValidationStrategyName = ClassUtils::getShortClassName(ModelValidationStrategy::class);
            $subValidationStrategyValue = $validationStrategyInfo['modelValidationStrategy']->name;

            $lines[] = "$newClassName::class => $subValidationStrategyName::$subValidationStrategyValue,";
        }

        // Append replacements if needed to end of array
        foreach ($this->validationReplacements as $validationClass => $modelValidationStrategy) {
            $validationClassName = ClassUtils::getShortClassName($validationClass);
            if (in_array($validationClassName, $processedClassNames, true) === true) {
                continue;
            }

            $namespace->addUse($validationClass);

            $subValidationStrategyName = ClassUtils::getShortClassName(ModelValidationStrategy::class);
            $lines[] = "$validationClassName::class => $subValidationStrategyName::$modelValidationStrategy->name,";
        }

        $lines[] = "]";

        $class->addProperty('map')
            ->setStatic()
            ->setType('array')
            ->setValue(new Literal(PrinterUtils::indentCode(implode("\n", $lines), 4)))
            ->setComment('@var array<class-string,ModelValidationStrategy> $map');

        $code = (new PsrPrinter())->printFile($file);

        // Prepare output directory path
        $outputDirectoryPath = FileUtils::getOutputDirectoryFromNamespace(
            $this->filePathToFqcn($this->validationMappingOutputDirectory),
            $mappingClassName,
            $this->validationMappingOutputDirectory,
        );
        FileUtils::createDirectory($this->validationMappingOutputDirectory);

        $filePath = FileUtils::getAbsoluteRealPath($outputDirectoryPath . '.php');

        FileUtils::saveFile($filePath, $code);

        echo "Generated validation map: $filePath\n";
    }

    /**
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @throws Exception
     * @param Operation $operation
     * @return array<\ToshY\BunnyNet\Model\AbstractParameter>
     */
    private function processBodySchema(Operation $operation): array
    {
        $requestBodyRef = $operation->requestBody;
        $requestBody = ($requestBodyRef instanceof Reference) ? $requestBodyRef->resolve() : $requestBodyRef;

        $mimeType = null;
        foreach ([MimeType::JSON, MimeType::JSON_ALL, MimeType::OCTET_STREAM] as $findMimeType) {
            if (isset($requestBody->content[$findMimeType]) === false) {
                continue;
            }

            $mimeType = $findMimeType;
        }

        if ($mimeType === null) {
            throw new Exception(
                sprintf(
                    "Content type '%s' not found in request body.",
                    array_key_first($requestBody->getRawSpecData()['content']), // @phpstan-ignore method.nonObject
                ),
            );
        }

        /* @phpstan-ignore-next-line property.nonObject */
        $mediaType = $requestBody->content[$mimeType];

        if (isset($mediaType->schema) === false) {
            throw new Exception("Schema not found for 'application/json' content type.");
        }
        $rootSchemaRef = $mediaType->schema;
        $rootRequestBodySchema = ($rootSchemaRef instanceof Reference) ? $rootSchemaRef->resolve() : $rootSchemaRef;

        if ($rootRequestBodySchema instanceof Schema === false) {
            throw new Exception("Root request body schema is not a valid Schema object.");
        }

        return ModelBodyMethodHelper::generateParameters(
            $rootRequestBodySchema,
            $this->logger,
        );
    }

    /**
     * @param string $className
     * @param string $namespace
     * @param string $httpMethod
     * @param string $path
     * @param array<array<string,string>> $existingClassHeaders
     * @param array<string,mixed> $pathParameters
     * @param array<\ToshY\BunnyNet\Model\AbstractParameter> $queryParameters
     * @param array<string,mixed> $headerParameters
     * @param array<\ToshY\BunnyNet\Model\AbstractParameter> $bodyParameters
     * @param Operation $operation
     * @return array{string, ModelValidationStrategy}
     */
    private function generatePhpFile(
        string $className,
        string $namespace,
        string $httpMethod,
        string $path,
        array $existingClassHeaders,
        array $pathParameters,
        array $queryParameters,
        array $headerParameters,
        array $bodyParameters,
        Operation $operation,
    ): array {
        $file = new PhpFile();
        $file->setStrictTypes();

        $namespace = $file->addNamespace($namespace);
        $namespace->addUse(Method::class);
        $namespace->addUse(Type::class);
        $namespace->addUse(ModelInterface::class);

        $implements = [ModelInterface::class];
        if (empty($queryParameters) === false) {
            $implements[] = QueryModelInterface::class;
            $namespace->addUse(QueryModelInterface::class);
        }

        if (empty($bodyParameters) === false) {
            $implements[] = BodyModelInterface::class;
            $namespace->addUse(BodyModelInterface::class);
        }

        if (empty($queryParameters) === false || empty($bodyParameters) === false) {
            $namespace->addUse(AbstractParameter::class);
        }

        $constructorReplacements = [];
        if (isset($this->replacements[$className]['constructor']) === true) {
            $constructorReplacements = $this->replacements[$className]['constructor'];
        }

        $hasQueryParameters = in_array(QueryModelInterface::class, $implements, true);
        $hasBodyParameters = in_array(BodyModelInterface::class, $implements, true);

        $class = $namespace->addClass($className);
        $class->setImplements($implements);
        if (
            empty($pathParameters) === false
            || empty($constructorReplacements) === false
            || $hasQueryParameters === true
            || $hasBodyParameters === true
            || empty($headerParameters) === false
        ) {
            $this->addConstructor(
                $namespace,
                $class,
                $pathParameters,
                $constructorReplacements,
                $headerParameters,
                $hasQueryParameters,
                $hasBodyParameters,
            );
        }
        $this->addMethod($class, $httpMethod);
        $this->addPath($class, $path, $pathParameters);

        $headers = $this->addHeaders($className, $class, $existingClassHeaders, $operation);
        if (empty($headers) === false) {
            $namespace->addUse(Header::class);
        }

        if ($hasQueryParameters === true) {
            $this->addQuery($class, $queryParameters);
        }

        if ($hasBodyParameters === true) {
            $this->addBody($class, $bodyParameters);
        }

        $modelValidationStrategy = ModelValidationStrategy::NONE;
        if ($hasQueryParameters === true && $hasBodyParameters === true) {
            $modelValidationStrategy = ModelValidationStrategy::STRICT;
        } elseif ($hasQueryParameters === true && $hasBodyParameters === false) {
            $modelValidationStrategy = ModelValidationStrategy::STRICT_QUERY;
        } elseif ($hasQueryParameters === false && $hasBodyParameters === true) {
            $modelValidationStrategy = ModelValidationStrategy::STRICT_BODY;
        }

        return [(new PsrPrinter())->printFile($file), $modelValidationStrategy];
    }

    /**
     * @param string $endpointClass
     * @return array<array<string,string>>
     */
    private function getExistingModelHeaders(string $endpointClass): array
    {
        if (isset($this->existingEndpoints[$endpointClass])) {
            return $this->existingEndpoints[$endpointClass]['headers'] ?? [];
        }

        return [];
    }

    /**
     * @param PhpNamespace $namespace
     * @param ClassType $class
     * @param array<string,mixed> $pathParameters
     * @param array<string,mixed> $replacements
     * @param array<string,mixed> $headerParameters
     * @param bool $hasQueryParameters
     * @param bool $hasBodyParameters
     * @return void
     */
    private function addConstructor(
        PhpNamespace $namespace,
        ClassType $class,
        array $pathParameters,
        array $replacements,
        array $headerParameters,
        bool $hasQueryParameters,
        bool $hasBodyParameters,
    ): void {
        $constructor = $class->addMethod('__construct');
        $constructor->setPublic();

        $constructorComments = [];
        foreach ($pathParameters as $param) {
            $name = $param['name'];
            $type = self::getPhpTypeFromOpenApiType($param['type']);
            if (
                array_key_exists($name, $replacements) === true
                && array_key_exists('type', $replacements[$name])
            ) {
                $type = self::getPhpTypeFromOpenApiType($replacements[$name]['type']);
            }

            $constructor->addPromotedParameter($name)
                ->setType($type)
                ->setVisibility('public')
                ->addAttribute(PathProperty::class)
                ->setReadOnly();

            $constructorComments[] = sprintf('@param %s $%s', $type, $name);
        }

        if (empty($pathParameters) === false) {
            $namespace->addUse(PathProperty::class);
        }

        // Determine argument order; required arguments before optional ones
        $determineArgumentOrder = [];
        $constructorProperties = [];
        $queryType = $replacements['query']['type'] ?? 'array';
        if ($hasQueryParameters === true || empty($replacements['query']) === false) {
            $type = self::getPhpTypeFromOpenApiType($queryType);
            $queryComment = match ($type) {
                'array' => 'array<string,mixed>',
                default => $type,
            };

            $constructorComments[] = sprintf('@param %s $query', $queryComment);

            $constructorProperties['query'] = [
                'type' => $type,
                'visibility' => 'public',
                'attribute' => QueryProperty::class,
            ];

            // Always set the default value except if the value is null
            $queryDefaultValue = [];
            if (
                !array_key_exists('query', $replacements)
                || !array_key_exists('default', $replacements['query'])
                || $replacements['query']['default'] !== null
            ) {
                $queryDefaultValue = $replacements['query']['default'] ?? $queryDefaultValue;
                $constructorProperties['query']['default'] = $queryDefaultValue;
            } else {
                $queryDefaultValue = null;
            }

            $determineArgumentOrder['query'] = $queryDefaultValue;
        }

        $bodyType = $replacements['body']['type'] ?? 'array';
        if ($hasBodyParameters === true || empty($replacements['body']) === false) {
            $type = self::getPhpTypeFromOpenApiType($bodyType);
            $bodyComment = match ($type) {
                'array' => 'array<string,mixed>',
                default => $type,
            };

            $constructorComments[] = sprintf('@param %s $body', $bodyComment);

            $constructorProperties['body'] = [
                'type' => $type,
                'visibility' => 'public',
                'attribute' => BodyProperty::class,
            ];

            // Always set the default value except if the value is null
            $bodyDefaultValue = [];
            if (
                !array_key_exists('body', $replacements)
                || !array_key_exists('default', $replacements['body'])
                || $replacements['body']['default'] !== null
            ) {
                $bodyDefaultValue = $replacements['body']['default'] ?? $bodyDefaultValue;
                $constructorProperties['body']['default'] = $bodyDefaultValue;
            } else {
                $bodyDefaultValue = null;
            }

            $determineArgumentOrder['body'] = $bodyDefaultValue;
        }

        if (empty($headerParameters) === false) {
            $headerDefaultValue = [];
            $constructorProperties['headers'] = [
                'type' => 'array',
                'visibility' => 'public',
                'attribute' => HeaderProperty::class,
                'default' => $headerDefaultValue,
            ];

            $constructorComments[] = '@param array<string,string> $headers';

            $determineArgumentOrder['headers'] = $headerDefaultValue;
        }

        // Get order
        $determineArgumentOrder = self::sortNullPriority($determineArgumentOrder);

        // Sort the constructor properties based on the order array
        $constructorPropertiesSorted = [];
        foreach (array_keys($determineArgumentOrder) as $key) {
            if (array_key_exists($key, $constructorProperties)) {
                $constructorPropertiesSorted[$key] = $constructorProperties[$key];
            }
        }

        foreach ($constructorPropertiesSorted as $property => $constructorProperty) {
            $property = $constructor->addPromotedParameter($property)
                ->setType($constructorProperty['type'])
                ->setVisibility($constructorProperty['visibility'])
                ->addAttribute($constructorProperty['attribute'])
                ->setReadOnly();

            if (isset($constructorProperty['default']) === true) {
                $property->setDefaultValue($constructorProperty['default']);
            }

            $namespace->addUse($constructorProperty['attribute']);
        }

        foreach ($constructorComments as $comment) {
            $constructor->addComment($comment);
        }
    }

    /**
     * @param string $className
     * @param ClassType $class
     * @param array<array<string,string>> $headers
     * @param Operation $operation
     * @return array<string,string>
     */
    private function addHeaders(
        string $className,
        ClassType $class,
        array $headers,
        Operation $operation,
    ): array {
        $method = $class->addMethod('getHeaders');
        $method->setReturnType('array');
        $method->setPublic();

        if (isset($this->replacements[$className]['headers']) === false) {
            // Get API accept headers
            $openApiHeaders = [];
            $openApiAcceptHeaders = $this->getOpenApiSpecsResponseContentType($operation);
            if ($openApiAcceptHeaders !== null) {
                $openApiHeaders['Accept'] = $openApiAcceptHeaders;
            }
            $openApiContentTypeHeaders = $this->getOpenApiSpecsRequestContentType($operation);
            if ($openApiContentTypeHeaders !== null) {
                $openApiHeaders['Content-Type'] = $openApiContentTypeHeaders;
            }
            ksort($openApiHeaders);

            // Existing class model headers
            $classHeaders = array_merge(...$headers);
            ksort($classHeaders);

            $classVersusSpecsDiff = ArrayUtils::getArrayDifferenceKeyValue($classHeaders, $openApiHeaders);
            foreach ($classVersusSpecsDiff as $executionType => $classVersusSpecDiffItems) {
                if (empty($classVersusSpecDiffItems) === true) {
                    continue;
                }

                foreach ($classVersusSpecDiffItems as $headerType => $headerValue) {
                    $this->logger::print(
                        "* INFO: [$className] Will '$executionType' header '$headerType: $headerValue'\n",
                    );

                    switch ($executionType) {
                        case 'add':
                        case 'update':
                            $classHeaders[$headerType] = $headerValue;
                            break;
                        case 'delete':
                            unset($classHeaders[$headerType]);
                    }
                }
            }
        } else {
            $classHeaders = $this->replacements[$className]['headers'];
            $this->logger::print("* INFO: [$className] Headers override \n");
        }

        // Generate code
        $headersCode = "return [";
        if (empty($classHeaders) === false) {
            $headersCode .= "\n";
        }

        foreach ($classHeaders as $type => $header) {
            $headerPrefixValue = match ($type) {
                'Accept' => 'ACCEPT',
                'Content-Type' => 'CONTENT_TYPE',
                default => strtoupper($type),
            };

            $headerSuffixValue = match ($header) {
                MimeType::ALL => 'ALL',
                MimeType::JSON => 'JSON',
                MimeType::JSON_ALL => 'JSON_ALL',
                MimeType::OCTET_STREAM => 'OCTET_STREAM',
                default => new RuntimeException('Unknown header: ' . $header),
            };

            $headerValue = sprintf('Header::%s_%s', $headerPrefixValue, $headerSuffixValue);

            $headersCode .= "    $headerValue,\n";
        }
        $headersCode .= "];";

        $method->setBody($headersCode);

        return $classHeaders;
    }

    private function addMethod(ClassType $class, string $httpMethod): void
    {
        $method = $class->addMethod('getMethod');
        $method->setReturnType(Method::class);
        $method->setPublic();
        $method->setBody(
            sprintf(
                "return Method::%s;",
                strtoupper($httpMethod),
            ),
        );
    }

    /**
     * @param ClassType $class
     * @param string $path
     * @param array<string,mixed> $parameters
     * @return void
     */
    private function addPath(ClassType $class, string $path, array $parameters): void
    {
        $method = $class->addMethod('getPath');
        $method->setReturnType('string');
        $method->setPublic();

        $replacements = [];
        foreach ($parameters as $param) {
            $placeholder = '{' . $param['name'] . '}';
            $format = $param['type'] === 'integer' ? '%d' : '%s';
            $replacements[$placeholder] = $format;
        }

        // Replace placeholders in the URL
        $formattedPath = ltrim(strtr($path, $replacements), '/');

        $method->setBody("return '$formattedPath';");
    }

    /**
     * @param ClassType $class
     * @param array<\ToshY\BunnyNet\Model\AbstractParameter> $parameters
     * @return void
     */
    private function addQuery(ClassType $class, array $parameters): void
    {
        $method = $class->addMethod('getQuery');
        $method->setReturnType('array');
        $method->setPublic();

        $queryCode = ModelMethodHelper::generateAbstractParameterArrayCode($parameters);

        $method->setBody('return [' . "\n" . PrinterUtils::indentCode($queryCode) . "\n" . '];');
    }

    /**
     * @param ClassType $class
     * @param array<\ToshY\BunnyNet\Model\AbstractParameter> $parameters
     * @return void
     */
    private function addBody(ClassType $class, array $parameters): void
    {
        $method = $class->addMethod('getBody');
        $method->setReturnType('array');
        $method->setPublic();

        $bodyCode = ModelMethodHelper::generateAbstractParameterArrayCode($parameters);

        $method->setBody('return [' . "\n" . PrinterUtils::indentCode($bodyCode) . "\n" . '];');
    }

    /**
     * @throws IOException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @throws InvalidJsonPointerSyntaxException
     */
    private function parseApiSpec(string $apiSpecPath): SpecObjectInterface|OpenApi
    {
        $specifications = Reader::readFromJsonFile(
            fileName: $apiSpecPath,
        );

        if ($specifications->validate() === false) {
            $errors = implode(PHP_EOL, $specifications->getErrors());

            throw new RuntimeException('Invalid OpenAPI specification: ' . $errors);
        }

        return $specifications;
    }

    /**
     * @throws UnresolvableReferenceException
     * @return array<\ToshY\BunnyNet\Model\AbstractParameter>
     * @param Operation $operation
     */
    private function processParametersForQuery(Operation $operation): array
    {
        $abstractParameters = [];
        if (empty($operation->parameters)) {
            return $abstractParameters;
        }

        foreach ($operation->parameters as $parameterRef) {
            $parameter = ($parameterRef instanceof Reference) ? $parameterRef->resolve() : $parameterRef;

            if (!$parameter instanceof Parameter || $parameter->in !== 'query') {
                continue;
            }

            if ($parameter->schema instanceof Schema) {
                $parentRequiredList = ($parameter->required ?? false) ? [$parameter->name] : [];

                $abstractParameters[] = ModelMethodHelper::createParameterRepresentation(
                    $parameter->name,
                    $parameter->schema,
                    $parentRequiredList,
                );
            }
        }

        return $abstractParameters;
    }

    /**
     * @param Operation $operation
     * @return array<mixed>
     */
    private function processParametersForPath(
        Operation $operation,
    ): array {
        $parameters = [];
        foreach ($operation->parameters ?? [] as $parameter) {
            /** @var Parameter $parameter */
            $paramName = $parameter->name;
            /* @phpstan-ignore-next-line nullsafe.neverNull */
            $paramType = $parameter->schema?->type ?? 'string';

            if ($parameter->in !== 'path') {
                continue;
            }

            $parameters[] = [
                'name' => $paramName,
                'type' => $paramType,
            ];
        }

        return $parameters;
    }

    /**
     * @param Operation $operation
     * @return array<mixed>
     */
    private function processParametersForHeader(
        Operation $operation,
    ): array {
        $parameters = [];
        foreach ($operation->parameters ?? [] as $parameter) {
            /** @var Parameter $parameter */
            $paramName = $parameter->name;
            /* @phpstan-ignore-next-line nullsafe.neverNull */
            $paramType = $parameter->schema?->type ?? 'string';

            // Skip the "AccessKey" header if its defined in the parameters, as this is handled by API/Client already
            if ($parameter->in !== 'header' || $paramName === 'AccessKey') {
                continue;
            }

            $parameters[] = [
                'name' => $paramName,
                'type' => $paramType,
                'required' => $parameter->required ?? false,
            ];
        }

        return $parameters;
    }

    private function createNewNamespace(string $originalNamespace): string
    {
        // Extract the API type (e.g., Base, Stream) from the original namespace
        if (preg_match('/\\\\Model\\\\Api\\\([^\\\\]+)\\\\(.+)$/', $originalNamespace, $matches)) {
            $subNamespace = $matches[2];

            return $this->baseNamespace . '\\' . $subNamespace;
        }

        // If we can't extract the structure, use the base namespace
        return $this->baseNamespace;
    }

    /**
     * @throws ReflectionException
     * @return array<string,mixed>
     */
    private function scanExistingEndpoints(): array
    {
        $existingEndpoints = [];

        $endpoints = $this->getEndpointsFromMappingClass();
        foreach ($endpoints as $methods) {
            foreach ($methods as $endpointClass) {
                if ($endpointClass === null) {
                    continue;
                }

                if (class_exists($endpointClass) === false) {
                    continue;
                }

                $reflectionClass = new ReflectionClass($endpointClass);
                /** @var ModelInterface $instance */
                $instance = $reflectionClass->newInstanceWithoutConstructor();

                $existingEndpoints[$endpointClass] = [
                    'headers' => $instance->getHeaders(),
                    'path' => $instance->getPath(),
                    'method' => $instance->getMethod(),
                ];
            }
        }

        return $existingEndpoints;
    }

    /**
     * Determine the base namespace from the output directory path
     */
    private function filePathToFqcn(string $fullFilepath): string
    {
        // Normalize path to handle potential relative paths
        $realPath = FileUtils::realPath($fullFilepath);
        if ($realPath === false) {
            $realPath = FileUtils::getAbsoluteRealPath($fullFilepath);
        }

        $psr4 = ClassUtils::getPsr4RootNamespace();
        $sourcePath = '/' . $psr4['path'];

        $relative = FileUtils::getRelativePathWithoutSource($realPath, $sourcePath);
        $namespacePath = ClassUtils::forwardSlashToBackwardSlash($relative);

        return sprintf(
            '%s%s',
            $psr4['namespace'],
            $namespacePath,
        );
    }

    private function getOpenApiSpecsResponseContentType(
        Operation $operation,
    ): ?string {
        $apiResponseContent = $operation->responses->getResponses();

        $newHeadersPerResponse = [];
        // If one of the responses has a content type set, use it for header
        foreach ($apiResponseContent as $code => $response) {
            $hasContent = isset($response->getRawSpecData()['content']);
            if ($hasContent === false) {
                continue;
            }

            $apiContentTypeArray = array_keys($response->getRawSpecData()['content']);
            foreach ($apiContentTypeArray as $apiContentType) {
                if (str_contains($apiContentType, 'xml') === true) {
                    unset($apiContentTypeArray[$apiContentType]);
                }
            }

            $newHeadersPerResponse[$code] = self::findMimeTypeForOpenApiContentType(
                $response->getRawSpecData(),
                [MimeType::ALL, MimeType::JSON],
            );
        }

        $uniqueHeadersPersResponse = array_unique($newHeadersPerResponse);
        if (empty($uniqueHeadersPersResponse) === true || array_key_first($newHeadersPerResponse) === null) {
            return null;
        }

        return $newHeadersPerResponse[array_key_first($newHeadersPerResponse)];
    }

    private function getOpenApiSpecsRequestContentType(
        Operation $operation,
    ): ?string {
        if ($operation->requestBody === null) {
            return null;
        }

        $requestBody = $operation->requestBody;

        // Check for content types
        if (isset($requestBody->content) === false) {
            return null;
        }

        return self::findMimeTypeForOpenApiContentType(
            $requestBody->getRawSpecData(),
            [MimeType::ALL, MimeType::JSON, MimeType::JSON_ALL, MimeType::OCTET_STREAM],
        );
    }

    /**
     * @param array<mixed> $rawSpecData
     * @param string[] $allowedMimeTypes
     * @return string
     */
    private static function findMimeTypeForOpenApiContentType(array $rawSpecData, array $allowedMimeTypes): string
    {
        $apiContentTypeArray = array_keys($rawSpecData['content']);

        $mimeType = null;
        foreach ($allowedMimeTypes as $findMimeType) {
            if (in_array($findMimeType, $apiContentTypeArray, true) === false) {
                continue;
            }

            $mimeType = $findMimeType;
        }

        if ($mimeType === null) {
            throw new RuntimeException(
                sprintf(
                    'No valid MimeType found in given operation request body: %s',
                    $apiContentTypeArray[array_key_first($apiContentTypeArray)],
                ),
            );
        }

        return $mimeType;
    }

    /**
     * @note This is only used when an API class is newly created
     * @param string $path
     * @param string $httpMethod
     * @return string[]
     */
    private function getNamespaceFromPath(string $path, string $httpMethod): array
    {
        /* @phpstan-ignore-next-line property.notFound */
        $specData = $this->apiSpec->paths->getPath($path)->getRawSpecData()[$httpMethod];

        if (isset($specData['operationId']) === false && (empty($specData['summary']) === true || empty($specData['description']) === true)) {
            $class = self::generateOperationIdFromPath($path, $httpMethod);

            $namespace = empty($specData['tags']) === false ? OpenApiModelUtils::extractNamespaceFromTags(
                $specData['tags'],
            ) : '';

            return [
                $namespace,
                $class,
            ];
        }

        if (isset($specData['tags']) === false) {
            if (empty($specData['summary']) === false) {
                return [
                    '',
                    ClassUtils::toPascalCase($specData['summary']),
                ];
            } elseif (empty($specData['description']) === false) {
                return [
                    '',
                    ClassUtils::toPascalCase($specData['description']),
                ];
            }
        }

        $operationId = $this->retrieveOperationId($specData['operationId'], $specData['tags']);

        [$operationNamespace, $operationClass] = explode('_', $operationId, 2);

        $namespace = OpenApiModelUtils::extractNamespaceFromTags($specData['tags']);
        $namespace = match ($namespace !== null) {
            true => ClassUtils::toPascalCase($namespace),
            false => OpenApiModelUtils::stripTagSuffix($operationNamespace),
        };

        $class = OpenApiModelUtils::stripTagSuffix($operationClass);

        if (empty($class) === true) {
            if (empty($specData['summary']) === false) {
                $class = ClassUtils::toPascalCase($specData['summary']);
            } else {
                // This likely won't happen... unless for deprecated/no longer supported endpoints like /compute/script
                $this->logger::print("* WARNING: Path '$path' does not have a summary to use for class name\n");
            }
        }

        return [
            $namespace,
            $class,
        ];
    }

    private static function generateOperationIdFromPath(string $path, string $method): string
    {
        $path = trim($path, '/');
        $parts = explode('/', $path);

        // Remove the first static segment (like 'shield')
        array_shift($parts);

        // If the last part is a path parameter (e.g. {id}), keep it
        $lastIsParam = !empty($parts) && preg_match('/^{.*}$/', end($parts));

        // Filter out all params unless it's the last one and lastIsParam = true
        $filteredParts = [];
        foreach ($parts as $i => $p) {
            $isParam = preg_match('/^{.*}$/', $p);
            if (!$isParam || ($i === array_key_last($parts) && $lastIsParam)) {
                $filteredParts[] = $p;
            }
        }

        // If no parts left, fallback to 'Root'
        if (empty($filteredParts)) {
            $filteredParts = ['Root'];
        }

        $filteredParts = array_map(function ($p) {
            $p = trim($p, '{}');
            return ClassUtils::toPascalCase(str_replace(['-', '_'], ' ', $p));
        }, $filteredParts);

        if ($lastIsParam && count($filteredParts) > 1) {
            $last = array_pop($filteredParts);
            $filteredParts[] = 'By' . $last;
        }

        return ClassUtils::toPascalCase($method) . implode('', $filteredParts);
    }


    /**
     * @param string $operationId
     * @param string[] $tags
     * @return string
     */
    private function retrieveOperationId(string $operationId, array $tags): string
    {
        [$operationNamespace, $operationClass] = explode('_', $operationId, 2);

        foreach ($tags as $tag) {
            if ($operationClass !== $tag) {
                continue;
            }

            // Edge case where the current operationId does not conform to the expected format of <namespace>_<class>
            $operationId = implode('_', [$operationClass, $operationNamespace]);
            break;
        }

        return $operationId;
    }

    public static function getPhpTypeFromOpenApiType(string $openApiType): string
    {
        return match ($openApiType) {
            'string' => Type::STRING_TYPE->value,
            'integer' => Type::INT_TYPE->value,
            'number' => 'float',
            'boolean' => Type::BOOLEAN_TYPE->value,
            'array' => Type::ARRAY_TYPE->value,
            'object' => 'array',
            'mixed' => 'mixed',
            default => throw new \InvalidArgumentException("Unknown OpenAPI type: $openApiType"),
        };
    }

    /**
     * @param array<string,mixed> $input
     * @return array<string,mixed>
     */
    private static function sortNullPriority(array $input): array
    {
        uasort($input, function ($a, $b) {
            if (is_null($a) && !is_null($b)) {
                return -1;
            } elseif (!is_null($a) && is_null($b)) {
                return 1;
            }
            return 0;
        });

        return $input;
    }
}
