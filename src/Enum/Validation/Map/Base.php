<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
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
use ToshY\BunnyNet\Model\Api\Base\Integration\GetGitHubIntegration;
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
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetDrmStatistics;
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

final class Base
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        ListAbuseCases::class => ModelValidationStrategy::STRICT_QUERY,
        GetDmcaCase::class => ModelValidationStrategy::NONE,
        GetAbuseCase::class => ModelValidationStrategy::NONE,
        ResolveDmcaCase::class => ModelValidationStrategy::NONE,
        ResolveAbuseCase::class => ModelValidationStrategy::NONE,
        CheckAbuseCase::class => ModelValidationStrategy::NONE,
        AuthJwt2fa::class => ModelValidationStrategy::STRICT_BODY,
        RefreshJwt::class => ModelValidationStrategy::NONE,
        GlobalSearch::class => ModelValidationStrategy::STRICT_QUERY,
        ListCountries::class => ModelValidationStrategy::NONE,
        GetBillingDetails::class => ModelValidationStrategy::NONE,
        ConfigureAutoRecharge::class => ModelValidationStrategy::STRICT_BODY,
        CreatePaymentCheckout::class => ModelValidationStrategy::STRICT_BODY,
        PreparePaymentAuthorization::class => ModelValidationStrategy::NONE,
        GetAffiliateDetails::class => ModelValidationStrategy::NONE,
        ClaimAffiliateCredits::class => ModelValidationStrategy::NONE,
        GetCoinifyBitcoinExchangeRate::class => ModelValidationStrategy::NONE,
        CreateCoinifyPayment::class => ModelValidationStrategy::STRICT_QUERY,
        GetBillingSummary::class => ModelValidationStrategy::NONE,
        GetBillingSummaryPDF::class => ModelValidationStrategy::NONE,
        ApplyPromoCode::class => ModelValidationStrategy::STRICT_QUERY,
        ListApiKeys::class => ModelValidationStrategy::STRICT_QUERY,
        ListTickets::class => ModelValidationStrategy::STRICT_QUERY,
        GetTicketDetails::class => ModelValidationStrategy::NONE,
        CloseTicket::class => ModelValidationStrategy::NONE,
        ReplyTicket::class => ModelValidationStrategy::STRICT_BODY,
        CreateTicket::class => ModelValidationStrategy::STRICT_BODY,
        ListDrmCertificates::class => ModelValidationStrategy::STRICT_QUERY,
        ListRegions::class => ModelValidationStrategy::NONE,
        ListVideoLibraries::class => ModelValidationStrategy::STRICT_QUERY,
        AddVideoLibrary::class => ModelValidationStrategy::STRICT_BODY,
        GetVideoLibrary::class => ModelValidationStrategy::NONE,
        UpdateVideoLibrary::class => ModelValidationStrategy::STRICT_BODY,
        DeleteVideoLibrary::class => ModelValidationStrategy::NONE,
        GetLanguages::class => ModelValidationStrategy::NONE,
        ResetPassword::class => ModelValidationStrategy::STRICT_QUERY,
        ResetPasswordByPathParameter::class => ModelValidationStrategy::NONE,
        AddWatermark::class => ModelValidationStrategy::NONE,
        DeleteWatermark::class => ModelValidationStrategy::NONE,
        AddAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        RemoveAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        RemoveBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        GetDrmStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        ListDnsZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddDnsZone::class => ModelValidationStrategy::STRICT_BODY,
        GetDnsZone::class => ModelValidationStrategy::NONE,
        UpdateDnsZone::class => ModelValidationStrategy::STRICT_BODY,
        DeleteDnsZone::class => ModelValidationStrategy::NONE,
        EnableDnssecOnDnsZone::class => ModelValidationStrategy::NONE,
        DisableDnssecOnDnsZone::class => ModelValidationStrategy::NONE,
        ExportDnsRecords::class => ModelValidationStrategy::NONE,
        GetDnsZoneQueryStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        CheckDnsZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        AddDnsRecord::class => ModelValidationStrategy::STRICT_BODY,
        UpdateDnsRecord::class => ModelValidationStrategy::STRICT_BODY,
        DeleteDnsRecord::class => ModelValidationStrategy::NONE,
        RecheckDnsConfiguration::class => ModelValidationStrategy::NONE,
        DismissDnsConfigurationNotice::class => ModelValidationStrategy::NONE,
        ImportDnsRecords::class => ModelValidationStrategy::NONE,
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
        LoadFreeCertificate::class => ModelValidationStrategy::STRICT_QUERY,
        PurgeCache::class => ModelValidationStrategy::STRICT_BODY,
        CheckPullZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        AddCustomCertificate::class => ModelValidationStrategy::STRICT_BODY,
        RemoveCertificate::class => ModelValidationStrategy::STRICT_BODY,
        AddCustomHostname::class => ModelValidationStrategy::STRICT_BODY,
        RemoveCustomHostname::class => ModelValidationStrategy::STRICT_BODY,
        SetForceSsl::class => ModelValidationStrategy::STRICT_BODY,
        ResetTokenKey::class => ModelValidationStrategy::NONE,
        PullZoneAddAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        PullZoneRemoveAllowedReferer::class => ModelValidationStrategy::STRICT_BODY,
        PullZoneAddBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        PullZoneRemoveBlockedReferer::class => ModelValidationStrategy::STRICT_BODY,
        AddBlockedIp::class => ModelValidationStrategy::STRICT_BODY,
        RemoveBlockedIp::class => ModelValidationStrategy::STRICT_BODY,
        PurgeUrlByHeader::class => ModelValidationStrategy::STRICT_QUERY,
        PurgeUrl::class => ModelValidationStrategy::STRICT_QUERY,
        GetStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        ListStorageZones::class => ModelValidationStrategy::STRICT_QUERY,
        AddStorageZone::class => ModelValidationStrategy::STRICT_BODY,
        CheckStorageZoneAvailability::class => ModelValidationStrategy::STRICT_BODY,
        GetStorageZone::class => ModelValidationStrategy::NONE,
        UpdateStorageZone::class => ModelValidationStrategy::STRICT_BODY,
        DeleteStorageZone::class => ModelValidationStrategy::NONE,
        GetStorageZoneConnections::class => ModelValidationStrategy::NONE,
        GetStorageZoneStatistics::class => ModelValidationStrategy::STRICT_QUERY,
        StorageZoneResetPassword::class => ModelValidationStrategy::NONE,
        ResetReadOnlyPassword::class => ModelValidationStrategy::STRICT_QUERY,
        GetHomeFeed::class => ModelValidationStrategy::NONE,
        ListNotifications::class => ModelValidationStrategy::NONE,
        GetUserDetails::class => ModelValidationStrategy::NONE,
        UpdateUserDetails::class => ModelValidationStrategy::STRICT_BODY,
        ResendEmailConfirmation::class => ModelValidationStrategy::NONE,
        ResetApiKey::class => ModelValidationStrategy::NONE,
        ListCloseAccountReasons::class => ModelValidationStrategy::NONE,
        CloseAccount::class => ModelValidationStrategy::STRICT_BODY,
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
    ];
}
