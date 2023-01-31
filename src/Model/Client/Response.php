<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Client;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Throwable;
use ToshY\BunnyNet\Client\BunnyClient;

class Response
{
    public function __construct(
        private readonly ResponseInterface $response
    ) {
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getContent(): array
    {
        try {
            $content = $this->response->toArray(BunnyClient::THROW_CLIENT_EXCEPTIONS);
        } catch (Throwable) {
            $content = $this->response->getContent(BunnyClient::THROW_CLIENT_EXCEPTIONS);
        }

        return $content;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getInfo(string $type = null): mixed
    {
        return $this->response->getInfo($type);
    }
}
