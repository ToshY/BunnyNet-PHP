<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\User;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class SetNotificationsOpened implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'user/setNotificationsOpened';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
