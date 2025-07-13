<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Query;

use ToshY\BunnyNet\Exception\Validation\UnexpectedParameterForObjectException;
use ToshY\BunnyNet\Model\QueryModelInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class LaxQueryValidationStrategy implements QueryValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, QueryModelInterface $model): void
    {
        try {
            ParameterValidator::validate($values, $model->getQuery());
        } catch (UnexpectedParameterForObjectException) {
            return;
        }
    }
}
