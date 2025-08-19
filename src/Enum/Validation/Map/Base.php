<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Base\ApiKeys\ListApiKeys;
use ToshY\BunnyNet\Model\Api\Base\Countries\ListCountries;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\AddDnsRecord;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\AddDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\CheckDnsZoneAvailability;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DeleteDnsRecord;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DeleteDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DisableDnssecOnDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\EnableDnssecOnDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ExportDnsRecords;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\GetDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\GetDnsZoneQueryStatistics;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ImportDnsRecords;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ListDnsZones;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\UpdateDnsRecord;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\UpdateDnsZone;
use ToshY\BunnyNet\Model\Api\Base\Integration\GetGitHubIntegration;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddBlockedIp;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddCustomCertificate;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddCustomHostname;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddOrUpdateEdgeRule;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddPullZone;
use ToshY\BunnyNet\Model\Api\Base\PullZone\CheckPullZoneAvailability;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteEdgeRule;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeletePullZone;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetOptimizerStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetOriginShieldQueueStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetPullZone;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetSafeHopStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\ListPullZones;
use ToshY\BunnyNet\Model\Api\Base\PullZone\LoadFreeCertificate;
use ToshY\BunnyNet\Model\Api\Base\PullZone\PurgeCache;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveBlockedIp;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveCertificate;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveCustomHostname;
use ToshY\BunnyNet\Model\Api\Base\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetForceSsl;
use ToshY\BunnyNet\Model\Api\Base\PullZone\UpdatePullZone;
use ToshY\BunnyNet\Model\Api\Base\Purge\PurgeUrl;
use ToshY\BunnyNet\Model\Api\Base\Region\ListRegions;
use ToshY\BunnyNet\Model\Api\Base\Statistics\GetStatistics;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\AddStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\CheckStorageZoneAvailability;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\DeleteStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\GetStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\GetStorageZoneStatistics;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ListStorageZones;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ResetPassword as StorageZoneResetPassword;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ResetReadOnlyPassword;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddAllowedReferer as StreamVideoLibraryAddAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddBlockedReferer as StreamVideoLibraryAddBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetDrmStatistics;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetLanguages;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\RemoveAllowedReferer as StreamVideoLibraryRemoveAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\RemoveBlockedReferer as StreamVideoLibraryRemoveBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ResetPassword;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ResetPasswordByPathParameter;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\UpdateVideoLibrary;

final class Base
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        ListPullZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddPullZone::class => ModelValidationStrategy::STRICT_BODY,
        GetPullZone::class => ModelValidationStrategy::STRICT_QUERY,
        UpdatePullZone::class => ModelValidationStrategy::STRICT_BODY,
        DeletePullZone::class => ModelValidationStrategy::NONE,
        GetOriginShieldQueueStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetSafeHopStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetOptimizerStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        LoadFreeCertificate::class => ModelValidationStrategy::STRICT_QUERY,
        AddOrUpdateEdgeRule::class => ModelValidationStrategy::STRICT_BODY,
        SetEdgeRuleEnabled::class => ModelValidationStrategy::STRICT_BODY,
        PurgeCache::class => ModelValidationStrategy::STRICT_BODY,
        CheckPullZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        AddCustomCertificate::class => ModelValidationStrategy::STRICT_BODY,
        AddCustomHostname::class => ModelValidationStrategy::STRICT_BODY,
        SetForceSsl::class => ModelValidationStrategy::STRICT_BODY,
        ResetTokenKey::class => ModelValidationStrategy::STRICT_BODY,
        AddAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        RemoveAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        RemoveBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddBlockedIp::class => ModelValidationStrategy::STRICT_BODY,
        RemoveBlockedIp::class => ModelValidationStrategy::STRICT_BODY,
        DeleteEdgeRule::class => ModelValidationStrategy::NONE,
        RemoveCertificate::class => ModelValidationStrategy::STRICT_BODY,
        RemoveCustomHostname::class => ModelValidationStrategy::STRICT_BODY,
        ListCountries::class => ModelValidationStrategy::NONE,
        ListDnsZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddDnsZone::class => ModelValidationStrategy::STRICT_BODY,
        GetDnsZone::class => ModelValidationStrategy::NONE,
        UpdateDnsZone::class => ModelValidationStrategy::STRICT_BODY,
        DeleteDnsZone::class => ModelValidationStrategy::NONE,
        ExportDnsRecords::class => ModelValidationStrategy::NONE,
        CheckDnsZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        UpdateDnsRecord::class => ModelValidationStrategy::STRICT_BODY,
        DeleteDnsRecord::class => ModelValidationStrategy::NONE,
        ImportDnsRecords::class => ModelValidationStrategy::NONE,
        AddDnsRecord::class => ModelValidationStrategy::STRICT_BODY,
        ListRegions::class => ModelValidationStrategy::NONE,
        ListVideoLibraries::class => ModelValidationStrategy::STRICT_QUERY,
        AddVideoLibrary::class => ModelValidationStrategy::STRICT_BODY,
        GetVideoLibrary::class => ModelValidationStrategy::NONE,
        UpdateVideoLibrary::class => ModelValidationStrategy::STRICT_BODY,
        DeleteVideoLibrary::class => ModelValidationStrategy::NONE,
        GetLanguages::class => ModelValidationStrategy::NONE,
        ResetPassword::class => ModelValidationStrategy::STRICT_QUERY,
        ResetPasswordByPathParameter::class => ModelValidationStrategy::NONE,
        StreamVideoLibraryAddAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        StreamVideoLibraryRemoveAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        StreamVideoLibraryAddBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        StreamVideoLibraryRemoveBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddWatermark::class => ModelValidationStrategy::NONE,
        DeleteWatermark::class => ModelValidationStrategy::NONE,
        PurgeUrl::class => ModelValidationStrategy::STRICT_QUERY,
        ListStorageZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddStorageZone::class => ModelValidationStrategy::STRICT_BODY,
        GetStorageZone::class => ModelValidationStrategy::NONE,
        UpdateStorageZone::class => ModelValidationStrategy::STRICT_BODY,
        DeleteStorageZone::class => ModelValidationStrategy::STRICT_QUERY,
        CheckStorageZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        StorageZoneResetPassword::class => ModelValidationStrategy::NONE,
        ResetReadOnlyPassword::class => ModelValidationStrategy::STRICT_QUERY,
        GetStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetStorageZoneStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        ListApiKeys::class => ModelValidationStrategy::STRICT_QUERY,
        GetDrmStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        EnableDnssecOnDnsZone::class => ModelValidationStrategy::NONE,
        DisableDnssecOnDnsZone::class => ModelValidationStrategy::NONE,
        GetDnsZoneQueryStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetGitHubIntegration::class => ModelValidationStrategy::NONE,
    ];
}
