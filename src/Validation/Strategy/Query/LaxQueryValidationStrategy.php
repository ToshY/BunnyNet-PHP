<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Query;

use ToshY\BunnyNet\Exception\Validation\UnexpectedParameterForObjectException;
use ToshY\BunnyNet\Model\EndpointQueryInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class LaxQueryValidationStrategy implements QueryValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, EndpointQueryInterface $endpoint): void
    {
        try {
            ParameterValidator::validate($values, $endpoint->getQuery());
        } catch (UnexpectedParameterForObjectException) {
            return;
        }
    }
}
