<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Nyholm\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use ToshY\BunnyNet\Exception\Client\BunnyHttpClientResponseException;
use ToshY\BunnyNet\Exception\Client\BunnyJsonException;
use ToshY\BunnyNet\Helper\BunnyHttpClientHelper;
use ToshY\BunnyNet\Model\Client\BunnyHttpClientResponseInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class BunnyHttpClient
{
    public function __construct(
        protected readonly ClientInterface $client,
        protected readonly string $apiKey,
        protected readonly string $baseUrl,
    ) {
    }

    /**
     * @throws BunnyHttpClientResponseException
     * @throws ClientExceptionInterface
     * @throws BunnyJsonException
     * @return BunnyHttpClientResponseInterface
     * @param ModelInterface $model
     */
    public function request(
        ModelInterface $model,
    ): BunnyHttpClientResponseInterface {
        $payload = BunnyHttpClientHelper::createPayload(
            model: $model,
        );
        $payload->headers['AccessKey'] = $this->apiKey;

        $path = BunnyHttpClientHelper::createPath(
            model: $model,
            payload: $payload,
        );

        $query = BunnyHttpClientHelper::createQuery(
            payload: $payload,
        );

        $url = BunnyHttpClientHelper::createUrl(
            baseUrl: $this->baseUrl,
            path: $path,
            query: $query,
        );

        $headers = BunnyHttpClientHelper::createHeaders(
            model: $model,
            payload: $payload,
        );

        $body = BunnyHttpClientHelper::createBody($payload);

        $request = new Request(
            method: $model->getMethod()->value,
            uri: $url,
            headers: $headers,
            body: $body,
        );

        $response = $this->client->sendRequest(
            request: $request,
        );

        return BunnyHttpClientHelper::parseResponse(
            request: $request,
            response: $response,
        );
    }
}
