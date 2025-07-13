<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateEdgeScript implements ModelInterface, BodyModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ScriptType', type: Type::INT_TYPE),
        ];
    }
}
