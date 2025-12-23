<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageLiveStreams;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class StopStream implements ModelInterface
{
    /**
     * @param int $libraryId
     * @param string $streamId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
        #[PathProperty]
        public readonly string $streamId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return 'library/%d/live/%s/stop';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
