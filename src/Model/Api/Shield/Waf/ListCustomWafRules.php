<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\Waf;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class ListCustomWafRules implements ModelInterface, QueryModelInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/waf/custom-rules/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'page', type: Type::INT_TYPE),
            new AbstractParameter(name: 'perPage', type: Type::INT_TYPE),
        ];
    }
}
