<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
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
use ToshY\BunnyNet\Model\Api\Core\Integration\GetGitHubIntegration;
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
use ToshY\BunnyNet\Model\Api\Core\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\Api\Core\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\Api\Core\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\Api\Core\User\VerifyTwoFactorAuthenticationCode;

final class Core
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        ListCountries::class => ModelValidationStrategy::NONE,
        ListDnsZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddDnsZone::class => ModelValidationStrategy::STRICT_BODY,
        GetDnsZone::class => ModelValidationStrategy::NONE,
        UpdateDnsZone::class => ModelValidationStrategy::STRICT_BODY,
        DeleteDnsZone::class => ModelValidationStrategy::NONE,
        ExportDnsRecords::class => ModelValidationStrategy::NONE,
        CheckDnsZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        AddDnsRecord::class => ModelValidationStrategy::STRICT_BODY,
        UpdateDnsRecord::class => ModelValidationStrategy::STRICT_BODY,
        DeleteDnsRecord::class => ModelValidationStrategy::NONE,
        ImportDnsRecords::class => ModelValidationStrategy::NONE,
        IssueWildcardCertificate::class => ModelValidationStrategy::STRICT_BODY,
        ListPullZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddPullZone::class => ModelValidationStrategy::STRICT_BODY,
        GetPullZone::class => ModelValidationStrategy::STRICT_QUERY,
        UpdatePullZone::class => ModelValidationStrategy::STRICT_BODY,
        DeletePullZone::class => ModelValidationStrategy::NONE,
        DeleteEdgeRule::class => ModelValidationStrategy::NONE,
        AddOrUpdateEdgeRule::class => ModelValidationStrategy::STRICT_BODY,
        SetEdgeRuleEnabled::class => ModelValidationStrategy::STRICT_BODY,
        GetOriginShieldQueueStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetSafeHopStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetOptimizerStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        UpdatePrivateKeyType::class => ModelValidationStrategy::STRICT_BODY,
        LoadFreeCertificate::class => ModelValidationStrategy::STRICT_QUERY,
        RequestExternalDnsCertificate::class => ModelValidationStrategy::STRICT_BODY,
        CompleteExternalDnsCertificate::class => ModelValidationStrategy::STRICT_BODY,
        PurgeCache::class => ModelValidationStrategy::STRICT_BODY,
        CheckPullZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        AddCustomCertificate::class => ModelValidationStrategy::STRICT_BODY,
        RemoveCertificate::class => ModelValidationStrategy::STRICT_BODY,
        AddCustomHostname::class => ModelValidationStrategy::STRICT_BODY,
        RemoveCustomHostname::class => ModelValidationStrategy::STRICT_BODY,
        SetForceSsl::class => ModelValidationStrategy::STRICT_BODY,
        ResetTokenKey::class => ModelValidationStrategy::STRICT_BODY,
        AddAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        RemoveAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        RemoveBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddBlockedIp::class => ModelValidationStrategy::STRICT_BODY,
        RemoveBlockedIp::class => ModelValidationStrategy::STRICT_BODY,
        PurgeUrl::class => ModelValidationStrategy::STRICT_QUERY,
        ListRegions::class => ModelValidationStrategy::NONE,
        ListStorageZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddStorageZone::class => ModelValidationStrategy::STRICT_BODY,
        CheckStorageZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        GetStorageZone::class => ModelValidationStrategy::NONE,
        UpdateStorageZone::class => ModelValidationStrategy::STRICT_BODY,
        DeleteStorageZone::class => ModelValidationStrategy::STRICT_QUERY,
        ResetPassword::class => ModelValidationStrategy::NONE,
        ResetReadOnlyPassword::class => ModelValidationStrategy::STRICT_QUERY,
        ListVideoLibraries::class => ModelValidationStrategy::STRICT_QUERY,
        AddVideoLibrary::class => ModelValidationStrategy::STRICT_BODY,
        GetVideoLibrary::class => ModelValidationStrategy::NONE,
        UpdateVideoLibrary::class => ModelValidationStrategy::STRICT_BODY,
        DeleteVideoLibrary::class => ModelValidationStrategy::NONE,
        GetLanguages::class => ModelValidationStrategy::NONE,
        ResetApiKey::class => ModelValidationStrategy::NONE,
        ResetReadOnlyApiKey::class => ModelValidationStrategy::NONE,
        AddWatermark::class => ModelValidationStrategy::NONE,
        DeleteWatermark::class => ModelValidationStrategy::NONE,
        StreamVideoLibraryAddAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        StreamVideoLibraryRemoveAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        StreamVideoLibraryAddBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        StreamVideoLibraryRemoveBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        GetTranscribingStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        AddLiveThumbnail::class => ModelValidationStrategy::NONE,
        DeleteLiveThumbnail::class => ModelValidationStrategy::NONE,
        AddLiveWatermark::class => ModelValidationStrategy::NONE,
        DeleteLiveWatermark::class => ModelValidationStrategy::NONE,
        GetDrmStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        CloseAccount::class => ModelValidationStrategy::STRICT_BODY,
        GetUserAuditLog::class => ModelValidationStrategy::STRICT_QUERY,
        GetStorageZoneStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GetStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        GlobalSearch::class => ModelValidationStrategy::STRICT_QUERY,
        GetDnsZoneQueryStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        EnableDnssecOnDnsZone::class => ModelValidationStrategy::NONE,
        DisableDnssecOnDnsZone::class => ModelValidationStrategy::NONE,
        TriggerScan::class => ModelValidationStrategy::STRICT_BODY,
        GetLatestScan::class => ModelValidationStrategy::NONE,
        GetBillingDetails::class => ModelValidationStrategy::NONE,
        DownloadPaymentRequestInvoicePdf::class => ModelValidationStrategy::NONE,
        GetPaymentRequests::class => ModelValidationStrategy::NONE,
        GetBillingSummaryPDF::class => ModelValidationStrategy::NONE,
        GetBillingSummary::class => ModelValidationStrategy::NONE,
        ListApiKeys::class => ModelValidationStrategy::STRICT_QUERY,
        GetAffiliateDetails::class => ModelValidationStrategy::NONE,
        ListAbuseCases::class => ModelValidationStrategy::STRICT_QUERY,
        GetDmcaCase::class => ModelValidationStrategy::NONE,
        GetAbuseCase::class => ModelValidationStrategy::NONE,
        ResolveDmcaCase::class => ModelValidationStrategy::NONE,
        ResolveAbuseCase::class => ModelValidationStrategy::NONE,
        CheckAbuseCase::class => ModelValidationStrategy::NONE,
        AuthJwt2fa::class => ModelValidationStrategy::STRICT_BODY,
        RefreshJwt::class => ModelValidationStrategy::NONE,
        ConfigureAutoRecharge::class => ModelValidationStrategy::STRICT_BODY,
        CreatePaymentCheckout::class => ModelValidationStrategy::STRICT_BODY,
        PreparePaymentAuthorization::class => ModelValidationStrategy::NONE,
        ClaimAffiliateCredits::class => ModelValidationStrategy::NONE,
        GetCoinifyBitcoinExchangeRate::class => ModelValidationStrategy::NONE,
        CreateCoinifyPayment::class => ModelValidationStrategy::STRICT_QUERY,
        ApplyPromoCode::class => ModelValidationStrategy::STRICT_QUERY,
        RecheckDnsConfiguration::class => ModelValidationStrategy::NONE,
        DismissDnsConfigurationNotice::class => ModelValidationStrategy::NONE,
        ListDrmCertificates::class => ModelValidationStrategy::STRICT_QUERY,
        PurgeUrlByHeader::class => ModelValidationStrategy::STRICT_QUERY,
        ListTickets::class => ModelValidationStrategy::STRICT_QUERY,
        GetTicketDetails::class => ModelValidationStrategy::NONE,
        CloseTicket::class => ModelValidationStrategy::NONE,
        ReplyTicket::class => ModelValidationStrategy::STRICT_BODY,
        CreateTicket::class => ModelValidationStrategy::STRICT_BODY,
        GetStorageZoneConnections::class => ModelValidationStrategy::NONE,
        GetHomeFeed::class => ModelValidationStrategy::NONE,
        ListNotifications::class => ModelValidationStrategy::NONE,
        GetUserDetails::class => ModelValidationStrategy::NONE,
        UpdateUserDetails::class => ModelValidationStrategy::STRICT_BODY,
        ResendEmailConfirmation::class => ModelValidationStrategy::NONE,
        ListCloseAccountReasons::class => ModelValidationStrategy::NONE,
        GetDpaDetails::class => ModelValidationStrategy::NONE,
        AcceptDpa::class => ModelValidationStrategy::NONE,
        GetDpaDetailsHtml::class => ModelValidationStrategy::NONE,
        SetNotificationsOpened::class => ModelValidationStrategy::NONE,
        GetWhatsNewItems::class => ModelValidationStrategy::NONE,
        ResetWhatsNew::class => ModelValidationStrategy::NONE,
        GenerateTwoFactorAuthenticationVerification::class => ModelValidationStrategy::NONE,
        DisableTwoFactorAuthentication::class => ModelValidationStrategy::STRICT_BODY,
        EnableTwoFactorAuthentication::class => ModelValidationStrategy::STRICT_BODY,
        VerifyTwoFactorAuthenticationCode::class => ModelValidationStrategy::STRICT_BODY,
        GetGitHubIntegration::class => ModelValidationStrategy::NONE,
        GetMarketingDetails::class => ModelValidationStrategy::NONE,
    ];
}
