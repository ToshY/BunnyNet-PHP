<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

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

final class Shield
{
    /** @var array<string,array<string,class-string|null>> */
    public static array $endpoints = [
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
        '/shield/waf/rules' => [
            'get' => ListWafRules::class,
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
