<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class UploadVideo implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @param mixed $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
        #[PathProperty]
        public readonly string $videoId,
        #[BodyProperty]
        public readonly mixed $body,
        #[QueryProperty]
        public readonly array $query = [],
    ) {
    }

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
            new AbstractParameter(name: 'generateTitle', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateDescription', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateChapters', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateMoments', type: Type::BOOLEAN_TYPE),
        ];
    }
}
