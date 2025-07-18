<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Body;

use ToshY\BunnyNet\Exception\Validation\UnexpectedParameterForObjectException;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Validation\ParameterValidator;

class LaxBodyValidationStrategy implements BodyValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, EndpointBodyInterface $endpoint): void
    {
        try {
            ParameterValidator::validate($values, $endpoint->getBody());
        } catch (UnexpectedParameterForObjectException) {
            return;
        }
    }
}
