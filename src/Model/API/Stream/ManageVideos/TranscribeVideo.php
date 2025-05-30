<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;
use ToshY\BunnyNet\Model\EndpointQueryInterface;

class TranscribeVideo implements EndpointInterface, EndpointQueryInterface, EndpointBodyInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/transcribe';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'language', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'force', type: Type::BOOLEAN_TYPE),
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'targetLanguages', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'generateTitle', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateDescription', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'sourceLanguage', type: Type::STRING_TYPE),
        ];
    }
}
