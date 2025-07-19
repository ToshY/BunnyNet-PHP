<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Query;

use ToshY\BunnyNet\Model\QueryModelInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class StrictQueryValidationStrategy implements QueryValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, QueryModelInterface $model): void
    {
        ParameterValidator::validate($values, $model->getQuery());
    }
}
