<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Client;

use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Exception\InvalidBodyParameterTypeException;
use ToshY\BunnyNet\Exception\InvalidJSONForBodyException;
use ToshY\BunnyNet\Exception\InvalidQueryParameterRequirementException;
use ToshY\BunnyNet\Exception\InvalidQueryParameterTypeException;
use ToshY\BunnyNet\Model\Client\Response;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class BunnyClient
{
    public const THROW_CLIENT_EXCEPTIONS = false;

    protected const SCHEME = 'https';

    protected string $apiKey;

    protected HttpClientInterface $client;

    public function __construct(
        protected string $hostRequest
    ) {
        $this->client = HttpClient::create();
    }

    private function getHostRequest(): string
    {
        return $this->hostRequest;
    }

    protected function request(
        EndpointInterface $endpoint,
        array $pathParameters = [],
        array $query = [],
        mixed $body = null
    ): Response {
        $options = array_filter(
            [
                'body' => $this->getBody($body),
                'headers' => array_merge(
                    array_merge(...$endpoint->getHeaders()),
                    $this->getAccessKeyHeader()
                ),
            ],
            fn ($value) => empty($value) === false
        );

        $base = $this->getHostRequest();
        $path = $this->createUrlPath(
            template: $endpoint->getPath(),
            pathCollection: $pathParameters
        );
        $query = $this->createQuery($query);

        $url = sprintf(
            '%s://%s%s%s',
            self::SCHEME,
            $base,
            $path,
            $query
        );

        $response = $this->client->request(
            $endpoint->getMethod()->value,
            $url,
            $options
        );

        return new Response(response: $response);
    }

    protected function createUrlPath(
        string $template,
        array $pathCollection
    ): string {
        return sprintf(
            sprintf(
                '/%s',
                $template
            ),
            ...$pathCollection
        );
    }

    protected function createQuery(array $query): string|null
    {
        if (empty($query) === true) {
            return null;
        }

        foreach ($query as $key => $value) {
            if (is_bool($value) === false) {
                continue;
            }

            $query[$key] = $value ? 'true' : 'false';
        }

        return sprintf(
            '?%s',
            http_build_query(
                data: $query,
                arg_separator: '&',
                encoding_type: PHP_QUERY_RFC3986
            )
        );
    }

    /**
     * @throws FileDoesNotExistException
     * @return resource
     */
    protected function openFileStream(string $filePath)
    {
        $fileRealPath = realpath($filePath);
        if ($fileRealPath === false) {
            throw new FileDoesNotExistException(
                sprintf(
                    'The local file `%s` could not be opened. Please check if it exists.',
                    $filePath
                )
            );
        }

        return fopen($fileRealPath, 'r');
    }

    private function getAccessKeyHeader(): array
    {
        return [
            'AccessKey' => $this->apiKey,
        ];
    }

    /**
     * @throws InvalidJSONForBodyException
     */
    private function getBody(mixed $body): mixed
    {
        if (is_array($body) === false) {
            return $body;
        }

        try {
            $jsonBody = json_encode(value: $body, flags: JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            throw new InvalidJSONForBodyException(
                $e->getMessage()
            );
        }

        return $jsonBody;
    }

    /**
     * @throws InvalidQueryParameterRequirementException
     * @throws InvalidQueryParameterTypeException
     */
    protected function validateQueryField(
        array $values,
        array $template
    ): array {
        $intersectTemplateKeys = array_intersect_key($template, $values);
        $intersectValues = array_intersect_key($values, $template);
        foreach ($intersectTemplateKeys as $key => $templateValue) {
            $parameterValue = $intersectValues[$key];
            $parameterValueType = gettype($parameterValue);

            // Field type check
            $typeCheck = sprintf('is_%s', $templateValue['type']);
            if ($typeCheck($parameterValue) === false) {
                throw new InvalidQueryParameterTypeException(
                    sprintf(
                        'Invalid query parameter type provided for `%s`. Expected `%s` got `%s`.',
                        $key,
                        $templateValue['type'],
                        $parameterValueType
                    )
                );
            }

            // Check required fields
            if (isset($templateValue['required']) === true) {
                if (
                    $templateValue['required'] === true
                    && empty($parameterValue) === true
                ) {
                    throw new InvalidQueryParameterRequirementException(
                        sprintf(
                            'Expected required parameter `%s` was not provided.',
                            $key
                        )
                    );
                }
            }

            $this->recurseValidationOnArray(__FUNCTION__, $key, $templateValue, $parameterValue);
        }

        return $intersectValues;
    }

    /**
     * @throws InvalidBodyParameterTypeException
     */
    protected function validateBodyField(
        array $values,
        array $template
    ): array {
        $intersectTemplateKeys = array_intersect_key($template, $values);
        $intersectValues = array_intersect_key($values, $template);
        foreach ($intersectTemplateKeys as $key => $templateValue) {
            $parameterValue = $intersectValues[$key];
            $parameterValueType = gettype($parameterValue);

            // Field type check
            $typeCheck = sprintf('is_%s', $templateValue['type']);
            if ($typeCheck($parameterValue) === false) {
                throw new InvalidBodyParameterTypeException(
                    sprintf(
                        'Invalid body parameter type provided for `%s`. Expected `%s` got `%s`.',
                        $key,
                        $templateValue['type'],
                        $parameterValueType
                    )
                );
            }

            $this->recurseValidationOnArray(__FUNCTION__, $key, $templateValue, $parameterValue);
        }

        return $intersectValues;
    }

    private function recurseValidationOnArray(
        string $methodName,
        string $key,
        array $templateValue,
        mixed $parameterValue
    ): void {
        if (is_array($parameterValue) === true) {
            foreach ($parameterValue as $subValue) {
                $traverseParameterValue = $subValue;
                if (is_array($traverseParameterValue) === false) {
                    $traverseParameterValue = [$key => $subValue];
                }

                $traverseTemplateValue = $templateValue['options'];
                if (isset($templateValue['options']['type']) === true) {
                    $traverseTemplateValue = [$key => $templateValue['options']];
                }

                $this->$methodName($traverseParameterValue, $traverseTemplateValue);
            }
        }
    }
}
