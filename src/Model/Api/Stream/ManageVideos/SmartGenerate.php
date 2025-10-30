<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class SmartGenerate implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
        #[PathProperty]
        public readonly string $videoId,
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/smart';
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
            new AbstractParameter(name: 'generateTitle', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateDescription', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateChapters', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'generateMoments', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'sourceLanguage', type: Type::STRING_TYPE),
        ];
    }
}
