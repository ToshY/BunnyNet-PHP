<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\User;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class ResetWhatsNew implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'user/whatsnew/reset';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
