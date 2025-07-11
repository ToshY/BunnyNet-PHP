<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Body;

use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class StrictBodyValidationStrategy implements BodyValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, EndpointBodyInterface $endpoint): void
    {
        ParameterValidator::validate($values, $endpoint->getBody());
    }
}
