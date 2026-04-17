<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\Core\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\GetAbuseCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\GetDmcaCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\ResolveDmcaCase;
use ToshY\BunnyNet\Model\Api\Core\ApiKeys\ListApiKeys;
use ToshY\BunnyNet\Model\Api\Core\Auth\AuthJwt2fa;
use ToshY\BunnyNet\Model\Api\Core\Auth\RefreshJwt;
use ToshY\BunnyNet\Model\Api\Core\Billing\ApplyPromoCode;
use ToshY\BunnyNet\Model\Api\Core\Billing\ClaimAffiliateCredits;
use ToshY\BunnyNet\Model\Api\Core\Billing\ConfigureAutoRecharge;
use ToshY\BunnyNet\Model\Api\Core\Billing\CreateCoinifyPayment;
use ToshY\BunnyNet\Model\Api\Core\Billing\CreatePaymentCheckout;
use ToshY\BunnyNet\Model\Api\Core\Billing\DownloadPaymentRequestInvoicePdf;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetAffiliateDetails;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingDetails;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingSummary;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingSummaryPDF;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetCoinifyBitcoinExchangeRate;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetPaymentRequests;
use ToshY\BunnyNet\Model\Api\Core\Billing\PreparePaymentAuthorization;
use ToshY\BunnyNet\Model\Api\Core\Countries\ListCountries;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\AddDnsRecord;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\AddDnsZone;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\CheckDnsZoneAvailability;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\DeleteDnsRecord;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\DeleteDnsZone;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\DisableDnssecOnDnsZone;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\DismissDnsConfigurationNotice;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\EnableDnssecOnDnsZone;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\ExportDnsRecords;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\GetDnsZone;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\GetDnsZoneQueryStatistics;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\GetLatestScan;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\ImportDnsRecords;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\IssueWildcardCertificate;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\ListDnsZones;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\RecheckDnsConfiguration;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\TriggerScan;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\UpdateDnsRecord;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\UpdateDnsZone;
use ToshY\BunnyNet\Model\Api\Core\DrmCertificate\ListDrmCertificates;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddAllowedReferer;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddBlockedIp;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddBlockedReferer;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddCustomCertificate;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddCustomHostname;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddOrUpdateEdgeRule;
use ToshY\BunnyNet\Model\Api\Core\PullZone\AddPullZone;
use ToshY\BunnyNet\Model\Api\Core\PullZone\CheckPullZoneAvailability;
use ToshY\BunnyNet\Model\Api\Core\PullZone\CompleteExternalDnsCertificate;
use ToshY\BunnyNet\Model\Api\Core\PullZone\DeleteEdgeRule;
use ToshY\BunnyNet\Model\Api\Core\PullZone\DeletePullZone;
use ToshY\BunnyNet\Model\Api\Core\PullZone\GetOptimizerStatistics;
use ToshY\BunnyNet\Model\Api\Core\PullZone\GetOriginShieldQueueStatistics;
use ToshY\BunnyNet\Model\Api\Core\PullZone\GetPullZone;
use ToshY\BunnyNet\Model\Api\Core\PullZone\GetSafeHopStatistics;
use ToshY\BunnyNet\Model\Api\Core\PullZone\ListPullZones;
use ToshY\BunnyNet\Model\Api\Core\PullZone\LoadFreeCertificate;
use ToshY\BunnyNet\Model\Api\Core\PullZone\PurgeCache;
use ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveAllowedReferer;
use ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveBlockedIp;
use ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveBlockedReferer;
use ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveCertificate;
use ToshY\BunnyNet\Model\Api\Core\PullZone\RemoveCustomHostname;
use ToshY\BunnyNet\Model\Api\Core\PullZone\RequestExternalDnsCertificate;
use ToshY\BunnyNet\Model\Api\Core\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\Api\Core\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\Api\Core\PullZone\SetForceSsl;
use ToshY\BunnyNet\Model\Api\Core\PullZone\UpdatePrivateKeyType;
use ToshY\BunnyNet\Model\Api\Core\PullZone\UpdatePullZone;
use ToshY\BunnyNet\Model\Api\Core\Purge\PurgeUrl;
use ToshY\BunnyNet\Model\Api\Core\Purge\PurgeUrlByHeader;
use ToshY\BunnyNet\Model\Api\Core\Region\ListRegions;
use ToshY\BunnyNet\Model\Api\Core\Search\GlobalSearch;
use ToshY\BunnyNet\Model\Api\Core\Statistics\GetStatistics;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\AddStorageZone;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\CheckStorageZoneAvailability;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\DeleteStorageZone;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZone;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZoneConnections;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZoneStatistics;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\ListStorageZones;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\ResetPassword;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\ResetReadOnlyPassword;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddAllowedReferer as StreamVideoLibraryAddAllowedReferer;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddBlockedReferer as StreamVideoLibraryAddBlockedReferer;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddLiveThumbnail;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddLiveWatermark;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteLiveThumbnail;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteLiveWatermark;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetDrmStatistics;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetLanguages;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetTranscribingStatistics;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\RemoveAllowedReferer as StreamVideoLibraryRemoveAllowedReferer;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\RemoveBlockedReferer as StreamVideoLibraryRemoveBlockedReferer;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ResetApiKey;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\ResetReadOnlyApiKey;
use ToshY\BunnyNet\Model\Api\Core\StreamVideoLibrary\UpdateVideoLibrary;
use ToshY\BunnyNet\Model\Api\Core\Support\CloseTicket;
use ToshY\BunnyNet\Model\Api\Core\Support\CreateTicket;
use ToshY\BunnyNet\Model\Api\Core\Support\GetTicketDetails;
use ToshY\BunnyNet\Model\Api\Core\Support\ListTickets;
use ToshY\BunnyNet\Model\Api\Core\Support\ReplyTicket;
use ToshY\BunnyNet\Model\Api\Core\User\AcceptDpa;
use ToshY\BunnyNet\Model\Api\Core\User\CloseAccount;
use ToshY\BunnyNet\Model\Api\Core\User\DisableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\Api\Core\User\EnableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\Api\Core\User\GenerateTwoFactorAuthenticationVerification;
use ToshY\BunnyNet\Model\Api\Core\User\GetDpaDetails;
use ToshY\BunnyNet\Model\Api\Core\User\GetDpaDetailsHtml;
use ToshY\BunnyNet\Model\Api\Core\User\GetHomeFeed;
use ToshY\BunnyNet\Model\Api\Core\User\GetMarketingDetails;
use ToshY\BunnyNet\Model\Api\Core\User\GetUserAuditLog;
use ToshY\BunnyNet\Model\Api\Core\User\GetUserDetails;
use ToshY\BunnyNet\Model\Api\Core\User\GetWhatsNewItems;
use ToshY\BunnyNet\Model\Api\Core\User\ListCloseAccountReasons;
use ToshY\BunnyNet\Model\Api\Core\User\ListNotifications;
use ToshY\BunnyNet\Model\Api\Core\User\ResendEmailConfirmation;
use ToshY\BunnyNet\Model\Api\Core\User\ResetApiKey as UserResetApiKey;
use ToshY\BunnyNet\Model\Api\Core\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\Api\Core\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\Api\Core\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\Api\Core\User\VerifyTwoFactorAuthenticationCode;

/**
 * @internal
 */
final class Core
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
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
        '/dnszone/{zoneId}/records' => [
            'put' => AddDnsRecord::class,
        ],
        '/dnszone/{zoneId}/records/{id}' => [
            'post' => UpdateDnsRecord::class,
            'delete' => DeleteDnsRecord::class,
        ],
        '/dnszone/{zoneId}/import' => [
            'post' => ImportDnsRecords::class,
        ],
        '/dnszone/{zoneId}/certificate/issue' => [
            'post' => IssueWildcardCertificate::class,
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
        '/pullzone/{id}/updatePrivateKeyType' => [
            'post' => UpdatePrivateKeyType::class,
        ],
        '/pullzone/loadFreeCertificate' => [
            'get' => LoadFreeCertificate::class,
        ],
        '/pullzone/requestExternalDnsCertificate' => [
            'post' => RequestExternalDnsCertificate::class,
        ],
        '/pullzone/completeExternalDnsCertificate' => [
            'post' => CompleteExternalDnsCertificate::class,
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
        '/purge' => [
            'post' => PurgeUrl::class,
            'get' => PurgeUrlByHeader::class,
        ],
        '/region' => [
            'get' => ListRegions::class,
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
        '/storagezone/{id}/resetPassword' => [
            'post' => ResetPassword::class,
        ],
        '/storagezone/resetReadOnlyPassword' => [
            'post' => ResetReadOnlyPassword::class,
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
        '/videolibrary/{id}/resetApiKey' => [
            'post' => ResetApiKey::class,
        ],
        '/videolibrary/{id}/resetReadOnlyApiKey' => [
            'post' => ResetReadOnlyApiKey::class,
        ],
        '/videolibrary/{id}/watermark' => [
            'put' => AddWatermark::class,
            'delete' => DeleteWatermark::class,
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
        '/videolibrary/{id}/transcribing/statistics' => [
            'get' => GetTranscribingStatistics::class,
        ],
        '/videolibrary/{id}/live/thumbnail' => [
            'put' => AddLiveThumbnail::class,
            'delete' => DeleteLiveThumbnail::class,
        ],
        '/videolibrary/{id}/live/watermark' => [
            'put' => AddLiveWatermark::class,
            'delete' => DeleteLiveWatermark::class,
        ],
        '/videolibrary/{id}/drm/statistics' => [
            'get' => GetDrmStatistics::class,
        ],
        '/user/closeaccount' => [
            'post' => CloseAccount::class,
        ],
        '/user/audit/{date}' => [
            'get' => GetUserAuditLog::class,
        ],
        '/storagezone/{id}/statistics' => [
            'get' => GetStorageZoneStatistics::class,
        ],
        '/statistics' => [
            'get' => GetStatistics::class,
        ],
        '/search' => [
            'get' => GlobalSearch::class,
        ],
        '/dnszone/{id}/statistics' => [
            'get' => GetDnsZoneQueryStatistics::class,
        ],
        '/dnszone/{id}/dnssec' => [
            'post' => EnableDnssecOnDnsZone::class,
            'delete' => DisableDnssecOnDnsZone::class,
        ],
        '/dnszone/records/scan' => [
            'post' => TriggerScan::class,
        ],
        '/dnszone/{zoneId}/records/scan' => [
            'get' => GetLatestScan::class,
        ],
        '/billing' => [
            'get' => GetBillingDetails::class,
        ],
        '/billing/payment-request-invoice/{id}/pdf' => [
            'get' => DownloadPaymentRequestInvoicePdf::class,
        ],
        '/billing/payment-requests' => [
            'get' => GetPaymentRequests::class,
        ],
        '/billing/summary/{billingRecordId}/pdf' => [
            'get' => GetBillingSummaryPDF::class,
        ],
        '/billing/summary' => [
            'get' => GetBillingSummary::class,
        ],
        '/apikey' => [
            'get' => ListApiKeys::class,
        ],
        '/billing/affiliate' => [
            'get' => GetAffiliateDetails::class,
        ],
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
        '/billing/payment/autorecharge' => [
            'post' => ConfigureAutoRecharge::class,
        ],
        '/billing/payment/checkout' => [
            'post' => CreatePaymentCheckout::class,
        ],
        '/billing/payment/prepare-authorization' => [
            'get' => PreparePaymentAuthorization::class,
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
        '/billing/applycode' => [
            'get' => ApplyPromoCode::class,
        ],
        '/dnszone/{id}/recheckdns' => [
            'post' => RecheckDnsConfiguration::class,
        ],
        '/dnszone/{id}/dismissnameservercheck' => [
            'post' => DismissDnsConfigurationNotice::class,
        ],
        '/drmcertificate' => [
            'get' => ListDrmCertificates::class,
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
        '/storagezone/{id}/connections' => [
            'get' => GetStorageZoneConnections::class,
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
            'post' => UserResetApiKey::class,
        ],
        '/user/closeaccount/reasons-list' => [
            'get' => ListCloseAccountReasons::class,
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
        '/user/mkd' => [
            'get' => GetMarketingDetails::class,
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
