<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use ToshY\BunnyNet\Enum\CDN\BillingEndpoint;
use ToshY\BunnyNet\Enum\CDN\PullZoneEndpoint;
use ToshY\BunnyNet\Enum\CDN\PurgeEndpoint;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\UuidType;
use ToshY\BunnyNet\Exception\KeyFormatNotSupportedException;

/**
 * Class ContentDeliveryNetwork
 * @link https://docs.bunny.net/reference/bunnynet-api-overview
 */
class BaseRequest extends AbstractRequest
{
    /**
     * ContentDeliveryNetwork constructor.
     * @param string|null $accountApiKey
     * @throws KeyFormatNotSupportedException
     */
    public function __construct(
        string $accountApiKey
    ) {
        $this->setApiKey($accountApiKey);

        parent::__construct(Host::API_ENDPOINT);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $key
     * @return BaseRequest
     * @throws KeyFormatNotSupportedException
     */
    public function setApiKey(string $key): BaseRequest
    {
        if (preg_match(UuidType::UUID_72, $key) !== 1) {
            throw new KeyFormatNotSupportedException(
                'Invalid API key: does not conform to the UUID 72 characters format.'
            );
        }
        $this->apiKey = $key;
        return $this;
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getBillingDetails(): array
    {
        $endpoint = BillingEndpoint::GET_BILLING_DETAILS;

        return $this->createRequest(
            $endpoint
        );
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getBillingSummary(): array
    {
        $endpoint = BillingEndpoint::GET_BILLING_SUMMARY;

        return $this->createRequest(
            $endpoint
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function applyPromoCode(array $query): array
    {
        $endpoint = BillingEndpoint::APPLY_PROMO_CODE;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function listPullZones(array $query = []): array
    {
        $endpoint = PullZoneEndpoint::LIST_PULL_ZONES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addPullZone(array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_PULL_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function getPullZone(int $id): array
    {
        $endpoint = PullZoneEndpoint::GET_PULL_ZONE;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function updatePullZone(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::UPDATE_PULL_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function deletePullZone(int $id): array
    {
        $endpoint = PullZoneEndpoint::DELETE_PULL_ZONE;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $pullZoneId
     * @param string $edgeRuleId
     * @return array
     * @throws GuzzleException
     */
    public function deleteEdgeRule(int $pullZoneId, string $edgeRuleId): array
    {
        $endpoint = PullZoneEndpoint::DELETE_EDGE_RULE;

        return $this->createRequest(
            $endpoint,
            [$pullZoneId, $edgeRuleId]
        );
    }

    /**
     * @param int $pullZoneId
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addOrUpdateEdgeRule(int $pullZoneId, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_UPDATE_EDGE_RULE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$pullZoneId],
            [],
            $body
        );
    }

    /**
     * @param int $pullZoneId
     * @param string $edgeRuleId
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function setEdgeRuleEnabled(int $pullZoneId, string $edgeRuleId, array $body): array
    {
        $endpoint = PullZoneEndpoint::SET_EDGE_RULE_ENABLED;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$pullZoneId, $edgeRuleId],
            [],
            $body
        );
    }

    /**
     * @param int $pullZoneId
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function getStatistics(int $pullZoneId, array $query = []): array
    {
        $endpoint = PullZoneEndpoint::GET_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [$pullZoneId],
            $query,
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function loadFreeCertificate(array $query): array
    {
        $endpoint = PullZoneEndpoint::LOAD_FREE_CERTIFICATE;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function purgeCache(): array
    {
        $endpoint = PullZoneEndpoint::PURGE_CACHE;

        return $this->createRequest(
            $endpoint,
            []
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addCustomCertificate(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_CUSTOM_CERTIFICATE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function removeCertificate(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_CERTIFICATE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addCustomHostname(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_CUSTOM_HOSTNAME;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function removeCustomHostname(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_CUSTOM_HOSTNAME;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function setForceSSL(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::SET_FORCE_SSL;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function resetTokenKey(int $id): array
    {
        $endpoint = PullZoneEndpoint::RESET_TOKEN_KEY;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addAllowedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_ALLOWED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function removeAllowedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_ALLOWED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addBlockedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function removeBlockedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addBlockedIP(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_IP;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function removeBlockedIP(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_IP;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function purgeURL(array $query)
    {
        $endpoint = PurgeEndpoint::PURGE_URL;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function purgeURLbyHeader(array $query)
    {
        $endpoint = PurgeEndpoint::PURGE_URL_HEADER;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query,
        );
    }
}
