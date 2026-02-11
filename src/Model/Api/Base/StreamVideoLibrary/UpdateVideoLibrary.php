<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateVideoLibrary implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $id,
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
        return 'videolibrary/%d';
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
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'CustomHTML', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'PlayerKeyColor', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'EnableTokenAuthentication', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTokenIPVerification', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'ResetToken', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'WatermarkPositionLeft', type: Type::INT_TYPE),
            new AbstractParameter(name: 'WatermarkPositionTop', type: Type::INT_TYPE),
            new AbstractParameter(name: 'WatermarkWidth', type: Type::INT_TYPE),
            new AbstractParameter(name: 'WatermarkHeight', type: Type::INT_TYPE),
            new AbstractParameter(name: 'EnabledResolutions', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ViAiPublisherId', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'VastTagUrl', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'WebhookUrl', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'CaptionsFontSize', type: Type::INT_TYPE),
            new AbstractParameter(name: 'CaptionsFontColor', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'CaptionsBackground', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'UILanguage', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'AllowEarlyPlay', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'PlayerTokenAuthenticationEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'BlockNoneReferrer', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableMP4Fallback', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'KeepOriginalFiles', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'AllowDirectPlay', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableDRM', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'DrmVersion', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Controls', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'PlaybackSpeeds', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Bitrate240p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Bitrate360p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Bitrate480p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Bitrate720p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Bitrate1080p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Bitrate1440p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'Bitrate2160p', type: Type::INT_TYPE),
            new AbstractParameter(name: 'ShowHeatmap', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableContentTagging', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'FontFamily', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'EnableTranscribing', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingTitleGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingDescriptionGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingChaptersGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableTranscribingMomentsGeneration', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'TranscribingCaptionLanguages', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'EnableCaptionsInPlaylist', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'RememberPlayerPosition', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableMultiAudioTrackSupport', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'UseSeparateAudioStream', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'JitEncodingEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EncodingTier', type: Type::INT_TYPE),
            new AbstractParameter(name: 'OutputCodecs', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'AppleFairPlayDrm', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
            ]),
            new AbstractParameter(name: 'GoogleWidevineDrm', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'Enabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'SdOnlyForL3', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'MinClientSecurityLevel', type: Type::INT_TYPE),
            ]),
            new AbstractParameter(name: 'PlayerVersion', type: Type::INT_TYPE),
            new AbstractParameter(name: 'RemoveMetadataFromFallbackVideos', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'ScaleVideoUsingBothDimensions', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'ExposeOriginals', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'ExposeVideoMetadata', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'EnableLive', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'Live', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'EnableCountdown', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'EnableVideoOnDemand', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'EnableDvr', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'DvrTimeframeSeconds', type: Type::INT_TYPE),
                new AbstractParameter(name: 'PreStreamTrailerVideoId', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'WatermarkPositionLeft', type: Type::INT_TYPE),
                new AbstractParameter(name: 'WatermarkPositionTop', type: Type::INT_TYPE),
                new AbstractParameter(name: 'WatermarkWidth', type: Type::INT_TYPE),
                new AbstractParameter(name: 'WatermarkHeight', type: Type::INT_TYPE),
                new AbstractParameter(name: 'RtmpOutputs', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'Endpoint', type: Type::STRING_TYPE),
                        new AbstractParameter(name: 'StreamKey', type: Type::STRING_TYPE),
                    ]),
                ]),
            ]),
        ];
    }
}
