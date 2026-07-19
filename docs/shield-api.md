# Shield API

The Shield API provides a RESTful interface for managing security settings on your pull zones. Configure WAF rules, rate limiting, bot detection, and access controls programmatically.

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
    new \ToshY\BunnyNet\Model\Api\Shield\ShieldZone\ListShieldZones(
        query: [
            'page' => 1,
            'perPage' => 1000,
        ],
    )
);
```

#### [List Shield Zones Pull Zone Mapping](https://docs.bunny.net/reference/get_shield-shield-zones-pullzone-mapping)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ShieldZone\ListShieldZonesPullzoneMapping()
);
```

#### [Get Shield Zone](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZone(
        shieldZoneId: 1,
    )
);
```

#### [Get Shield Zone (by PullZoneId)](https://docs.bunny.net/reference/get_shield-shield-zone-get-by-pullzone-pullzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ShieldZone\GetShieldZoneByPullZoneId(
        pullZoneId: 1,
    )
);
```

#### [Create Shield Zone](https://docs.bunny.net/reference/post_shield-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ShieldZone\CreateShieldZone(
        body: [
            'pullZoneId' => 1,
            'shieldZone' => [
                'shieldZoneId' => 2,
                'premiumPlan' => false,
                'planType' => 0,
                'learningMode' => true,
                'learningModeUntil' => 'Y-m-d\TH:i:s',
                'wafEnabled' => true,
                'wafExecutionMode' => 1,
                'wafDisabledRules' => [],
                'wafLogOnlyRules' => [],
                'wafCustomRuleOrder' => [],
                'wafRequestHeaderLoggingEnabled' => true,
                'requestBodyLoggingEnabled' => false,
                'wafRequestIgnoredHeaders' => [],
                'wafRealtimeThreatIntelligenceEnabled' => false,
                'wafProfileId' => 1,
                'wafEngineConfig' => [],
                'wafRequestBodyLimitAction' => 0,
                'wafResponseBodyLimitAction' => 0,
                'dDoSShieldSensitivity' => 1,
                'dDoSExecutionMode' => 1,
                'dDoSChallengeWindow' => 1,
                'whitelabelResponsePages' => false,
            ],
        ],
    )
);
```

??? note

    - The key `shieldZoneId` is not needed or required when creating a shield zone.

#### [Update Shield Zone](https://docs.bunny.net/reference/patch_shield-shield-zone2)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ShieldZone\UpdateShieldZone(
        body: [
            'shieldZoneId' => 2,
            'shieldZone' => [
                'shieldZoneId' => 2,
                'premiumPlan' => false,
                'planType' => 0,
                'learningMode' => true,
                'learningModeUntil' => 'Y-m-d\TH:i:s',
                'wafEnabled' => true,
                'wafExecutionMode' => 1,
                'wafDisabledRules' => [],
                'wafLogOnlyRules' => [],
                'wafCustomRuleOrder' => [],
                'wafRequestHeaderLoggingEnabled' => true,
                'requestBodyLoggingEnabled' => false,
                'wafRequestIgnoredHeaders' => [],
                'wafRealtimeThreatIntelligenceEnabled' => false,
                'wafProfileId' => 1,
                'wafEngineConfig' => [],
                'wafRequestBodyLimitAction' => 0,
                'wafResponseBodyLimitAction' => 0,
                'dDoSShieldSensitivity' => 1,
                'dDoSExecutionMode' => 1,
                'dDoSChallengeWindow' => 1,
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
                    'FINGERPRINT' => 'string',
                    'VERIFIED_BOT_CATEGORY' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'isNegated' => false,
                'isRegexVariable' => false,
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
                'chainedRuleConditions' => [
                    [
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
                            'FINGERPRINT' => 'string',
                            'VERIFIED_BOT_CATEGORY' => 'string',
                        ],
                        'operatorType' => 0,
                        'value' => 'string',
                        'isNegated' => false,
                        'isRegexVariable' => false,
                    ],
                ],
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
                    'FINGERPRINT' => 'string',
                    'VERIFIED_BOT_CATEGORY' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'isNegated' => false,
                'isRegexVariable' => false,
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
                'chainedRuleConditions' => [
                    [
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
                            'FINGERPRINT' => 'string',
                            'VERIFIED_BOT_CATEGORY' => 'string',
                        ],
                        'operatorType' => 0,
                        'value' => 'string',
                        'isNegated' => false,
                        'isRegexVariable' => false,
                    ],
                ],
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
                    'FINGERPRINT' => 'string',
                    'VERIFIED_BOT_CATEGORY' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'isNegated' => false,
                'isRegexVariable' => false,
                'requestCount' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
                'chainedRuleConditions' => [
                    [
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
                            'FINGERPRINT' => 'string',
                            'VERIFIED_BOT_CATEGORY' => 'string',
                        ],
                        'operatorType' => 0,
                        'value' => 'string',
                        'isNegated' => false,
                        'isRegexVariable' => false,
                    ],
                ],
            ],
        ],
    )
);
```

??? warning

    If this endpoint is requested for a shield zone on a free tier, it returns a `202` status code with the error message: `We do not support Custom WAF Rule creation on our Free Tier of Bunny Shield, please upgrade to Advanced.`

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

#### [Get WAF Rules](https://docs.bunny.net/reference/get_shield-waf-rules-shieldzoneid)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\GetWafRules(
        shieldZoneId: 1,
    )
);
```

#### [Get WAF Rules Plan Segmentation](https://docs.bunny.net/reference/get_shield-waf-rules-plan-segmentation)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Waf\GetWafRulesPlanSegmentation(
        shieldZoneId: 1,
    )
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
                    'FINGERPRINT' => 'string',
                    'VERIFIED_BOT_CATEGORY' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'isNegated' => false,
                'isRegexVariable' => false,
                'requestCount' => 0,
                'counterKeyType' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
                'chainedRuleConditions' => [
                    [
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
                            'FINGERPRINT' => 'string',
                            'VERIFIED_BOT_CATEGORY' => 'string',
                        ],
                        'operatorType' => 0,
                        'value' => 'string',
                        'isNegated' => false,
                        'isRegexVariable' => false,
                    ],
                ],
            ],
        ],
    )
);
```

??? note

    - The key `counterKeyType` has the following possible values:
        - `0`
        - `1`
        - `2`
        - `3`
        - `4`

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
                    'FINGERPRINT' => 'string',
                    'VERIFIED_BOT_CATEGORY' => 'string',
                ],
                'operatorType' => 0,
                'severityType' => 0,
                'transformationTypes' => [1],
                'value' => 'string',
                'isNegated' => false,
                'isRegexVariable' => false,
                'requestCount' => 0,
                'counterKeyType' => 0,
                'timeframe' => 1,
                'blockTime' => 30,
                'chainedRuleConditions' => [
                    [
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
                            'FINGERPRINT' => 'string',
                            'VERIFIED_BOT_CATEGORY' => 'string',
                        ],
                        'operatorType' => 0,
                        'value' => 'string',
                        'isNegated' => false,
                        'isRegexVariable' => false,
                    ],
                ],
            ],
        ],
    )
);
```

??? note

    - The key `counterKeyType` has the following possible values:
        - `0`
        - `1`
        - `2`
        - `3`
        - `4`

### Metrics

#### [Get Shield Zone Monthly Overages](https://docs.bunny.net/api-reference/shield/metrics/get-the-overage-breakdown-for-the-specified-shield-zone-for-a-given-month-segmented-by-billing-plan-changes)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetShieldZoneMonthlyOverages(
        shieldZoneId: 1,
        query: [
            'year' => 2025,
            'month' => 1,
        ],
    )
);
```

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

#### [Get Bot Detection Metrics](https://docs.bunny.net/reference/get_shield-metrics-shield-zone-shieldzoneid-bot-detection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetBotDetectionMetrics(
        shieldZoneId: 1,
    )
);
```

#### [Get Upload Scanning Metrics](https://docs.bunny.net/reference/get_shield-metrics-shield-zone-shieldzoneid-upload-scanning)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetUploadScanningMetrics(
        shieldZoneId: 1,
    )
);
```

#### Get Metrics Overview Detailed

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetMetricsOverviewDetailed(
        shieldZoneId: 1,
        query: [
            'StartDate' => 'm-d-Y',
            'EndDate' => 'm-d-Y',
            'Resolution' => 0,
        ],
    )
);
```

??? note

    - The key `Resolution` has the following possible values:
        - `0`
        - `1`
        - `2`
        - `3`
        - `4`
        - `5`
        - `6`

#### [Get Shield Zone API Guardian Metrics](https://docs.bunny.net/api-reference/shield/metrics/get-api-guardian-metrics-for-the-specified-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetShieldZoneApiGuardianMetrics(
        shieldZoneId: 1,
    )
);
```

#### [Get API Guardian Endpoint Metrics](https://docs.bunny.net/api-reference/shield/metrics/get-metrics-for-a-specific-api-guardian-endpoint-within-the-specified-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Metrics\GetApiGuardianEndpointMetrics(
        shieldZoneId: 1,
        endpointId: 2,
    )
);
```

### API Guardian

#### Get API Guardian

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\GetApiGuardian(
        shieldZoneId: 1,
    )
);
```

#### Update API Guardian

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\UpdateApiGuardian(
        shieldZoneId: 1,
        endpointId: 2,
        body: [
            'isEnabled' => true,
            'validateRequestBodySchema' => true,
            'validateResponseBodySchema' => false,
            'validateAuthorization' => false,
            'injectionDetectionParameters' => [
                'Path' => ['string'],
                'Query' => ['string'],
                'Header' => ['string'],
                'Cookie' => ['string'],
            ],
            'detectParameterXss' => true,
            'detectParameterSqli' => true,
            'rateLimitingEnabled' => false,
            'rateLimitingType' => '',
            'rateLimitingRequestCount' => 0,
            'rateLimitingTimeframe' => 0,
        ],
    )
);
```

??? warning

    - This endpoint returns a `403` status code if you do not have Advanced plan or higher.

#### Upload OpenAPI Specification

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\UploadOpenapiSpecification(
        shieldZoneId: 1,
        body: [
            'content' => '{"openapi":"3.0.0","info":{"title":"My API","version":"1.0.0"}}',
            'enforceAuthorisationValidation' => false,
        ],
    )
);
```

#### Update OpenAPI Specification

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\UpdateOpenapiSpecification(
        shieldZoneId: 1,
        body: [
            'isEnabled' => true,
            'executionMode' => 0,
            'bodyLimitAction' => 0,
            'unmatchedPathAction' => 0,
        ],
    )
);
```

#### [Upload Your OpenAPI Specification](https://docs.bunny.net/api-reference/shield/api-guardian/upload-your-openapi-specification)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\UploadYourOpenapiSpecification(
        shieldZoneId: 1,
        body: [
            'content' => '{"openapi":"3.0.0","info":{"title":"My API","version":"1.0.0"}}',
            'enforceAuthorizationValidation' => false,
        ],
    )
);
```

#### [Update Your OpenAPI Specification](https://docs.bunny.net/api-reference/shield/api-guardian/update-your-openapi-specification)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\UpdateYourOpenapiSpecification(
        shieldZoneId: 1,
        body: [
            'content' => '{"openapi":"3.0.0","info":{"title":"My API","version":"2.0.0"}}',
            'enforceAuthorizationValidation' => true,
        ],
    )
);
```

#### [Get API Guardian Enums](https://docs.bunny.net/api-reference/shield/api-guardian/get-all-api-guardian-enumeration-types-and-their-values)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\ApiGuardian\GetApiGuardianEnums(
        shieldZoneId: '46d1703e-7d63-4138-83b1-78695bee5a07',
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

#### [Search Event Logs](https://docs.bunny.net/api-reference/shield/event-logs/search-filter-and-group-event-logs-for-a-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\EventLogs\SearchEventLogs(
        shieldZoneId: 1,
        body: [
            'from' => 1704067200,
            'to' => 1706745600,
            'query' => 'action:block',
            'filters' => [
                [
                    'field' => 'country',
                    'op' => 'eq',
                    'value' => ['US'],
                ],
            ],
            'groupBy' => ['country'],
            'page' => 1,
            'pageSize' => 100,
        ],
    )
);
```

#### [Export Event Logs](https://docs.bunny.net/api-reference/shield/event-logs/export-the-full-filtered-event-logs-set-for-a-shield-zone-as-csv)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\EventLogs\ExportEventLogs(
        shieldZoneId: 1,
        body: [
            'from' => 1704067200,
            'to' => 1706745600,
            'query' => 'action:block',
            'filters' => [
                [
                    'field' => 'country',
                    'op' => 'eq',
                    'value' => ['US'],
                ],
            ],
        ],
    )
);
```

### Access Lists

#### [List Shield Zone Access Lists](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid-access-lists)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\ListShieldZoneAccessLists(
        shieldZoneId: 1,
    )
);
```

#### [Get Shield Zone Access List](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid-access-lists-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessList(
        id: 2,
        shieldZoneId: 1,
    )
);
```

#### [Get Shield Zone Access List Enums](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid-access-lists-enums)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\GetShieldZoneAccessListEnums(
        shieldZoneId: 1,
    )
);
```

#### [Create Shield Zone Access List](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid-access-lists-enums)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\CreateShieldZoneAccessList(
        shieldZoneId: 1,
        body: [
            'name' => 'Custom Access List',
            'description' => 'This is a description for the access list',
            'type' => 0,
            'content' => '192.168.0.1',
            'checksum' => '37d7a80604871e579850a658c7add2ae7557d0c6abcc9b31ecddc4424207eba3',
        ],
    )
);
```

??? note

    - The key `type` has the following possible values:
        - `0` = IP Addresses 
        - `1` = CIDR Blocks
        - `2` = ASNs
        - `3` = Countries

??? warning

    If this endpoint is requested for a shield zone on a free tier, it returns a `202` status code with the error message: `Custom Access List limit exceeded. You can have a maximum of 1 custom lists. Please upgrade your Bunny Shield tier or contact support for assistance.`

#### [Update Shield Zone Access List](https://docs.bunny.net/reference/patch_shield-shield-zone-shieldzoneid-access-lists-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\UpdateShieldZoneAccessList(
        id: 2,
        shieldZoneId: 1,
        body: [
            'name' => 'Custom Access List Updated',
            'content' => '192.168.0.1',
            'checksum' => '37d7a80604871e579850a658c7add2ae7557d0c6abcc9b31ecddc4424207eba3',
        ],
    )
);
```

#### [Update Shield Zone Curated Threat List](https://docs.bunny.net/reference/patch_shield-shield-zone-shieldzoneid-access-lists-configurations-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\UpdateShieldZoneCuratedThreatList(
        id: 2,
        shieldZoneId: 1,
        body: [
            'isEnabled' => true,
            'action' => 4,
        ],
    )
);
```

??? note

    - The key `action` has the following possible values:
        - `0` = <unknown>
        - `1` = Allow
        - `2` = Block
        - `3` = Challenge
        - `4` = Log
        - `5` = Bypass

#### [Delete Shield Zone Access List](https://docs.bunny.net/reference/delete_shield-shield-zone-shieldzoneid-access-lists-id)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\AccessLists\DeleteShieldZoneAccessList(
        id: 2,
        shieldZoneId: 1,
    )
);
```

### Bot Detection

#### [Get Shield Zone Bot Detection](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid-bot-detection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\BotDetection\GetShieldZoneBotDetection(
        shieldZoneId: 1,
    )
);
```

#### [Create Or Update Shield Zone Bot Detection](https://docs.bunny.net/reference/patch_shield-shield-zone-shieldzoneid-bot-detection)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\BotDetection\CreateOrUpdateShieldZoneBotDetection(
        shieldZoneId: 1,
        body: [
            'shieldZoneId' => 1,
            'executionMode' => 0,
            'requestIntegrity' => [
                'sensitivity' => 0,    
            ],
            'ipAddress' => [
                'sensitivity' => 0,    
            ],
            'browserFingerprint' => [
                'sensitivity' => 0,    
                'aggression' => 0,    
                'complexEnabled' => false,    
            ],
        ]
    )
);
```

??? note

    - The key `executionMode` has the following possible values:
        - `0` = Log
        - `1` = Challenge
    - The key `sensitivity` has the following possible values:
        - `0` = <off>
        - `1` = Low
        - `2` = Medium
        - `3` = High
    - The key `aggression` has the following possible values:
        - `0`
        - `1`
        - `2`
        - `3`
        - `4`

### Bot Categorization

#### [List Bot Categorizations](https://docs.bunny.net/api-reference/shield/bot-categorization/list-bots-available-for-explicit-allowblock-configuration-on-this-shield-zone-grouped-by-category)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\BotCategorization\ListBotCategorizations(
        shieldZoneId: 1,
    )
);
```

#### [Set Bot Categorization Action](https://docs.bunny.net/api-reference/shield/bot-categorization/set-or-clear-the-action-applied-to-a-categorised-bot-for-this-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\BotCategorization\SetBotCategorizationAction(
        shieldZoneId: 1,
        botId: 1,
        body: [
            'action' => 2,
        ],
    )
);
```

#### [Set Bot Category Action](https://docs.bunny.net/api-reference/shield/bot-categorization/set-or-clear-the-action-applied-to-every-bot-in-a-category-for-this-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\BotCategorization\SetBotCategoryAction(
        shieldZoneId: 1,
        category: 1,
        body: [
            'action' => 2,
        ],
    )
);
```

??? note

    - The key `action` has the following possible values:
        - `0` = <unknown>
        - `1` = Allow
        - `2` = Block
        - `3` = Challenge
        - `4` = Log
        - `5` = Bypass

### Promotions

#### [Get Shield Zone Current Promotions](https://docs.bunny.net/reference/get_shield-promo-state)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\Promo\GetCurrentPromotions()
);
```

### Upload Scanning

#### [Get Shield Zone Upload Scanning](https://docs.bunny.net/reference/get_shield-shield-zone-shieldzoneid-upload-scanning)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\UploadScanning\GetShieldZoneUploadScanning(
        shieldZoneId: 1,
    )
);
```

#### [Create Or Update Shield Zone Upload Scanning](https://docs.bunny.net/reference/patch_shield-shield-zone-shieldzoneid-upload-scanning)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\UploadScanning\CreateOrUpdateShieldZoneUploadScanning(
        shieldZoneId: 1,
        body: [
            'shieldZoneId' => 1,
            'isEnabled' => false,
            'csamScanningMode' => 2,
            'antivirusScanningMode' => 1,
        ]
    )
);
```

??? note

    - The key `csamScanningMode` has the following possible values:
        - `0` = <off>
        - `1` = Log
        - `2` = Block
    - The key `antivirusScanningMode` has the following possible values:
        - `0` = <off>
        - `1` = Log
        - `2` = Block

### Custom Response Pages

#### [Upload Custom Response Page](https://docs.bunny.net/api-reference/shield/custom-response-pages/upload-a-custom-html-response-page-for-a-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\CustomResponsePages\UploadCustomResponsePage(
        shieldZoneId: 1,
        pageType: 'blocked',
    )
);
```

#### [Get Custom Response Page](https://docs.bunny.net/api-reference/shield/custom-response-pages/get-a-custom-html-response-page-for-a-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\CustomResponsePages\GetCustomResponsePage(
        shieldZoneId: 1,
        pageType: 'blocked',
    )
);
```

#### [Delete Custom Response Page](https://docs.bunny.net/api-reference/shield/custom-response-pages/delete-a-custom-html-response-page-for-a-shield-zone)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\Shield\CustomResponsePages\DeleteCustomResponsePage(
        shieldZoneId: 1,
        pageType: 'blocked',
    )
);
```

## Reference

* [Shield API](https://docs.bunny.net/api-reference/shield)
* [Shield API (Swagger)](https://api.bunny.net/shield/docs/index.html)
