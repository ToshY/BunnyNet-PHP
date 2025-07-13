<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\StorageZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateStorageZone implements ModelInterface, BodyModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'storagezone/%d';
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
            new AbstractParameter(name: 'ReplicationZones', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'OriginUrl', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Custom404FilePath', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Rewrite404To200', type: Type::BOOLEAN_TYPE),
        ];
    }
}
