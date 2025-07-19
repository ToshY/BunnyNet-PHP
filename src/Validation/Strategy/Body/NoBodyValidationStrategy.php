<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Body;

use ToshY\BunnyNet\Model\BodyModelInterface;

class NoBodyValidationStrategy implements BodyValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, BodyModelInterface $model): void
    {
    }
}
