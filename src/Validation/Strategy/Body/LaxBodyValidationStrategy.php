<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Body;

use ToshY\BunnyNet\Exception\Validation\UnexpectedParameterForObjectException;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class LaxBodyValidationStrategy implements BodyValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, BodyModelInterface $model): void
    {
        try {
            ParameterValidator::validate($values, $model->getBody());
        } catch (UnexpectedParameterForObjectException) {
            return;
        }
    }
}
