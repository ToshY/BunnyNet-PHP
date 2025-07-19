<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Client;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

interface BunnyHttpClientResponseInterface
{
    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * @return mixed
     */
    public function getContents(): mixed;

    /**
     * @return StreamInterface
     */
    public function getBody(): StreamInterface;

    /**
     * @return array<string,array<string>>
     */
    public function getHeaders(): array;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return string
     */
    public function getReasonPhrase(): string;
}
