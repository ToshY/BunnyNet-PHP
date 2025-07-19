<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Query;

use ToshY\BunnyNet\Exception\Validation\BunnyValidatorExceptionInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

interface QueryValidationStrategyInterface
{
    /**
     * @throws BunnyValidatorExceptionInterface
     * @param array<string,mixed> $values
     */
    public static function validate(array $values, QueryModelInterface $model): void;
}
