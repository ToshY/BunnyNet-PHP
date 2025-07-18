<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation\Strategy;

use ToshY\BunnyNet\Validation\Strategy\Body\BodyValidationStrategyInterface;
use ToshY\BunnyNet\Validation\Strategy\Query\QueryValidationStrategyInterface;

/**
 * @internal
 */
final class ValidationModelStrategy
{
    public function __construct(
        public readonly QueryValidationStrategyInterface $query,
        public readonly BodyValidationStrategyInterface $body,
    ) {
    }
}
