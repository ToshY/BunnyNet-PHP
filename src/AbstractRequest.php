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
            array_map(
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
                sprintf(
                    'The local file `%s` could not be opened. Please check if it exists.',
                    $filePath
                )
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
        switch ($body){
            case is_array($body):
                return Utils::jsonEncode($body);
            case is_resource($body):
            case is_null($body):
            default:
                return $body;
        }
    }
}
