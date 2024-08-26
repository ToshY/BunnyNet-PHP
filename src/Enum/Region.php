<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

enum Region: string
{
    /** Falkenstein / Frankfurt (Germany) | Main */
    case DE = 'DE';
    case FS = 'FS';

    /** London (United Kingdom) | Main */
    case UK = 'UK';

    /** Norway (Stockholm) | Main */
    case SE = 'SE';

    /** Prague (Czech Republic) */
    case CZ = 'CZ';

    /** Madrid (Spain) */
    case ES = 'ES';

    /** New York (United States East) | Main */
    case NY = 'NY';

    /** Los Angeles (United States West) | Main */
    case LA = 'LA';

    /** Seattle (United States West) */
    case WA = 'WA';

    /** Miami (United States East) */
    case MI = 'MI';

    /** Singapore (Singapore) | Main */
    case SG = 'SG';

    /** Hong Kong (SAR of China) */
    case HK = 'HK';

    /** Tokyo (Japan) */
    case JP = 'JP';

    /** Sydney (Oceania) | Main */
    case SYD = 'SYD';

    /** Sao Paolo (Brazil) | Main */
    case BR = 'BR';

    /** Johannesburg (Africa) | Main */
    case JH = 'JH';

    public function host(): string
    {
        return match ($this) {
            self::DE, self::FS => Host::STORAGE_ENDPOINT,
            default => sprintf('%s.%s', strtolower($this->value), Host::STORAGE_ENDPOINT),
        };
    }
}
