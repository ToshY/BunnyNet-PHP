<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Body;

use ToshY\BunnyNet\Exception\Validation\BunnyValidatorExceptionInterface;
use ToshY\BunnyNet\Model\BodyModelInterface;

interface BodyValidationStrategyInterface
{
    /**
     * @throws BunnyValidatorExceptionInterface
     * @param array<string,mixed> $values
     */
    public static function validate(array $values, BodyModelInterface $model): void;
}
