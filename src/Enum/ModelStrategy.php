<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

use ToshY\BunnyNet\Model\API\Base\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\GetAbuseCase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\GetDMCACase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\API\Base\AbuseCase\ResolveDMCACase;
use ToshY\BunnyNet\Model\API\Base\APIKeys\ListAPIKeys;
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
use ToshY\BunnyNet\Model\API\Base\Integration\GetGitHubIntegration;
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
use ToshY\BunnyNet\Model\API\Base\PullZone\GetWAFStatistics;
use ToshY\BunnyNet\Model\API\Base\PullZone\ListPullZones;
use ToshY\BunnyNet\Model\API\Base\PullZone\LoadFreeCertificate;
use ToshY\BunnyNet\Model\API\Base\PullZone\PurgeCache;
use ToshY\BunnyNet\Model\API\Base\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\API\Base\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\API\Base\PullZone\SetForceSSL;
use ToshY\BunnyNet\Model\API\Base\PullZone\SetZoneSecurityEnabled;
use ToshY\BunnyNet\Model\API\Base\PullZone\SetZoneSecurityIncludeHashRemoteIPEnabled;
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
use ToshY\BunnyNet\Model\API\Base\StorageZone\ResetReadOnlyPassword as StorageZoneResetReadOnlyPassword;
use ToshY\BunnyNet\Model\API\Base\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddAllowedReferer as VideoLibraryAllowedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddBlockedReferer as VideoLibraryAddBlockedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteAllowedReferer as VideoLibraryDeleteAllowedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteBlockedReferer as VideoLibraryDeleteBlockedReferer;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\GetLanguages;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\ResetPassword as VideoLibraryResetPassword;
use ToshY\BunnyNet\Model\API\Base\StreamVideoLibrary\ResetPasswordByPathParameter as VideoLibraryResetPasswordByPathParameter;
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
use ToshY\BunnyNet\Model\API\Base\User\GetMarketingDetails;
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
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\GetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\SetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\AddEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\DeleteEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScriptStatistics;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\ListEdgeScripts;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\RotateDeploymentKey;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\UpdateEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\GetActiveReleases;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\GetReleases;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\PublishRelease;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\PublishReleaseByPathParameter;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\AddSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\DeleteSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\ListSecrets;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\UpdateSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\UpsertSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\AddVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\DeleteVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\GetVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpdateVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpsertVariable;
use ToshY\BunnyNet\Model\API\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\DownloadZip;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\UploadFile;
use ToshY\BunnyNet\Model\API\Logging\GetLog;
use ToshY\BunnyNet\Model\API\Shield\DDoS\ListDDoSEnums;
use ToshY\BunnyNet\Model\API\Shield\EventLogs\ListEventLogs;
use ToshY\BunnyNet\Model\API\Shield\Metrics\GetOverviewMetrics;
use ToshY\BunnyNet\Model\API\Shield\Metrics\GetRateLimitMetrics;
use ToshY\BunnyNet\Model\API\Shield\Metrics\GetWAFRuleMetrics;
use ToshY\BunnyNet\Model\API\Shield\Metrics\ListRateLimitMetrics;
use ToshY\BunnyNet\Model\API\Shield\RateLimiting\CreateRateLimit;
use ToshY\BunnyNet\Model\API\Shield\RateLimiting\DeleteRateLimit;
use ToshY\BunnyNet\Model\API\Shield\RateLimiting\GetRateLimit;
use ToshY\BunnyNet\Model\API\Shield\RateLimiting\ListRateLimits;
use ToshY\BunnyNet\Model\API\Shield\RateLimiting\UpdateRateLimit;
use ToshY\BunnyNet\Model\API\Shield\WAF\CreateCustomWAFRule;
use ToshY\BunnyNet\Model\API\Shield\WAF\DeleteCustomWAFRule;
use ToshY\BunnyNet\Model\API\Shield\WAF\GetCustomWAFRule;
use ToshY\BunnyNet\Model\API\Shield\WAF\ListCustomWAFRules;
use ToshY\BunnyNet\Model\API\Shield\WAF\ListWAFEngineConfiguration;
use ToshY\BunnyNet\Model\API\Shield\WAF\ListWAFEnums;
use ToshY\BunnyNet\Model\API\Shield\WAF\ListWAFProfiles;
use ToshY\BunnyNet\Model\API\Shield\WAF\ListWAFRules;
use ToshY\BunnyNet\Model\API\Shield\WAF\ReviewTriggeredRule;
use ToshY\BunnyNet\Model\API\Shield\WAF\ReviewTriggeredRuleAIRecommendation;
use ToshY\BunnyNet\Model\API\Shield\WAF\ReviewTriggeredRules;
use ToshY\BunnyNet\Model\API\Shield\WAF\UpdateCustomWAFRule;
use ToshY\BunnyNet\Model\API\Shield\WAF\UpdateCustomWAFRuleByPatch;
use ToshY\BunnyNet\Model\API\Shield\Zone\CreateShieldZone;
use ToshY\BunnyNet\Model\API\Shield\Zone\GetShieldZone;
use ToshY\BunnyNet\Model\API\Shield\Zone\GetShieldZoneByPullZoneId;
use ToshY\BunnyNet\Model\API\Shield\Zone\ListShieldZones;
use ToshY\BunnyNet\Model\API\Shield\Zone\UpdateShieldZone;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\AddOutputCodecToVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteUnconfiguredResolutions;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoPlayData;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoResolutionsInfo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ListVideoStatistics;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\RepackageVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\TranscribeVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Model\API\Stream\OEmbed\GetOEmbed;
use ToshY\BunnyNet\Validation\Strategy\Body\NoBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Body\StrictBodyValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\NoQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\Query\StrictQueryValidationStrategy;
use ToshY\BunnyNet\Validation\Strategy\ValidationModelStrategy;

enum ModelStrategy
{
    case STRICT;

    case STRICT_QUERY;

    case STRICT_BODY;

    case NONE;

    /** @var array<class-string,ModelStrategy> */
    private const BASE = [
        ListAbuseCases::class => self::STRICT_QUERY,
        GetDMCACase::class => self::NONE,
        GetAbuseCase::class => self::NONE,
        ResolveDMCACase::class => self::NONE,
        ResolveAbuseCase::class => self::NONE,
        CheckAbuseCase::class => self::NONE,
        AuthJwt2fa::class => self::STRICT_BODY,
        RefreshJwt::class => self::NONE,
        ListCountries::class => self::NONE,
        ListAPIKeys::class => self::STRICT_QUERY,
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
        ListDRMCertificates::class => self::STRICT_QUERY,
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
        ListDNSZones::class => self::STRICT_QUERY,
        AddDNSZone::class => self::STRICT_BODY,
        GetDNSZone::class => self::NONE,
        UpdateDNSZone::class => self::STRICT_BODY,
        DeleteDNSZone::class => self::NONE,
        EnableDNSSECOnDNSZone::class => self::NONE,
        DisableDNSSECOnDNSZone::class => self::NONE,
        ExportDNSRecords::class => self::NONE,
        GetDNSZoneQueryStatistics::class => self::STRICT_QUERY,
        CheckDNSZoneAvailability::class => self::STRICT_BODY,
        AddDNSRecord::class => self::STRICT_BODY,
        UpdateDNSRecord::class => self::STRICT_BODY,
        DeleteDNSRecord::class => self::NONE,
        RecheckDNSConfiguration::class => self::NONE,
        DismissDNSConfigurationNotice::class => self::NONE,
        ImportDNSRecords::class => self::NONE,
        ListPullZones::class => self::STRICT_QUERY,
        AddPullZone::class => self::STRICT_BODY,
        GetPullZone::class => self::STRICT_QUERY,
        UpdatePullZone::class => self::STRICT_BODY,
        DeletePullZone::class => self::NONE,
        DeleteEdgeRule::class => self::NONE,
        AddOrUpdateEdgeRule::class => self::STRICT_BODY,
        SetEdgeRuleEnabled::class => self::STRICT_BODY,
        SetZoneSecurityEnabled::class => self::NONE,
        SetZoneSecurityIncludeHashRemoteIPEnabled::class => self::NONE,
        GetOriginShieldQueueStatistics::class => self::STRICT_QUERY,
        GetSafeHopStatistics::class => self::STRICT_QUERY,
        GetOptimizerStatistics::class => self::STRICT_QUERY,
        GetWAFStatistics::class => self::STRICT_QUERY,
        LoadFreeCertificate::class => self::STRICT_QUERY,
        PurgeCache::class => self::STRICT_BODY,
        CheckPullZoneAvailability::class => self::STRICT_BODY,
        AddCustomCertificate::class => self::STRICT_BODY,
        DeleteCertificate::class => self::STRICT_BODY,
        AddCustomHostname::class => self::STRICT_BODY,
        DeleteCustomHostname::class => self::STRICT_BODY,
        SetForceSSL::class => self::STRICT_BODY,
        ResetTokenKey::class => self::NONE,
        PullZoneAddAllowedReferer::class => self::STRICT_BODY,
        PullZoneDeleteAllowedReferer::class => self::STRICT_BODY,
        PullZoneAddBlockedReferer::class => self::STRICT_BODY,
        PullZoneDeleteBlockedReferer::class => self::STRICT_BODY,
        AddBlockedIP::class => self::STRICT_BODY,
        DeleteBlockedIP::class => self::STRICT_BODY,
        PurgeURL::class => self::STRICT_QUERY,
        PurgeURLByHeader::class => self::STRICT_QUERY,
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
        ResetAPIKey::class => self::NONE,
        ListCloseAccountReasons::class => self::NONE,
        CloseAccount::class => self::STRICT_BODY,
        GetDPADetails::class => self::NONE,
        AcceptDPA::class => self::NONE,
        GetDPADetailsHTML::class => self::NONE,
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
        ListWAFRules::class => self::NONE,
        ReviewTriggeredRules::class => self::NONE,
        ReviewTriggeredRule::class => self::STRICT_BODY,
        ReviewTriggeredRuleAIRecommendation::class => self::NONE,
        ListCustomWAFRules::class => self::STRICT_QUERY,
        GetCustomWAFRule::class => self::NONE,
        UpdateCustomWAFRule::class => self::STRICT_BODY,
        UpdateCustomWAFRuleByPatch::class => self::STRICT_BODY,
        DeleteCustomWAFRule::class => self::NONE,
        CreateCustomWAFRule::class => self::STRICT_BODY,
        ListWAFProfiles::class => self::NONE,
        ListWAFEnums::class => self::NONE,
        ListWAFEngineConfiguration::class => self::NONE,
        ListDDoSEnums::class => self::NONE,
        ListRateLimits::class => self::STRICT_QUERY,
        GetRateLimit::class => self::NONE,
        UpdateRateLimit::class => self::STRICT_BODY,
        DeleteRateLimit::class => self::NONE,
        CreateRateLimit::class => self::STRICT_BODY,
        GetOverviewMetrics::class => self::NONE,
        ListRateLimitMetrics::class => self::NONE,
        GetRateLimitMetrics::class => self::NONE,
        GetWAFRuleMetrics::class => self::NONE,
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
            self::NONE => new ValidationModelStrategy(
                query: new NoQueryValidationStrategy(),
                body: new NoBodyValidationStrategy(),
            ),
        };
    }
}
