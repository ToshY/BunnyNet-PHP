<?php

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
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\KeyFormatNotSupportedException;
use ToshY\BunnyNet\Model\Client\Response;

/**
 * @link https://docs.bunny.net/reference/bunnynet-api-overview
 */
final class BaseRequest extends BunnyClient
{
    /**
     * @throws KeyFormatNotSupportedException
     */
    public function __construct(
        string $accountApiKey
    ) {
        $this->setApiKey($accountApiKey);

        parent::__construct(Host::API_ENDPOINT);
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @throws KeyFormatNotSupportedException
     */
    public function setApiKey(string $key): BaseRequest
    {
        if (preg_match(Type::UUID72_TYPE->value, $key) !== 1) {
            throw new KeyFormatNotSupportedException(
                'Invalid API key: does not conform to the UUID 72 characters format.'
            );
        }
        $this->apiKey = $key;
        return $this;
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listAbuseCases(array $query = []): Response
    {
        $endpoint = AbuseCaseEndpoint::LIST_ABUSE_CASES;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    public function checkAbuseCase(int $id): Response
    {
        $endpoint = AbuseCaseEndpoint::CHECK_ABUSE_CASE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function listRegions(): Response
    {
        $endpoint = RegionEndpoint::GET_REGION_LIST;

        return $this->request(
            $endpoint
        );
    }

    public function getCountryList(): Response
    {
        $endpoint = CountryEndpoint::GET_COUNTRY_LIST;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listVideoLibraries(array $query): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addVideoLibrary(array $body): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getVideoLibrary(int $id, array $query = []): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateVideoLibrary(int $id, array $body): Response
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

    public function deleteVideoLibrary(int $id): Response
    {
        $endpoint = StreamEndpoint::DELETE_VIDEO_LIBRARY;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function resetVideoLibraryPasswordByQuery(array $query): Response
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_QUERY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    public function resetVideoLibraryPasswordByPath(int $id): Response
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_PATH;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function addWatermark(int $id): Response
    {
        $endpoint = StreamEndpoint::ADD_WATERMARK;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function deleteWatermark(int $id): Response
    {
        $endpoint = StreamEndpoint::DELETE_WATERMARK;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addVideoLibraryAllowedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removeVideoLibraryAllowedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addVideoLibraryBlockedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removeVideoLibraryBlockedReferer(int $id, array $body): Response
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

    public function getBillingDetails(): Response
    {
        $endpoint = BillingEndpoint::GET_BILLING_DETAILS;

        return $this->request(
            $endpoint
        );
    }

    public function getBillingSummary(): Response
    {
        $endpoint = BillingEndpoint::GET_BILLING_SUMMARY;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function applyPromoCode(array $query): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listPullZones(array $query = []): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZone(array $body): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getPullZone(int $id, array $query = []): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updatePullZone(int $id, array $body): Response
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

    public function deletePullZone(int $id): Response
    {
        $endpoint = PullZoneEndpoint::DELETE_PULL_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function deleteEdgeRule(int $pullZoneId, string $edgeRuleId): Response
    {
        $endpoint = PullZoneEndpoint::DELETE_EDGE_RULE;

        return $this->request(
            $endpoint,
            [$pullZoneId, $edgeRuleId]
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addOrUpdateEdgeRule(int $pullZoneId, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function setEdgeRuleEnabled(
        int $pullZoneId,
        string $edgeRuleId,
        array $body
    ): Response {
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getOriginShieldQueueStatistics(
        int $pullZoneId,
        array $query = []
    ): Response {
        $endpoint = PullZoneEndpoint::GET_ORIGIN_SHIELD_QUEUE_STATISTICS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$pullZoneId],
            $query,
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getSafeHopStatistics(int $pullZoneId, array $query = []): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getOptimizerStatistics(int $pullZoneId, array $query = []): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getStatisticsPullZone(int $pullZoneId, array $query = []): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function loadFreeCertificate(array $query): Response
    {
        $endpoint = PullZoneEndpoint::LOAD_FREE_CERTIFICATE;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    public function purgeCache(): Response
    {
        $endpoint = PullZoneEndpoint::PURGE_CACHE;

        return $this->request(
            $endpoint,
            []
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addCustomCertificate(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removeCertificate(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addCustomHostname(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removeCustomHostname(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function setForceSSL(int $id, array $body): Response
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

    public function resetPullZoneTokenKey(int $id): Response
    {
        $endpoint = PullZoneEndpoint::RESET_TOKEN_KEY;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZoneAllowedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removePullZoneAllowedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZoneBlockedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removePullZoneBlockedReferer(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZoneBlockedIP(int $id, array $body): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function removePullZoneBlockedIP(int $id, array $body): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function purgeUrl(array $query): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function purgeUrlByHeader(array $query): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getStatistics(array $query = []): Response
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
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listStorageZone(array $query = []): Response
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
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addStorageZone(array $body): Response
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

    public function getStorageZone(int $id): Response
    {
        $endpoint = StorageEndpoint::GET_STORAGE_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateStorageZone(int $id, array $body): Response
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

    public function deleteStorageZone(int $id): Response
    {
        $endpoint = StorageEndpoint::DELETE_STORAGE_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function resetStorageZonePasswordByQuery(array $query): Response
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_QUERY;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    public function resetStorageZonePasswordByPath(int $id): Response
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_PATH;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function resetStorageZoneReadOnlyPassword(array $query): Response
    {
        $endpoint = StorageEndpoint::RESET_READONLY_PASSWORD;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    public function getUserDetails(): Response
    {
        $endpoint = UserEndpoint::GET_USER_DETAILS;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateUserDetails(array $body): Response
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

    public function resetUserApiKey(): Response
    {
        $endpoint = UserEndpoint::RESET_API_KEY;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function closeTheAccount(array $body): Response
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

    public function getDpaDetails(): Response
    {
        $endpoint = UserEndpoint::GET_DPA_DETAILS;

        return $this->request(
            $endpoint
        );
    }
}
