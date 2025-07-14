<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\ModelStrategy;
use ToshY\BunnyNet\Exception\Validation\BunnyValidatorExceptionInterface;
use ToshY\BunnyNet\Helper\BunnyValidatorHelper;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class BunnyValidator
{
    /** @var array<class-string,ModelStrategy> $modelStrategy */
    private array $modelStrategy;

    /**
     * @param array<class-string,ModelStrategy> $modelStrategyOverride
     */
    public function __construct(
        array $modelStrategyOverride = [],
    ) {
        $this->modelStrategy = array_merge(
            ModelStrategy::all(),
            $modelStrategyOverride,
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

        /** @var ModelStrategy $modelStrategy */
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

        /** @var ModelStrategy $modelStrategy */
        $modelStrategy = $this->modelStrategy[$model::class];
        $bodyStrategy = $modelStrategy->validationStrategy()->body;

        $values = BunnyValidatorHelper::getBodyValue($model);

        $bodyStrategy::validate($values, $model);
    }
}
