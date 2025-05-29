<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Utils;

final class ArrayUtils
{
    /**
     * @param array<mixed> $old
     * @param array<mixed> $new
     * @return array<mixed>
     */
    public static function getArrayDifferenceKeyValue(array $old, array $new): array
    {
        return [
            'add' => array_diff_key($new, $old),
            'update' => array_diff(array_intersect_key($new, $old), array_intersect_key($old, $new)),
            'delete' => array_diff_key($old, $new),
        ];
    }
}
