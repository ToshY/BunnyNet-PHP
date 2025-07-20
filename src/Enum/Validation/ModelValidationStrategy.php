<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation;

use ToshY\BunnyNet\Enum\Validation\Map\Base;
use ToshY\BunnyNet\Enum\Validation\Map\EdgeScripting;
use ToshY\BunnyNet\Enum\Validation\Map\EdgeStorage;
use ToshY\BunnyNet\Enum\Validation\Map\Logging;
use ToshY\BunnyNet\Enum\Validation\Map\Shield;
use ToshY\BunnyNet\Enum\Validation\Map\Stream;
use ToshY\BunnyNet\Validation\Strategy\Body\LaxBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Body\NoBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Body\StrictBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\LaxQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\NoQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\StrictQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\ValidationModelStrategy;

enum ModelValidationStrategy
{
    case STRICT;

    case STRICT_QUERY;

    case STRICT_BODY;

    case LAX;

    case NONE;

    /**
     * @return array<class-string,ModelValidationStrategy>
     */
    public static function all(): array
    {
        return array_merge(
            Base::$map,
            EdgeScripting::$map,
            EdgeStorage::$map,
            Logging::$map,
            Shield::$map,
            Stream::$map,
        );
    }

    public function validationStrategy(): ValidationModelStrategy
    {
        return match ($this) {
            self::STRICT => new ValidationModelStrategy(
                query: new StrictQueryValidationStrategy(),
                body: new StrictBodyValidationStrategy(),
            ),
            self::STRICT_QUERY => new ValidationModelStrategy(
                query: new StrictQueryValidationStrategy(),
                body: new NoBodyValidationStrategy(),
            ),
            self::STRICT_BODY => new ValidationModelStrategy(
                query: new NoQueryValidationStrategy(),
                body: new StrictBodyValidationStrategy(),
            ),
            self::LAX => new ValidationModelStrategy(
                query: new LaxQueryValidationStrategy(),
                body: new LaxBodyValidationStrategy(),
            ),
            self::NONE => new ValidationModelStrategy(
                query: new NoQueryValidationStrategy(),
                body: new NoBodyValidationStrategy(),
            ),
        };
    }
}
