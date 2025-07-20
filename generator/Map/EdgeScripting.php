<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

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
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\PublishReleaseByUuid;
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

/**
 * @internal
 */
final class EdgeScripting
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
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
            'post' => PublishReleaseByUuid::class,
        ],
    ];
}
