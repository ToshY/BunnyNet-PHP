<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\ModelValidationStrategy;
use ToshY\BunnyNet\Exception\Validation\BunnyValidatorExceptionInterface;
use ToshY\BunnyNet\Helper\BunnyValidatorHelper;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class BunnyValidator
{
    /** @var array<class-string,ModelValidationStrategy> $modelStrategy */
    private array $modelStrategy;

    /**
     * @param array<class-string,ModelValidationStrategy> $strategyOverride
     */
    public function __construct(
        array $strategyOverride = [],
    ) {
        $this->modelStrategy = array_merge(
            ModelValidationStrategy::all(),
            $strategyOverride,
        );
    }

    /**
     * @throws BunnyValidatorExceptionInterface
     * @param QueryModelInterface $model
     * @return void
     */
    public function query(QueryModelInterface $model): void
    {
        $hasModelStrategy = isset($this->modelStrategy[$model::class]) === true;
        if ($hasModelStrategy === false) {
            return;
        }

        /** @var ModelValidationStrategy $modelStrategy */
        $modelStrategy = $this->modelStrategy[$model::class];
        $queryStrategy = $modelStrategy->validationStrategy()->query;

        $values = BunnyValidatorHelper::getQueryValue($model);

        $queryStrategy::validate($values, $model);
    }

    /**
     * @throws BunnyValidatorExceptionInterface
     * @param BodyModelInterface $model
     * @return void
     */
    public function body(BodyModelInterface $model): void
    {
        $hasModelStrategy = isset($this->modelStrategy[$model::class]) === true;
        if ($hasModelStrategy === false) {
            return;
        }

        /** @var ModelValidationStrategy $modelStrategy */
        $modelStrategy = $this->modelStrategy[$model::class];
        $bodyStrategy = $modelStrategy->validationStrategy()->body;

        $values = BunnyValidatorHelper::getBodyValue($model);

        $bodyStrategy::validate($values, $model);
    }
}
