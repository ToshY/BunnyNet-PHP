<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class UpdateVideoLibrary implements EndpointInterface
{
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
        ];
    }

    public function getBody(): array
    {
        return [
            'Name' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'CustomHTML' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'PlayerKeyColor' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'EnableTokenAuthentication' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableTokenIPVerification' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'ResetToken' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'WatermarkPositionLeft' => [
                'type' => Type::INT_TYPE->value,
            ],
            'WatermarkPositionTop' => [
                'type' => Type::INT_TYPE->value,
            ],
            'WatermarkWidth' => [
                'type' => Type::INT_TYPE->value,
            ],
            'WatermarkHeight' => [
                'type' => Type::INT_TYPE->value,
            ],
            'EnabledResolutions' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ViAiPublisherId' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'VastTagUrl' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'WebhookUrl' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'CaptionsFontSize' => [
                'type' => Type::INT_TYPE->value,
            ],
            'CaptionsFontColor' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'CaptionsBackground' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'UILanguage' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'AllowEarlyPlay' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'PlayerTokenAuthenticationEnabled' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'BlockNoneReferrer' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableMP4Fallback' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'KeepOriginalFiles' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'AllowDirectPlay' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableDRM' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'Controls' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Bitrate240p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'Bitrate360p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'Bitrate480p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'Bitrate720p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'Bitrate1080p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'Bitrate1440p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'Bitrate2160p' => [
                'type' => Type::INT_TYPE->value,
            ],
            'ShowHeatmap' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'EnableContentTagging' => [
                'type' => Type::BOOLEAN_TYPE->value,
            ],
            'FontFamily' => [
                'type' => Type::STRING_TYPE->value,
            ],
        ];
    }
}
