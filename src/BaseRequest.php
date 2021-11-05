<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use GuzzleHttp\Exception\GuzzleException;
use ToshY\BunnyNet\Enum\CDN\BillingEndpoint;
use ToshY\BunnyNet\Enum\CDN\PullZoneEndpoint;
use ToshY\BunnyNet\Enum\CDN\PurgeEndpoint;
use ToshY\BunnyNet\Enum\CDN\StatisticsEndpoint;
use ToshY\BunnyNet\Enum\CDN\StorageEndpoint;
use ToshY\BunnyNet\Enum\CDN\StreamEndpoint;
use ToshY\BunnyNet\Enum\CDN\UserEndpoint;
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
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function listVideoLibraries(array $query): array
    {
        $endpoint = StreamEndpoint::LIST_VIDEO_LIBRARIES;
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
    public function addVideoLibrary(array $body): array
    {
        $endpoint = StreamEndpoint::ADD_VIDEO_LIBRARY;
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
    public function getVideoLibrary(int $id): array
    {
        $endpoint = StreamEndpoint::GET_VIDEO_LIBRARY;

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
    public function updateVideoLibrary(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::ADD_VIDEO_LIBRARY;
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
    public function deleteVideoLibrary(int $id): array
    {
        $endpoint = StreamEndpoint::DELETE_VIDEO_LIBRARY;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function resetVideoLibraryPasswordByQuery(array $query): array
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_QUERY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function resetVideoLibraryPasswordByPath(int $id): array
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_PATH;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function addWatermark(int $id): array
    {
        $endpoint = StreamEndpoint::ADD_WATERMARK;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws GuzzleException
     */
    public function deleteWatermark(int $id): array
    {
        $endpoint = StreamEndpoint::DELETE_WATERMARK;

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
    public function addVideoLibraryAllowedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::ADD_ALLOWED_REFERER;
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
    public function removeVideoLibraryAllowedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::REMOVE_ALLOWED_REFERER;
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
    public function addVideoLibraryBlockedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::ADD_BLOCKED_REFERER;
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
    public function removeVideoLibraryBlockedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::REMOVE_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$id],
            [],
            $body
        );
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
    public function getStatisticsPullZone(int $pullZoneId, array $query = []): array
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
    public function resetPullZoneTokenKey(int $id): array
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
    public function addPullZoneAllowedReferer(int $id, array $body): array
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
    public function removePullZoneAllowedReferer(int $id, array $body): array
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
    public function addPullZoneBlockedReferer(int $id, array $body): array
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
    public function removePullZoneBlockedReferer(int $id, array $body): array
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
    public function addPullZoneBlockedIP(int $id, array $body): array
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
    public function removePullZoneBlockedIP(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_BLOCKED_IP;
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
    public function purgeURL(array $query): array
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
    public function purgeURLbyHeader(array $query): array
    {
        $endpoint = PurgeEndpoint::PURGE_URL_HEADER;
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
    public function getStatistics(array $query = []): array
    {
        $endpoint = StatisticsEndpoint::GET_STATISTICS;
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
    public function listStorageZone(array $query = []): array
    {
        $endpoint = StorageEndpoint::LIST_STORAGE_ZONES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function addStorageZone(array $body): array
    {
        $endpoint = StorageEndpoint::ADD_STORAGE_ZONE;
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
    public function getStorageZone(int $id): array
    {
        $endpoint = StorageEndpoint::GET_STORAGE_ZONE;

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
    public function updateStorageZone(int $id, array $body): array
    {
        $endpoint = StorageEndpoint::UPDATE_STORAGE_ZONE;
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
    public function deleteStorageZone(int $id): array
    {
        $endpoint = StorageEndpoint::DELETE_STORAGE_ZONE;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function resetStorageZonePasswordByQuery(array $query): array
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_QUERY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @param array $id
     * @return array
     * @throws GuzzleException
     */
    public function resetStorageZonePasswordByPath(array $id): array
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_PATH;

        return $this->createRequest(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function resetStorageZoneReadOnlyPassword(array $query): array
    {
        $endpoint = StorageEndpoint::RESET_READONLY_PASSWORD;
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
    public function getUserDetails(): array
    {
        $endpoint = UserEndpoint::GET_USER_DETAILS;

        return $this->createRequest(
            $endpoint
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws GuzzleException
     */
    public function updateUserDetails(array $body): array
    {
        $endpoint = StorageEndpoint::UPDATE_STORAGE_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [],
            [],
            $body
        );
    }
}
