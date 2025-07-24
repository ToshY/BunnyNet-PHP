<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

final class Endpoint
{
    /** @var string Base API endpoint */
    public const BASE = 'api.bunny.net';

    /** @var string Edge Scripting API endpoint */
    public const EDGE_SCRIPTING = self::BASE;

    /** @var string Shield API endpoint */
    public const SHIELD = self::BASE;

    /** @var string Stream API endpoint */
    public const STREAM = 'video.bunnycdn.com';

    /** @var string Logging API endpoint */
    public const LOGGING = 'logging.bunnycdn.com';

    /** @deprecated Will be removed in 7.1. Use Endpoint::EDGE_STORAGE_DE instead. */
    public const EDGE_STORAGE = self::EDGE_STORAGE_DE;

    /** @var string Storage Zone Region API Endpoint | Frankfurt (Germany) | Main */
    public const EDGE_STORAGE_DE = 'storage.bunnycdn.com';

    /** @deprecated Will be removed in 7.1. Use Endpoint::EDGE_STORAGE_DE instead. */
    public const EDGE_STORAGE_FS = self::EDGE_STORAGE_DE;

    /** @var string Storage Zone Region API Endpoint | London (United Kingdom) | Main */
    public const EDGE_STORAGE_UK = 'uk.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Norway (Stockholm) | Main */
    public const EDGE_STORAGE_SE = 'se.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint |Prague (Czech Republic) */
    public const EDGE_STORAGE_CZ = 'cz.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Madrid (Spain) */
    public const EDGE_STORAGE_ES = 'es.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | New York (United States East) | Main */
    public const EDGE_STORAGE_NY = 'ny.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Los Angeles (United States West) | Main */
    public const EDGE_STORAGE_LA = 'la.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Seattle (United States West) */
    public const EDGE_STORAGE_WA = 'wa.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Miami (United States East) */
    public const EDGE_STORAGE_MI = 'mi.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Singapore (Singapore) | Main */
    public const EDGE_STORAGE_SG = 'sg.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Hong Kong (SAR of China) */
    public const EDGE_STORAGE_HK = 'hk.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Tokyo (Japan) */
    public const EDGE_STORAGE_JP = 'jp.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Sydney (Oceania) | Main */
    public const EDGE_STORAGE_SYD = 'syd.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Sao Paolo (Brazil) | Main */
    public const EDGE_STORAGE_BR = 'br.storage.bunnycdn.com';

    /** @var string Storage Zone Region API Endpoint | Johannesburg (Africa) | Main */
    public const EDGE_STORAGE_JH = 'jh.storage.bunnycdn.com';
}
