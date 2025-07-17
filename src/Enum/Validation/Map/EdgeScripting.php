<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Code\GetCode;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Code\SetCode;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\AddEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\DeleteEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\GetEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\GetEdgeScriptStatistics;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\ListEdgeScripts;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\RotateDeploymentKey;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\UpdateEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\GetActiveReleases;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\GetReleases;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\PublishRelease;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\PublishReleaseByPathParameter;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\AddSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\DeleteSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\ListSecrets;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\UpdateSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\UpsertSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\AddVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\DeleteVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\GetVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\UpdateVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\UpsertVariable;

final class EdgeScripting
{
    /** @var array<class-string,ModelValidationStrategy> */
    public static array $map = [
        GetCode::class => ModelValidationStrategy::NONE,
        SetCode::class => ModelValidationStrategy::STRICT_BODY,
        DeleteEdgeScript::class => ModelValidationStrategy::STRICT_QUERY,
        GetEdgeScript::class => ModelValidationStrategy::NONE,
        UpdateEdgeScript::class => ModelValidationStrategy::STRICT_BODY,
        GetEdgeScriptStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        ListEdgeScripts::class => ModelValidationStrategy::STRICT_QUERY,
        AddEdgeScript::class => ModelValidationStrategy::STRICT_BODY,
        RotateDeploymentKey::class => ModelValidationStrategy::NONE,
        AddVariable::class => ModelValidationStrategy::STRICT_BODY,
        DeleteVariable::class => ModelValidationStrategy::NONE,
        GetVariable::class => ModelValidationStrategy::NONE,
        UpdateVariable::class => ModelValidationStrategy::STRICT_BODY,
        UpsertVariable::class => ModelValidationStrategy::STRICT_BODY,
        AddSecret::class => ModelValidationStrategy::STRICT_BODY,
        ListSecrets::class => ModelValidationStrategy::NONE,
        UpsertSecret::class => ModelValidationStrategy::STRICT_BODY,
        DeleteSecret::class => ModelValidationStrategy::NONE,
        UpdateSecret::class => ModelValidationStrategy::STRICT_BODY,
        GetActiveReleases::class => ModelValidationStrategy::NONE,
        GetReleases::class => ModelValidationStrategy::STRICT_QUERY,
        PublishRelease::class => ModelValidationStrategy::STRICT_BODY,
        PublishReleaseByPathParameter::class => ModelValidationStrategy::STRICT_BODY,
    ];
}
