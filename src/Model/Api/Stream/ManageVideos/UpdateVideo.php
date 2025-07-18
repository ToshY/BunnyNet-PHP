<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateVideo implements ModelInterface, BodyModelInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'title', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'collectionId', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'chapters', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'title', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'start', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'end', type: Type::INT_TYPE),
                ]),
            ]),
            new AbstractParameter(name: 'moments', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'label', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'timestamp', type: Type::INT_TYPE),
                ]),
            ]),
            new AbstractParameter(name: 'metaTags', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'property', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'value', type: Type::STRING_TYPE),
                ]),
            ]),
        ];
    }
}
