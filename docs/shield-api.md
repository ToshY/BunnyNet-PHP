# Shield API

Bunny Shield: a powerful, next-generation web security suite—built to democratize access to serious, scalable protection that supports you from the moment you go live.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyHttpClient;
use ToshY\BunnyNet\Enum\Endpoint;

$bunnyHttpClient = new BunnyHttpClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
    // Provide the account API key.
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    baseUrl: Endpoint::SHIELD
);
```

## Usage

### Shield Zone

#### [List Shield Zones](https://docs.bunny.net/reference/get_shield-shield-zones)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Zone\ListShieldZones(
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

#### [Get Shield Zone](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZone(
        shieldZoneId: 1,
    )
);
```

#### [Get Shield Zone (by PullZoneId)](https://docs.bunny.net/reference/get_shield-shield-zone-get-by-pullzone-pullzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Zone\GetShieldZoneByPullZoneId(
        pullZoneId: 1,
    )
);
```

#### [Create Shield Zone](https://docs.bunny.net/reference/post_shield-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Zone\CreateShieldZone(
        body: [
            'pullZoneId' => 1,
            'shieldZone' => [
                'shieldZoneId' => 2,
                'premiumPlan' => false,
                'learningMode' => true,
                'learningModeUntil' => 'Y-m-d\TH:i:s',
                'wafEnabled' => true,
                'wafExecutionMode' => 1,
                'wafDisabledRules' => [],
                'wafLogOnlyRules' => [],
                'wafRequestHeaderLoggingEnabled' => true,
                'wafRequestIgnoredHeaders' => [],
                'wafRealtimeThreatIntelligenceEnabled' => false,
                'wafProfileId' => 1,
                'wafEngineConfig' => [],
                'dDoSShieldSensitivity' => 1,
                'dDoSExecutionMode' => 1,
                'dDoSChallengeWindow' => 1,
                'blockVpn' => false,
                'blockTor' => false,
                'blockDatacentre' => false,
                'whitelabelResponsePages' => false,
            ],
        ],
    )
);
```

!!! note

    - The key `shieldZoneId` is not needed or required when creating a shield zone.

#### [Update Shield Zone](https://docs.bunny.net/reference/patch_shield-shield-zone2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Zone\UpdateShieldZone(
        body: [
            'shieldZoneId' => 2,
            'shieldZone' => [
                'shieldZoneId' => 2,
                'premiumPlan' => false,
                'learningMode' => true,
                'learningModeUntil' => 'Y-m-d\TH:i:s',
                'wafEnabled' => true,
                'wafExecutionMode' => 1,
                'wafDisabledRules' => [],
                'wafLogOnlyRules' => [],
                'wafRequestHeaderLoggingEnabled' => true,
                'wafRequestIgnoredHeaders' => [],
                'wafRealtimeThreatIntelligenceEnabled' => false,
                'wafProfileId' => 1,
                'wafEngineConfig' => [],
                'dDoSShieldSensitivity' => 1,
                'dDoSExecutionMode' => 1,
                'dDoSChallengeWindow' => 1,
                'blockVpn' => false,
                'blockTor' => false,
                'blockDatacentre' => false,
                'whitelabelResponsePages' => false,
            ],
        ],
    )
);
```

### WAF

#### [List WAF Rules](https://docs.bunny.net/reference/get_shield-waf-rules)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ListCustomWafRules()
);
```

#### [Review Triggered Rules](https://docs.bunny.net/reference/get_shield-waf-rules-review-triggered-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ReviewTriggeredRules(
        shieldZoneId: 1,
    )
);
```

#### [Review Triggered Rule](https://docs.bunny.net/reference/post_shield-waf-rules-review-triggered-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ReviewTriggeredRule(
        shieldZoneId: 1,
        body: [
            'ruleId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'action' => 2,
        ],
    )
);
```

#### [Review Triggered Rule AI Recommendation](https://docs.bunny.net/reference/get_shield-waf-rules-review-triggered-ai-recommendation-shieldzoneid-ruleid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ReviewTriggeredRuleAiRecommendation(
        shieldZoneId: 1,
        ruleId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [List Custom WAF Rules](https://docs.bunny.net/reference/get_shield-waf-custom-rules-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ListCustomWafRules(
        shieldZoneId: 1,
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

#### [Get Custom WAF Rule](https://docs.bunny.net/reference/get_shield-waf-custom-rule-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\GetCustomWafRule(
        id: 1,
    )
);
```

#### [Update Custom WAF Rule](https://docs.bunny.net/reference/put_shield-waf-custom-rule-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\UpdateCustomWafRule(
        id: 1,
        body: [
            'ruleName' => 'string',
            'ruleDescription' => 'string',
            'ruleConfiguration' => [
                'actionType' => 1,
                'variableTypes' => [
                    'REQUEST_URI' => 'string',
                    'REQUEST_URI_RAW' => 'string',
                    'ARGS' => 'string',
                    'ARGS_COMBINED_SIZE' => 'string',
                    'ARGS_GET' => 'string',
                    'ARGS_GET_NAMES' => 'string',
                    'ARGS_POST' => 'string',
                    'ARGS_POST_NAMES' => 'string',
                    'FILES_NAMES' => 'string',
                    'GEO' => 'string',
                    'REMOTE_ADDR' => 'string',
                    'QUERY_STRING' => 'string',
                    'REQUEST_BASENAME' => 'string',
                    'REQUEST_BODY' => 'string',
                    'REQUEST_COOKIES_NAMES' => 'string',
                    'REQUEST_COOKIES' => 'string',
                    'REQUEST_FILENAME' => 'string',
                    'REQUEST_HEADERS_NAMES' => 'string',
                    'REQUEST_HEADERS' => 'string',
                    'REQUEST_LINE' => 'string',
                    'REQUEST_METHOD' => 'string',
                    'REQUEST_PROTOCOL' => 'string',
                    'RESPONSE_BODY' => 'string',
                    'RESPONSE_HEADERS' => 'string',
                    'RESPONSE_STATUS' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
            ],
        ],
    )
);
```

#### [Update Custom WAF Rule (PATCH)](https://docs.bunny.net/reference/patch_shield-waf-custom-rule-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\UpdateCustomWafRuleByPatch(
        id: 1,
        body: [
            'ruleName' => 'string',
            'ruleDescription' => 'string',
            'ruleConfiguration' => [
                'actionType' => 1,
                'variableTypes' => [
                    'REQUEST_URI' => 'string',
                    'REQUEST_URI_RAW' => 'string',
                    'ARGS' => 'string',
                    'ARGS_COMBINED_SIZE' => 'string',
                    'ARGS_GET' => 'string',
                    'ARGS_GET_NAMES' => 'string',
                    'ARGS_POST' => 'string',
                    'ARGS_POST_NAMES' => 'string',
                    'FILES_NAMES' => 'string',
                    'GEO' => 'string',
                    'REMOTE_ADDR' => 'string',
                    'QUERY_STRING' => 'string',
                    'REQUEST_BASENAME' => 'string',
                    'REQUEST_BODY' => 'string',
                    'REQUEST_COOKIES_NAMES' => 'string',
                    'REQUEST_COOKIES' => 'string',
                    'REQUEST_FILENAME' => 'string',
                    'REQUEST_HEADERS_NAMES' => 'string',
                    'REQUEST_HEADERS' => 'string',
                    'REQUEST_LINE' => 'string',
                    'REQUEST_METHOD' => 'string',
                    'REQUEST_PROTOCOL' => 'string',
                    'RESPONSE_BODY' => 'string',
                    'RESPONSE_HEADERS' => 'string',
                    'RESPONSE_STATUS' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
            ],
        ],
    )
);
```

#### [Delete Custom WAF Rule](https://docs.bunny.net/reference/delete_shield-waf-custom-rule-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\DeleteCustomWafRule(
        id: 1,
    )
);
```


#### [Create Custom WAF Rule](https://docs.bunny.net/reference/post_shield-waf-custom-rule)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\CreateCustomWafRule(
        body: [
            'shieldZoneId' => 1,
            'ruleName' => 'string',
            'ruleDescription' => 'string',
            'ruleConfiguration' => [
                'actionType' => 1,
                'variableTypes' => [
                    'REQUEST_URI' => 'string',
                    'REQUEST_URI_RAW' => 'string',
                    'ARGS' => 'string',
                    'ARGS_COMBINED_SIZE' => 'string',
                    'ARGS_GET' => 'string',
                    'ARGS_GET_NAMES' => 'string',
                    'ARGS_POST' => 'string',
                    'ARGS_POST_NAMES' => 'string',
                    'FILES_NAMES' => 'string',
                    'GEO' => 'string',
                    'REMOTE_ADDR' => 'string',
                    'QUERY_STRING' => 'string',
                    'REQUEST_BASENAME' => 'string',
                    'REQUEST_BODY' => 'string',
                    'REQUEST_COOKIES_NAMES' => 'string',
                    'REQUEST_COOKIES' => 'string',
                    'REQUEST_FILENAME' => 'string',
                    'REQUEST_HEADERS_NAMES' => 'string',
                    'REQUEST_HEADERS' => 'string',
                    'REQUEST_LINE' => 'string',
                    'REQUEST_METHOD' => 'string',
                    'REQUEST_PROTOCOL' => 'string',
                    'RESPONSE_BODY' => 'string',
                    'RESPONSE_HEADERS' => 'string',
                    'RESPONSE_STATUS' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
            ],
        ],
    )
);
```

!!! warning

    - If this endpoint is requested for a shield zone on a free tier, it returns a `202` status code with the error message: `We do not support Custom WAF Rule creation on our Free Tier of Bunny Shield, please upgrade to Advanced.`

#### [List WAF Profiles](https://docs.bunny.net/reference/get_shield-waf-profiles)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafProfiles()
);
```

#### [List WAF Enums](https://docs.bunny.net/reference/get_shield-waf-enums)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafEnums()
);
```

#### [List WAF Engine Configuration](https://docs.bunny.net/reference/get_shield-waf-engine-config)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\ListWafEngineConfiguration()
);
```

### DDoS

#### [List DDoS Enums](https://docs.bunny.net/reference/get_shield-ddos-enums)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Ddos\ListDdosEnums()
);
```

### Rate Limiting

#### [List Rate Limits](https://docs.bunny.net/reference/get_shield-rate-limits-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\RateLimiting\ListRateLimits(
        shieldZoneId: 1,
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

#### [Get Rate Limit](https://docs.bunny.net/reference/get_shield-rate-limit-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\RateLimiting\GetRateLimit(
        id: 1,
    )
);
```

#### [Update Rate Limit](https://docs.bunny.net/reference/patch_shield-rate-limit-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\RateLimiting\UpdateRateLimit(
        id: 1,
        body: [
            'ruleName' => 'string',
            'ruleDescription' => 'string',
            'ruleConfiguration' => [
                'actionType' => 1,
                'variableTypes' => [
                    'REQUEST_URI' => 'string',
                    'REQUEST_URI_RAW' => 'string',
                    'ARGS' => 'string',
                    'ARGS_COMBINED_SIZE' => 'string',
                    'ARGS_GET' => 'string',
                    'ARGS_GET_NAMES' => 'string',
                    'ARGS_POST' => 'string',
                    'ARGS_POST_NAMES' => 'string',
                    'FILES_NAMES' => 'string',
                    'GEO' => 'string',
                    'REMOTE_ADDR' => 'string',
                    'QUERY_STRING' => 'string',
                    'REQUEST_BASENAME' => 'string',
                    'REQUEST_BODY' => 'string',
                    'REQUEST_COOKIES_NAMES' => 'string',
                    'REQUEST_COOKIES' => 'string',
                    'REQUEST_FILENAME' => 'string',
                    'REQUEST_HEADERS_NAMES' => 'string',
                    'REQUEST_HEADERS' => 'string',
                    'REQUEST_LINE' => 'string',
                    'REQUEST_METHOD' => 'string',
                    'REQUEST_PROTOCOL' => 'string',
                    'RESPONSE_BODY' => 'string',
                    'RESPONSE_HEADERS' => 'string',
                    'RESPONSE_STATUS' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
            ],
        ],
    )
);
```

#### [Delete Rate Limit](https://docs.bunny.net/reference/delete_shield-rate-limit-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\RateLimiting\DeleteRateLimit(
        id: 1,
    )
);
```

#### [Create Rate Limit](https://docs.bunny.net/reference/post_shield-rate-limit)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\RateLimiting\CreateRateLimit(
        id: 1,
        body: [
            'shieldZoneId' => 1,
            'ruleName' => 'string',
            'ruleDescription' => 'string',
            'ruleConfiguration' => [
                'actionType' => 1,
                'variableTypes' => [
                    'REQUEST_URI' => 'string',
                    'REQUEST_URI_RAW' => 'string',
                    'ARGS' => 'string',
                    'ARGS_COMBINED_SIZE' => 'string',
                    'ARGS_GET' => 'string',
                    'ARGS_GET_NAMES' => 'string',
                    'ARGS_POST' => 'string',
                    'ARGS_POST_NAMES' => 'string',
                    'FILES_NAMES' => 'string',
                    'GEO' => 'string',
                    'REMOTE_ADDR' => 'string',
                    'QUERY_STRING' => 'string',
                    'REQUEST_BASENAME' => 'string',
                    'REQUEST_BODY' => 'string',
                    'REQUEST_COOKIES_NAMES' => 'string',
                    'REQUEST_COOKIES' => 'string',
                    'REQUEST_FILENAME' => 'string',
                    'REQUEST_HEADERS_NAMES' => 'string',
                    'REQUEST_HEADERS' => 'string',
                    'REQUEST_LINE' => 'string',
                    'REQUEST_METHOD' => 'string',
                    'REQUEST_PROTOCOL' => 'string',
                    'RESPONSE_BODY' => 'string',
                    'RESPONSE_HEADERS' => 'string',
                    'RESPONSE_STATUS' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
            ],
        ],
    )
);
```

### Metrics

#### [Get Overview Metrics](https://docs.bunny.net/reference/get_shield-metrics-overview-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetOverviewMetrics(
        shieldZoneId: 1,
    )
);
```

#### [List Rate Limit Metrics](https://docs.bunny.net/reference/get_shield-metrics-rate-limits-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\ListRateLimitMetrics(
        shieldZoneId: 1,
    )
);
```

#### [Get Rate Limit Metrics](https://docs.bunny.net/reference/get_shield-metrics-rate-limit-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetRateLimitMetrics(
        id: 1,
    )
);
```

#### [Get WAF Rule Metrics](https://docs.bunny.net/reference/get_shield-metrics-shield-zone-shieldzoneid-waf-rule-ruleid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetWafRuleMetrics(
        shieldZoneId: 1,
        ruleId: '68332416-124a-4a55-b3fd-4f6c995a3bdf',
    )
);
```

### Event Logs

#### [List Event Logs](https://docs.bunny.net/reference/get_shield-event-logs-shieldzoneid-date-continuationtoken)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\EventLogs\ListEventLogs(
        shieldZoneId: 1,
        date: 'Y-m-d\TH:i:s',
        continuationToken: 'string',
    )
);
```

## Reference

* [Shield API](https://docs.bunny.net/reference/get_shield-shield-zones)
* [Shield API (Swagger)](https://api.bunny.net/shield/docs/index.html)
