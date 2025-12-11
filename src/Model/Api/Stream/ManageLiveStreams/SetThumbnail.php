<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageLiveStreams;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class SetThumbnail implements ModelInterface, QueryModelInterface
{
    /**
     * @param int $libraryId
     * @param string $streamId
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
        #[PathProperty]
        public readonly string $streamId,
        #[QueryProperty]
        public readonly array $query = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/live/%s/thumbnail';
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
            new AbstractParameter(name: 'thumbnailUrl', type: Type::STRING_TYPE),
        ];
    }
}
