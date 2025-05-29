<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\API\Base\APIKeys\ListAPIKeys;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\GetAbuseCase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\GetDMCACase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\ResolveDMCACase;
use ToshY\BunnyNet\Model\API\Base\Auth\AuthJwt2fa;
use ToshY\BunnyNet\Model\API\Base\Auth\RefreshJwt;
use ToshY\BunnyNet\Model\API\Base\Billing\ApplyPromoCode;
use ToshY\BunnyNet\Model\API\Base\Billing\ClaimAffiliateCredits;
use ToshY\BunnyNet\Model\API\Base\Billing\ConfigureAutoRecharge;
use ToshY\BunnyNet\Model\API\Base\Billing\CreateCoinifyPayment;
use ToshY\BunnyNet\Model\API\Base\Billing\CreatePaymentCheckout;
use ToshY\BunnyNet\Model\API\Base\Billing\GetAffiliateDetails;
use ToshY\BunnyNet\Model\API\Base\Billing\GetBillingDetails;
use ToshY\BunnyNet\Model\API\Base\Billing\GetBillingSummary;
use ToshY\BunnyNet\Model\API\Base\Billing\GetBillingSummaryPDF;
use ToshY\BunnyNet\Model\API\Base\Billing\GetCoinifyBitcoinExchangeRate;
use ToshY\BunnyNet\Model\API\Base\Billing\PreparePaymentAuthorization;
use ToshY\BunnyNet\Model\API\Base\Countries\ListCountries;
use ToshY\BunnyNet\Model\API\Base\DNSZone\AddDNSRecord;
use ToshY\BunnyNet\Model\API\Base\DNSZone\AddDNSZone;
use ToshY\BunnyNet\Model\API\Base\DNSZone\CheckDNSZoneAvailability;
use ToshY\BunnyNet\Model\API\Base\DNSZone\DeleteDNSRecord;
use ToshY\BunnyNet\Model\API\Base\DNSZone\DeleteDNSZone;
use ToshY\BunnyNet\Model\API\Base\DNSZone\DisableDNSSECOnDNSZone;
use ToshY\BunnyNet\Model\API\Base\DNSZone\DismissDNSConfigurationNotice;
use ToshY\BunnyNet\Model\API\Base\DNSZone\EnableDNSSECOnDNSZone;
use ToshY\BunnyNet\Model\API\Base\DNSZone\ExportDNSRecords;
use ToshY\BunnyNet\Model\API\Base\DNSZone\GetDNSZone;
use ToshY\BunnyNet\Model\API\Base\DNSZone\GetDNSZoneQueryStatistics;
use ToshY\BunnyNet\Model\API\Base\DNSZone\ImportDNSRecords;
use ToshY\BunnyNet\Model\API\Base\DNSZone\ListDNSZones;
use ToshY\BunnyNet\Model\API\Base\DNSZone\RecheckDNSConfiguration;
use ToshY\BunnyNet\Model\API\Base\DNSZone\UpdateDNSRecord;
use ToshY\BunnyNet\Model\API\Base\DNSZone\UpdateDNSZone;
use ToshY\BunnyNet\Model\API\Base\DRMCertificate\ListDRMCertificates;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddAllowedReferer as PullZoneAddAllowedReferer;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddBlockedIP;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddBlockedReferer as PullZoneAddBlockedReferer;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddCustomCertificate;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddCustomHostname;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddOrUpdateEdgeRule;
use ToshY\BunnyNet\Model\API\Base\PullZone\AddPullZone;
use ToshY\BunnyNet\Model\API\Base\PullZone\CheckPullZoneAvailability;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeleteAllowedReferer as PullZoneDeleteAllowedReferer;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeleteBlockedIP;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeleteBlockedReferer as PullZoneDeleteBlockedReferer;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeleteCertificate;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeleteCustomHostname;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeleteEdgeRule;
use ToshY\BunnyNet\Model\API\Base\PullZone\DeletePullZone;
use ToshY\BunnyNet\Model\API\Base\PullZone\GetOptimizerStatistics;
use ToshY\BunnyNet\Model\API\Base\PullZone\GetOriginShieldQueueStatistics;
use ToshY\BunnyNet\Model\API\Base\PullZone\GetPullZone;
use ToshY\BunnyNet\Model\API\Base\PullZone\GetSafeHopStatistics;
use ToshY\BunnyNet\Model\API\Base\PullZone\ListPullZones;
use ToshY\BunnyNet\Model\API\Base\PullZone\LoadFreeCertificate;
use ToshY\BunnyNet\Model\API\Base\PullZone\PurgeCache;
use ToshY\BunnyNet\Model\API\Base\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\API\Base\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\API\Base\PullZone\SetForceSSL;
use ToshY\BunnyNet\Model\API\Base\PullZone\UpdatePullZone;
use ToshY\BunnyNet\Model\API\Base\Purge\PurgeURL;
use ToshY\BunnyNet\Model\API\Base\Purge\PurgeURLByHeader;
use ToshY\BunnyNet\Model\API\Base\Region\ListRegions;
use ToshY\BunnyNet\Model\API\Base\Search\GlobalSearch;
use ToshY\BunnyNet\Model\API\Base\Statistics\GetStatistics;
use ToshY\BunnyNet\Model\API\Base\StorageZone\AddStorageZone;
use ToshY\BunnyNet\Model\API\Base\StorageZone\CheckStorageZoneAvailability;
use ToshY\BunnyNet\Model\API\Base\StorageZone\DeleteStorageZone;
use ToshY\BunnyNet\Model\API\Base\StorageZone\GetStorageZone;
use ToshY\BunnyNet\Model\API\Base\StorageZone\GetStorageZoneConnections;
use ToshY\BunnyNet\Model\API\Base\StorageZone\GetStorageZoneStatistics;
use ToshY\BunnyNet\Model\API\Base\StorageZone\ListStorageZones;
use ToshY\BunnyNet\Model\API\Base\StorageZone\ResetPassword as StorageZoneResetPassword;
use ToshY\BunnyNet\Model\API\Base\StorageZone\ResetReadOnlyPassword;
use ToshY\BunnyNet\Model\API\Base\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddAllowedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddBlockedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteAllowedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteBlockedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\GetLanguages;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\ResetPassword;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\ResetPasswordByPathParameter;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\UpdateVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\Support\CloseTicket;
use ToshY\BunnyNet\Model\API\Base\Support\CreateTicket;
use ToshY\BunnyNet\Model\API\Base\Support\GetTicketDetails;
use ToshY\BunnyNet\Model\API\Base\Support\ListTickets;
use ToshY\BunnyNet\Model\API\Base\Support\ReplyTicket;
use ToshY\BunnyNet\Model\API\Base\User\AcceptDPA;
use ToshY\BunnyNet\Model\API\Base\User\CloseAccount;
use ToshY\BunnyNet\Model\API\Base\User\DisableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\API\Base\User\EnableTwoFactorAuthentication;
use ToshY\BunnyNet\Model\API\Base\User\GenerateTwoFactorAuthenticationVerification;
use ToshY\BunnyNet\Model\API\Base\User\GetDPADetails;
use ToshY\BunnyNet\Model\API\Base\User\GetDPADetailsHTML;
use ToshY\BunnyNet\Model\API\Base\User\GetHomeFeed;
use ToshY\BunnyNet\Model\API\Base\User\GetUserDetails;
use ToshY\BunnyNet\Model\API\Base\User\GetWhatsNewItems;
use ToshY\BunnyNet\Model\API\Base\User\ListCloseAccountReasons;
use ToshY\BunnyNet\Model\API\Base\User\ListNotifications;
use ToshY\BunnyNet\Model\API\Base\User\ResendEmailConfirmation;
use ToshY\BunnyNet\Model\API\Base\User\ResetAPIKey;
use ToshY\BunnyNet\Model\API\Base\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\API\Base\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\API\Base\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\API\Base\User\VerifyTwoFactorAuthenticationCode;

final class Base
{
    /** @var array<string,array<string,class-string|null>> */
    public static array $endpoints = [
        '/abusecase' => [
            'get' => ListAbuseCases::class,
        ],
        '/dmca/{id}' => [
            'get' => GetDMCACase::class,
        ],
        '/abusecase/{id}' => [
            'get' => GetAbuseCase::class,
        ],
        '/dmca/{id}/resolve' => [
            'post' => ResolveDMCACase::class,
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
            'get' => ListAPIKeys::class,
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
            'get' => ListDRMCertificates::class,
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
            'post' => DeleteAllowedReferer::class,
        ],
        '/videolibrary/{id}/addBlockedReferrer' => [
            'post' => AddBlockedReferer::class,
        ],
        '/videolibrary/{id}/removeBlockedReferrer' => [
            'post' => DeleteBlockedReferer::class,
        ],
        '/dnszone' => [
            'get' => ListDNSZones::class,
            'post' => AddDNSZone::class,
        ],
        '/dnszone/{id}' => [
            'get' => GetDNSZone::class,
            'post' => UpdateDNSZone::class,
            'delete' => DeleteDNSZone::class,
        ],
        '/dnszone/{id}/dnssec' => [
            'post' => EnableDNSSECOnDNSZone::class,
            'delete' => DisableDNSSECOnDNSZone::class,
        ],
        '/dnszone/{id}/export' => [
            'get' => ExportDNSRecords::class,
        ],
        '/dnszone/{id}/statistics' => [
            'get' => GetDNSZoneQueryStatistics::class,
        ],
        '/dnszone/checkavailability' => [
            'post' => CheckDNSZoneAvailability::class,
        ],
        '/dnszone/{zoneId}/records' => [
            'put' => AddDNSRecord::class,
        ],
        '/dnszone/{zoneId}/records/{id}' => [
            'post' => UpdateDNSRecord::class,
            'delete' => DeleteDNSRecord::class,
        ],
        '/dnszone/{id}/recheckdns' => [
            'post' => RecheckDNSConfiguration::class,
        ],
        '/dnszone/{id}/dismissnameservercheck' => [
            'post' => DismissDNSConfigurationNotice::class,
        ],
        '/dnszone/{zoneId}/import' => [
            'post' => ImportDNSRecords::class,
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
            'delete' => DeleteCertificate::class,
        ],
        '/pullzone/{id}/addHostname' => [
            'post' => AddCustomHostname::class,
        ],
        '/pullzone/{id}/removeHostname' => [
            'delete' => DeleteCustomHostname::class,
        ],
        '/pullzone/{id}/setForceSSL' => [
            'post' => SetForceSSL::class,
        ],
        '/pullzone/{id}/resetSecurityKey' => [
            'post' => ResetTokenKey::class,
        ],
        '/pullzone/{id}/addAllowedReferrer' => [
            'post' => PullZoneAddAllowedReferer::class,
        ],
        '/pullzone/{id}/removeAllowedReferrer' => [
            'post' => PullZoneDeleteAllowedReferer::class,
        ],
        '/pullzone/{id}/addBlockedReferrer' => [
            'post' => PullZoneAddBlockedReferer::class,
        ],
        '/pullzone/{id}/removeBlockedReferrer' => [
            'post' => PullZoneDeleteBlockedReferer::class,
        ],
        '/pullzone/{id}/addBlockedIp' => [
            'post' => AddBlockedIP::class,
        ],
        '/pullzone/{id}/removeBlockedIp' => [
            'post' => DeleteBlockedIP::class,
        ],
        '/purge' => [
            'get' => PurgeURLByHeader::class,
            'post' => PurgeURL::class,
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
            'post' => ResetAPIKey::class,
        ],
        '/user/closeaccount/reasons-list' => [
            'get' => ListCloseAccountReasons::class,
        ],
        '/user/closeaccount' => [
            'post' => CloseAccount::class,
        ],
        '/user/dpa' => [
            'get' => GetDPADetails::class,
        ],
        '/user/dpa/accept' => [
            'post' => AcceptDPA::class,
        ],
        '/user/dpa/pdfhtml' => [
            'get' => GetDPADetailsHTML::class,
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
