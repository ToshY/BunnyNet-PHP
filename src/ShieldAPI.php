<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\API\Shield\DDoS\ListDDoSEnums;
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
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Validation\BunnyValidator;

class ShieldAPI
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     * @param BunnyValidator $validator
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
        protected readonly BunnyValidator $validator = new BunnyValidator(),
    ) {
        $this->client
            ->setApiKey($this->apiKey)
            ->setBaseUrl(Host::API_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function listShieldZones(array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new ListShieldZones();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     */
    public function getShieldZone(int $shieldZoneId): BunnyClientResponseInterface
    {
        $endpoint = new GetShieldZone();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $pullZoneId
     */
    public function getShieldZoneByPullZoneId(int $pullZoneId): BunnyClientResponseInterface
    {
        $endpoint = new GetShieldZoneByPullZoneId();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param array<string,mixed> $body
     */
    public function createShieldZone(array $body): BunnyClientResponseInterface
    {
        $endpoint = new CreateShieldZone();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param array<string,mixed> $body
     */
    public function updateShieldZone(array $body): BunnyClientResponseInterface
    {
        $endpoint = new UpdateShieldZone();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     */
    public function listWafRules(): BunnyClientResponseInterface
    {
        $endpoint = new ListWAFRules();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     */
    public function reviewTriggeredRules(int $shieldZoneId): BunnyClientResponseInterface
    {
        $endpoint = new ReviewTriggeredRules();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     * @param array<string,mixed> $body
     */
    public function reviewTriggeredRule(
        int $shieldZoneId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new ReviewTriggeredRule();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     * @param string $ruleId
     */
    public function reviewTriggeredRuleAiRecommendation(
        int $shieldZoneId,
        string $ruleId,
    ): BunnyClientResponseInterface {
        $endpoint = new ReviewTriggeredRuleAIRecommendation();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId, $ruleId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $shieldZoneId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function listCustomWafRules(
        int $shieldZoneId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new ListCustomWAFRules();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function getCustomWafRule(int $id): BunnyClientResponseInterface
    {
        $endpoint = new GetCustomWAFRule();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateCustomWafRule(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateCustomWAFRule();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateCustomWafRuleByPatch(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateCustomWAFRuleByPatch();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function deleteCustomWafRule(int $id): BunnyClientResponseInterface
    {
        $endpoint = new DeleteCustomWAFRule();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param array<string,mixed> $body
     */
    public function createCustomWafRule(
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new CreateCustomWAFRule();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     */
    public function listWafProfiles(): BunnyClientResponseInterface
    {
        $endpoint = new ListWafProfiles();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     */
    public function listWafEnums(): BunnyClientResponseInterface
    {
        $endpoint = new ListWAFEnums();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     */
    public function listWafEngineConfiguration(): BunnyClientResponseInterface
    {
        $endpoint = new ListWAFEngineConfiguration();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     */
    public function listDdosEnums(): BunnyClientResponseInterface
    {
        $endpoint = new ListDDoSEnums();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $shieldZoneId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function listRateLimits(
        int $shieldZoneId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new ListRateLimits();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function getRateLimit(int $id): BunnyClientResponseInterface
    {
        $endpoint = new GetRateLimit();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateRateLimit(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateRateLimit();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function deleteRateLimit(int $id): BunnyClientResponseInterface
    {
        $endpoint = new DeleteRateLimit();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param array<string,mixed> $body
     */
    public function createRateLimit(
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new CreateRateLimit();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     */
    public function getOverviewMetrics(
        int $shieldZoneId,
    ): BunnyClientResponseInterface {
        $endpoint = new GetOverviewMetrics();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     */
    public function listRateLimitMetrics(
        int $shieldZoneId,
    ): BunnyClientResponseInterface {
        $endpoint = new ListRateLimitMetrics();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function getRateLimitMetrics(
        int $id,
    ): BunnyClientResponseInterface {
        $endpoint = new GetRateLimitMetrics();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     * @param string $ruleId
     */
    public function getWafRuleMetrics(
        int $shieldZoneId,
        string $ruleId,
    ): BunnyClientResponseInterface {
        $endpoint = new GetWafRuleMetrics();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId, $ruleId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @return BunnyClientResponseInterface
     * @param int $shieldZoneId
     * @param string $date
     * @param string $continuationToken
     */
    public function listEventLogs(
        int $shieldZoneId,
        string $date,
        string $continuationToken,
    ): BunnyClientResponseInterface {
        $endpoint = new GetWafRuleMetrics();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$shieldZoneId, $date, $continuationToken],
        );
    }
}
