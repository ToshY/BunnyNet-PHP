<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

enum ValidationType
{
    /** model-based validation */
    case MODEL;

    /** no validation */
    case NONE;

    /**
     * @param array<class-string,ModelStrategy> $modelStrategyOverride
     * @return array<class-string,ModelStrategy>
     */
    public function getStrategy(array $modelStrategyOverride): array
    {
        return match ($this) {
            self::NONE => [],
            self::MODEL => array_merge(
                ModelStrategy::all(),
                $modelStrategyOverride,
            ),
        };
    }
}
