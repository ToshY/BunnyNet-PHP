<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Applications;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class UndeployApplication implements ModelInterface
{
    /**
     * @param string $appId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'apps/%s/undeploy';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
