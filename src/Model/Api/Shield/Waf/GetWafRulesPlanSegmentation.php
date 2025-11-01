<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\Waf;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetWafRulesPlanSegmentation implements ModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/waf/rules/plan-segmentation';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
