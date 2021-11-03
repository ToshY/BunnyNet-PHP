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
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\UuidType;
use ToshY\BunnyNet\Exception\KeyFormatNotSupported;

/**
 * Class ContentDeliveryNetwork
 * @link https://docs.bunny.net/reference/bunnynet-api-overview
 */
class Base extends AbstractRequest
{
    /** @var string Account API key */
    private string $accountApiKey;

    /**
     * ContentDeliveryNetwork constructor.
     * @param string|null $accountApiKey
     * @throws KeyFormatNotSupported
     */
    public function __construct(
        string $accountApiKey
    ) {
        $this->setAccountApiKey($accountApiKey);

        parent::__construct(Host::API_ENDPOINT);
    }

    /**
     * @return string
     */
    public function getAccountApiKey(): string
    {
        return $this->accountApiKey;
    }

    /**
     * @param string $key
     * @return Base
     * @throws KeyFormatNotSupported
     */
    public function setAccountApiKey(string $key): Base
    {
        if (preg_match(UuidType::UUID_72, $key) !== 1) {
            throw new KeyFormatNotSupported(
                'Invalid API key: does not conform to the UUID 72 characters format.'
            );
        }
        $this->accountApiKey = $key;
        return $this;
    }

    /**
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getBillingDetails(): StreamInterface
    {
        $endpoint = BillingEndpoint::GET_BILLING_DETAILS;

        return $this->createRequest(
            $endpoint
        );
    }

    /**
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getBillingSummary(): StreamInterface
    {
        $endpoint = BillingEndpoint::GET_BILLING_SUMMARY;

        return $this->createRequest(
            $endpoint
        );
    }

    /**
     * @param array $query
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function applyPromoCode(array $query): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function listPullZones(array $query): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addPullZone(array $body): StreamInterface
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
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getPullZone(int $id): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function updatePullZone(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function deletePullZone(int $id): StreamInterface
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
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function deleteEdgeRule(int $pullZoneId, string $edgeRuleId): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addOrUpdateEdgeRule(int $pullZoneId, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function setEdgeRuleEnabled(int $pullZoneId, string $edgeRuleId, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function getStatistics(int $pullZoneId, array $query): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function loadFreeCertificate(array $query): StreamInterface
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
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function purgeCache(): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addCustomCertificate(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function removeCertificate(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addCustomHostname(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function removeCustomHostname(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function setForceSSL(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function resetTokenKey(int $id): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addAllowedReferer(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function removeAllowedReferer(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addBlockedReferer(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function removeBlockedReferer(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addBlockedIP(int $id, array $body): StreamInterface
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
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function removeBlockedIP(int $id, array $body): StreamInterface
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
     * @param float $bytes
     * @param int $precision
     * @param array|string[] $unitCollection
     * @return array
     */
    private function convertBytes(
        float $bytes,
        int $precision = 2,
        array $unitCollection = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB']
    ): array {
        $i = 0;
        while ($bytes > 1024) {
            $bytes /= 1024;
            $i++;
        }

        $value = round($bytes, $precision);
        $unit = $unitCollection[$i];

        return [
            'value' => $value,
            'unit' => $unit,
        ];
    }
}
