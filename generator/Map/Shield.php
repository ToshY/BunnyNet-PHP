<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

use ToshY\BunnyNet\Model\Api\Shield\AccessLists\DeleteShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\ListShieldZoneAccessLists;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessListEnums;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\UpdateShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\UpdateShieldZoneCuratedThreatList;
use ToshY\BunnyNet\Model\Api\Shield\AccessLists\CreateShieldZoneAccessList;
use ToshY\BunnyNet\Model\Api\Shield\BotDetection\GetShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\BotDetection\CreateOrUpdateShieldZoneBotDetection;
use ToshY\BunnyNet\Model\Api\Shield\Ddos\ListDdosEnums;
use ToshY\BunnyNet\Model\Api\Shield\EventLogs\ListEventLogs;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetBotDetectionMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetUploadScanningMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetOverviewMetrics;
use ToshY\BunnyNet\Model\Api\Shield\Metrics\GetRateLimitMetrics;
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
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZonesPullzoneMapping;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\ListShieldZones;
use ToshY\BunnyNet\Model\Api\Shield\ShieldZone\UpdateShieldZone;
use ToshY\BunnyNet\Model\Api\Shield\UploadScanning\GetShieldZoneUploadScanning;
use ToshY\BunnyNet\Model\Api\Shield\UploadScanning\CreateOrUpdateShieldZoneUploadScanning;
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

/**
 * @internal
 */
final class Shield
{
    /** @var array<string,array<string,class-string|null>> $endpoints */
    public static array $endpoints = [
        '/shield/shield-zone/{shieldZoneId}/access-lists' => [
            'get' => ListShieldZoneAccessLists::class,
            'post' => CreateShieldZoneAccessList::class,
        ],
        '/shield/shield-zone/{shieldZoneId}/access-lists/configurations/{id}' => [
            'patch' => UpdateShieldZoneCuratedThreatList::class,
        ],
        '/shield/shield-zone/{shieldZoneId}/access-lists/{id}' => [
            'get' => GetShieldZoneAccessList::class,
            'delete' => DeleteShieldZoneAccessList::class,
            'patch' => UpdateShieldZoneAccessList::class,
        ],
        '/shield/shield-zone/{shieldZoneId}/access-lists/enums' => [
            'get' => GetShieldZoneAccessListEnums::class,
        ],
        '/shield/shield-zone/{shieldZoneId}/bot-detection' => [
            'get' => GetShieldZoneBotDetection::class,
            'patch' => CreateOrUpdateShieldZoneBotDetection::class,
        ],
        '/shield/ddos/enums' => [
            'get' => ListDdosEnums::class,
        ],
        '/shield/event-logs/{shieldZoneId}/{date}/{continuationToken}' => [
            'get' => ListEventLogs::class,
        ],
        '/shield/metrics/overview/{shieldZoneId}' => [
            'get' => GetOverviewMetrics::class,
        ],
        '/shield/metrics/rate-limits/{shieldZoneId}' => [
            'get' => ListRateLimitMetrics::class,
        ],
        '/shield/metrics/rate-limit/{id}' => [
            'get' => GetRateLimitMetrics::class,
        ],
        '/shield/metrics/shield-zone/{shieldZoneId}/waf-rule/{ruleId}' => [
            'get' => GetWafRuleMetrics::class,
        ],
        '/shield/metrics/shield-zone/{shieldZoneId}/bot-detection' => [
            'get' => GetBotDetectionMetrics::class,
        ],
        '/shield/metrics/shield-zone/{shieldZoneId}/upload-scanning' => [
            'get' => GetUploadScanningMetrics::class,
        ],
        '/shield/promo/state' => [
            'get' => GetCurrentPromotions::class,
        ],
        '/shield/rate-limits/{shieldZoneId}' => [
            'get' => ListRateLimits::class,
        ],
        '/shield/rate-limit/{id}' => [
            'get' => GetRateLimit::class,
            'delete' => DeleteRateLimit::class,
            'patch' => UpdateRateLimit::class,
        ],
        '/shield/rate-limit' => [
            'post' => CreateRateLimit::class,
        ],
        '/shield/shield-zones' => [
            'get' => ListShieldZones::class,
        ],
        '/shield/shield-zones/pullzone-mapping' => [
            'get' => GetShieldZonesPullzoneMapping::class,
        ],
        '/shield/shield-zone/{shieldZoneId}' => [
            'get' => GetShieldZone::class,
        ],
        '/shield/shield-zone/get-by-pullzone/{pullZoneId}' => [
            'get' => GetShieldZoneByPullZoneId::class,
        ],
        '/shield/shield-zone' => [
            'post' => CreateShieldZone::class,
            'patch' => UpdateShieldZone::class,
        ],
        '/shield/shield-zone/{shieldZoneId}/upload-scanning' => [
            'get' => GetShieldZoneUploadScanning::class,
            'patch' => CreateOrUpdateShieldZoneUploadScanning::class,
        ],
        '/shield/waf/rules/{shieldZoneId}' => [
            'get' => GetWafRules::class,
        ],
        '/shield/waf/rules/plan-segmentation' => [
            'get' => GetWafRulesPlanSegmentation::class,
        ],
        '/shield/waf/rules/review-triggered/{shieldZoneId}' => [
            'get' => ReviewTriggeredRules::class,
            'post' => ReviewTriggeredRule::class,
        ],
        '/shield/waf/rules/review-triggered/ai-recommendation/{shieldZoneId}/{ruleId}' => [
            'get' => ReviewTriggeredRuleAiRecommendation::class,
        ],
        '/shield/waf/custom-rules/{shieldZoneId}' => [
            'get' => ListCustomWafRules::class,
        ],
        '/shield/waf/custom-rule/{id}' => [
            'get' => GetCustomWafRule::class,
            'put' => UpdateCustomWafRule::class,
            'delete' => DeleteCustomWafRule::class,
            'patch' => UpdateCustomWafRuleByPatch::class,
        ],
        '/shield/waf/custom-rule' => [
            'post' => CreateCustomWafRule::class,
        ],
        '/shield/waf/profiles' => [
            'get' => ListWafProfiles::class,
        ],
        '/shield/waf/enums' => [
            'get' => ListWafEnums::class,
        ],
        '/shield/waf/engine-config' => [
            'get' => ListWafEngineConfiguration::class,
        ],
    ];
}
