<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class ResetPasswordByPathParameter implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'videolibrary/%d/resetApiKey';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
