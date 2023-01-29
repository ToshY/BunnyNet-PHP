<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

enum Type: string
{
    case BOOLEAN_TYPE = 'bool';
    case INT_TYPE = 'int';
    case NUMERIC_TYPE = 'numeric';
    case STRING_TYPE = 'string';
    case ARRAY_TYPE = 'array';

    case UUID36_TYPE = '/^'
    . '[0-9A-F]{8}-'
    . '[0-9A-F]{4}-'
    . '4[0-9A-F]{3}-'
    . '[89AB][0-9A-F]{3}-'
    . '[0-9A-F]{12}'
    . '$/i';

    case UUID72_TYPE = '/^'
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
