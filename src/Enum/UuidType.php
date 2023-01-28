<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

final class UuidType
{
    /** @var string Standard UUIDv4 format for API keys */
    public const UUID_36 = '/^'
    . '[0-9A-F]{8}-'
    . '[0-9A-F]{4}-'
    . '4[0-9A-F]{3}-'
    . '[89AB][0-9A-F]{3}-'
    . '[0-9A-F]{12}'
    . '$/i';

    /** @var string Double UUIDv4 format for account API key */
    public const UUID_72 = '/^'
    . '[0-9A-F]{8}-'
    . '[0-9A-F]{4}-'
    . '4[0-9A-F]{3}-'
    . '[89AB][0-9A-F]{3}-'
    . '[0-9A-F]{12}'
    . '[0-9A-F]{8}-'
    . '[0-9A-F]{4}-'
    . '4[0-9A-F]{3}-'
    . '[89AB][0-9A-F]{3}-'
    . '[0-9A-F]{12}'
    . '$/i';
}
