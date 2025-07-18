<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Query;

use ToshY\BunnyNet\Model\EndpointQueryInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class StrictQueryValidationStrategy implements QueryValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, EndpointQueryInterface $endpoint): void
    {
        ParameterValidator::validate($values, $endpoint->getQuery());
    }
}
