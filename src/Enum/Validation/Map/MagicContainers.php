<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
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

final class MagicContainers
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        DeployApplication::class => ModelValidationStrategy::NONE,
        UndeployApplication::class => ModelValidationStrategy::NONE,
        GetApplicationStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetApplicationUsageSummary::class => ModelValidationStrategy::NONE,
        GetApplicationOverview::class => ModelValidationStrategy::NONE,
        ListApplications::class => ModelValidationStrategy::STRICT_QUERY,
        AddApplication::class => ModelValidationStrategy::STRICT_BODY,
        GetApplication::class => ModelValidationStrategy::NONE,
        UpdateApplication::class => ModelValidationStrategy::STRICT_BODY,
        DeleteApplication::class => ModelValidationStrategy::NONE,
        PatchApplication::class => ModelValidationStrategy::STRICT_BODY,
        RestartApplication::class => ModelValidationStrategy::NONE,
        GetApplicationAutoscaling::class => ModelValidationStrategy::NONE,
        UpdateApplicationAutoscaling::class => ModelValidationStrategy::STRICT_BODY,
        ListContainerRegistries::class => ModelValidationStrategy::NONE,
        AddContainerRegistry::class => ModelValidationStrategy::STRICT_BODY,
        SearchForPublicContainerImages::class => ModelValidationStrategy::STRICT_BODY,
        ListContainerImages::class => ModelValidationStrategy::STRICT_BODY,
        GetContainerRegistry::class => ModelValidationStrategy::NONE,
        UpdateContainerRegistry::class => ModelValidationStrategy::STRICT_BODY,
        DeleteContainerRegistry::class => ModelValidationStrategy::NONE,
        ListContainerImageTags::class => ModelValidationStrategy::STRICT_BODY,
        GetImageConfig::class => ModelValidationStrategy::STRICT_BODY,
        GetContainerImageTagDigest::class => ModelValidationStrategy::STRICT_BODY,
        GetContainerConfigSuggestions::class => ModelValidationStrategy::STRICT_BODY,
        SetContainerEnvironmentVariables::class => ModelValidationStrategy::STRICT_BODY,
        GetApplicationContainerTemplate::class => ModelValidationStrategy::NONE,
        DeleteApplicationContainerTemplate::class => ModelValidationStrategy::NONE,
        PatchApplicationContainerTemplate::class => ModelValidationStrategy::STRICT_BODY,
        AddApplicationContainerTemplate::class => ModelValidationStrategy::STRICT_BODY,
        EndpointsUpdateApplication::class => ModelValidationStrategy::STRICT_BODY,
        EndpointsDeleteApplication::class => ModelValidationStrategy::NONE,
        ListApplicationEndpoints::class => ModelValidationStrategy::NONE,
        EndpointsAddApplication::class => ModelValidationStrategy::STRICT_BODY,
        GetLimits::class => ModelValidationStrategy::NONE,
        ListNodes::class => ModelValidationStrategy::STRICT_QUERY,
        ListNodesPlain::class => ModelValidationStrategy::NONE,
        RecreatePod::class => ModelValidationStrategy::NONE,
        ListRegions::class => ModelValidationStrategy::STRICT_QUERY,
        GetOptimalBaseRegion::class => ModelValidationStrategy::STRICT_QUERY,
        GetApplicationRegionSettings::class => ModelValidationStrategy::NONE,
        UpdateApplicationRegionSettings::class => ModelValidationStrategy::STRICT_BODY,
        DeleteAllVolumeInstances::class => ModelValidationStrategy::NONE,
        UpdateVolume::class => ModelValidationStrategy::STRICT_BODY,
        ListVolumes::class => ModelValidationStrategy::NONE,
        DetachVolume::class => ModelValidationStrategy::NONE,
        DeleteVolumeInstance::class => ModelValidationStrategy::NONE,
        ListLogForwardingConfigurations::class => ModelValidationStrategy::NONE,
        CreateLogForwardingConfiguration::class => ModelValidationStrategy::STRICT_BODY,
        GetLogForwardingConfiguration::class => ModelValidationStrategy::NONE,
        UpdateLogForwardingConfiguration::class => ModelValidationStrategy::STRICT_BODY,
        DeleteLogForwardingConfiguration::class => ModelValidationStrategy::NONE,
    ];
}
