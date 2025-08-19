<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\User;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

/**
 * @note no longer in OpenAPI spec
 */
class ListCloseAccountReasons implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'user/closeaccount/reasons-list';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
