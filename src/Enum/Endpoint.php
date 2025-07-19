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

    /** @var string Storage API endpoint */
    public const EDGE_STORAGE = 'storage.bunnycdn.com';

    /** Frankfurt (Germany) | Main */
    public const EDGE_STORAGE_DE = self::EDGE_STORAGE;

    /** Falkenstein (Germany) | Main */
    public const EDGE_STORAGE_FS = self::EDGE_STORAGE;

    /** London (United Kingdom) | Main */
    public const EDGE_STORAGE_UK = 'uk.storage.bunnycdn.com';

    /** Norway (Stockholm) | Main */
    public const EDGE_STORAGE_SE = 'se.storage.bunnycdn.com';

    /** Prague (Czech Republic) */
    public const EDGE_STORAGE_CZ = 'cz.storage.bunnycdn.com';

    /** Madrid (Spain) */
    public const EDGE_STORAGE_ES = 'es.storage.bunnycdn.com';

    /** New York (United States East) | Main */
    public const EDGE_STORAGE_NY = 'ny.storage.bunnycdn.com';

    /** Los Angeles (United States West) | Main */
    public const EDGE_STORAGE_LA = 'la.storage.bunnycdn.com';

    /** Seattle (United States West) */
    public const EDGE_STORAGE_WA = 'wa.storage.bunnycdn.com';

    /** Miami (United States East) */
    public const EDGE_STORAGE_MI = 'mi.storage.bunnycdn.com';

    /** Singapore (Singapore) | Main */
    public const EDGE_STORAGE_SG = 'sg.storage.bunnycdn.com';

    /** Hong Kong (SAR of China) */
    public const EDGE_STORAGE_HK = 'hk.storage.bunnycdn.com';

    /** Tokyo (Japan) */
    public const EDGE_STORAGE_JP = 'jp.storage.bunnycdn.com';

    /** Sydney (Oceania) | Main */
    public const EDGE_STORAGE_SYD = 'syd.storage.bunnycdn.com';

    /** Sao Paolo (Brazil) | Main */
    public const EDGE_STORAGE_BR = 'br.storage.bunnycdn.com';

    /** Johannesburg (Africa) | Main */
    public const EDGE_STORAGE_JH = 'jh.storage.bunnycdn.com';
}
