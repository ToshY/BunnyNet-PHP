<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\Base\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\GetAbuseCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\GetDmcaCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\Api\Base\AbuseCase\ResolveDmcaCase;
use ToshY\BunnyNet\Model\Api\Base\ApiKeys\ListApiKeys;
use ToshY\BunnyNet\Model\Api\Base\Auth\AuthJwt2fa;
use ToshY\BunnyNet\Model\Api\Base\Auth\RefreshJwt;
use ToshY\BunnyNet\Model\Api\Base\Billing\ApplyPromoCode;
use ToshY\BunnyNet\Model\Api\Base\Billing\ClaimAffiliateCredits;
use ToshY\BunnyNet\Model\Api\Base\Billing\ConfigureAutoRecharge;
use ToshY\BunnyNet\Model\Api\Base\Billing\CreateCoinifyPayment;
use ToshY\BunnyNet\Model\Api\Base\Billing\CreatePaymentCheckout;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetAffiliateDetails;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetBillingDetails;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetBillingSummary;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetBillingSummaryPDF;
use ToshY\BunnyNet\Model\Api\Base\Billing\GetCoinifyBitcoinExchangeRate;
use ToshY\BunnyNet\Model\Api\Base\Billing\PreparePaymentAuthorization;
use ToshY\BunnyNet\Model\Api\Base\Countries\ListCountries;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\AddDnsRecord;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\AddDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\CheckDnsZoneAvailability;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DeleteDnsRecord;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DeleteDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DisableDnssecOnDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\DismissDnsConfigurationNotice;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\EnableDnssecOnDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ExportDnsRecords;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\GetDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\GetDnsZoneQueryStatistics;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ImportDnsRecords;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\ListDnsZones;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\RecheckDnsConfiguration;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\UpdateDnsRecord;
use ToshY\BunnyNet\Model\Api\Base\DnsZone\UpdateDnsZone;
use ToshY\BunnyNet\Model\Api\Base\DrmCertificate\ListDrmCertificates;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddAllowedReferer as PullZoneAddAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddBlockedIp;
use ToshY\BunnyNet\Model\Api\Base\PullZone\AddBlockedReferer as PullZoneAddBlockedReferer;
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
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveAllowedReferer as PullZoneRemoveAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveBlockedIp;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveBlockedReferer as PullZoneRemoveBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveCertificate;
use ToshY\BunnyNet\Model\Api\Base\PullZone\RemoveCustomHostname;
use ToshY\BunnyNet\Model\Api\Base\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetForceSsl;
use ToshY\BunnyNet\Model\Api\Base\PullZone\UpdatePullZone;
use ToshY\BunnyNet\Model\Api\Base\Purge\PurgeUrl;
use ToshY\BunnyNet\Model\Api\Base\Purge\PurgeUrlByHeader;
use ToshY\BunnyNet\Model\Api\Base\Region\ListRegions;
use ToshY\BunnyNet\Model\Api\Base\Search\GlobalSearch;
use ToshY\BunnyNet\Model\Api\Base\Statistics\GetStatistics;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\AddStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\CheckStorageZoneAvailability;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\DeleteStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\GetStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\GetStorageZoneConnections;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\GetStorageZoneStatistics;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ListStorageZones;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ResetPassword as StorageZoneResetPassword;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ResetReadOnlyPassword;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetLanguages;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\RemoveAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\RemoveBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ResetPassword;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ResetPasswordByPathParameter;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\UpdateVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\Support\CloseTicket;
use ToshY\BunnyNet\Model\Api\Base\Support\CreateTicket;
use ToshY\BunnyNet\Model\Api\Base\Support\GetTicketDetails;
use ToshY\BunnyNet\Model\Api\Base\Support\ListTickets;
use ToshY\BunnyNet\Model\Api\Base\Support\ReplyTicket;
use ToshY\BunnyNet\Model\Api\Base\User\AcceptDpa;
use ToshY\BunnyNet\Model\Api\Base\User\CloseAccount;
use ToshY\BunnyNet\Model\Api\Base\User\DisableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\Api\Base\User\EnableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\Api\Base\User\GenerateTwoFactorAuthenticationVerification;
use ToshY\BunnyNet\Model\Api\Base\User\GetDpaDetails;
use ToshY\BunnyNet\Model\Api\Base\User\GetDpaDetailsHtml;
use ToshY\BunnyNet\Model\Api\Base\User\GetHomeFeed;
use ToshY\BunnyNet\Model\Api\Base\User\GetUserDetails;
use ToshY\BunnyNet\Model\Api\Base\User\GetWhatsNewItems;
use ToshY\BunnyNet\Model\Api\Base\User\ListCloseAccountReasons;
use ToshY\BunnyNet\Model\Api\Base\User\ListNotifications;
use ToshY\BunnyNet\Model\Api\Base\User\ResendEmailConfirmation;
use ToshY\BunnyNet\Model\Api\Base\User\ResetApiKey;
use ToshY\BunnyNet\Model\Api\Base\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\Api\Base\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\Api\Base\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\Api\Base\User\VerifyTwoFactorAuthenticationCode;

/**
 * @internal
 */
final class Base
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
        '/abusecase' => [
            'get' => ListAbuseCases::class,
        ],
        '/dmca/{id}' => [
            'get' => GetDmcaCase::class,
        ],
        '/abusecase/{id}' => [
            'get' => GetAbuseCase::class,
        ],
        '/dmca/{id}/resolve' => [
            'post' => ResolveDmcaCase::class,
        ],
        '/abusecase/{id}/resolve' => [
            'post' => ResolveAbuseCase::class,
        ],
        '/abusecase/{id}/check' => [
            'post' => CheckAbuseCase::class,
        ],
        '/auth/jwt/2fa' => [
            'post' => AuthJwt2fa::class,
        ],
        '/auth/jwt/refresh' => [
            'post' => RefreshJwt::class,
        ],
        '/search' => [
            'get' => GlobalSearch::class,
        ],
        '/country' => [
            'get' => ListCountries::class,
        ],
        '/billing' => [
            'get' => GetBillingDetails::class,
        ],
        '/billing/payment/autorecharge' => [
            'post' => ConfigureAutoRecharge::class,
        ],
        '/billing/payment/checkout' => [
            'post' => CreatePaymentCheckout::class,
        ],
        '/billing/payment/prepare-authorization' => [
            'get' => PreparePaymentAuthorization::class,
        ],
        '/billing/affiliate' => [
            'get' => GetAffiliateDetails::class,
        ],
        '/billing/affiliate/claim' => [
            'post' => ClaimAffiliateCredits::class,
        ],
        '/billing/coinify/exchangerate' => [
            'get' => GetCoinifyBitcoinExchangeRate::class,
        ],
        '/billing/coinify/create' => [
            'get' => CreateCoinifyPayment::class,
        ],
        '/billing/summary' => [
            'get' => GetBillingSummary::class,
        ],
        '/billing/summary/{billingRecordId}/pdf' => [
            'get' => GetBillingSummaryPDF::class,
        ],
        '/billing/applycode' => [
            'get' => ApplyPromoCode::class,
        ],
        '/apikey' => [
            'get' => ListApiKeys::class,
        ],
        '/support/ticket/list' => [
            'get' => ListTickets::class,
        ],
        '/support/ticket/details/{id}' => [
            'get' => GetTicketDetails::class,
        ],
        '/support/ticket/{id}/close' => [
            'post' => CloseTicket::class,
        ],
        '/support/ticket/{id}/reply' => [
            'post' => ReplyTicket::class,
        ],
        '/support/ticket/create' => [
            'post' => CreateTicket::class,
        ],
        '/drmcertificate' => [
            'get' => ListDrmCertificates::class,
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
        '/videolibrary/{id}/watermark' => [
            'put' => AddWatermark::class,
            'delete' => DeleteWatermark::class,
        ],
        '/videolibrary/{id}/addAllowedReferrer' => [
            'post' => AddAllowedReferer::class,
        ],
        '/videolibrary/{id}/removeAllowedReferrer' => [
            'post' => RemoveAllowedReferer::class,
        ],
        '/videolibrary/{id}/addBlockedReferrer' => [
            'post' => AddBlockedReferer::class,
        ],
        '/videolibrary/{id}/removeBlockedReferrer' => [
            'post' => RemoveBlockedReferer::class,
        ],
        '/videolibrary/{id}/drm/statistics' => [
            'get' => null,
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
        '/dnszone/{id}/dnssec' => [
            'post' => EnableDnssecOnDnsZone::class,
            'delete' => DisableDnssecOnDnsZone::class,
        ],
        '/dnszone/{id}/export' => [
            'get' => ExportDnsRecords::class,
        ],
        '/dnszone/{id}/statistics' => [
            'get' => GetDnsZoneQueryStatistics::class,
        ],
        '/dnszone/checkavailability' => [
            'post' => CheckDnsZoneAvailability::class,
        ],
        '/dnszone/{zoneId}/records' => [
            'put' => AddDnsRecord::class,
        ],
        '/dnszone/{zoneId}/records/{id}' => [
            'post' => UpdateDnsRecord::class,
            'delete' => DeleteDnsRecord::class,
        ],
        '/dnszone/{id}/recheckdns' => [
            'post' => RecheckDnsConfiguration::class,
        ],
        '/dnszone/{id}/dismissnameservercheck' => [
            'post' => DismissDnsConfigurationNotice::class,
        ],
        '/dnszone/{zoneId}/import' => [
            'post' => ImportDnsRecords::class,
        ],
        '/pullzone' => [
            'get' => ListPullZones::class,
            'post' => AddPullZone::class,
        ],
        '/pullzone/{id}' => [
            'get' => GetPullZone::class,
            'post' => UpdatePullZone::class,
            'delete' => DeletePullZone::class,
        ],
        '/pullzone/{pullZoneId}/edgerules/{edgeRuleId}' => [
            'delete' => DeleteEdgeRule::class,
        ],
        '/pullzone/{pullZoneId}/edgerules/addOrUpdate' => [
            'post' => AddOrUpdateEdgeRule::class,
        ],
        '/pullzone/{pullZoneId}/edgerules/{edgeRuleId}/setEdgeRuleEnabled' => [
            'post' => SetEdgeRuleEnabled::class,
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
        '/pullzone/{id}/purgeCache' => [
            'post' => PurgeCache::class,
        ],
        '/pullzone/checkavailability' => [
            'post' => CheckPullZoneAvailability::class,
        ],
        '/pullzone/{id}/addCertificate' => [
            'post' => AddCustomCertificate::class,
        ],
        '/pullzone/{id}/removeCertificate' => [
            'delete' => RemoveCertificate::class,
        ],
        '/pullzone/{id}/addHostname' => [
            'post' => AddCustomHostname::class,
        ],
        '/pullzone/{id}/removeHostname' => [
            'delete' => RemoveCustomHostname::class,
        ],
        '/pullzone/{id}/setForceSSL' => [
            'post' => SetForceSsl::class,
        ],
        '/pullzone/{id}/resetSecurityKey' => [
            'post' => ResetTokenKey::class,
        ],
        '/pullzone/{id}/addAllowedReferrer' => [
            'post' => PullZoneAddAllowedReferer::class,
        ],
        '/pullzone/{id}/removeAllowedReferrer' => [
            'post' => PullZoneRemoveAllowedReferer::class,
        ],
        '/pullzone/{id}/addBlockedReferrer' => [
            'post' => PullZoneAddBlockedReferer::class,
        ],
        '/pullzone/{id}/removeBlockedReferrer' => [
            'post' => PullZoneRemoveBlockedReferer::class,
        ],
        '/pullzone/{id}/addBlockedIp' => [
            'post' => AddBlockedIp::class,
        ],
        '/pullzone/{id}/removeBlockedIp' => [
            'post' => RemoveBlockedIp::class,
        ],
        '/purge' => [
            'get' => PurgeUrlByHeader::class,
            'post' => PurgeUrl::class,
        ],
        '/statistics' => [
            'get' => GetStatistics::class,
        ],
        '/storagezone' => [
            'get' => ListStorageZones::class,
            'post' => AddStorageZone::class,
        ],
        '/storagezone/checkavailability' => [
            'post' => CheckStorageZoneAvailability::class,
        ],
        '/storagezone/{id}' => [
            'get' => GetStorageZone::class,
            'post' => UpdateStorageZone::class,
            'delete' => DeleteStorageZone::class,
        ],
        '/storagezone/{id}/connections' => [
            'get' => GetStorageZoneConnections::class,
        ],
        '/storagezone/{id}/statistics' => [
            'get' => GetStorageZoneStatistics::class,
        ],
        '/storagezone/{id}/resetPassword' => [
            'post' => StorageZoneResetPassword::class,
        ],
        '/storagezone/resetReadOnlyPassword' => [
            'post' => ResetReadOnlyPassword::class,
        ],
        '/user/homefeed' => [
            'get' => GetHomeFeed::class,
        ],
        '/user/notifications' => [
            'get' => ListNotifications::class,
        ],
        '/user' => [
            'get' => GetUserDetails::class,
            'post' => UpdateUserDetails::class,
        ],
        '/user/resend-email-confirmation' => [
            'post' => ResendEmailConfirmation::class,
        ],
        '/user/resetApiKey' => [
            'post' => ResetApiKey::class,
        ],
        '/user/closeaccount/reasons-list' => [
            'get' => ListCloseAccountReasons::class,
        ],
        '/user/closeaccount' => [
            'post' => CloseAccount::class,
        ],
        '/user/dpa' => [
            'get' => GetDpaDetails::class,
        ],
        '/user/dpa/accept' => [
            'post' => AcceptDpa::class,
        ],
        '/user/dpa/pdfhtml' => [
            'get' => GetDpaDetailsHtml::class,
        ],
        '/user/setNotificationsOpened' => [
            'post' => SetNotificationsOpened::class,
        ],
        '/user/whatsnew' => [
            'get' => GetWhatsNewItems::class,
        ],
        '/user/whatsnew/reset' => [
            'post' => ResetWhatsNew::class,
        ],
        '/user/2fa/generate-verification' => [
            'get' => GenerateTwoFactorAuthenticationVerification::class,
        ],
        '/user/2fa/disable' => [
            'post' => DisableTwoFactorAuthentication::class,
        ],
        '/user/2fa/enable' => [
            'post' => EnableTwoFactorAuthentication::class,
        ],
        '/user/2fa/verify' => [
            'post' => VerifyTwoFactorAuthenticationCode::class,
        ],
    ];
}
