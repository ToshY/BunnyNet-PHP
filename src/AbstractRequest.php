<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Exception;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Utils;
use Psr\Http\Message\StreamInterface;
use ToshY\BunnyNet\Exception\FileDoesNotExist;
use ToshY\BunnyNet\Exception\InvalidBodyField;
use ToshY\BunnyNet\Exception\InvalidBodyParameterType;
use ToshY\BunnyNet\Exception\InvalidPathParameterField;
use ToshY\BunnyNet\Exception\InvalidPathParameterType;
use ToshY\BunnyNet\Exception\InvalidQueryParameterField;
use ToshY\BunnyNet\Exception\InvalidQueryParameterType;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest extends Guzzle
{
    /** @var string */
    protected string $apiKey;

    /**
     * @param string $method
     * @param string $base
     * @param string $path
     * @param array $query
     * @param array $headers
     * @param null $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    protected function createRequest(
        string $method,
        string $base,
        string $path,
        array $query = [],
        array $headers = [],
        $body = null
    ): StreamInterface {
        $options = array_filter(
            [
                'body' => $this->getBody($body),
                'headers' => array_merge(
                    $headers,
                    $this->getAccessKeyHeader()
                )
            ]
        );

        $base = parse_url($base);
        $query = empty($query) !== false ?
            sprintf(
                '?%s',
                http_build_query($query, '', '&', PHP_QUERY_RFC3986)
            )
            : null;

        $url = sprintf(
            'https://%s%s%s',
            $base['host'],
            $path,
            $query
        );

        $response = parent::request(
            $method,
            $url,
            $options
        );

        return $response->getBody();
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
     * @param array $values
     * @param array $template
     * @return array
     * @throws InvalidQueryParameterType
     */
    protected function validateQueryField(array $values, array $template)
    {
        return $this->getValidInputFields($values, $template, InvalidQueryParameterType::class);
    }

    /**
     * @param array $values
     * @param array $template
     * @return array
     * @throws InvalidBodyParameterType
     */
    protected function validateBodyField(array $values, array $template): array
    {
        return $this->getValidInputFields($values, $template, InvalidBodyParameterType::class);
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
     * @return string
     */
    private function getAccessKeyHeader(): string
    {
        return sprintf(
            'AccessKey: %s',
            $this->apiKey
        );
    }

    /**
     * @param $body
     * @return string|resource|null
     */
    private function getBody($body)
    {
        switch ($body) {
            case is_array($body):
                return Utils::jsonEncode($body);
            case is_resource($body):
            case is_null($body):
            default:
                return $body;
        }
    }

    /**
     * @param array $values
     * @param array $template
     * @param $exception
     * @return array
     * @throws InvalidPathParameterType|InvalidQueryParameterType|InvalidBodyParameterType
     */
    private function getValidInputFields(array $values, array $template, $exception): array
    {
        $intersectTemplateKeys = array_intersect_key($template, $values);
        $intersectValues = array_intersect_key($values, $template);
        foreach ($intersectTemplateKeys as $key => $templateValue) {
            $parameterValue = $intersectValues[$key];
            $parameterValueType = gettype($parameterValue);

            $typeCheck = sprintf('is_%s', $templateValue['type']);
            if ($typeCheck($parameterValue) === false) {
                throw new $exception(
                    sprintf(
                        'Invalid parameter type provided for `%s`. Expected `%s` got `%s`.',
                        $key,
                        $templateValue['type'],
                        $parameterValueType
                    )
                );
            }

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

                    $this->getValidInputFields($traverseParameterValue, $traverseTemplateValue, $exception);
                }
            }
        }

        return $intersectValues;
    }
}
