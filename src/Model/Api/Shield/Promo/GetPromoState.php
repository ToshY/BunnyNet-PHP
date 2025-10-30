<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\Promo;

use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetPromoState implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/promo/state';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
