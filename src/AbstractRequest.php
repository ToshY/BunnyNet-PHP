<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Utils;
use Psr\Http\Message\StreamInterface;
use ToshY\BunnyNet\Exception\FileDoesNotExist;
use ToshY\BunnyNet\Exception\InvalidBodyParameterType;
use ToshY\BunnyNet\Exception\InvalidQueryParameterRequirement;
use ToshY\BunnyNet\Exception\InvalidQueryParameterType;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest extends Guzzle
{
    /** @var string */
    protected const SCHEME = 'https';

    /** @var string */
    protected string $apiKey;

    /** @var string */
    protected string $hostRequest;

    /**
     * AbstractRequest constructor.
     * @param string $hostRequest
     */
    protected function __construct(string $hostRequest)
    {
        parent::__construct();
        $this->hostRequest = $hostRequest;
    }

    /**
     * @return string
     */
    private function getHostRequest(): string
    {
        return $this->hostRequest;
    }

    /**
     * @param array $endpoint
     * @param array $pathParameters
     * @param array $query
     * @param null $body
     * @return array
     * @throws GuzzleException
     */
    protected function createRequest(
        array $endpoint,
        array $pathParameters = [],
        array $query = [],
        $body = null
    ): array {
        $options = array_filter(
            [
                'body' => $this->getBody($body),
                'headers' => array_merge(
                    $endpoint['headers'],
                    $this->getAccessKeyHeader()
                )
            ],
            function ($value) {
                return empty($value) === false;
            }
        );

        $base = $this->getHostRequest();
        $path = $this->createUrlPath($endpoint['path'], $pathParameters);
        $query = empty($query) === false ?
            sprintf(
                '?%s',
                http_build_query($query, '', '&', PHP_QUERY_RFC3986)
            )
            : null;

        $url = sprintf(
            '%s://%s%s%s',
            self::SCHEME,
            $base,
            $path,
            $query
        );

        $response = parent::request(
            $endpoint['method'],
            $url,
            $options
        );

        $responseBodyContents = $response->getBody()->getContents();

        try {
            $content = Utils::jsonDecode($responseBodyContents, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            $content = $responseBodyContents;
        }

        return [
            'content' => $content,
            'headers' => $response->getHeaders(),
            'status' => [
                'code' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
            ],
        ];
    }

    /**
     * @param string $template
     * @param array $pathCollection
     * @return string
     */
    protected function createUrlPath(string $template, array $pathCollection): string
    {
        return sprintf(
            sprintf('/%s', $template),
            ...array_map(
                function ($item) {
                    return ltrim($item, '/');
                },
                $pathCollection
            )
        );
    }

    /**
     * @param string $filePath
     * @return resource
     * @throws FileDoesNotExist
     */
    protected function openFileStream(string $filePath)
    {
        $fileStream = fopen($filePath, 'r');
        if ($fileStream === false) {
            throw new FileDoesNotExist(
                sprintf('The local file `%s` could not be opened. Please check if it exists.', $filePath)
            );
        }

        return $fileStream;
    }

    /**
     * @return array
     */
    private function getAccessKeyHeader(): array
    {
        return [
            'AccessKey' => $this->apiKey,
        ];
    }

    /**
     * @param $body
     */
    private function getBody($body)
    {
        if (is_array($body) === true) {
            return Utils::jsonEncode($body);
        }
        return $body;
    }

    /**
     * @param array $values
     * @param array $template
     * @return array
     * @throws InvalidQueryParameterRequirement
     * @throws InvalidQueryParameterType
     */
    protected function validateQueryField(array $values, array $template): array
    {
        $intersectTemplateKeys = array_intersect_key($template, $values);
        $intersectValues = array_intersect_key($values, $template);
        foreach ($intersectTemplateKeys as $key => $templateValue) {
            $parameterValue = $intersectValues[$key];
            $parameterValueType = gettype($parameterValue);

            // Field type check
            $typeCheck = sprintf('is_%s', $templateValue['type']);
            if ($typeCheck($parameterValue) === false) {
                throw new InvalidQueryParameterType(
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
                    throw new InvalidQueryParameterRequirement(
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
     * @param array $values
     * @param array $template
     * @return array
     * @throws InvalidBodyParameterType
     */
    protected function validateBodyField(array $values, array $template): array
    {
        $intersectTemplateKeys = array_intersect_key($template, $values);
        $intersectValues = array_intersect_key($values, $template);
        foreach ($intersectTemplateKeys as $key => $templateValue) {
            $parameterValue = $intersectValues[$key];
            $parameterValueType = gettype($parameterValue);

            // Field type check
            $typeCheck = sprintf('is_%s', $templateValue['type']);
            if ($typeCheck($parameterValue) === false) {
                throw new InvalidBodyParameterType(
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

    /**
     * @param string $methodName
     * @param string $key
     * @param array $templateValue
     * @param $parameterValue
     */
    private function recurseValidationOnArray(string $methodName, string $key, array $templateValue, $parameterValue)
    {
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
