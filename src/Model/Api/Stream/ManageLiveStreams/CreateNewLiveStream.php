<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageLiveStreams;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class CreateNewLiveStream implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $libraryId,
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
        return 'library/%d/live';
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
            new AbstractParameter(name: 'title', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'description', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'collectionId', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'dvrEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'dvrWindowSeconds', type: Type::INT_TYPE),
            new AbstractParameter(name: 'recordVod', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'scheduledStartTime', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'scheduledEndTime', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'public', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'enableCountdown', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'rtmpOutputs', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
        ];
    }
}
