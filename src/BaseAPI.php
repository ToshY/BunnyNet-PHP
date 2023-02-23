<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\Base\AbuseCase\CheckAbuseCase;
use ToshY\BunnyNet\Model\Base\AbuseCase\ListAbuseCases;
use ToshY\BunnyNet\Model\Base\AbuseCase\ResolveAbuseCase;
use ToshY\BunnyNet\Model\Base\AbuseCase\ResolveDMCACase;
use ToshY\BunnyNet\Model\Base\Billing\ApplyPromoCode;
use ToshY\BunnyNet\Model\Base\Billing\ClaimAffiliateCredits;
use ToshY\BunnyNet\Model\Base\Billing\ConfigureAutoRecharge;
use ToshY\BunnyNet\Model\Base\Billing\CreateCoinifyPayment;
use ToshY\BunnyNet\Model\Base\Billing\CreatePaymentCheckout;
use ToshY\BunnyNet\Model\Base\Billing\GetAffiliateDetails;
use ToshY\BunnyNet\Model\Base\Billing\GetBillingDetails;
use ToshY\BunnyNet\Model\Base\Billing\GetBillingSummary;
use ToshY\BunnyNet\Model\Base\Billing\GetCoinifyBTCExchangeRate;
use ToshY\BunnyNet\Model\Base\Billing\PreparePaymentAuthorization;
use ToshY\BunnyNet\Model\Base\Compute\AddComputeScript;
use ToshY\BunnyNet\Model\Base\Compute\PublishComputeScript;
use ToshY\BunnyNet\Model\Base\Compute\PublishComputeScriptByPathParameter;
use ToshY\BunnyNet\Model\Base\Compute\AddComputeScriptVariable;
use ToshY\BunnyNet\Model\Base\Compute\DeleteComputeScript;
use ToshY\BunnyNet\Model\Base\Compute\DeleteComputeScriptVariable;
use ToshY\BunnyNet\Model\Base\Compute\GetComputeScript;
use ToshY\BunnyNet\Model\Base\Compute\GetComputeScriptCode;
use ToshY\BunnyNet\Model\Base\Compute\GetComputeScriptVariable;
use ToshY\BunnyNet\Model\Base\Compute\ListComputeScriptReleases;
use ToshY\BunnyNet\Model\Base\Compute\ListComputeScripts;
use ToshY\BunnyNet\Model\Base\Compute\UpdateComputeScript;
use ToshY\BunnyNet\Model\Base\Compute\UpdateComputeScriptCode;
use ToshY\BunnyNet\Model\Base\Compute\UpdateComputeScriptVariable;
use ToshY\BunnyNet\Model\Base\Countries\ListCountries;
use ToshY\BunnyNet\Model\Base\DNSZone\AddDNSRecord;
use ToshY\BunnyNet\Model\Base\DNSZone\AddDNSZone;
use ToshY\BunnyNet\Model\Base\DNSZone\CheckDNSZoneAvailability;
use ToshY\BunnyNet\Model\Base\DNSZone\DeleteDNSRecord;
use ToshY\BunnyNet\Model\Base\DNSZone\DeleteDNSZone;
use ToshY\BunnyNet\Model\Base\DNSZone\DismissDNSConfigurationNotice;
use ToshY\BunnyNet\Model\Base\DNSZone\ExportDNSRecords;
use ToshY\BunnyNet\Model\Base\DNSZone\GetDNSZone;
use ToshY\BunnyNet\Model\Base\DNSZone\GetDNSZoneQueryStatistics;
use ToshY\BunnyNet\Model\Base\DNSZone\ImportDNSRecords;
use ToshY\BunnyNet\Model\Base\DNSZone\ListDNSZones;
use ToshY\BunnyNet\Model\Base\DNSZone\RecheckDNSConfiguration;
use ToshY\BunnyNet\Model\Base\DNSZone\UpdateDNSRecord;
use ToshY\BunnyNet\Model\Base\DNSZone\UpdateDNSZone;
use ToshY\BunnyNet\Model\Base\DRMCertificate\ListDRMCertificates;
use ToshY\BunnyNet\Model\Base\PullZone\AddCustomCertificate;
use ToshY\BunnyNet\Model\Base\PullZone\AddCustomHostname;
use ToshY\BunnyNet\Model\Base\PullZone\AddOrUpdateEdgeRule;
use ToshY\BunnyNet\Model\Base\PullZone\AddPullZone;
use ToshY\BunnyNet\Model\Base\PullZone\CheckPullZoneAvailability;
use ToshY\BunnyNet\Model\Base\PullZone\DeleteCertificate;
use ToshY\BunnyNet\Model\Base\PullZone\DeleteCustomHostname;
use ToshY\BunnyNet\Model\Base\PullZone\DeleteEdgeRule;
use ToshY\BunnyNet\Model\Base\PullZone\DeletePullZone;
use ToshY\BunnyNet\Model\Base\PullZone\GetOptimizerStatistics;
use ToshY\BunnyNet\Model\Base\PullZone\GetOriginShieldQueueStatistics;
use ToshY\BunnyNet\Model\Base\PullZone\GetPullZone;
use ToshY\BunnyNet\Model\Base\PullZone\GetSafeHopStatistics;
use ToshY\BunnyNet\Model\Base\PullZone\GetWAFStatistics;
use ToshY\BunnyNet\Model\Base\PullZone\ListPullZones;
use ToshY\BunnyNet\Model\Base\PullZone\LoadFreeCertificate;
use ToshY\BunnyNet\Model\Base\PullZone\PurgeCache;
use ToshY\BunnyNet\Model\Base\PullZone\ResetTokenKey;
use ToshY\BunnyNet\Model\Base\PullZone\SetEdgeRuleEnabled;
use ToshY\BunnyNet\Model\Base\PullZone\SetForceSSL;
use ToshY\BunnyNet\Model\Base\PullZone\UpdatePullZone;
use ToshY\BunnyNet\Model\Base\Purge\PurgeURL;
use ToshY\BunnyNet\Model\Base\Purge\PurgeURLByHeader;
use ToshY\BunnyNet\Model\Base\Region\ListRegions;
use ToshY\BunnyNet\Model\Base\Statistics\GetStatistics;
use ToshY\BunnyNet\Model\Base\StorageZone\AddStorageZone;
use ToshY\BunnyNet\Model\Base\StorageZone\CheckStorageZoneAvailability;
use ToshY\BunnyNet\Model\Base\StorageZone\DeleteStorageZone;
use ToshY\BunnyNet\Model\Base\StorageZone\GetStorageZone;
use ToshY\BunnyNet\Model\Base\StorageZone\ListStorageZones;
use ToshY\BunnyNet\Model\Base\StorageZone\UpdateStorageZone;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\AddVideoLibrary;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\AddWatermark;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\DeleteVideoLibrary;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\DeleteWatermark;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\GetVideoLibrary;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\ListVideoLibraries;
use ToshY\BunnyNet\Model\Base\StreamVideoLibrary\UpdateVideoLibrary;
use ToshY\BunnyNet\Model\Base\Support\CloseTicket;
use ToshY\BunnyNet\Model\Base\Support\CreateTicket;
use ToshY\BunnyNet\Model\Base\Support\GetTicketDetails;
use ToshY\BunnyNet\Model\Base\Support\ListTickets;
use ToshY\BunnyNet\Model\Base\Support\ReplyTicket;
use ToshY\BunnyNet\Model\Base\User\AcceptDPA;
use ToshY\BunnyNet\Model\Base\User\CloseAccount;
use ToshY\BunnyNet\Model\Base\User\Disable2FA;
use ToshY\BunnyNet\Model\Base\User\Enable2FA;
use ToshY\BunnyNet\Model\Base\User\Generate2FAVerification;
use ToshY\BunnyNet\Model\Base\User\GetDPADetails;
use ToshY\BunnyNet\Model\Base\User\GetDPADetailsHTML;
use ToshY\BunnyNet\Model\Base\User\GetHomeFeed;
use ToshY\BunnyNet\Model\Base\User\GetUserDetails;
use ToshY\BunnyNet\Model\Base\User\GetWhatsNewItems;
use ToshY\BunnyNet\Model\Base\User\ListCloseAccountReasons;
use ToshY\BunnyNet\Model\Base\User\ResendEmailConfirmation;
use ToshY\BunnyNet\Model\Base\User\ResetAPIKey;
use ToshY\BunnyNet\Model\Base\User\ResetWhatsNew;
use ToshY\BunnyNet\Model\Base\User\SetNotificationsOpened;
use ToshY\BunnyNet\Model\Base\User\UpdateUserDetails;
use ToshY\BunnyNet\Model\Base\User\Verify2FACode;
use ToshY\BunnyNet\Validator\ParameterValidator;

class BaseAPI
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client
            ->setAPIKey($this->apiKey)
            ->setBaseUrl(Host::API_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listAbuseCases(array $query = []): ResponseInterface
    {
        $endpoint = new ListAbuseCases();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function resolveDMCACase(int $id): ResponseInterface
    {
        $endpoint = new ResolveDMCACase();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function resolveAbuseCase(int $id): ResponseInterface
    {
        $endpoint = new ResolveAbuseCase();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function checkAbuseCase(int $id): ResponseInterface
    {
        $endpoint = new CheckAbuseCase();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getCountryList(): ResponseInterface
    {
        $endpoint = new ListCountries();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getBillingDetails(): ResponseInterface
    {
        $endpoint = new GetBillingDetails();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function configureAutoRecharge(array $body): ResponseInterface
    {
        $endpoint = new ConfigureAutoRecharge();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function createPaymentCheckout(array $body): ResponseInterface
    {
        $endpoint = new CreatePaymentCheckout();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function preparePaymentAuthorization(): ResponseInterface
    {
        $endpoint = new PreparePaymentAuthorization();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getAffiliateDetails(): ResponseInterface
    {
        $endpoint = new GetAffiliateDetails();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function claimAffiliateCredits(): ResponseInterface
    {
        $endpoint = new ClaimAffiliateCredits();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getCoinifyBTCExchangeRate(): ResponseInterface
    {
        $endpoint = new GetCoinifyBTCExchangeRate();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function createCoinifyPayment(array $query): ResponseInterface
    {
        $endpoint = new CreateCoinifyPayment();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getBillingSummary(): ResponseInterface
    {
        $endpoint = new GetBillingSummary();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function applyPromoCode(array $query): ResponseInterface
    {
        $endpoint = new ApplyPromoCode();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listComputeScripts(array $query): ResponseInterface
    {
        $endpoint = new ListComputeScripts();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function addComputeScript(array $body): ResponseInterface
    {
        $endpoint = new AddComputeScript();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function getComputeScript(int $id): ResponseInterface
    {
        $endpoint = new GetComputeScript();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateComputeScript(int $id, array $body): ResponseInterface
    {
        $endpoint = new UpdateComputeScript();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function deleteComputeScript(int $id): ResponseInterface
    {
        $endpoint = new DeleteComputeScript();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function getComputeScriptCode(int $id): ResponseInterface
    {
        $endpoint = new GetComputeScriptCode();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateComputeScriptCode(int $id, array $body = []): ResponseInterface
    {
        $endpoint = new UpdateComputeScriptCode();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $id
     */
    public function listComputeScriptReleases(int $id, array $query = []): ResponseInterface
    {
        $endpoint = new ListComputeScriptReleases();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $id
     */
    public function publishComputeScript(int $id, array $query, array $body = []): ResponseInterface
    {
        $endpoint = new PublishComputeScript();

        ParameterValidator::validate($query, $endpoint->getQuery());
        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param string $uuid
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $id
     */
    public function publishComputeScriptByPathParameter(
        int $id,
        string $uuid,
        array $body = []
    ): ResponseInterface {
        $endpoint = new PublishComputeScriptByPathParameter();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $uuid],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addComputeScriptVariable(int $id, array $body): ResponseInterface
    {
        $endpoint = new AddComputeScriptVariable();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $variableId
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $id
     */
    public function updateComputeScriptVariable(int $id, int $variableId, array $body): ResponseInterface
    {
        $endpoint = new UpdateComputeScriptVariable();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $variableId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param int $variableId
     * @return ResponseInterface
     * @param int $id
     */
    public function getComputeScriptVariable(int $id, int $variableId): ResponseInterface
    {
        $endpoint = new GetComputeScriptVariable();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $variableId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param int $variableId
     * @return ResponseInterface
     * @param int $id
     */
    public function deleteComputeScriptVariable(int $id, int $variableId): ResponseInterface
    {
        $endpoint = new DeleteComputeScriptVariable();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $variableId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listTickets(array $query = []): ResponseInterface
    {
        $endpoint = new ListTickets();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function getTicketDetails(int $id): ResponseInterface
    {
        $endpoint = new GetTicketDetails();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function closeTicket(int $id): ResponseInterface
    {
        $endpoint = new CloseTicket();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function replyTicket(int $id, array $body = []): ResponseInterface
    {
        $endpoint = new ReplyTicket();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function createTicket(array $body): ResponseInterface
    {
        $endpoint = new CreateTicket();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listDRMCertificates(array $query = []): ResponseInterface
    {
        $endpoint = new ListDRMCertificates();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function listRegions(): ResponseInterface
    {
        $endpoint = new ListRegions();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listVideoLibraries(array $query = []): ResponseInterface
    {
        $endpoint = new ListVideoLibraries();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function addVideoLibrary(array $body): ResponseInterface
    {
        $endpoint = new AddVideoLibrary();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $id
     */
    public function getVideoLibrary(int $id, array $query = []): ResponseInterface
    {
        $endpoint = new GetVideoLibrary();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateVideoLibrary(int $id, array $body): ResponseInterface
    {
        $endpoint = new UpdateVideoLibrary();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function deleteVideoLibrary(int $id): ResponseInterface
    {
        $endpoint = new DeleteVideoLibrary();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function resetVideoLibraryPassword(array $query): ResponseInterface
    {
        $endpoint = new Model\Base\StreamVideoLibrary\ResetPassword();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function resetVideoLibraryPasswordByPathParameter(int $id): ResponseInterface
    {
        $endpoint = new Model\Base\StreamVideoLibrary\ResetPasswordByPathParameter();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function addWatermark(int $id): ResponseInterface
    {
        $endpoint = new AddWatermark();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function deleteWatermark(int $id): ResponseInterface
    {
        $endpoint = new DeleteWatermark();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addVideoLibraryAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\StreamVideoLibrary\AddAllowedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removeVideoLibraryAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\StreamVideoLibrary\DeleteAllowedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addVideoLibraryBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\StreamVideoLibrary\AddBlockedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removeVideoLibraryBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\StreamVideoLibrary\DeleteBlockedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listDNSZones(array $query = []): ResponseInterface
    {
        $endpoint = new ListDNSZones();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function addDNSZone(array $body): ResponseInterface
    {
        $endpoint = new AddDNSZone();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function getDNSZone(int $id): ResponseInterface
    {
        $endpoint = new GetDNSZone();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateDNSZone(int $id, array $body = []): ResponseInterface
    {
        $endpoint = new UpdateDNSZone();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function deleteDNSZone(int $id): ResponseInterface
    {
        $endpoint = new DeleteDNSZone();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function exportDNSZone(int $id): ResponseInterface
    {
        $endpoint = new ExportDNSRecords();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $id
     */
    public function getDNSZoneQueryStatistics(int $id, array $query = []): ResponseInterface
    {
        $endpoint = new GetDNSZoneQueryStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function checkDNSZoneAvailability(array $body): ResponseInterface
    {
        $endpoint = new CheckDNSZoneAvailability();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $zoneId
     * @param array<string,mixed> $body
     */
    public function addDNSRecord(int $zoneId, array $body): ResponseInterface
    {
        $endpoint = new AddDNSRecord();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$zoneId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $id
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $zoneId
     */
    public function updateDNSRecord(int $zoneId, int $id, array $body): ResponseInterface
    {
        $endpoint = new UpdateDNSRecord();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$zoneId, $id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param int $id
     * @return ResponseInterface
     * @param int $zoneId
     */
    public function deleteDNSRecord(int $zoneId, int $id): ResponseInterface
    {
        $endpoint = new DeleteDNSRecord();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$zoneId, $id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function recheckDNSConfiguration(int $id): ResponseInterface
    {
        $endpoint = new RecheckDNSConfiguration();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function dismissDNSConfigurationNotice(int $id): ResponseInterface
    {
        $endpoint = new DismissDNSConfigurationNotice();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\FileDoesNotExistException
     * @return ResponseInterface
     * @param int $zoneId
     * @param string $localFilePath
     */
    public function importDNSRecords(int $zoneId, string $localFilePath): ResponseInterface
    {
        $endpoint = new ImportDNSRecords();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$zoneId],
            body: BodyContentHelper::openFileStream($localFilePath),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listPullZones(array $query = []): ResponseInterface
    {
        $endpoint = new ListPullZones();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function addPullZone(array $body): ResponseInterface
    {
        $endpoint = new AddPullZone();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $id
     */
    public function getPullZone(int $id, array $query = []): ResponseInterface
    {
        $endpoint = new GetPullZone();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updatePullZone(int $id, array $body): ResponseInterface
    {
        $endpoint = new UpdatePullZone();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function deletePullZone(int $id): ResponseInterface
    {
        $endpoint = new DeletePullZone();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $edgeRuleId
     * @return ResponseInterface
     * @param int $pullZoneId
     */
    public function deleteEdgeRule(int $pullZoneId, string $edgeRuleId): ResponseInterface
    {
        $endpoint = new DeleteEdgeRule();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId, $edgeRuleId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $pullZoneId
     * @param array<string,mixed> $body
     */
    public function addOrUpdateEdgeRule(int $pullZoneId, array $body): ResponseInterface
    {
        $endpoint = new AddOrUpdateEdgeRule();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param string $edgeRuleId
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $pullZoneId
     */
    public function setEdgeRuleEnabled(
        int $pullZoneId,
        string $edgeRuleId,
        array $body
    ): ResponseInterface {
        $endpoint = new SetEdgeRuleEnabled();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId, $edgeRuleId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $pullZoneId
     */
    public function getOriginShieldQueueStatistics(
        int $pullZoneId,
        array $query = []
    ): ResponseInterface {
        $endpoint = new GetOriginShieldQueueStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $pullZoneId
     */
    public function getSafeHopStatistics(int $pullZoneId, array $query = []): ResponseInterface
    {
        $endpoint = new GetSafeHopStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $pullZoneId
     */
    public function getOptimizerStatistics(int $pullZoneId, array $query = []): ResponseInterface
    {
        $endpoint = new GetOptimizerStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $pullZoneId
     */
    public function getWAFStatistics(int $pullZoneId, array $query = []): ResponseInterface
    {
        $endpoint = new GetWAFStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$pullZoneId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function loadFreeCertificate(array $query): ResponseInterface
    {
        $endpoint = new LoadFreeCertificate();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function purgePullZoneCache(int $id, array $body = []): ResponseInterface
    {
        $endpoint = new PurgeCache();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function checkPullZoneAvailability(array $body): ResponseInterface
    {
        $endpoint = new CheckPullZoneAvailability();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addCustomCertificate(int $id, array $body): ResponseInterface
    {
        $endpoint = new AddCustomCertificate();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removeCertificate(int $id, array $body): ResponseInterface
    {
        $endpoint = new DeleteCertificate();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addCustomHostname(int $id, array $body): ResponseInterface
    {
        $endpoint = new AddCustomHostname();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removeCustomHostname(int $id, array $body): ResponseInterface
    {
        $endpoint = new DeleteCustomHostname();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function setForceSSL(int $id, array $body): ResponseInterface
    {
        $endpoint = new SetForceSSL();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function resetPullZoneTokenKey(int $id): ResponseInterface
    {
        $endpoint = new ResetTokenKey();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addPullZoneAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\PullZone\AddAllowedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removePullZoneAllowedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\PullZone\DeleteAllowedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addPullZoneBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\PullZone\AddBlockedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removePullZoneBlockedReferer(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\PullZone\DeleteBlockedReferer();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addPullZoneBlockedIP(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\PullZone\AddBlockedIP();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function removePullZoneBlockedIP(int $id, array $body): ResponseInterface
    {
        $endpoint = new Model\Base\PullZone\DeleteBlockedIP();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function purgeUrl(array $query): ResponseInterface
    {
        $endpoint = new PurgeURL();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function purgeUrlByHeader(array $query): ResponseInterface
    {
        $endpoint = new PurgeURLByHeader();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function getStatistics(array $query = []): ResponseInterface
    {
        $endpoint = new GetStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function listStorageZones(array $query = []): ResponseInterface
    {
        $endpoint = new ListStorageZones();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function addStorageZone(array $body): ResponseInterface
    {
        $endpoint = new AddStorageZone();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function checkStorageZoneAvailability(array $body): ResponseInterface
    {
        $endpoint = new CheckStorageZoneAvailability();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function getStorageZone(int $id): ResponseInterface
    {
        $endpoint = new GetStorageZone();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id]
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateStorageZone(int $id, array $body): ResponseInterface
    {
        $endpoint = new UpdateStorageZone();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function deleteStorageZone(int $id): ResponseInterface
    {
        $endpoint = new DeleteStorageZone();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     * @param int $id
     */
    public function resetStorageZonePassword(int $id): ResponseInterface
    {
        $endpoint = new Model\Base\StorageZone\ResetPassword();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function resetStorageZoneReadOnlyPassword(array $query): ResponseInterface
    {
        $endpoint = new Model\Base\StorageZone\ResetReadOnlyPassword();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getHomeFeed(): ResponseInterface
    {
        $endpoint = new GetHomeFeed();

        return $this->client->request(
            endpoint: $endpoint,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getUserDetails(): ResponseInterface
    {
        $endpoint = new GetUserDetails();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function updateUserDetails(array $body): ResponseInterface
    {
        $endpoint = new UpdateUserDetails();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function resendEmailConfirmation(): ResponseInterface
    {
        $endpoint = new ResendEmailConfirmation();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function resetUserApiKey(): ResponseInterface
    {
        $endpoint = new ResetAPIKey();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function listCloseAccountReasons(): ResponseInterface
    {
        $endpoint = new ListCloseAccountReasons();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function closeAccount(array $body): ResponseInterface
    {
        $endpoint = new CloseAccount();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getDPADetails(): ResponseInterface
    {
        $endpoint = new GetDPADetails();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function acceptDPA(): ResponseInterface
    {
        $endpoint = new AcceptDPA();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getDPADetailsHTML(): ResponseInterface
    {
        $endpoint = new GetDPADetailsHTML();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function setNotificationsOpened(): ResponseInterface
    {
        $endpoint = new SetNotificationsOpened();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function getWhatsNewItems(): ResponseInterface
    {
        $endpoint = new GetWhatsNewItems();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function resetWhatsNew(): ResponseInterface
    {
        $endpoint = new ResetWhatsNew();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function generate2FAVerification(): ResponseInterface
    {
        $endpoint = new Generate2FAVerification();

        return $this->client->request(
            endpoint: $endpoint
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function disable2FA(array $body): ResponseInterface
    {
        $endpoint = new Disable2FA();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function enable2FA(array $body): ResponseInterface
    {
        $endpoint = new Enable2FA();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param array<string,mixed> $body
     */
    public function verify2FACode(array $body): ResponseInterface
    {
        $endpoint = new Verify2FACode();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            body: BodyContentHelper::getBody($body),
        );
    }
}