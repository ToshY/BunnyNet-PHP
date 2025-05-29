<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Model;

/**
 * @note Duplicate class required with custom enum cases object and mixed
 * @see \ToshY\BunnyNet\Enum\Type
 */
enum Type: string
{
    case BOOLEAN_TYPE = 'bool';
    case INT_TYPE = 'int';
    case NUMERIC_TYPE = 'numeric';
    case STRING_TYPE = 'string';
    case ARRAY_TYPE = 'array';
    case OBJECT_TYPE = 'object';
    case MIXED_TYPE = 'mixed';
}
