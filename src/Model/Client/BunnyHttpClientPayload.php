<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Client;

/**
 * @internal
 */
final class BunnyHttpClientPayload
{
    /** @var array<string,mixed> */
    public array $path;

    /** @var array<string,mixed>  */
    public array $query;

    public mixed $body;

    /** @var array<string,string> */
    public array $headers = [];
}
