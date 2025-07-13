<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

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
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteAllowedReferer as PullZoneDeleteAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteBlockedIp;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteBlockedReferer as PullZoneDeleteBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteCertificate;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteCustomHostname;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeleteEdgeRule;
use ToshY\BunnyNet\Model\Api\Base\PullZone\DeletePullZone;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetOptimizerStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetOriginShieldQueueStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetPullZone;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetSafeHopStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\GetWafStatistics;
use ToshY\BunnyNet\Model\Api\Base\PullZone\ListPullZones;
use ToshY\BunnyNet\Model\Api\Base\PullZone\LoadFreeCertificate;
use ToshY\BunnyNet\Model\Api\Base\PullZone\PurgeCache;
use ToshY\BunnyNet\Model\Api\Base\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetForceSsl;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetZoneSecurityEnabled;
use ToshY\BunnyNet\Model\Api\Base\PullZone\SetZoneSecurityIncludeHashRemoteIpEnabled;
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
use ToshY\BunnyNet\Model\Api\Base\StorageZone\ResetReadOnlyPassword as StorageZoneResetReadOnlyPassword;
use ToshY\BunnyNet\Model\Api\Base\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddAllowedReferer as VideoLibraryAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddBlockedReferer as VideoLibraryAddBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteAllowedReferer as VideoLibraryDeleteAllowedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteBlockedReferer as VideoLibraryDeleteBlockedReferer;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetLanguages;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ResetPassword as VideoLibraryResetPassword;
use ToshY\BunnyNet\Model\Api\Base\StreamVideoLibrary\ResetPasswordByPathParameter as VideoLibraryResetPasswordByPathParameter;
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
use ToshY\BunnyNet\Model\Api\Base\User\GetMarketingDetails;
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
use ToshY\BunnyNet\Model\Api\EdgeScripting\Code\GetCode;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Code\SetCode;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\AddEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\DeleteEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\GetEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\GetEdgeScriptStatistics;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\ListEdgeScripts;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\RotateDeploymentKey;
use ToshY\BunnyNet\Model\Api\EdgeScripting\EdgeScript\UpdateEdgeScript;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\GetActiveReleases;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\GetReleases;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\PublishRelease;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Release\PublishReleaseByPathParameter;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\AddSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\DeleteSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\ListSecrets;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\UpdateSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Secret\UpsertSecret;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\AddVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\DeleteVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\GetVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\UpdateVariable;
use ToshY\BunnyNet\Model\Api\EdgeScripting\Variable\UpsertVariable;
use ToshY\BunnyNet\Model\Api\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\DownloadZip;
use ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles\UploadFile;
use ToshY\BunnyNet\Model\Api\Logging\GetLog;
use ToshY\BunnyNet\Model\Api\Shield\DDoS\ListDdosEnums;
use ToshY\BunnyNet\Model\Api\Shield\EventLogs\ListEventLogs;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetOverviewMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetRateLimitMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetWafRuleMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\ListRateLimitMetrics;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\CreateRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\DeleteRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\GetRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\ListRateLimits;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\UpdateRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\WAF\CreateCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\WAF\DeleteCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\WAF\GetCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ListCustomWafRules;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ListWafEngineConfiguration;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ListWafEnums;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ListWafProfiles;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ListWafRules;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ReviewTriggeredRule;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ReviewTriggeredRuleAiRecommendation;
use ToshY\BunnyNet\Model\Api\Shield\WAF\ReviewTriggeredRules;
use ToshY\BunnyNet\Model\Api\Shield\WAF\UpdateCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\WAF\UpdateCustomWafRuleByPatch;
use ToshY\BunnyNet\Model\Api\Shield\Zone\CreateShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZoneByPullZoneId;
use ToshY\BunnyNet\Model\Api\Shield\Zone\ListShieldZones;
use ToshY\BunnyNet\Model\Api\Shield\Zone\UpdateShieldZone;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\Api\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\AddOutputCodecToVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteUnconfiguredResolutions;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoPlayData;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\GetVideoResolutionsInfo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ListVideoStatistics;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\RepackageVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\TranscribeVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Api\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Model\Api\Stream\OEmbed\GetOEmbed;
use ToshY\BunnyNet\Validation\Strategy\Body\LaxBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Body\NoBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Body\StrictBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\LaxQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\NoQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\StrictQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\ValidationModelStrategy;

enum ModelStrategy
{
    case STRICT;

    case STRICT_QUERY;

    case STRICT_BODY;

    case LAX;

    case NONE;

    /** @var array<class-string,ModelStrategy> */
    private const BASE = [
        ListAbuseCases::class => self::STRICT_QUERY,
        GetDmcaCase::class => self::NONE,
        GetAbuseCase::class => self::NONE,
        ResolveDmcaCase::class => self::NONE,
        ResolveAbuseCase::class => self::NONE,
        CheckAbuseCase::class => self::NONE,
        AuthJwt2fa::class => self::STRICT_BODY,
        RefreshJwt::class => self::NONE,
        ListCountries::class => self::NONE,
        ListApiKeys::class => self::STRICT_QUERY,
        GetBillingDetails::class => self::NONE,
        ConfigureAutoRecharge::class => self::STRICT_BODY,
        CreatePaymentCheckout::class => self::STRICT_BODY,
        PreparePaymentAuthorization::class => self::NONE,
        GetAffiliateDetails::class => self::NONE,
        ClaimAffiliateCredits::class => self::NONE,
        GetCoinifyBitcoinExchangeRate::class => self::NONE,
        CreateCoinifyPayment::class => self::STRICT_QUERY,
        GetBillingSummary::class => self::NONE,
        GetBillingSummaryPDF::class => self::NONE,
        ApplyPromoCode::class => self::STRICT_QUERY,
        ListTickets::class => self::STRICT_QUERY,
        GetTicketDetails::class => self::NONE,
        CloseTicket::class => self::NONE,
        ReplyTicket::class => self::STRICT_BODY,
        CreateTicket::class => self::STRICT_BODY,
        ListDrmCertificates::class => self::STRICT_QUERY,
        GetGitHubIntegration::class => self::NONE,
        ListRegions::class => self::NONE,
        ListVideoLibraries::class => self::STRICT_QUERY,
        AddVideoLibrary::class => self::STRICT_BODY,
        GetVideoLibrary::class => self::NONE,
        UpdateVideoLibrary::class => self::STRICT_BODY,
        DeleteVideoLibrary::class => self::NONE,
        GetLanguages::class => self::NONE,
        VideoLibraryResetPassword::class => self::STRICT_QUERY,
        VideoLibraryResetPasswordByPathParameter::class => self::NONE,
        AddWatermark::class => self::NONE,
        DeleteWatermark::class => self::NONE,
        VideoLibraryAllowedReferer::class => self::STRICT_BODY,
        VideoLibraryDeleteAllowedReferer::class => self::STRICT_BODY,
        VideoLibraryAddBlockedReferer::class => self::STRICT_BODY,
        VideoLibraryDeleteBlockedReferer::class => self::STRICT_BODY,
        ListDnsZones::class => self::STRICT_QUERY,
        AddDnsZone::class => self::STRICT_BODY,
        GetDnsZone::class => self::NONE,
        UpdateDnsZone::class => self::STRICT_BODY,
        DeleteDnsZone::class => self::NONE,
        EnableDnssecOnDnsZone::class => self::NONE,
        DisableDnssecOnDnsZone::class => self::NONE,
        ExportDnsRecords::class => self::NONE,
        GetDnsZoneQueryStatistics::class => self::STRICT_QUERY,
        CheckDnsZoneAvailability::class => self::STRICT_BODY,
        AddDnsRecord::class => self::STRICT_BODY,
        UpdateDnsRecord::class => self::STRICT_BODY,
        DeleteDnsRecord::class => self::NONE,
        RecheckDnsConfiguration::class => self::NONE,
        DismissDnsConfigurationNotice::class => self::NONE,
        ImportDnsRecords::class => self::NONE,
        ListPullZones::class => self::STRICT_QUERY,
        AddPullZone::class => self::STRICT_BODY,
        GetPullZone::class => self::STRICT_QUERY,
        UpdatePullZone::class => self::STRICT_BODY,
        DeletePullZone::class => self::NONE,
        DeleteEdgeRule::class => self::NONE,
        AddOrUpdateEdgeRule::class => self::STRICT_BODY,
        SetEdgeRuleEnabled::class => self::STRICT_BODY,
        SetZoneSecurityEnabled::class => self::NONE,
        SetZoneSecurityIncludeHashRemoteIpEnabled::class => self::NONE,
        GetOriginShieldQueueStatistics::class => self::STRICT_QUERY,
        GetSafeHopStatistics::class => self::STRICT_QUERY,
        GetOptimizerStatistics::class => self::STRICT_QUERY,
        GetWafStatistics::class => self::STRICT_QUERY,
        LoadFreeCertificate::class => self::STRICT_QUERY,
        PurgeCache::class => self::STRICT_BODY,
        CheckPullZoneAvailability::class => self::STRICT_BODY,
        AddCustomCertificate::class => self::STRICT_BODY,
        DeleteCertificate::class => self::STRICT_BODY,
        AddCustomHostname::class => self::STRICT_BODY,
        DeleteCustomHostname::class => self::STRICT_BODY,
        SetForceSsl::class => self::STRICT_BODY,
        ResetTokenKey::class => self::NONE,
        PullZoneAddAllowedReferer::class => self::STRICT_BODY,
        PullZoneDeleteAllowedReferer::class => self::STRICT_BODY,
        PullZoneAddBlockedReferer::class => self::STRICT_BODY,
        PullZoneDeleteBlockedReferer::class => self::STRICT_BODY,
        AddBlockedIp::class => self::STRICT_BODY,
        DeleteBlockedIp::class => self::STRICT_BODY,
        PurgeUrl::class => self::STRICT_QUERY,
        PurgeUrlByHeader::class => self::STRICT_QUERY,
        GetStatistics::class => self::STRICT_QUERY,
        GlobalSearch::class => self::STRICT_QUERY,
        ListStorageZones::class => self::STRICT_QUERY,
        AddStorageZone::class => self::STRICT_BODY,
        CheckStorageZoneAvailability::class => self::STRICT_BODY,
        GetStorageZone::class => self::NONE,
        UpdateStorageZone::class => self::STRICT_BODY,
        DeleteStorageZone::class => self::NONE,
        GetStorageZoneStatistics::class => self::STRICT_QUERY,
        GetStorageZoneConnections::class => self::NONE,
        StorageZoneResetPassword::class => self::NONE,
        StorageZoneResetReadOnlyPassword::class => self::STRICT_QUERY,
        GetHomeFeed::class => self::NONE,
        GetUserDetails::class => self::NONE,
        UpdateUserDetails::class => self::STRICT_BODY,
        ResendEmailConfirmation::class => self::NONE,
        ResetApiKey::class => self::NONE,
        ListCloseAccountReasons::class => self::NONE,
        CloseAccount::class => self::STRICT_BODY,
        GetDpaDetails::class => self::NONE,
        AcceptDpa::class => self::NONE,
        GetDpaDetailsHtml::class => self::NONE,
        ListNotifications::class => self::NONE,
        SetNotificationsOpened::class => self::NONE,
        GetMarketingDetails::class => self::NONE,
        GetWhatsNewItems::class => self::NONE,
        ResetWhatsNew::class => self::NONE,
        GenerateTwoFactorAuthenticationVerification::class => self::NONE,
        DisableTwoFactorAuthentication::class => self::STRICT_BODY,
        EnableTwoFactorAuthentication::class => self::STRICT_BODY,
        VerifyTwoFactorAuthenticationCode::class => self::STRICT_BODY,
    ];

    /** @var array<class-string,ModelStrategy> */
    private const EDGE_SCRIPTING = [
        GetCode::class => self::NONE,
        SetCode::class => self::STRICT_BODY,
        DeleteEdgeScript::class => self::STRICT_QUERY,
        GetEdgeScript::class => self::NONE,
        UpdateEdgeScript::class => self::STRICT_BODY,
        GetEdgeScriptStatistics::class => self::STRICT_QUERY,
        ListEdgeScripts::class => self::STRICT_QUERY,
        AddEdgeScript::class => self::STRICT_BODY,
        RotateDeploymentKey::class => self::NONE,
        AddVariable::class => self::STRICT_BODY,
        DeleteVariable::class => self::NONE,
        GetVariable::class => self::NONE,
        UpdateVariable::class => self::STRICT_BODY,
        UpsertVariable::class => self::STRICT_BODY,
        AddSecret::class => self::STRICT_BODY,
        ListSecrets::class => self::NONE,
        UpsertSecret::class => self::STRICT_BODY,
        DeleteSecret::class => self::NONE,
        UpdateSecret::class => self::STRICT_BODY,
        GetActiveReleases::class => self::NONE,
        GetReleases::class => self::STRICT_QUERY,
        PublishRelease::class => self::STRICT_BODY,
        PublishReleaseByPathParameter::class => self::STRICT_BODY,
    ];

    /** @var array<class-string,ModelStrategy> */
    private const EDGE_STORAGE = [
        DownloadFile::class => self::NONE,
        DownloadZip::class => self::STRICT_BODY,
        UploadFile::class => self::NONE,
        DeleteFile::class => self::NONE,
        ListFiles::class => self::NONE,
    ];


    /** @var array<class-string,ModelStrategy> */
    private const LOGGING = [
        GetLog::class => self::STRICT_QUERY,
    ];

    /** @var array<class-string,ModelStrategy> */
    private const SHIELD = [
        ListShieldZones::class => self::STRICT_QUERY,
        GetShieldZone::class => self::NONE,
        GetShieldZoneByPullZoneId::class => self::NONE,
        CreateShieldZone::class => self::STRICT_BODY,
        UpdateShieldZone::class => self::STRICT_BODY,
        ListWafRules::class => self::NONE,
        ReviewTriggeredRules::class => self::NONE,
        ReviewTriggeredRule::class => self::STRICT_BODY,
        ReviewTriggeredRuleAiRecommendation::class => self::NONE,
        ListCustomWafRules::class => self::STRICT_QUERY,
        GetCustomWafRule::class => self::NONE,
        UpdateCustomWafRule::class => self::STRICT_BODY,
        UpdateCustomWafRuleByPatch::class => self::STRICT_BODY,
        DeleteCustomWafRule::class => self::NONE,
        CreateCustomWafRule::class => self::STRICT_BODY,
        ListWafProfiles::class => self::NONE,
        ListWafEnums::class => self::NONE,
        ListWafEngineConfiguration::class => self::NONE,
        ListDdosEnums::class => self::NONE,
        ListRateLimits::class => self::STRICT_QUERY,
        GetRateLimit::class => self::NONE,
        UpdateRateLimit::class => self::STRICT_BODY,
        DeleteRateLimit::class => self::NONE,
        CreateRateLimit::class => self::STRICT_BODY,
        GetOverviewMetrics::class => self::NONE,
        ListRateLimitMetrics::class => self::NONE,
        GetRateLimitMetrics::class => self::NONE,
        GetWafRuleMetrics::class => self::NONE,
        ListEventLogs::class => self::NONE,
    ];

    /** @var array<class-string,ModelStrategy> */
    private const STREAM = [
        GetCollection::class => self::STRICT_QUERY,
        UpdateCollection::class => self::STRICT_BODY,
        DeleteCollection::class => self::NONE,
        ListCollections::class => self::STRICT_QUERY,
        CreateCollection::class => self::STRICT_BODY,
        GetVideo::class => self::NONE,
        UpdateVideo::class => self::STRICT_BODY,
        DeleteVideo::class => self::NONE,
        CreateVideo::class => self::STRICT_BODY,
        UploadVideo::class => self::STRICT_QUERY,
        GetVideoHeatmap::class => self::NONE,
        GetVideoPlayData::class => self::STRICT_QUERY,
        ListVideoStatistics::class => self::STRICT_QUERY,
        ReEncodeVideo::class => self::NONE,
        AddOutputCodecToVideo::class => self::NONE,
        RepackageVideo::class => self::STRICT_QUERY,
        ListVideos::class => self::STRICT_QUERY,
        SetThumbnail::class => self::STRICT_QUERY,
        FetchVideo::class => self::STRICT,
        AddCaption::class => self::STRICT_BODY,
        DeleteCaption::class => self::NONE,
        TranscribeVideo::class => self::STRICT_QUERY,
        GetVideoResolutionsInfo::class => self::NONE,
        DeleteUnconfiguredResolutions::class => self::STRICT_QUERY,
        GetOEmbed::class => self::STRICT_QUERY,
    ];

    /**
     * @return array<class-string,ModelStrategy>
     */
    public static function all(): array
    {
        return array_merge(
            self::BASE,
            self::EDGE_SCRIPTING,
            self::EDGE_STORAGE,
            self::LOGGING,
            self::SHIELD,
            self::STREAM,
        );
    }

    public function validationStrategy(): ValidationModelStrategy
    {
        return match ($this) {
            self::STRICT => new ValidationModelStrategy(
                query: new StrictQueryValidationStrategy(),
                body: new StrictBodyValidationStrategy(),
            ),
            self::STRICT_QUERY => new ValidationModelStrategy(
                query: new StrictQueryValidationStrategy(),
                body: new NoBodyValidationStrategy(),
            ),
            self::STRICT_BODY => new ValidationModelStrategy(
                query: new NoQueryValidationStrategy(),
                body: new StrictBodyValidationStrategy(),
            ),
            self::LAX => new ValidationModelStrategy(
                query: new LaxQueryValidationStrategy(),
                body: new LaxBodyValidationStrategy(),
            ),
            self::NONE => new ValidationModelStrategy(
                query: new NoQueryValidationStrategy(),
                body: new NoBodyValidationStrategy(),
            ),
        };
    }
}
