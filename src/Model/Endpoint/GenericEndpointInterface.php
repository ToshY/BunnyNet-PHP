<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint;

interface GenericEndpointInterface
{
    public function getMethod(): string;

    public function getPath(): string;

    public function getHeaders(): array;
}
