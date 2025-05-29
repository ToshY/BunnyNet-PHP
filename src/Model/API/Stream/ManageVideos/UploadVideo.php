<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;
use ToshY\BunnyNet\Model\EndpointQueryInterface;

class UploadVideo implements EndpointInterface, EndpointQueryInterface
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_OCTET_STREAM,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'jitEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'enabledResolutions', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'enabledOutputCodecs', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'transcribeEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'transcribeLanguages', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'sourceLanguage', type: Type::STRING_TYPE),
        ];
    }
}
