<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Generator\Map;

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

final class Shield
{
    /** @var array<string,array<string,class-string|null>> */
    public static array $endpoints = [
        '/shield/ddos/enums' => [
            'get' => ListDDoSEnums::class,
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
            'get' => GetWAFRuleMetrics::class,
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
            'get' => ListWAFRules::class,
        ],
        '/shield/waf/rules/review-triggered/{shieldZoneId}' => [
            'get' => ReviewTriggeredRules::class,
            'post' => ReviewTriggeredRule::class,
        ],
        '/shield/waf/rules/review-triggered/ai-recommendation/{shieldZoneId}/{ruleId}' => [
            'get' => ReviewTriggeredRuleAIRecommendation::class,
        ],
        '/shield/waf/custom-rules/{shieldZoneId}' => [
            'get' => ListCustomWAFRules::class,
        ],
        '/shield/waf/custom-rule/{id}' => [
            'get' => GetCustomWAFRule::class,
            'put' => UpdateCustomWAFRule::class,
            'delete' => DeleteCustomWAFRule::class,
            'patch' => UpdateCustomWAFRuleByPatch::class,
        ],
        '/shield/waf/custom-rule' => [
            'post' => CreateCustomWAFRule::class,
        ],
        '/shield/waf/profiles' => [
            'get' => ListWAFProfiles::class,
        ],
        '/shield/waf/enums' => [
            'get' => ListWAFEnums::class,
        ],
        '/shield/waf/engine-config' => [
            'get' => ListWAFEngineConfiguration::class,
        ],
    ];
}
