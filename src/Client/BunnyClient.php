<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Client;

use Nyholm\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Model\EndpointInterface;

class BunnyClient
{
    protected const SCHEME = 'https';

    /**
     * @param ClientInterface $client
     * @param string|null $apiKey
     * @param string|null $baseUrl
     */
    public function __construct(
        protected readonly ClientInterface $client,
        protected string|null $apiKey = null,
        protected string|null $baseUrl = null,
    ) {
    }

    /**
     * @param string $apiKey
     * @return $this
     */
    public function setAPIKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $baseUrl
     * @return $this
     */
    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @throws ClientExceptionInterface
     * @param array<int,mixed> $parameters
     * @param array<string,mixed> $query
     * @param mixed|null $body
     * @param array<string,mixed> $headers
     * @return ResponseInterface
     * @param EndpointInterface $endpoint
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
                ...array_merge(
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
            body: $body,
        );

        return $this->client->sendRequest(
            request: $request
        );
    }

    /**
     * @param string $template
     * @param array<int,mixed> $pathCollection
     * @return string
     */
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

    /**
     * @param array<string,mixed> $query
     * @return string|null
     */
    private function createQuery(array $query): string|null
    {
        if (true === empty($query)) {
            return null;
        }

        foreach ($query as $key => $value) {
            if (false === is_bool($value)) {
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
     * @return string[]
     */
    private function getAccessKeyHeader(): array
    {
        return [
            'AccessKey' => $this->apiKey,
        ];
    }
}
