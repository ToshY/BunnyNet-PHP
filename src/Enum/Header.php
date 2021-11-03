<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

/**
 * Class Header
 */
final class Header
{
    /** @var array */
    public const ACCEPT_JSON = [
        'Accept' => MimeType::JSON,
    ];

    /** @var array */
    public const ACCEPT_ALL = [
        'Accept' => MimeType::ALL,
    ];

    /** @var array */
    public const CONTENT_TYPE_JSON = [
        'Content-Type' => MimeType::JSON,
    ];

    /** @var array */
    public const CONTENT_TYPE_JSON_ALL = [
        'Content-Type' => MimeType::JSON_ALL,
    ];

    /** @var array */
    public const CONTENT_TYPE_OCTET_STREAM = [
        'Content-Type' => MimeType::OCTET_STREAM,
    ];
}
