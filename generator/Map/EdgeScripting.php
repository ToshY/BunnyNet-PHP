<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\API\EdgeScripting\Code\GetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\SetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\AddEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\DeleteEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScriptStatistics;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\ListEdgeScripts;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\RotateDeploymentKey;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\UpdateEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\GetActiveReleases;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\GetReleases;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\PublishRelease;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\PublishReleaseByPathParameter;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\AddSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\DeleteSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\ListSecrets;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\UpdateSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\UpsertSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\AddVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\DeleteVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\GetVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpdateVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpsertVariable;

final class EdgeScripting
{
    /** @var array<string,array<string,class-string|null>> */
    public static array $endpoints = [
        '/compute/script/{id}/code' => [
            'get' => GetCode::class,
            'post' => SetCode::class,
        ],
        '/compute/script/{id}' => [
            'get' => GetEdgeScript::class,
            'post' => UpdateEdgeScript::class,
            'delete' => DeleteEdgeScript::class,
        ],
        '/compute/script/{id}/statistics' => [
            'get' => GetEdgeScriptStatistics::class,
        ],
        '/compute/script' => [
            'get' => ListEdgeScripts::class,
            'post' => AddEdgeScript::class,
        ],
        '/compute/script/{id}/deploymentKey/rotate' => [
            'post' => RotateDeploymentKey::class,
        ],
        '/compute/script/{id}/variables/add' => [
            'post' => AddVariable::class,
        ],
        '/compute/script/{id}/variables/{variableId}' => [
            'get' => GetVariable::class,
            'post' => UpdateVariable::class,
            'delete' => DeleteVariable::class,
        ],
        '/compute/script/{id}/variables' => [
            'put' => UpsertVariable::class,
        ],
        '/compute/script/{id}/secrets' => [
            'get' => ListSecrets::class,
            'put' => UpsertSecret::class,
            'post' => AddSecret::class,
        ],
        '/compute/script/{id}/secrets/{secretId}' => [
            'post' => UpdateSecret::class,
            'delete' => DeleteSecret::class,
        ],
        '/compute/script/{id}/releases/active' => [
            'get' => GetActiveReleases::class,
        ],
        '/compute/script/{id}/releases' => [
            'get' => GetReleases::class,
        ],
        '/compute/script/{id}/publish' => [
            'post' => PublishRelease::class,
        ],
        '/compute/script/{id}/publish/{uuid}' => [
            'post' => PublishReleaseByPathParameter::class,
        ],
    ];
}
