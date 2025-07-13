<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class FetchVideo implements ModelInterface, QueryModelInterface, BodyModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/fetch';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'collectionId', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'thumbnailTime', type: Type::INT_TYPE),
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'url', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'headers', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'title', type: Type::STRING_TYPE),
        ];
    }
}
