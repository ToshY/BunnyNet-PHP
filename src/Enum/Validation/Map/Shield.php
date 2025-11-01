<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\CreateShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\DeleteShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessListEnums;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\ListShieldZoneAccessLists;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\UpdateShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\UpdateShieldZoneCuratedThreatList;
use ToshY\BunnyNet\Model\Api\Shield\BotDetection\CreateOrUpdateShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\BotDetection\GetShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\Ddos\ListDdosEnums;
use ToshY\BunnyNet\Model\Api\Shield\EventLogs\ListEventLogs;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetBotDetectionMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetOverviewMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetRateLimitMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetUploadScanningMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetWafRuleMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\ListRateLimitMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Promo\GetCurrentPromotions;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\CreateRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\DeleteRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\GetRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\ListRateLimits;
use ToshY\BunnyNet\Model\Api\Shield\RateLimiting\UpdateRateLimit;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\CreateShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZoneByPullZoneId;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\ListShieldZones;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\ListShieldZonesPullzoneMapping;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\UpdateShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\UploadScanning\CreateOrUpdateShieldZoneUploadScanning;
use ToshY\BunnyNet\Model\Api\Shield\UploadScanning\GetShieldZoneUploadScanning;
use ToshY\BunnyNet\Model\Api\Shield\Waf\CreateCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\DeleteCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\GetCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\GetWafRules;
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

final class Shield
{
    /** @var array<class-string,ModelValidationStrategy> $map */
    public static array $map = [
        ListShieldZoneAccessLists::class => ModelValidationStrategy::NONE,
        CreateShieldZoneAccessList::class => ModelValidationStrategy::STRICT_BODY,
        UpdateShieldZoneCuratedThreatList::class => ModelValidationStrategy::STRICT_BODY,
        GetShieldZoneAccessList::class => ModelValidationStrategy::NONE,
        DeleteShieldZoneAccessList::class => ModelValidationStrategy::NONE,
        UpdateShieldZoneAccessList::class => ModelValidationStrategy::STRICT_BODY,
        GetShieldZoneAccessListEnums::class => ModelValidationStrategy::NONE,
        GetShieldZoneBotDetection::class => ModelValidationStrategy::NONE,
        CreateOrUpdateShieldZoneBotDetection::class => ModelValidationStrategy::STRICT_BODY,
        ListDdosEnums::class => ModelValidationStrategy::NONE,
        ListEventLogs::class => ModelValidationStrategy::NONE,
        GetOverviewMetrics::class => ModelValidationStrategy::NONE,
        ListRateLimitMetrics::class => ModelValidationStrategy::NONE,
        GetRateLimitMetrics::class => ModelValidationStrategy::NONE,
        GetWafRuleMetrics::class => ModelValidationStrategy::NONE,
        GetBotDetectionMetrics::class => ModelValidationStrategy::NONE,
        GetUploadScanningMetrics::class => ModelValidationStrategy::NONE,
        GetCurrentPromotions::class => ModelValidationStrategy::NONE,
        ListRateLimits::class => ModelValidationStrategy::STRICT_QUERY,
        GetRateLimit::class => ModelValidationStrategy::NONE,
        DeleteRateLimit::class => ModelValidationStrategy::NONE,
        UpdateRateLimit::class => ModelValidationStrategy::STRICT_BODY,
        CreateRateLimit::class => ModelValidationStrategy::STRICT_BODY,
        ListShieldZones::class => ModelValidationStrategy::STRICT_QUERY,
        ListShieldZonesPullzoneMapping::class => ModelValidationStrategy::NONE,
        GetShieldZone::class => ModelValidationStrategy::NONE,
        GetShieldZoneByPullZoneId::class => ModelValidationStrategy::NONE,
        CreateShieldZone::class => ModelValidationStrategy::STRICT_BODY,
        UpdateShieldZone::class => ModelValidationStrategy::STRICT_BODY,
        GetShieldZoneUploadScanning::class => ModelValidationStrategy::NONE,
        CreateOrUpdateShieldZoneUploadScanning::class => ModelValidationStrategy::STRICT_BODY,
        GetWafRules::class => ModelValidationStrategy::NONE,
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
