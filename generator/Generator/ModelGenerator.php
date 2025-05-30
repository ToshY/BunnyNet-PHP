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
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use Throwable;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\MimeType;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Generator\Helper\ModelBodyMethodHelper;
use ToshY\BunnyNet\Generator\Helper\ModelMethodHelper;
use ToshY\BunnyNet\Generator\Utils\ArrayUtils;
use ToshY\BunnyNet\Generator\Utils\ClassUtils;
use ToshY\BunnyNet\Generator\Utils\FileUtils;
use ToshY\BunnyNet\Generator\Utils\LoggerUtils;
use ToshY\BunnyNet\Generator\Utils\OpenApiModelUtils;
use ToshY\BunnyNet\Generator\Utils\PrinterUtils;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;
use ToshY\BunnyNet\Model\EndpointQueryInterface;

class ModelGenerator
{
    private SpecObjectInterface|OpenApi $apiSpec;

    private string $outputDirectory;

    /** @var array<string,array<mixed>> */
    private array $replacements;

    private string $mappingClass;

    private string $baseNamespace;

    /** @var string[] */
    private array $existingEndpoints;

    private LoggerUtils $logger;

    /**
     * @throws IOException
     * @throws InvalidJsonPointerSyntaxException
     * @throws ReflectionException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @param string $apiSpecPath
     * @param string $outputDir
     * @param string $mappingClass
     * @param array<string,array<mixed>> $replacements
     * @param LoggerUtils $logger
     */

    public function __construct(
        string $apiSpecPath,
        string $outputDir,
        string $mappingClass,
        array $replacements = [],
        LoggerUtils $logger = new LoggerUtils(),
    ) {
        $this->outputDirectory = $outputDir;
        $this->mappingClass = $mappingClass;
        $this->baseNamespace = $this->filePathToFqcn($outputDir);
        $this->existingEndpoints = $this->scanExistingEndpoints();
        $this->apiSpec = $this->parseApiSpec($apiSpecPath);
        $this->replacements = $replacements;
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
                    $newNamespace = $this->baseNamespace . '\\' . $newNamespaceDirectory;
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
                $this->generateModel($path, $httpMethod, $operation, $className, $endpointClass, $newNamespace);
            }
        }
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
    ): void {
        $existingClassHeaders = $this->getExistingModelHeaders($endpointClass);

        $newSpecsPathParameters = $this->processParametersForPath(
            operation: $operation,
        );

        $newSpecsQueryParameters = $this->processParametersForQuery(
            operation: $operation,
        );

        $bodyParameters = [];
        if ($operation->requestBody !== null) {
            $bodyParameters = $this->processBodySchema($operation);
        }

        $code = $this->generatePhpFile(
            $className,
            $newNamespace,
            $httpMethod,
            $path,
            $existingClassHeaders,
            $newSpecsPathParameters,
            $newSpecsQueryParameters,
            $bodyParameters,
            $operation,
        );

        // Prepare output directory path
        $outputDirectoryPath = FileUtils::getOutputDirectoryFromNamespace(
            $this->baseNamespace,
            $newNamespace,
            $this->outputDirectory,
        );
        FileUtils::createDirectory($outputDirectoryPath);

        $filePath = FileUtils::getAbsoluteRealPath($outputDirectoryPath . '/' . $className . '.php');
        FileUtils::saveFile($filePath, $code);

        echo "Generated model: $filePath\n";
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
     * @param array<\ToshY\BunnyNet\Model\AbstractParameter> $bodyParameters
     * @param Operation $operation
     * @return string
     */
    private function generatePhpFile(
        string $className,
        string $namespace,
        string $httpMethod,
        string $path,
        array $existingClassHeaders,
        array $pathParameters,
        array $queryParameters,
        array $bodyParameters,
        Operation $operation,
    ): string {
        $file = new PhpFile();
        $file->setStrictTypes();

        $namespace = $file->addNamespace($namespace);
        $namespace->addUse(Method::class);
        $namespace->addUse(Type::class);
        $namespace->addUse(EndpointInterface::class);

        $implements = [EndpointInterface::class];
        if (empty($queryParameters) === false) {
            $implements[] = EndpointQueryInterface::class;
            $namespace->addUse(EndpointQueryInterface::class);
        }

        if (empty($bodyParameters) === false) {
            $implements[] = EndpointBodyInterface::class;
            $namespace->addUse(EndpointBodyInterface::class);
        }

        if (empty($queryParameters) === false || empty($bodyParameters) === false) {
            $namespace->addUse(AbstractParameter::class);
        }

        $class = $namespace->addClass($className);
        $class->setImplements($implements);
        $this->addMethod($class, $httpMethod);
        $this->addPath($class, $path, $pathParameters);

        $headers = $this->addHeaders($className, $class, $existingClassHeaders, $operation);
        if (empty($headers) === false) {
            $namespace->addUse(Header::class);
        }

        if (in_array(EndpointQueryInterface::class, $implements, true) === true) {
            $this->addQuery($class, $queryParameters);
        }

        if (in_array(EndpointBodyInterface::class, $implements, true)) {
            $this->addBody($class, $bodyParameters);
        }

        return (new PsrPrinter())->printFile($file);
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

    private function createNewNamespace(string $originalNamespace): string
    {
        // Extract the API type (e.g., Base, Stream) from the original namespace
        if (preg_match('/\\\\Model\\\\API\\\\([^\\\\]+)\\\\(.+)$/', $originalNamespace, $matches)) {
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

                try {
                    $reflectionClass = new ReflectionClass($endpointClass);
                    /** @var EndpointInterface $instance */
                    $instance = $reflectionClass->newInstance();

                    $existingEndpoints[$endpointClass] = [
                        'headers' => $instance->getHeaders(),
                        'path' => $instance->getPath(),
                        'method' => $instance->getMethod(),
                    ];
                } catch (Throwable) {
                    continue;
                }
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
     * @param string $path
     * @param string $httpMethod
     * @return string[]
     */
    private function getNamespaceFromPath(string $path, string $httpMethod): array
    {
        /* @phpstan-ignore-next-line property.notFound */
        $specData = $this->apiSpec->paths->getPath($path)->getRawSpecData()[$httpMethod];

        [$operationNamespace, $operationClass] = explode('_', $specData['operationId'], 2);

        $namespace = OpenApiModelUtils::stripTagSuffix($operationNamespace);
        $class = OpenApiModelUtils::stripTagSuffix($operationClass);

        if (empty($class) === true) {
            if (empty($specData['summary']) === false) {
                $class = implode('', array_map('ucfirst', explode(' ', $specData['summary'])));
            } else {
                // This likely won't happen
                $this->logger::print("* WARNING: Path '$path' does not have a summary to use for class name\n");
            }
        }

        return [
            $namespace,
            $class,
        ];
    }
}
