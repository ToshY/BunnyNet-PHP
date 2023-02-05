<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Message\ResponseInterface;
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
use ToshY\BunnyNet\Validator\ParameterValidator;

/**
 * @link https://docs.bunny.net/reference/bunnynet-api-overview
 * @note Requires the account API key.
 * @todo refactor this and add the new model endpoints
 */
class BaseRequest
{
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client->setBaseUrl(Host::API_ENDPOINT);
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listAbuseCases(array $query = []): ResponseInterface
    {
        $endpoint = AbuseCaseEndpoint::LIST_ABUSE_CASES;
        ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    public function checkAbuseCase(int $id): ResponseInterface
    {
        $endpoint = AbuseCaseEndpoint::CHECK_ABUSE_CASE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function listRegions(): ResponseInterface
    {
        $endpoint = RegionEndpoint::GET_REGION_LIST;

        return $this->request(
            $endpoint
        );
    }

    public function getCountryList(): ResponseInterface
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
    public function listVideoLibraries(array $query): ResponseInterface
    {
        $endpoint = StreamEndpoint::LIST_VIDEO_LIBRARIES;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addVideoLibrary(array $body): ResponseInterface
    {
        $endpoint = StreamEndpoint::ADD_VIDEO_LIBRARY;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function getVideoLibrary(int $id, array $query = []): ResponseInterface
    {
        $endpoint = StreamEndpoint::GET_VIDEO_LIBRARY;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$id],
            $query
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateVideoLibrary(int $id, array $body): ResponseInterface
    {
        $endpoint = StreamEndpoint::ADD_VIDEO_LIBRARY;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    public function deleteVideoLibrary(int $id): ResponseInterface
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
    public function resetVideoLibraryPasswordByQuery(array $query): ResponseInterface
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_QUERY;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    public function resetVideoLibraryPasswordByPath(int $id): ResponseInterface
    {
        $endpoint = StreamEndpoint::RESET_PASSWORD_PATH;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function addWatermark(int $id): ResponseInterface
    {
        $endpoint = StreamEndpoint::ADD_WATERMARK;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function deleteWatermark(int $id): ResponseInterface
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
    public function addVideoLibraryAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = StreamEndpoint::ADD_ALLOWED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removeVideoLibraryAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = StreamEndpoint::REMOVE_ALLOWED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function addVideoLibraryBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = StreamEndpoint::ADD_BLOCKED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removeVideoLibraryBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = StreamEndpoint::REMOVE_BLOCKED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    public function getBillingDetails(): ResponseInterface
    {
        $endpoint = BillingEndpoint::GET_BILLING_DETAILS;

        return $this->request(
            $endpoint
        );
    }

    public function getBillingSummary(): ResponseInterface
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
    public function applyPromoCode(array $query): ResponseInterface
    {
        $endpoint = BillingEndpoint::APPLY_PROMO_CODE;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function listPullZones(array $query = []): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::LIST_PULL_ZONES;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addPullZone(array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_PULL_ZONE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function getPullZone(int $id, array $query = []): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::GET_PULL_ZONE;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$id],
            $query
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updatePullZone(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::UPDATE_PULL_ZONE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    public function deletePullZone(int $id): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::DELETE_PULL_ZONE;

        return $this->request(
            $endpoint,
            [$id]
        );
    }

    public function deleteEdgeRule(int $pullZoneId, string $edgeRuleId): ResponseInterface
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
    public function addOrUpdateEdgeRule(int $pullZoneId, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_UPDATE_EDGE_RULE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    ): ResponseInterface {
        $endpoint = PullZoneEndpoint::SET_EDGE_RULE_ENABLED;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    ): ResponseInterface {
        $endpoint = PullZoneEndpoint::GET_ORIGIN_SHIELD_QUEUE_STATISTICS;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function getSafeHopStatistics(int $pullZoneId, array $query = []): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::GET_SAFEHOP_STATISTICS;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function getOptimizerStatistics(int $pullZoneId, array $query = []): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::GET_OPTIMIZER_STATISTICS;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function getStatisticsPullZone(int $pullZoneId, array $query = []): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::GET_STATISTICS;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function loadFreeCertificate(array $query): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::LOAD_FREE_CERTIFICATE;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    public function purgeCache(): ResponseInterface
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
    public function addCustomCertificate(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_CUSTOM_CERTIFICATE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removeCertificate(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::REMOVE_CERTIFICATE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function addCustomHostname(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_CUSTOM_HOSTNAME;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removeCustomHostname(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::REMOVE_CUSTOM_HOSTNAME;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function setForceSSL(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::SET_FORCE_SSL;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    public function resetPullZoneTokenKey(int $id): ResponseInterface
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
    public function addPullZoneAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_ALLOWED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removePullZoneAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::REMOVE_ALLOWED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function addPullZoneBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removePullZoneBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::REMOVE_BLOCKED_REFERER;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function addPullZoneBlockedIP(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::ADD_BLOCKED_IP;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function removePullZoneBlockedIP(int $id, array $body): ResponseInterface
    {
        $endpoint = PullZoneEndpoint::REMOVE_BLOCKED_IP;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

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
    public function purgeUrl(array $query): ResponseInterface
    {
        $endpoint = PurgeEndpoint::PURGE_URL;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function purgeUrlByHeader(array $query): ResponseInterface
    {
        $endpoint = PurgeEndpoint::PURGE_URL_HEADER;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function getStatistics(array $query = []): ResponseInterface
    {
        $endpoint = StatisticsEndpoint::GET_STATISTICS;
        $query = ParameterValidator::validate($query, $endpoint['query']);

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
    public function listStorageZone(array $query = []): ResponseInterface
    {
        $endpoint = StorageEndpoint::LIST_STORAGE_ZONES;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addStorageZone(array $body): ResponseInterface
    {
        $endpoint = StorageEndpoint::ADD_STORAGE_ZONE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    public function getStorageZone(int $id): ResponseInterface
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
    public function updateStorageZone(int $id, array $body): ResponseInterface
    {
        $endpoint = StorageEndpoint::UPDATE_STORAGE_ZONE;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [$id],
            [],
            $body
        );
    }

    public function deleteStorageZone(int $id): ResponseInterface
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
    public function resetStorageZonePasswordByQuery(array $query): ResponseInterface
    {
        $endpoint = StorageEndpoint::RESET_PASSWORD_QUERY;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    public function resetStorageZonePasswordByPath(int $id): ResponseInterface
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
    public function resetStorageZoneReadOnlyPassword(array $query): ResponseInterface
    {
        $endpoint = StorageEndpoint::RESET_READONLY_PASSWORD;
        $query = ParameterValidator::validate($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [],
            $query,
        );
    }

    public function getUserDetails(): ResponseInterface
    {
        $endpoint = UserEndpoint::GET_USER_DETAILS;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateUserDetails(array $body): ResponseInterface
    {
        $endpoint = UserEndpoint::UPDATE_USER_DETAILS;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    public function resetUserApiKey(): ResponseInterface
    {
        $endpoint = UserEndpoint::RESET_API_KEY;

        return $this->request(
            $endpoint
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function closeTheAccount(array $body): ResponseInterface
    {
        $endpoint = UserEndpoint::CLOSE_ACCOUNT;
        $body = ParameterValidator::getBody($body, $endpoint['body']);

        return $this->request(
            $endpoint,
            [],
            [],
            $body
        );
    }

    public function getDpaDetails(): ResponseInterface
    {
        $endpoint = UserEndpoint::GET_DPA_DETAILS;

        return $this->request(
            $endpoint
        );
    }
}
