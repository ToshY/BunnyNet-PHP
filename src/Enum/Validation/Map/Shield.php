<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\DeleteShieldZoneAccessListsById;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessLists;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessListsById;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessListsEnums;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\PatchShieldZoneAccessListsById;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\PatchShieldZoneAccessListsConfigurationsById;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\PostShieldZoneAccessLists;
use ToshY\BunnyNet\Model\Api\Shield\BotDetection\GetShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\BotDetection\PatchShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\Ddos\ListDdosEnums;
use ToshY\BunnyNet\Model\Api\Shield\EventLogs\ListEventLogs;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetMetricsShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetMetricsShieldZoneUploadScanning;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetOverviewMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetRateLimitMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetWafRuleMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\ListRateLimitMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Promo\GetPromoState;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\CreateRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\DeleteRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\GetRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\ListRateLimits;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\UpdateRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZonesPullzoneMapping;
use ToshY\BunnyNet\Model\Api\Shield\UploadScanning\GetShieldZoneUploadScanning;
use ToshY\BunnyNet\Model\Api\Shield\UploadScanning\PatchShieldZoneUploadScanning;
use ToshY\BunnyNet\Model\Api\Shield\Waf\CreateCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\DeleteCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\GetCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\GetWafRulesByShieldzoneid;
use ToshY\BunnyNet\Model\Api\Shield\Waf\GetWafRulesPlanSegmentation;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListCustomWafRules;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafEngineConfiguration;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafEnums;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafProfiles;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ReviewTriggeredRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ReviewTriggeredRuleAiRecommendation;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ReviewTriggeredRules;
use ToshY\BunnyNet\Model\Api\Shield\Waf\UpdateCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\UpdateCustomWafRuleByPatch;
use ToshY\BunnyNet\Model\Api\Shield\Zone\CreateShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZoneByPullZoneId;
use ToshY\BunnyNet\Model\Api\Shield\Zone\ListShieldZones;
use ToshY\BunnyNet\Model\Api\Shield\Zone\UpdateShieldZone;

final class Shield
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        GetShieldZoneAccessLists::class => ModelValidationStrategy::NONE,
        PostShieldZoneAccessLists::class => ModelValidationStrategy::STRICT_BODY,
        PatchShieldZoneAccessListsConfigurationsById::class => ModelValidationStrategy::STRICT_BODY,
        GetShieldZoneAccessListsById::class => ModelValidationStrategy::NONE,
        DeleteShieldZoneAccessListsById::class => ModelValidationStrategy::NONE,
        PatchShieldZoneAccessListsById::class => ModelValidationStrategy::STRICT_BODY,
        GetShieldZoneAccessListsEnums::class => ModelValidationStrategy::NONE,
        GetShieldZoneBotDetection::class => ModelValidationStrategy::NONE,
        PatchShieldZoneBotDetection::class => ModelValidationStrategy::STRICT_BODY,
        ListDdosEnums::class => ModelValidationStrategy::NONE,
        ListEventLogs::class => ModelValidationStrategy::NONE,
        GetOverviewMetrics::class => ModelValidationStrategy::NONE,
        ListRateLimitMetrics::class => ModelValidationStrategy::NONE,
        GetRateLimitMetrics::class => ModelValidationStrategy::NONE,
        GetWafRuleMetrics::class => ModelValidationStrategy::NONE,
        GetMetricsShieldZoneBotDetection::class => ModelValidationStrategy::NONE,
        GetMetricsShieldZoneUploadScanning::class => ModelValidationStrategy::NONE,
        GetPromoState::class => ModelValidationStrategy::NONE,
        ListRateLimits::class => ModelValidationStrategy::STRICT_QUERY,
        GetRateLimit::class => ModelValidationStrategy::NONE,
        DeleteRateLimit::class => ModelValidationStrategy::NONE,
        UpdateRateLimit::class => ModelValidationStrategy::STRICT_BODY,
        CreateRateLimit::class => ModelValidationStrategy::STRICT_BODY,
        ListShieldZones::class => ModelValidationStrategy::STRICT_QUERY,
        GetShieldZonesPullzoneMapping::class => ModelValidationStrategy::NONE,
        GetShieldZone::class => ModelValidationStrategy::NONE,
        GetShieldZoneByPullZoneId::class => ModelValidationStrategy::NONE,
        CreateShieldZone::class => ModelValidationStrategy::STRICT_BODY,
        UpdateShieldZone::class => ModelValidationStrategy::STRICT_BODY,
        GetShieldZoneUploadScanning::class => ModelValidationStrategy::NONE,
        PatchShieldZoneUploadScanning::class => ModelValidationStrategy::STRICT_BODY,
        GetWafRulesByShieldzoneid::class => ModelValidationStrategy::NONE,
        GetWafRulesPlanSegmentation::class => ModelValidationStrategy::NONE,
        ReviewTriggeredRules::class => ModelValidationStrategy::NONE,
        ReviewTriggeredRule::class => ModelValidationStrategy::STRICT_BODY,
        ReviewTriggeredRuleAiRecommendation::class => ModelValidationStrategy::NONE,
        ListCustomWafRules::class => ModelValidationStrategy::STRICT_QUERY,
        GetCustomWafRule::class => ModelValidationStrategy::NONE,
        UpdateCustomWafRule::class => ModelValidationStrategy::STRICT_BODY,
        DeleteCustomWafRule::class => ModelValidationStrategy::NONE,
        UpdateCustomWafRuleByPatch::class => ModelValidationStrategy::STRICT_BODY,
        CreateCustomWafRule::class => ModelValidationStrategy::STRICT_BODY,
        ListWafProfiles::class => ModelValidationStrategy::NONE,
        ListWafEnums::class => ModelValidationStrategy::NONE,
        ListWafEngineConfiguration::class => ModelValidationStrategy::NONE,
    ];
}
