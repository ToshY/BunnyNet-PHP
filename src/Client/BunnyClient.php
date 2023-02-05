<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Client;

use Exception;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Exception\InvalidJSONForBodyException;
use ToshY\BunnyNet\Model\EndpointInterface;

class BunnyClient
{
    protected const SCHEME = 'https';

    protected readonly string $apiKey;

    public readonly string $baseUrl;

    public function __construct(
        protected readonly ClientInterface $client,
    ) {
    }

    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws InvalidJSONForBodyException
     */
    public function request(
        EndpointInterface $endpoint,
        array $parameters = [],
        array $query = [],
        mixed $body = null,
        array $headers = [],
    ): ResponseInterface {
        $headers = array_filter(
            [
                'headers' => array_merge(
                    $headers,
                    array_merge(...$endpoint->getHeaders()),
                    $this->getAccessKeyHeader()
                ),
            ],
            fn ($value) => empty($value) === false
        );

        $path = $this->createUrlPath(
            template: $endpoint->getPath(),
            pathCollection: $parameters
        );
        $query = $this->createQuery($query);

        $url = sprintf(
            '%s://%s%s%s',
            self::SCHEME,
            $this->baseUrl,
            $path,
            $query
        );

        $request = new Request(
            method: $endpoint->getMethod()->value,
            uri: $url,
            headers: $headers,
            body: $this->getBody($body),
        );

        return $this->client->sendRequest(
            request: $request
        );
    }

    private function createUrlPath(
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

    private function createQuery(array $query): string|null
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
}
