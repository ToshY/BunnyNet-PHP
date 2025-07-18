<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Validation;

use ToshY\BunnyNet\Enum\ValidationType;
use ToshY\BunnyNet\Enum\ModelStrategy;
use ToshY\BunnyNet\Exception\Validation\BunnyValidatorExceptionInterface;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointQueryInterface;

class BunnyValidator
{
    /** @var array<class-string,ModelStrategy> $modelStrategy */
    private array $modelStrategy;

    /**
     * @param array<class-string,ModelStrategy> $modelStrategyOverride
     */
    public function __construct(
        ValidationType $validationType = ValidationType::MODEL,
        array $modelStrategyOverride = [],
    ) {
        $this->modelStrategy = $validationType->getStrategy($modelStrategyOverride);
    }

    /**
     * @throws BunnyValidatorExceptionInterface
     * @param array<string,mixed> $values
     * @param EndpointQueryInterface $endpoint
     * @return void
     */
    public function query(
        array $values,
        EndpointQueryInterface $endpoint,
    ): void {
        $hasModelStrategy = isset($this->modelStrategy[$endpoint::class]) === true;
        if ($hasModelStrategy === false) {
            return;
        }

        /** @var ModelStrategy $modelStrategy */
        $modelStrategy = $this->modelStrategy[$endpoint::class];
        $queryStrategy = $modelStrategy->validationStrategy()->query;

        $queryStrategy::validate($values, $endpoint);
    }

    /**
     * @throws BunnyValidatorExceptionInterface
     * @param array<string,mixed> $values
     * @param EndpointBodyInterface $endpoint
     * @return void
     */
    public function body(
        mixed $values,
        EndpointBodyInterface $endpoint,
    ): void {
        $hasModelStrategy = isset($this->modelStrategy[$endpoint::class]) === true;
        if ($hasModelStrategy === false) {
            return;
        }

        /** @var ModelStrategy $modelStrategy */
        $modelStrategy = $this->modelStrategy[$endpoint::class];
        $bodyStrategy = $modelStrategy->validationStrategy()->body;

        $bodyStrategy::validate($values, $endpoint);
    }
}
