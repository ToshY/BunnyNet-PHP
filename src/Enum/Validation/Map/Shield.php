<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Validation\Map;

use ToshY\BunnyNet\Enum\Validation\ModelValidationStrategy;
use ToshY\BunnyNet\Model\Api\Shield\Ddos\ListDdosEnums;
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
use ToshY\BunnyNet\Model\Api\Shield\Waf\CreateCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\DeleteCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\GetCustomWafRule;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListCustomWafRules;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafEngineConfiguration;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafEnums;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafProfiles;
use ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafRules;
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
    /** @var array<class-string,ModelValidationStrategy> */
    public static array $map = [
        ListShieldZones::class => ModelValidationStrategy::STRICT_QUERY,
        GetShieldZone::class => ModelValidationStrategy::NONE,
        GetShieldZoneByPullZoneId::class => ModelValidationStrategy::NONE,
        CreateShieldZone::class => ModelValidationStrategy::STRICT_BODY,
        UpdateShieldZone::class => ModelValidationStrategy::STRICT_BODY,
        ListWafRules::class => ModelValidationStrategy::NONE,
        ReviewTriggeredRules::class => ModelValidationStrategy::NONE,
        ReviewTriggeredRule::class => ModelValidationStrategy::STRICT_BODY,
        ReviewTriggeredRuleAiRecommendation::class => ModelValidationStrategy::NONE,
        ListCustomWafRules::class => ModelValidationStrategy::STRICT_QUERY,
        GetCustomWafRule::class => ModelValidationStrategy::NONE,
        UpdateCustomWafRule::class => ModelValidationStrategy::STRICT_BODY,
        UpdateCustomWafRuleByPatch::class => ModelValidationStrategy::STRICT_BODY,
        DeleteCustomWafRule::class => ModelValidationStrategy::NONE,
        CreateCustomWafRule::class => ModelValidationStrategy::STRICT_BODY,
        ListWafProfiles::class => ModelValidationStrategy::NONE,
        ListWafEnums::class => ModelValidationStrategy::NONE,
        ListWafEngineConfiguration::class => ModelValidationStrategy::NONE,
        ListDdosEnums::class => ModelValidationStrategy::NONE,
        ListRateLimits::class => ModelValidationStrategy::STRICT_QUERY,
        GetRateLimit::class => ModelValidationStrategy::NONE,
        UpdateRateLimit::class => ModelValidationStrategy::STRICT_BODY,
        DeleteRateLimit::class => ModelValidationStrategy::NONE,
        CreateRateLimit::class => ModelValidationStrategy::STRICT_BODY,
        GetOverviewMetrics::class => ModelValidationStrategy::NONE,
        ListRateLimitMetrics::class => ModelValidationStrategy::NONE,
        GetRateLimitMetrics::class => ModelValidationStrategy::NONE,
        GetWafRuleMetrics::class => ModelValidationStrategy::NONE,
        ListEventLogs::class => ModelValidationStrategy::NONE,
    ];
}
