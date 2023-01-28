<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\StreamVideoLibrary;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class UpdateVideoLibrary implements GenericEndpointInterface
{
    public function getMethod(): string
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
                'type' => 'string',
            ],
            'CustomHTML' => [
                'type' => 'string',
            ],
            'PlayerKeyColor' => [
                'type' => 'string',
            ],
            'EnableTokenAuthentication' => [
                'type' => 'bool',
            ],
            'EnableTokenIPVerification' => [
                'type' => 'bool',
            ],
            'ResetToken' => [
                'type' => 'bool',
            ],
            'WatermarkPositionLeft' => [
                'type' => 'int',
            ],
            'WatermarkPositionTop' => [
                'type' => 'int',
            ],
            'WatermarkWidth' => [
                'type' => 'int',
            ],
            'WatermarkHeight' => [
                'type' => 'int',
            ],
            'EnabledResolutions' => [
                'type' => 'string',
            ],
            'ViAiPublisherId' => [
                'type' => 'string',
            ],
            'VastTagUrl' => [
                'type' => 'string',
            ],
            'WebhookUrl' => [
                'type' => 'string',
            ],
            'CaptionsFontSize' => [
                'type' => 'int',
            ],
            'CaptionsFontColor' => [
                'type' => 'string',
            ],
            'CaptionsBackground' => [
                'type' => 'string',
            ],
            'UILanguage' => [
                'type' => 'string',
            ],
            'AllowEarlyPlay' => [
                'type' => 'bool',
            ],
            'PlayerTokenAuthenticationEnabled' => [
                'type' => 'bool',
            ],
            'BlockNoneReferrer' => [
                'type' => 'bool',
            ],
            'EnableMP4Fallback' => [
                'type' => 'bool',
            ],
            'KeepOriginalFiles' => [
                'type' => 'bool',
            ],
            'AllowDirectPlay' => [
                'type' => 'bool',
            ],
            'EnableDRM' => [
                'type' => 'bool',
            ],
            'Controls' => [
                'type' => 'string',
            ],
            'Bitrate240p' => [
                'type' => 'int',
            ],
            'Bitrate360p' => [
                'type' => 'int',
            ],
            'Bitrate480p' => [
                'type' => 'int',
            ],
            'Bitrate720p' => [
                'type' => 'int',
            ],
            'Bitrate1080p' => [
                'type' => 'int',
            ],
            'Bitrate1440p' => [
                'type' => 'int',
            ],
            'Bitrate2160p' => [
                'type' => 'int',
            ],
            'ShowHeatmap' => [
                'type' => 'bool',
            ],
            'EnableContentTagging' => [
                'type' => 'bool',
            ],
            'FontFamily' => [
                'type' => 'string',
            ],
        ];
    }
}
