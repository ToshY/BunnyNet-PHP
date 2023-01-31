<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

enum Region
{
    /** Germany (Falkenstein / Frankfurt) */
    case DE;
    case FS;

    /** United States (New York) */
    case NY;

    /** United States (Lost Angeles) */
    case LA;

    /** Singapore (Singapore) */
    case SG;

    /** Sidney (Oceania) */
    case SYD;

    /** London (United Kingdom) */
    case UK;

    /** Norway (Stockholm) */
    case SE;

    /** Brazil (Sao Paolo) */
    case BR;

    /** Africa (Johannesburg) */
    case JH;

    public function host(): string
    {
        $subdomain = sprintf('%s.', strtolower($this->name));
        if (in_array($this->name, [self::DE->name, self::FS->name]) === true) {
            $subdomain = '';
        }
        return $subdomain . Host::STORAGE_ENDPOINT;
    }
}
