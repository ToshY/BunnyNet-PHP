<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Pods;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class RecreatePod implements ModelInterface
{
    /**
     * @param string $appId
     * @param string $podId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
        #[PathProperty]
        public readonly string $podId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'apps/%s/pods/%s/recreate';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
