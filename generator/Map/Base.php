<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

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

/**
 * @internal
 */
final class Base
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
        '/pullzone' => [
            'get' => ListPullZones::class,
            'post' => AddPullZone::class,
        ],
        '/pullzone/{id}' => [
            'get' => GetPullZone::class,
            'post' => UpdatePullZone::class,
            'delete' => DeletePullZone::class,
        ],
        '/pullzone/{pullZoneId}/originshield/queuestatistics' => [
            'get' => GetOriginShieldQueueStatistics::class,
        ],
        '/pullzone/{pullZoneId}/safehop/statistics' => [
            'get' => GetSafeHopStatistics::class,
        ],
        '/pullzone/{pullZoneId}/optimizer/statistics' => [
            'get' => GetOptimizerStatistics::class,
        ],
        '/pullzone/loadFreeCertificate' => [
            'get' => LoadFreeCertificate::class,
        ],
        '/pullzone/{pullZoneId}/edgerules/addOrUpdate' => [
            'post' => AddOrUpdateEdgeRule::class,
        ],
        '/pullzone/{pullZoneId}/edgerules/{edgeRuleId}/setEdgeRuleEnabled' => [
            'post' => SetEdgeRuleEnabled::class,
        ],
        '/pullzone/{id}/purgeCache' => [
            'post' => PurgeCache::class,
        ],
        '/pullzone/checkavailability' => [
            'post' => CheckPullZoneAvailability::class,
        ],
        '/pullzone/{id}/addCertificate' => [
            'post' => AddCustomCertificate::class,
        ],
        '/pullzone/{id}/addHostname' => [
            'post' => AddCustomHostname::class,
        ],
        '/pullzone/{id}/setForceSSL' => [
            'post' => SetForceSsl::class,
        ],
        '/pullzone/{id}/resetSecurityKey' => [
            'post' => ResetTokenKey::class,
        ],
        '/pullzone/{id}/addAllowedReferrer' => [
            'post' => AddAllowedReferer::class,
        ],
        '/pullzone/{id}/removeAllowedReferrer' => [
            'post' => RemoveAllowedReferer::class,
        ],
        '/pullzone/{id}/addBlockedReferrer' => [
            'post' => AddBlockedReferer::class,
        ],
        '/pullzone/{id}/removeBlockedReferrer' => [
            'post' => RemoveBlockedReferer::class,
        ],
        '/pullzone/{id}/addBlockedIp' => [
            'post' => AddBlockedIp::class,
        ],
        '/pullzone/{id}/removeBlockedIp' => [
            'post' => RemoveBlockedIp::class,
        ],
        '/pullzone/{pullZoneId}/edgerules/{edgeRuleId}' => [
            'delete' => DeleteEdgeRule::class,
        ],
        '/pullzone/{id}/removeCertificate' => [
            'delete' => RemoveCertificate::class,
        ],
        '/pullzone/{id}/removeHostname' => [
            'delete' => RemoveCustomHostname::class,
        ],
        '/country' => [
            'get' => ListCountries::class,
        ],
        '/dnszone' => [
            'get' => ListDnsZones::class,
            'post' => AddDnsZone::class,
        ],
        '/dnszone/{id}' => [
            'get' => GetDnsZone::class,
            'post' => UpdateDnsZone::class,
            'delete' => DeleteDnsZone::class,
        ],
        '/dnszone/{id}/export' => [
            'get' => ExportDnsRecords::class,
        ],
        '/dnszone/checkavailability' => [
            'post' => CheckDnsZoneAvailability::class,
        ],
        '/dnszone/{zoneId}/records/{id}' => [
            'post' => UpdateDnsRecord::class,
            'delete' => DeleteDnsRecord::class,
        ],
        '/dnszone/{zoneId}/import' => [
            'post' => ImportDnsRecords::class,
        ],
        '/dnszone/{zoneId}/records' => [
            'put' => AddDnsRecord::class,
        ],
        '/region' => [
            'get' => ListRegions::class,
        ],
        '/videolibrary' => [
            'get' => ListVideoLibraries::class,
            'post' => AddVideoLibrary::class,
        ],
        '/videolibrary/{id}' => [
            'get' => GetVideoLibrary::class,
            'post' => UpdateVideoLibrary::class,
            'delete' => DeleteVideoLibrary::class,
        ],
        '/videolibrary/languages' => [
            'get' => GetLanguages::class,
        ],
        '/videolibrary/resetApiKey' => [
            'post' => ResetPassword::class,
        ],
        '/videolibrary/{id}/resetApiKey' => [
            'post' => ResetPasswordByPathParameter::class,
        ],
        '/videolibrary/{id}/addAllowedReferrer' => [
            'post' => StreamVideoLibraryAddAllowedReferer::class,
        ],
        '/videolibrary/{id}/removeAllowedReferrer' => [
            'post' => StreamVideoLibraryRemoveAllowedReferer::class,
        ],
        '/videolibrary/{id}/addBlockedReferrer' => [
            'post' => StreamVideoLibraryAddBlockedReferer::class,
        ],
        '/videolibrary/{id}/removeBlockedReferrer' => [
            'post' => StreamVideoLibraryRemoveBlockedReferer::class,
        ],
        '/videolibrary/{id}/watermark' => [
            'put' => AddWatermark::class,
            'delete' => DeleteWatermark::class,
        ],
        '/purge' => [
            'post' => PurgeUrl::class,
        ],
        '/storagezone' => [
            'get' => ListStorageZones::class,
            'post' => AddStorageZone::class,
        ],
        '/storagezone/{id}' => [
            'get' => GetStorageZone::class,
            'post' => UpdateStorageZone::class,
            'delete' => DeleteStorageZone::class,
        ],
        '/storagezone/checkavailability' => [
            'post' => CheckStorageZoneAvailability::class,
        ],
        '/storagezone/{id}/resetPassword' => [
            'post' => StorageZoneResetPassword::class,
        ],
        '/storagezone/resetReadOnlyPassword' => [
            'post' => ResetReadOnlyPassword::class,
        ],
        '/statistics' => [
            'get' => GetStatistics::class,
        ],
        '/storagezone/{id}/statistics' => [
            'get' => GetStorageZoneStatistics::class,
        ],
        '/apikey' => [
            'get' => ListApiKeys::class,
        ],
        '/videolibrary/{id}/drm/statistics' => [
            'get' => GetDrmStatistics::class,
        ],
        '/dnszone/{id}/dnssec' => [
            'post' => EnableDnssecOnDnsZone::class,
            'delete' => DisableDnssecOnDnsZone::class,
        ],
        '/dnszone/{id}/statistics' => [
            'get' => GetDnsZoneQueryStatistics::class,
        ],
    ];
}
