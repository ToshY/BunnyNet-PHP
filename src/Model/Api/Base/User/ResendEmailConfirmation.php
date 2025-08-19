<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\User;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

/**
 * @note no longer in OpenAPI spec
 */
class ResendEmailConfirmation implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'user/resend-email-confirmation';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
