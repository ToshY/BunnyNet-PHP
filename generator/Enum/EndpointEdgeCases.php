<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Enum;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\GetAbuseCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\GetDmcaCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\Api\Core\AbuseCase\ResolveDmcaCase;
use ToshY\BunnyNet\Model\Api\Core\Auth\AuthJwt2fa;
use ToshY\BunnyNet\Model\Api\Core\Auth\RefreshJwt;
use ToshY\BunnyNet\Model\Api\Core\Billing\ApplyPromoCode;
use ToshY\BunnyNet\Model\Api\Core\Billing\ClaimAffiliateCredits;
use ToshY\BunnyNet\Model\Api\Core\Billing\ConfigureAutoRecharge;
use ToshY\BunnyNet\Model\Api\Core\Billing\CreateCoinifyPayment;
use ToshY\BunnyNet\Model\Api\Core\Billing\CreatePaymentCheckout;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetAffiliateDetails;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingDetails;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingSummary;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetBillingSummaryPDF;
use ToshY\BunnyNet\Model\Api\Core\Billing\GetCoinifyBitcoinExchangeRate;
use ToshY\BunnyNet\Model\Api\Core\Billing\PreparePaymentAuthorization;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\DismissDnsConfigurationNotice;
use ToshY\BunnyNet\Model\Api\Core\DnsZone\RecheckDnsConfiguration;
use ToshY\BunnyNet\Model\Api\Core\DrmCertificate\ListDrmCertificates;
use ToshY\BunnyNet\Model\Api\Core\Integration\GetGitHubIntegration;
use ToshY\BunnyNet\Model\Api\Core\Purge\PurgeUrlByHeader;
use ToshY\BunnyNet\Model\Api\Core\Search\GlobalSearch;
use ToshY\BunnyNet\Model\Api\Core\StorageZone\GetStorageZoneConnections;
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
use ToshY\BunnyNet\Model\Api\Core\User\GetUserDetails;
use ToshY\BunnyNet\Model\Api\Core\User\GetWhatsNewItems;
use ToshY\BunnyNet\Model\Api\Core\User\ListCloseAccountReasons;
use ToshY\BunnyNet\Model\Api\Core\User\ListNotifications;
use ToshY\BunnyNet\Model\Api\Core\User\ResendEmailConfirmation;
use ToshY\BunnyNet\Model\Api\Core\User\ResetApiKey;
use ToshY\BunnyNet\Model\Api\Core\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\Api\Core\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\Api\Core\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\Api\Core\User\VerifyTwoFactorAuthenticationCode;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadZip;

final class EndpointEdgeCases
{
    public const CORE_API_UNDOCUMENTED_IN_OPEN_API_SPECS = [
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
        '/dnszone/{id}/recheckdns' => [
            'post' => RecheckDnsConfiguration::class,
        ],
        '/dnszone/{id}/dismissnameservercheck' => [
            'post' => DismissDnsConfigurationNotice::class,
        ],
        '/drmcertificate' => [
            'get' => ListDrmCertificates::class,
        ],
        '/purge' => [
            'get' => PurgeUrlByHeader::class,
        ],
        '/search' => [
            'get' => GlobalSearch::class,
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

    public const CORE_API_VALIDATION_REPLACEMENTS = [
        ListAbuseCases::class => ModelValidationStrategy::STRICT_QUERY,
        GetDmcaCase::class => ModelValidationStrategy::NONE,
        GetAbuseCase::class => ModelValidationStrategy::NONE,
        ResolveDmcaCase::class => ModelValidationStrategy::NONE,
        ResolveAbuseCase::class => ModelValidationStrategy::NONE,
        CheckAbuseCase::class => ModelValidationStrategy::NONE,
        AuthJwt2fa::class => ModelValidationStrategy::STRICT_BODY,
        RefreshJwt::class => ModelValidationStrategy::NONE,
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
        GlobalSearch::class => ModelValidationStrategy::STRICT_QUERY,
        GetMarketingDetails::class => ModelValidationStrategy::NONE,
    ];

    public const EDGE_STORAGE_VALIDATION_REPLACEMENTS = [
        DownloadZip::class => ModelValidationStrategy::STRICT_BODY,
    ];
}
