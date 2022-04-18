<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Base\AbuseCaseEndpoint;
use ToshY\BunnyNet\Enum\Base\BillingEndpoint;
use ToshY\BunnyNet\Enum\Base\CountryEndpoint;
use ToshY\BunnyNet\Enum\Base\PullZoneEndpoint;
use ToshY\BunnyNet\Enum\Base\PurgeEndpoint;
use ToshY\BunnyNet\Enum\Base\RegionEndpoint;
use ToshY\BunnyNet\Enum\Base\StatisticsEndpoint;
use ToshY\BunnyNet\Enum\Base\StorageEndpoint;
use ToshY\BunnyNet\Enum\Base\StreamEndpoint;
use ToshY\BunnyNet\Enum\Base\UserEndpoint;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\UuidType;
use ToshY\BunnyNet\Exception\KeyFormatNotSupportedException;

/**
 * Class BaseRequest
 * @link https://docs.bunny.net/reference/bunnynet-api-overview
 */
final class BaseRequest extends BunnyClient
{
    /**
     * BaseRequest constructor.
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
     */
    public function listAbuseCases(array $query = []): array
    {
        $endpoint = AbuseCaseEndpoint::LIST_ABUSE_CASES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function checkAbuseCase(int $id): array
    {
        $endpoint = AbuseCaseEndpoint::CHECK_ABUSE_CASE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @return array
     */
    public function listRegions(): array
    {
        $endpoint = RegionEndpoint::GET_REGION_LIST;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @return array
     */
    public function getCountryList(): array
    {
        $endpoint = CountryEndpoint::GET_COUNTRY_LIST;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listVideoLibraries(array $query): array
    {
        $endpoint = StreamEndpoint::LIST_VIDEO_LIBRARIES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addVideoLibrary(array $body): array
    {
        $endpoint = StreamEndpoint::ADD_VIDEO_LIBRARY;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getVideoLibrary(int $id, array $query = []): array
    {
        $endpoint = StreamEndpoint::GET_VIDEO_LIBRARY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$id],
            $query
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateVideoLibrary(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::ADD_VIDEO_LIBRARY;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function deleteVideoLibrary(int $id): array
    {
        $endpoint = StreamEndpoint::DELETE_VIDEO_LIBRARY;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function resetVideoLibraryPasswordByQuery(array $query): array
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_QUERY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function resetVideoLibraryPasswordByPath(int $id): array
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_PATH;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function addWatermark(int $id): array
    {
        $endpoint = StreamEndpoint::ADD_WATERMARK;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function deleteWatermark(int $id): array
    {
        $endpoint = StreamEndpoint::DELETE_WATERMARK;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addVideoLibraryAllowedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::ADD_ALLOWED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removeVideoLibraryAllowedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::REMOVE_ALLOWED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function addVideoLibraryBlockedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::ADD_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removeVideoLibraryBlockedReferer(int $id, array $body): array
    {
        $endpoint = StreamEndpoint::REMOVE_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @return array
     */
    public function getBillingDetails(): array
    {
        $endpoint = BillingEndpoint::GET_BILLING_DETAILS;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @return array
     */
    public function getBillingSummary(): array
    {
        $endpoint = BillingEndpoint::GET_BILLING_SUMMARY;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function applyPromoCode(array $query): array
    {
        $endpoint = BillingEndpoint::APPLY_PROMO_CODE;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
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
     */
    public function listPullZones(array $query = []): array
    {
        $endpoint = PullZoneEndpoint::LIST_PULL_ZONES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZone(array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_PULL_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getPullZone(int $id, array $query = []): array
    {
        $endpoint = PullZoneEndpoint::GET_PULL_ZONE;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$id],
            $query
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updatePullZone(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::UPDATE_PULL_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function deletePullZone(int $id): array
    {
        $endpoint = PullZoneEndpoint::DELETE_PULL_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $pullZoneId
     * @param string $edgeRuleId
     * @return array
     */
    public function deleteEdgeRule(int $pullZoneId, string $edgeRuleId): array
    {
        $endpoint = PullZoneEndpoint::DELETE_EDGE_RULE;

        return $this->request(
            $endpoint,
            [$pullZoneId, $edgeRuleId]
        );
    }

    /**
     * @param int $pullZoneId
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addOrUpdateEdgeRule(int $pullZoneId, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_UPDATE_EDGE_RULE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function setEdgeRuleEnabled(int $pullZoneId, string $edgeRuleId, array $body): array
    {
        $endpoint = PullZoneEndpoint::SET_EDGE_RULE_ENABLED;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function getOriginShieldQueueStatistics(int $pullZoneId, array $query = []): array
    {
        $endpoint = PullZoneEndpoint::GET_ORIGIN_SHIELD_QUEUE_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$pullZoneId],
            $query,
        );
    }

    /**
     * @param int $pullZoneId
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getSafeHopStatistics(int $pullZoneId, array $query = []): array
    {
        $endpoint = PullZoneEndpoint::GET_SAFEHOP_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$pullZoneId],
            $query,
        );
    }

    /**
     * @param int $pullZoneId
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getOptimizerStatistics(int $pullZoneId, array $query = []): array
    {
        $endpoint = PullZoneEndpoint::GET_OPTIMIZER_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$pullZoneId],
            $query,
        );
    }

    /**
     * @param int $pullZoneId
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getStatisticsPullZone(int $pullZoneId, array $query = []): array
    {
        $endpoint = PullZoneEndpoint::GET_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
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
     */
    public function loadFreeCertificate(array $query): array
    {
        $endpoint = PullZoneEndpoint::LOAD_FREE_CERTIFICATE;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @return array
     */
    public function purgeCache(): array
    {
        $endpoint = PullZoneEndpoint::PURGE_CACHE;

        return $this->request(
            $endpoint,
            []
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addCustomCertificate(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_CUSTOM_CERTIFICATE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removeCertificate(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_CERTIFICATE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function addCustomHostname(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_CUSTOM_HOSTNAME;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removeCustomHostname(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_CUSTOM_HOSTNAME;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function setForceSSL(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::SET_FORCE_SSL;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function resetPullZoneTokenKey(int $id): array
    {
        $endpoint = PullZoneEndpoint::RESET_TOKEN_KEY;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZoneAllowedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_ALLOWED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removePullZoneAllowedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_ALLOWED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function addPullZoneBlockedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removePullZoneBlockedReferer(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_BLOCKED_REFERER;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function addPullZoneBlockedIP(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_IP;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function removePullZoneBlockedIP(int $id, array $body): array
    {
        $endpoint = PullZoneEndpoint::REMOVE_BLOCKED_IP;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
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
     */
    public function purgeUrl(array $query): array
    {
        $endpoint = PurgeEndpoint::PURGE_URL;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
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
     */
    public function purgeUrlByHeader(array $query): array
    {
        $endpoint = PurgeEndpoint::PURGE_URL_HEADER;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
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
     */
    public function getStatistics(array $query = []): array
    {
        $endpoint = StatisticsEndpoint::GET_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
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
     */
    public function listStorageZone(array $query = []): array
    {
        $endpoint = StorageEndpoint::LIST_STORAGE_ZONES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addStorageZone(array $body): array
    {
        $endpoint = StorageEndpoint::ADD_STORAGE_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function getStorageZone(int $id): array
    {
        $endpoint = StorageEndpoint::GET_STORAGE_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param int $id
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateStorageZone(int $id, array $body): array
    {
        $endpoint = StorageEndpoint::UPDATE_STORAGE_ZONE;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function deleteStorageZone(int $id): array
    {
        $endpoint = StorageEndpoint::DELETE_STORAGE_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function resetStorageZonePasswordByQuery(array $query): array
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_QUERY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @param int $id
     * @return array
     */
    public function resetStorageZonePasswordByPath(int $id): array
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_PATH;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @param array $query
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function resetStorageZoneReadOnlyPassword(array $query): array
    {
        $endpoint = StorageEndpoint::RESET_READONLY_PASSWORD;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @return array
     */
    public function getUserDetails(): array
    {
        $endpoint = UserEndpoint::GET_USER_DETAILS;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateUserDetails(array $body): array
    {
        $endpoint = UserEndpoint::UPDATE_USER_DETAILS;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    /**
     * @return array
     */
    public function resetUserApiKey(): array
    {
        $endpoint = UserEndpoint::RESET_API_KEY;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @param array $body
     * @return array
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function closeTheAccount(array $body): array
    {
        $endpoint = UserEndpoint::CLOSE_ACCOUNT;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    /**
     * @return array
     */
    public function getDpaDetails(): array
    {
        $endpoint = UserEndpoint::GET_DPA_DETAILS;

        return $this->request(
            $endpoint
        );
    }
}
