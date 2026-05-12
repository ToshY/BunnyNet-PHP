<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class AddVideoLibrary implements ModelInterface, BodyModelInterface
{
    /**
     * @param array<string,mixed> $body
     */
    public function __construct(
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
        return 'videolibrary';
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'ReplicationRegions', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'PlayerVersion', type: Type::INT_TYPE),
            new AbstractParameter(name: 'EncodingTier', type: Type::INT_TYPE),
            new AbstractParameter(name: 'JitEncodingEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'OutputCodecs', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'EnabledResolutions', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'BlockNoneReferrer', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableMP4Fallback', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'KeepOriginalFiles', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'AllowDirectPlay', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableMultiAudioTrackSupport', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribing', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'TranscribingCaptionLanguages', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'EnableTranscribingTitleGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingDescriptionGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingChaptersGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingMomentsGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'AllowEarlyPlay', type: Type::BOOLEAN_TYPE),
        ];
    }
}
