<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model;

use ToshY\BunnyNet\Enum\Method;

interface EndpointInterface
{
    public function getMethod(): Method;

    public function getPath(): string;

    public function getHeaders(): array;
}
