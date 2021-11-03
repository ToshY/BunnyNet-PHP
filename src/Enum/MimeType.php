<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

/**
 * Class MimeType
 */
final class MimeType
{
    /** @var string */
    public const ALL = '*/*';

    /** @var string */
    public const JSON = 'application/json';

    /** @var string */
    public const JSON_ALL = 'application/*+json';

    /** @var string */
    public const OCTET_STREAM = 'application/octet-stream';
}
