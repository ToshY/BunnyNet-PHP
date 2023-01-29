<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class PurgeCache implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/purgeCache';
    }

    public function getHeaders(): array
    {
        return [
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            'CacheTag' => [
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
