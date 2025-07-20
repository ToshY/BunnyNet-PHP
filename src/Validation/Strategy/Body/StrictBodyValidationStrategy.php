<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Body;

use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class StrictBodyValidationStrategy implements BodyValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, BodyModelInterface $model): void
    {
        ParameterValidator::validate($values, $model->getBody());
    }
}
