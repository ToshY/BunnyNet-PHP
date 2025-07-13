<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class RotateDeploymentKey implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script/%d/deploymentKey/rotate';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
