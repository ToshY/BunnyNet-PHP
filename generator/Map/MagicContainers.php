<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\AddApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\DeleteApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\DeployApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplicationOverview;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplicationStatistics;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplicationUsageSummary;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\ListApplications;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\PatchApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\RestartApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\UndeployApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Applications\UpdateApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\AutoscalingSettings\GetApplicationAutoscaling;
use ToshY\BunnyNet\Model\Api\MagicContainers\AutoscalingSettings\UpdateApplicationAutoscaling;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\AddContainerRegistry;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\DeleteContainerRegistry;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetContainerConfigSuggestions;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetContainerImageTagDigest;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetContainerRegistry;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetImageConfig;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\ListContainerImageTags;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\ListContainerImages;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\ListContainerRegistries;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\SearchForPublicContainerImages;
use ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\UpdateContainerRegistry;
use ToshY\BunnyNet\Model\Api\MagicContainers\Containers\AddApplicationContainerTemplate;
use ToshY\BunnyNet\Model\Api\MagicContainers\Containers\DeleteApplicationContainerTemplate;
use ToshY\BunnyNet\Model\Api\MagicContainers\Containers\GetApplicationContainerTemplate;
use ToshY\BunnyNet\Model\Api\MagicContainers\Containers\PatchApplicationContainerTemplate;
use ToshY\BunnyNet\Model\Api\MagicContainers\Containers\SetContainerEnvironmentVariables;
use ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\AddApplication as EndpointsAddApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\DeleteApplication as EndpointsDeleteApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\ListApplicationEndpoints;
use ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\UpdateApplication as EndpointsUpdateApplication;
use ToshY\BunnyNet\Model\Api\MagicContainers\Limits\GetLimits;
use ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\CreateLogForwardingConfiguration;
use ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\DeleteLogForwardingConfiguration;
use ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\GetLogForwardingConfiguration;
use ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\ListLogForwardingConfigurations;
use ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\UpdateLogForwardingConfiguration;
use ToshY\BunnyNet\Model\Api\MagicContainers\Nodes\ListNodes;
use ToshY\BunnyNet\Model\Api\MagicContainers\Nodes\ListNodesPlain;
use ToshY\BunnyNet\Model\Api\MagicContainers\Pods\RecreatePod;
use ToshY\BunnyNet\Model\Api\MagicContainers\RegionSettings\GetApplicationRegionSettings;
use ToshY\BunnyNet\Model\Api\MagicContainers\RegionSettings\UpdateApplicationRegionSettings;
use ToshY\BunnyNet\Model\Api\MagicContainers\Regions\GetOptimalBaseRegion;
use ToshY\BunnyNet\Model\Api\MagicContainers\Regions\ListRegions;
use ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\DeleteAllVolumeInstances;
use ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\DeleteVolumeInstance;
use ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\DetachVolume;
use ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\ListVolumes;
use ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\UpdateVolume;

/**
 * @internal
 */
final class MagicContainers
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
        '/apps/{appId}/deploy' => [
            'post' => DeployApplication::class,
        ],
        '/apps/{appId}/undeploy' => [
            'post' => UndeployApplication::class,
        ],
        '/apps/{appId}/statistics' => [
            'get' => GetApplicationStatistics::class,
        ],
        '/apps/{appId}/summary' => [
            'get' => GetApplicationUsageSummary::class,
        ],
        '/apps/{appId}/overview' => [
            'get' => GetApplicationOverview::class,
        ],
        '/apps' => [
            'get' => ListApplications::class,
            'post' => AddApplication::class,
        ],
        '/apps/{appId}' => [
            'get' => GetApplication::class,
            'put' => UpdateApplication::class,
            'delete' => DeleteApplication::class,
            'patch' => PatchApplication::class,
        ],
        '/apps/{appId}/restart' => [
            'post' => RestartApplication::class,
        ],
        '/apps/{appId}/autoscaling' => [
            'get' => GetApplicationAutoscaling::class,
            'put' => UpdateApplicationAutoscaling::class,
        ],
        '/registries' => [
            'get' => ListContainerRegistries::class,
            'post' => AddContainerRegistry::class,
        ],
        '/registries/public-images/search' => [
            'post' => SearchForPublicContainerImages::class,
        ],
        '/registries/images' => [
            'post' => ListContainerImages::class,
        ],
        '/registries/{registryId}' => [
            'get' => GetContainerRegistry::class,
            'put' => UpdateContainerRegistry::class,
            'delete' => DeleteContainerRegistry::class,
        ],
        '/registries/tags' => [
            'post' => ListContainerImageTags::class,
        ],
        '/registries/image-config' => [
            'post' => GetImageConfig::class,
        ],
        '/registries/digest' => [
            'post' => GetContainerImageTagDigest::class,
        ],
        '/registries/config-suggestions' => [
            'post' => GetContainerConfigSuggestions::class,
        ],
        '/apps/{appId}/containers/{containerId}/env' => [
            'put' => SetContainerEnvironmentVariables::class,
        ],
        '/apps/{appId}/containers/{containerId}' => [
            'get' => GetApplicationContainerTemplate::class,
            'delete' => DeleteApplicationContainerTemplate::class,
            'patch' => PatchApplicationContainerTemplate::class,
        ],
        '/apps/{appId}/containers' => [
            'post' => AddApplicationContainerTemplate::class,
        ],
        '/apps/{appId}/endpoints/{endpointId}' => [
            'put' => EndpointsUpdateApplication::class,
            'delete' => EndpointsDeleteApplication::class,
        ],
        '/apps/{appId}/endpoints' => [
            'get' => ListApplicationEndpoints::class,
        ],
        '/apps/{appId}/containers/{containerId}/endpoints' => [
            'post' => EndpointsAddApplication::class,
        ],
        '/limits' => [
            'get' => GetLimits::class,
        ],
        '/nodes' => [
            'get' => ListNodes::class,
        ],
        '/nodes/plain' => [
            'get' => ListNodesPlain::class,
        ],
        '/apps/{appId}/pods/{podId}/recreate' => [
            'post' => RecreatePod::class,
        ],
        '/regions' => [
            'get' => ListRegions::class,
        ],
        '/regions/optimal' => [
            'get' => GetOptimalBaseRegion::class,
        ],
        '/apps/{appId}/region-settings' => [
            'get' => GetApplicationRegionSettings::class,
            'put' => UpdateApplicationRegionSettings::class,
        ],
        '/apps/{appId}/volumes/{volumeId}' => [
            'delete' => DeleteAllVolumeInstances::class,
            'patch' => UpdateVolume::class,
        ],
        '/apps/{appId}/volumes' => [
            'get' => ListVolumes::class,
        ],
        '/apps/{appId}/volumes/{volumeId}/detach' => [
            'post' => DetachVolume::class,
        ],
        '/apps/{appId}/volumes/{volumeId}/instances/{instanceId}' => [
            'delete' => DeleteVolumeInstance::class,
        ],
        '/log/forwarding' => [
            'get' => ListLogForwardingConfigurations::class,
            'post' => CreateLogForwardingConfiguration::class,
        ],
        '/log/forwarding/{appId}' => [
            'get' => GetLogForwardingConfiguration::class,
            'put' => UpdateLogForwardingConfiguration::class,
            'delete' => DeleteLogForwardingConfiguration::class,
        ],
    ];
}
