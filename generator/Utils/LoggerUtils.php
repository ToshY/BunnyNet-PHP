<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Utils;

final class LoggerUtils
{
    public static bool $debug = false;

    public static function print(string $message): void
    {
        if (self::$debug !== true) {
            return;
        }

        echo $message;
    }
}
