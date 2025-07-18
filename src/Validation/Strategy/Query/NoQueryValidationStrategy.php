<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy\Query;

use ToshY\BunnyNet\Model\EndpointQueryInterface;

class NoQueryValidationStrategy implements QueryValidationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public static function validate(array $values, EndpointQueryInterface $endpoint): void
    {
    }
}
