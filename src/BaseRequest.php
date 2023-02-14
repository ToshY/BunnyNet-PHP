<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Helper\EndpointHelper;
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

/**
 * Base endpoint for pull zones, video libraries, storage zones, billing, support, and lots more.
 *
 * Provide the API key available at the **[Account Settings](https://panel.bunny.net/account)** section.
 *
 * ```php
 * <?php
 *
 * require 'vendor/autoload.php';
 *
 * use ToshY\BunnyNet\BaseRequest;
 * use ToshY\BunnyNet\Client\BunnyClient;
 *
 * // Create a BunnyClient using any HTTP client implementing Psr\Http\Client\ClientInterface
 * $bunnyClient = new BunnyClient(
 *     client: new \Symfony\Component\HttpClient\HttpClient()
 * );
 *
 * $bunnyBase = new BaseRequest(
 *     apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
 *     client: $bunnyClient
 * );
 * ```
 *
 * @link https://docs.bunny.net/reference/bunnynet-api-overview
 */
class BaseRequest
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client->setBaseUrl(Host::API_ENDPOINT);
    }

    /**
     * Abuse Case | List Abuse Cases.
     *
     * ```php
     * $bunnyBase->listAbuseCases(
     *     query: [
     *         'page' => 1,
     *         'perPage' => 1000,
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/abusecasepublic_index
     *
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
     * Abuse Case | Resolve DMCA Case.
     *
     * ```php
     * $bunnyBase->resolveDMCACase(
     *     id: 1,
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/abusecasepublic_resolveabusecase
     *
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
     * Abuse Case | Resolve Abuse Case.
     *
     * ```php
     * $bunnyBase->resolveAbuseCase(
     *     id: 1,
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/abusecasepublic_resolveabusecase2
     *
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
     * Abuse Case | Check Abuse Case.
     *
     * ```php
     * $bunnyBase->checkAbuseCase(
     *     id: 1,
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/abusecasepublic_checkabusecase
     *
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
     * Countries | Get Country List.
     *
     * ```php
     * $bunnyBase->getCountryList();
     * ```
     *
     * @link https://docs.bunny.net/reference/countriespublic_getcountrylist
     *
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
     * Billing | Get Billing Details.
     *
     * ```php
     * $bunnyBase->getBillingDetails();
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_index
     *
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
     * Billing | Configure Auto Recharge.
     *
     * ```php
     * $bunnyBase->configureAutoRecharge(
     *     body: [
     *         'AutoRechargeEnabled' => true,
     *         'PaymentMethodToken' => 1000,
     *         'PaymentAmount' => 10,
     *         'RechargeTreshold' => 2
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `RechargeTreshold` (misspelled) has a range of 2-2000.
     * - `PaymentAmount` has a range of 10-2000.
     * ---
     *
     * @link https://docs.bunny.net/reference/billingpublic_configureautorecharge
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Billing | Create Payment Checkout.
     *
     * ```php
     * $bunnyBase->configureAutoRecharge(
     *     body: [
     *         'RechargeAmount' => 10,
     *         'PaymentAmount' => 10,
     *         'PaymentRequestId' => 123456,
     *         'Nonce' => 'ab'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `RechargeAmount` has a range of 10-10000.
     * - `PaymentAmount` has a range of 10-10000.
     * ---
     *
     * @link https://docs.bunny.net/reference/billingpublic_checkout
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Billing | Prepare Payment Authorization.
     *
     * ```php
     * $bunnyBase->preparePaymentAuthorization();
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_paymentsprepareauthorization
     *
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
     * Billing | Get Affiliate Details.
     *
     * ```php
     * $bunnyBase->getAffiliateDetails();
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_affiliatedetails
     *
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
     * Billing | Claim Affiliate Credits.
     *
     * ```php
     * $bunnyBase->claimAffiliateCredits();
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_affiliateclaim
     *
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
     * Billing | Get The Coinify BTC exchange rate.
     *
     * ```php
     * $bunnyBase->getCoinifyBTCExchangeRate();
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_coinifyexchangerate
     *
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
     * Billing | Create Coinify payment.
     *
     * ```php
     * $bunnyBase->createCoinifyPayment(
     *     query: [
     *         'amount' => 123
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_createcoinifypayment
     *
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
     * Billing | Get Billing Summary.
     *
     * ```php
     * $bunnyBase->getBillingSummary();
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_summary
     *
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
     * Billing | Apply Promo Code.
     *
     * ```php
     * $bunnyBase->applyPromoCode(
     *     query: [
     *         'CouponCode' => 'YOUFOUNDME'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/billingpublic_applycode
     *
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
     * Compute | List Compute Scripts.
     *
     * ```php
     * $bunnyBase->listComputeScripts(
     *     query: [
     *         'page' => 1,
     *         'perPage' => 1000
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_index
     *
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
     * Compute | Create Compute Script.
     *
     * ```php
     * $bunnyBase->addComputeScript(
     *     body: [
     *         'Name' => 'Test',
     *         'ScriptType' => 1000
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `ScriptType` possible values:
     *   - 0 = CDN
     *   - 1 = DNS
     * ---
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_addscript
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | Get Compute Script.
     *
     * ```php
     * $bunnyBase->getComputeScript(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_index2
     *
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
     * Compute | Update Compute Script.
     *
     * ```php
     * $bunnyBase->updateComputeScript(
     *     id: 1,
     *     body: [
     *         'Name' => 'Test',
     *         'ScriptType' => 1000
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `ScriptType` possible values:
     *   - 0 = CDN
     *   - 1 = DNS
     * ---
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_update
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | Delete Compute Script.
     *
     * ```php
     * $bunnyBase->deleteComputeScript(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_delete
     *
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
     * Compute | Get Compute Script Code.
     *
     * ```php
     * $bunnyBase->getComputeScriptCode(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_getcode
     *
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
     * Compute | Update Compute Script Code.
     *
     * ```php
     * $bunnyBase->updateComputeScriptCode(
     *     id: 1,
     *     body: [
     *         'Code' => "export default function handleQuery(event) {\n    console.log(\"Hello world!\")\n    return new TxtRecord(\"Hello world!\");\n}",
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_setcode
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | List Compute Script Releases.
     *
     * ```php
     * $bunnyBase->listComputeScriptReleases(
     *     id: 1,
     *     query: [
     *         'page' => 1,
     *         'perPage' => 1000
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_getreleases
     *
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
     * Compute | Publish Compute Script.
     *
     * ```php
     * $bunnyBase->publishComputeScript(
     *     id: 1,
     *     query: [
     *         'uuid' => '173d4dfc-a8dd-42f5-a55c-cba765c75aa5'
     *     ],
     *     body: [
     *         'Note' => 'Initial release'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_publish
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | Publish Compute Script (by path parameter).
     *
     * ```php
     * $bunnyBase->publishComputeScriptByPathParameter(
     *     id: 1,
     *     uuid: '173d4dfc-a8dd-42f5-a55c-cba765c75aa5',
     *     body: [
     *         'Note' => 'Initial release'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_publish2
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | Create Compute Script Variable.
     *
     * ```php
     * $bunnyBase->addComputeScriptVariable(
     *     id: 1,
     *     body: [
     *         'Name' => 'New Variable',
     *         'Required' => true,
     *         'DefaultValue' => 'Hello World'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_addvariable
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | Create Compute Script Variable.
     *
     * ```php
     * $bunnyBase->updateComputeScriptVariable(
     *     id: 1,
     *     variableId: 2,
     *     body: [
     *         'DefaultValue' => 'Hello World the Sequel',
     *         'Required' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_updatevariable
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Compute | Get Compute Script Variable.
     *
     * ```php
     * $bunnyBase->getComputeScriptVariable(
     *     id: 1,
     *     variableId: 2
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_getvariable
     *
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
     * Compute | Delete Compute Script Variable.
     *
     * ```php
     * $bunnyBase->deleteComputeScriptVariable(
     *     id: 1,
     *     variableId: 2
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/computeedgescriptpublic_deletevariable
     *
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
     * Support | List Tickets.
     *
     * ```php
     * $bunnyBase->listTickets(
     *     query: [
     *         'page' => 1,
     *         'perPage' => 1000
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/supportpublic_index
     *
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
     * Support | Get Ticket Details.
     *
     * ```php
     * $bunnyBase->getTicketDetails(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/supportpublic_index2
     *
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
     * Support | Close Ticket.
     *
     * ```php
     * $bunnyBase->closeTicket(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/supportpublic_close
     *
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
     * Support | Reply Ticket.
     *
     * ```php
     * $bunnyBase->closeTicket(
     *     id: 1,
     *     body: [
     *         'Message' => 'Hope you're having a nice day!\n\nThe weather is nice outside.',
     *         'Attachments' => [
     *             [
     *                 'Body' => 'aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1kUXc0dzlXZ1hjUQ==',
     *                 'FileName' => 'details.txt',
     *                 'ContentType' => 'text/plain'
     *             ]
     *         ]
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - You can supply the `Body` for an attachment by base64 encoding its contents.
     * ---
     *
     * @link https://docs.bunny.net/reference/supportpublic_reply
     *
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
            body: EndpointHelper::getBody($body),
        );
    }


    /**
     * Support | Create Ticket.
     *
     * ```php
     * $bunnyBase->createTicket(
     *     id: 1,
     *     body: [
     *         'Subject' => 'Good day!',
     *         'LinkedPullZone' => 1,
     *         'Message' => 'Hope you're having a nice day!\n\nThe weather is nice outside.',
     *         'LinkedStorageZone' => 2,
     *         'Attachments' => [
     *             [
     *                 'Body' => 'aHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1kUXc0dzlXZ1hjUQ==',
     *                 'FileName' => 'details.txt',
     *                 'ContentType' => 'text/plain'
     *             ]
     *         ]
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `LinkedPullZone` and `LinkedStorageZone` are not required unlike stated in the API specifications.
     * - You can supply the `Body` for an attachment by base64 encoding its contents.
     * ---
     *
     * @link https://docs.bunny.net/reference/supportpublic_createticket
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DRM Certificate | List DRM Certificates.
     *
     * ```php
     * $bunnyBase->listDRMCertificates(
     *     query: [
     *         'page' => 1,
     *         'perPage' => 1000
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/drmcertificatepublic_index
     *
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
     * Region | List Regions.
     *
     * ```php
     * $bunnyBase->listRegions();
     * ```
     *
     * @link https://docs.bunny.net/reference/regionpublic_index
     *
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
     * Stream Video Library | List Video Libraries.
     *
     * ```php
     * $bunnyBase->listVideoLibraries(
     *     query: [
     *         'page' => 0,
     *         'perPage' => 1000,
     *         'includeAccessKey' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_index
     *
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
     * Stream Video Library | Add Video Library.
     *
     * ```php
     * $bunnyBase->addVideoLibrary(
     *     body: [
     *         'Name' => 'New Video Library',
     *         'ReplicationRegions' => [
     *             'UK',
     *             'SE',
     *             'NY',
     *             'LA',
     *             'SG',
     *             'SYD',
     *             'BR',
     *             'JH'
     *         ]
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `ReplicationRegions` possible values:
     *   - UK = London (United Kingdom)
     *   - SE = Norway (Stockholm)
     *   - NY = New York (United States East)
     *   - LA = Los Angeles (United States West)
     *   - SG = Singapore (Singapore)
     *   - SYD = Sydney (Oceania)
     *   - BR = Sao Paolo (Brazil)
     *   - JH = Johannesburg (Africa)
     * ---
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_add
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Stream Video Library | Get Video Library.
     *
     * ```php
     * $bunnyBase->getVideoLibrary(
     *     id: 1,
     *     query: [
     *         'includeAccessKey' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_index2
     *
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
     * Stream Video Library | Update Video Library.
     *
     * ```php
     * $bunnyBase->updateVideoLibrary(
     *     id: 1,
     *     body: [
     *         'Name' => 'New Video Library V2',
     *         'CustomHTML' => '<style>.plyr--full-ui input[type=range]{color: purple}</style>',
     *         'PlayerKeyColor' => '6a329f',
     *         'EnableTokenAuthentication' => true,
     *         'EnableTokenIPVerification' => false,
     *         'ResetToken' => false,
     *         'WatermarkPositionLeft' => 0,
     *         'WatermarkPositionTop' => 0,
     *         'WatermarkWidth' => 0,
     *         'WatermarkHeight' => 0,
     *         'EnabledResolutions' => '720p,1080p,1440p,2160p',
     *         'ViAiPublisherId' => '',
     *         'VastTagUrl' => '',
     *         'WebhookUrl' => 'https://example.com/video-status',
     *         'CaptionsFontSize' => 20,
     *         'CaptionsFontColor' => 'white',
     *         'CaptionsBackground' => 'black',
     *         'UILanguage' => 'GR',
     *         'AllowEarlyPlay' => true,
     *         'PlayerTokenAuthenticationEnabled' => true,
     *         'BlockNoneReferrer' => true,
     *         'EnableMP4Fallback' => true,
     *         'KeepOriginalFiles' => true,
     *         'AllowDirectPlay' => true,
     *         'EnableDRM' => false,
     *         'Controls' => play,progress,current-time,mute,volume,pip,fullscreen',
     *         'Bitrate240p' => 600,
     *         'Bitrate360p' => 800,
     *         'Bitrate480p' => 1400,
     *         'Bitrate720p' => 2800,
     *         'Bitrate1080p' => 5000,
     *         'Bitrate1440p' => 8000,
     *         'Bitrate2160p' => 25000,
     *         'ShowHeatmap' => false,
     *         'EnableContentTagging' => true,
     *         'FontFamily' => 'Arial'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `EnabledResolutions` possible values (comma separated):
     *   - 240p
     *   - 360p
     *   - 480p
     *   - 720p
     *   - 1080p
     *   - 1440p
     *   - 2160p
     * - `Controls` possible values (comma separated):
     *   - play-large
     *   - play
     *   - progress
     *   - current-time
     *   - mute
     *   - volume
     *   - captions
     *   - settings
     *   - pip
     *   - airplay
     *   - fullscreen
     * ---
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_update
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Stream Video Library | Delete Video Library.
     *
     * ```php
     * $bunnyBase->deleteVideoLibrary(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_delete
     *
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
     * Stream Video Library | Reset Password.
     *
     * ```php
     * $bunnyBase->resetVideoLibraryPassword(
     *     query: [
     *         'id' => 1
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_resetpassword
     *
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
     * Stream Video Library | Reset Password (by path parameter).
     *
     * ```php
     * $bunnyBase->resetVideoLibraryPasswordByPathParameter(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_resetpassword2
     *
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
     * Stream Video Library | Add Watermark.
     *
     * ```php
     * $bunnyBase->addWatermark(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_addwatermark
     *
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
     * Stream Video Library | Delete Watermark.
     *
     * ```php
     * $bunnyBase->deleteWatermark(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_deletewatermark
     *
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
     * Stream Video Library | Add Allowed Referer.
     *
     * ```php
     * $bunnyBase->addVideoLibraryAllowedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => '*.example.com,*.example.org'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - Adding of allowed referer allows for multiple domains through comma separated values.
     *   - Other endpoints, like removing the allowed referer, or adding/removing blocked referer do not support this.
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Stream Video Library | Remove Allowed Referer.
     *
     * ```php
     * $bunnyBase->removeVideoLibraryAllowedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => '*.example.com'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_removeallowedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Stream Video Library | Add Blocked Referer.
     *
     * ```php
     * $bunnyBase->addVideoLibraryBlockedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'evil.org'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_addblockedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Stream Video Library | Remove Blocked Referer.
     *
     * ```php
     * $bunnyBase->removeVideoLibraryBlockedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'evil.org'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/videolibrarypublic_removeblockedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DNS Zone | List DNS Zones.
     *
     * ```php
     * $bunnyBase->listDNSZones(
     *     query: [
     *         'page' => 1,
     *         'perPage' => 1000
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_index
     *
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
     * DNS Zone | Add DNS Zone.
     *
     * ```php
     * $bunnyBase->addDNSZone(
     *     body: [
     *         'Domain' => 'example.com',
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_add
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DNS Zone | Get DNS Zone.
     *
     * ```php
     * $bunnyBase->addDNSZone(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_index2
     *
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
     * DNS Zone | Update DNS Zone.
     *
     * ```php
     * $bunnyBase->addDNSZone(
     *     id: 1,
     *     body: [
     *         'CustomNameserversEnabled' => true,
     *         'Nameserver1' => 'abbby.ns.cloudflare.com',
     *         'Nameserver2' => 'jonah.ns.cloudflare.com',
     *         'SoaEmail' => 'admin@example.com',
     *         'LoggingEnabled' => true,
     *         'LogAnonymizationType' => true,
     *         'LoggingIPAnonymizationEnabled' => true,
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `LogAnonymizationType` possible values (undocumented):
     *   - 0 = Remove one octet
     *   - 1 = Drop IP
     * - To disable `LoggingIPAnonymizationEnabled`, you first need to agree to the DPA agreement (GDPR).
     * ---
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_update
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DNS Zone | Delete DNS Zone.
     *
     * ```php
     * $bunnyBase->deleteDNSZone(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_delete
     *
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
     * DNS Zone | Export DNS Zone.
     *
     * ```php
     * $bunnyBase->exportDNSZone(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_export
     *
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
     * DNS Zone | Get DNS Query Statistics.
     *
     * ```php
     * $bunnyBase->getDNSZoneQueryStatistics(
     *     id: 1,
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_statistics
     *
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
     * DNS Zone | Get DNS Query Statistics.
     *
     * ```php
     * $bunnyBase->getDNSZoneQueryStatistics(
     *     body: [
     *         'Name' => 'example.com',
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_checkavailability
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DNS Zone | Add DNS Record.
     *
     * ```php
     * $bunnyBase->addDNSRecord(
     *     zoneId: 1,
     *     body: [
     *         'Type' => 3,
     *         'Ttl' => 15,
     *         'Value' => 'My TXT Value',
     *         'Name' => '',
     *         'Weight' => 0,
     *         'Priority' => 0,
     *         'Flags' => 0,
     *         'Tag' => '',
     *         'Port' => 0,
     *         'PullZoneId' => 0,
     *         'ScriptId' => 0,
     *         'Accelerated' => false,
     *         'MonitorType' => 0,
     *         'GeolocationLatitude' => 0,
     *         'GeolocationLongitude' => 0,
     *         'LatencyZone' => null,
     *         'SmartRoutingType' => 0,
     *         'Disabled' => false,
     *         'EnviromentalVariables' => [
     *             [
     *                 'Name' => 'Hello',
     *                 'Value' => 'World'
     *             ]
     *         ]
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `Type` possible values:
     *   - 0 = A
     *   - 1 = AAAA
     *   - 2 = CNAME
     *   - 3 = TXT
     *   - 4 = MX
     *   - 5 = RDR (Redirect)
     *   - 6 = -
     *   - 7 = PZ (Pull Zone)
     *   - 8 = SRV
     *   - 9 = CAA
     *   - 10 = PTR
     *   - 11 = SCR (Script)
     *   - 12 = NS
     * - `TTL` possible values (in seconds; gets rounded to the nearest possible value if deviating):
     *   - 15 seconds
     *   - 30 seconds
     *   - 60 = 1 minute
     *   - 120 = 2 minutes
     *   - 300 = 5 minutes
     *   - 900 = 15 minutes
     *   - 1800 = 30 minutes
     *   - 3600 = 1 hour
     *   - 18000 = 5 hours
     *   - 43200 = 12 hours
     *   - 86400 = 1 day
     * - `MonitorType` possible values:
     *   - Undetermined.
     * - `ScriptId` can be supplied but is not returned in the response.
     * ---
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_addrecord
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DNS Zone | Update DNS Record.
     *
     * ```php
     * $bunnyBase->updateDNSRecord(
     *     zoneId: 1,
     *     id: 2,
     *     body: [
     *         'Type' => 3,
     *         'Ttl' => 15,
     *         'Value' => 'My TXT Value',
     *         'Name' => '',
     *         'Weight' => 0,
     *         'Priority' => 0,
     *         'Flags' => 0,
     *         'Tag' => '',
     *         'Port' => 0,
     *         'PullZoneId' => 0,
     *         'ScriptId' => 0,
     *         'Accelerated' => false,
     *         'MonitorType' => 0,
     *         'GeolocationLatitude' => 0,
     *         'GeolocationLongitude' => 0,
     *         'LatencyZone' => null,
     *         'SmartRoutingType' => 0,
     *         'Disabled' => false,
     *         'EnviromentalVariables' => [
     *             [
     *                 'Name' => 'Hello',
     *                 'Value' => 'World'
     *             ]
     *         ]
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `Type` possible values:
     *   - 0 = A
     *   - 1 = AAAA
     *   - 2 = CNAME
     *   - 3 = TXT
     *   - 4 = MX
     *   - 5 = RDR (Redirect)
     *   - 6 = -
     *   - 7 = PZ (Pull Zone)
     *   - 8 = SRV
     *   - 9 = CAA
     *   - 10 = PTR
     *   - 11 = SCR (Script)
     *   - 12 = NS
     * - `TTL` possible values (in seconds; gets rounded to the nearest possible value if deviating):
     *   - 15 seconds
     *   - 30 seconds
     *   - 60 = 1 minute
     *   - 120 = 2 minutes
     *   - 300 = 5 minutes
     *   - 900 = 15 minutes
     *   - 1800 = 30 minutes
     *   - 3600 = 1 hour
     *   - 18000 = 5 hours
     *   - 43200 = 12 hours
     *   - 86400 = 1 day
     * - `MonitorType` possible values:
     *   - Undetermined.
     * - `ScriptId` can be supplied but is not returned in the response.
     * ---
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_updaterecord
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * DNS Zone | Delete DNS Record.
     *
     * ```php
     * $bunnyBase->deleteDNSRecord(
     *     zoneId: 1,
     *     id: 2
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_deleterecord
     *
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
     * DNS Zone | Delete DNS Record.
     *
     * ```php
     * $bunnyBase->recheckDNSConfiguration(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_recheckdns
     *
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
     * DNS Zone | Dismiss DNS Configuration Notice.
     *
     * ```php
     * $bunnyBase->dismissDNSConfigurationNotice(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_dismissnameservercheck
     *
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
     * DNS Zone | Import DNS Records.
     *
     * ```php
     * $bunnyBase->importDNSRecords(
     *     zoneId: 1,
     *     localFilePath: './records.txt'
     * );
     * ```
     * ---
     * Notes:
     * - `localFilePath` is the path to the local file containing the DNS records for your zone.
     * ---
     *
     * @link https://docs.bunny.net/reference/dnszonepublic_import
     *
     * @throws ClientExceptionInterface
     * @throws Exception\FileDoesNotExistException
     * @return ResponseInterface
     * @param int $zoneId
     * @param string $localFilePath
     */
    public function importDNSRecords(int $zoneId, string $localFilePath): ResponseInterface
    {
        $endpoint = new DismissDNSConfigurationNotice();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$zoneId],
            body: EndpointHelper::openFileStream($localFilePath),
        );
    }

    /**
     * Pull Zone | List Pull Zones.
     *
     * ```php
     * $bunnyBase->listPullZones(
     *     query: [
     *         'page' => 0,
     *         'perPage' => 1000,
     *         'includeCertificate' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_index
     *
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
     * Pull Zone | Add Pull Zone.
     *
     * ```php
     * $bunnyBase->addPullZone(
     *     body: [
     *         'OriginUrl' => 'https://my-bucket-2.service.com',
     *         'AllowedReferrers' => [],
     *         'BlockedReferrers' => [],
     *         'BlockedIps' => [],
     *         'EnableGeoZoneUS' => true,
     *         'EnableGeoZoneEU' => true,
     *         'EnableGeoZoneASIA' => true,
     *         'EnableGeoZoneSA' => true,
     *         'EnableGeoZoneAF' => true,
     *         'BlockRootPathAccess' => false,
     *         'BlockPostRequests' => false,
     *         'EnableQueryStringOrdering' => true,
     *         'EnableWebpVary' => false,
     *         'EnableAvifVary' => false,
     *         'EnableMobileVary' => false,
     *         'EnableCountryCodeVary' => false,
     *         'EnableHostnameVary' => false,
     *         'EnableCacheSlice' => false,
     *         'ZoneSecurityEnabled' => false,
     *         'ZoneSecurityIncludeHashRemoteIP' => false,
     *         'IgnoreQueryStrings' => true,
     *         'MonthlyBandwidthLimit' => 0,
     *         'AccessControlOriginHeaderExtensions' => [],
     *         'EnableAccessControlOriginHeader' => true,
     *         'DisableCookies' => true,
     *         'BudgetRedirectedCountries' => [],
     *         'BlockedCountries' => [],
     *         'CacheControlMaxAgeOverride' => 30,
     *         'CacheControlBrowserMaxAgeOverride' => 157784760,
     *         'AddHostHeader' => false,
     *         'AddCanonicalHeader' => false,
     *         'EnableLogging' => true,
     *         'LoggingIPAnonymizationEnabled' => true,
     *         'PermaCacheStorageZoneId' => 0,
     *         'AWSSigningEnabled' => false,
     *         'AWSSigningKey' => null,
     *         'AWSSigningRegionName' => null,
     *         'AWSSigningSecret' => null,
     *         'EnableOriginShield' => false,
     *         'OriginShieldZoneCode' => 'FR',
     *         'EnableTLS1' => true,
     *         'EnableTLS1_1' => true,
     *         'CacheErrorResponses' => false,
     *         'VerifyOriginSSL' => false,
     *         'LogForwardingEnabled' => false,
     *         'LogForwardingHostname' => null,
     *         'LogForwardingPort' => 0,
     *         'LogForwardingToken' => null,
     *         'LogForwardingProtocol' => 0,
     *         'LoggingSaveToStorage' => false,
     *         'LoggingStorageZoneId' => 0,
     *         'FollowRedirects' => false,
     *         'ConnectionLimitPerIPCount' => 0,
     *         'RequestLimit' => 0,
     *         'LimitRateAfter' => 0,
     *         'LimitRatePerSecond' => 0,
     *         'BurstSize' => 0,
     *         'WAFEnabled' => false,
     *         'WAFDisabledRuleGroups' => [],
     *         'WAFDisabledRules' => [],
     *         'WAFEnableRequestHeaderLogging' => false,
     *         'WAFRequestHeaderIgnores' => [],
     *         'ErrorPageEnableCustomCode' => false,
     *         'ErrorPageCustomCode' => null,
     *         'ErrorPageEnableStatuspageWidget' => false,
     *         'ErrorPageStatuspageCode' => null,
     *         'ErrorPageWhitelabel' => false,
     *         'OptimizerEnabled' => false,
     *         'OptimizerDesktopMaxWidth' => 1600,
     *         'OptimizerMobileMaxWidth' => 800,
     *         'OptimizerImageQuality' => 85,
     *         'OptimizerMobileImageQuality' => 70,
     *         'OptimizerEnableWebP' => true,
     *         'OptimizerEnableManipulationEngine' => true,
     *         'OptimizerMinifyCSS' => true,
     *         'OptimizerMinifyJavaScript' => true,
     *         'OptimizerWatermarkEnabled' => true,
     *         'OptimizerWatermarkUrl' => '',
     *         'OptimizerWatermarkPosition' => 0,
     *         'OptimizerWatermarkOffset' => 3,
     *         'OptimizerWatermarkMinImageSize' => 300,
     *         'OptimizerAutomaticOptimizationEnabled' => true,
     *         'OptimizerClasses' => [],
     *         'OptimizerForceClasses' => false,
     *         'Type' => 0,
     *         'OriginRetries' => 0,
     *         'OriginConnectTimeout' => 10,
     *         'OriginResponseTimeout' => 60,
     *         'UseStaleWhileUpdating' => false,
     *         'UseStaleWhileOffline' => false,
     *         'OriginRetry5XXResponses' => false,
     *         'OriginRetryConnectionTimeout' => true,
     *         'OriginRetryResponseTimeout' => true,
     *         'OriginRetryDelay' => 0,
     *         'DnsOriginPort' => 0,
     *         'DnsOriginScheme' => '',
     *         'QueryStringVaryParameters' => [],
     *         'OriginShieldEnableConcurrencyLimit' => false,
     *         'OriginShieldMaxConcurrentRequests' => 5000,
     *         'EnableCookieVary' => false,
     *         'CookieVaryParameters' => [],
     *         'EnableSafeHop' => false,
     *         'OriginShieldQueueMaxWaitTime' => 30,
     *         'UseBackgroundUpdate' => false,
     *         'OriginShieldMaxQueuedRequests' => 5000,
     *         'EnableAutoSSL' => false,
     *         'LogAnonymizationType' => 0,
     *         'StorageZoneId' => 0,
     *         'EdgeScriptId' => 0,
     *         'OriginType' => 0,
     *         'LogFormat' => 0,
     *         'LogForwardingFormat' => 0,
     *         'ShieldDDosProtectionType' => 1,
     *         'ShieldDDosProtectionEnabled' => false,
     *         'OriginHostHeader' => '',
     *         'EnableSmartCache' => false,
     *         'EnableRequestCoalescing' => false,
     *         'RequestCoalescingTimeout' => 30,
     *         'Name' => 'New Pull Zone'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `Type` possible values:
     *   - 0 = Premium
     *   - 1 = Volume
     * - `OriginType possible values (undocumented):
     *   - 0 = URL
     *   - 1 = -
     *   - 2 = Storage Zone
     *   - 3 = -
     *   - 4 = Script
     * - `LogAnonymizationType` possible values (undocumented):
     *   - 0 = Remove one octet
     *   - 1 = Drop IP
     * - `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The UI will
     * show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
     * - `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
     * - `WAF` related settings are not implemented yet. This feature is currently being worked on and does not have an ETA.
     * It is advised **not** to update these values until the feature is implemented, therefore these options
     * are removed from the example above.
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_add
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Get Pull Zone.
     *
     * ```php
     * $bunnyBase->getPullZone(
     *     id: 1,
     *     query: [
     *         'includeCertificate' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_index2
     *
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
     * Pull Zone | Update Pull Zone.
     *
     * ```php
     * $bunnyBase->updatePullZone(
     *     body: [
     *         'OriginUrl' => 'https://my-bucket-2.service.com',
     *         'AllowedReferrers' => [],
     *         'BlockedReferrers' => [],
     *         'BlockedIps' => [],
     *         'EnableGeoZoneUS' => true,
     *         'EnableGeoZoneEU' => true,
     *         'EnableGeoZoneASIA' => true,
     *         'EnableGeoZoneSA' => true,
     *         'EnableGeoZoneAF' => true,
     *         'BlockRootPathAccess' => false,
     *         'BlockPostRequests' => false,
     *         'EnableQueryStringOrdering' => true,
     *         'EnableWebpVary' => false,
     *         'EnableAvifVary' => false,
     *         'EnableMobileVary' => false,
     *         'EnableCountryCodeVary' => false,
     *         'EnableHostnameVary' => false,
     *         'EnableCacheSlice' => false,
     *         'ZoneSecurityEnabled' => false,
     *         'ZoneSecurityIncludeHashRemoteIP' => false,
     *         'IgnoreQueryStrings' => true,
     *         'MonthlyBandwidthLimit' => 0,
     *         'AccessControlOriginHeaderExtensions' => [],
     *         'EnableAccessControlOriginHeader' => true,
     *         'DisableCookies' => true,
     *         'BudgetRedirectedCountries' => [],
     *         'BlockedCountries' => [],
     *         'CacheControlMaxAgeOverride' => 30,
     *         'CacheControlBrowserMaxAgeOverride' => 157784760,
     *         'AddHostHeader' => false,
     *         'AddCanonicalHeader' => false,
     *         'EnableLogging' => true,
     *         'LoggingIPAnonymizationEnabled' => true,
     *         'PermaCacheStorageZoneId' => 0,
     *         'AWSSigningEnabled' => false,
     *         'AWSSigningKey' => null,
     *         'AWSSigningRegionName' => null,
     *         'AWSSigningSecret' => null,
     *         'EnableOriginShield' => false,
     *         'OriginShieldZoneCode' => 'FR',
     *         'EnableTLS1' => true,
     *         'EnableTLS1_1' => true,
     *         'CacheErrorResponses' => false,
     *         'VerifyOriginSSL' => false,
     *         'LogForwardingEnabled' => false,
     *         'LogForwardingHostname' => null,
     *         'LogForwardingPort' => 0,
     *         'LogForwardingToken' => null,
     *         'LogForwardingProtocol' => 0,
     *         'LoggingSaveToStorage' => false,
     *         'LoggingStorageZoneId' => 0,
     *         'FollowRedirects' => false,
     *         'ConnectionLimitPerIPCount' => 0,
     *         'RequestLimit' => 0,
     *         'LimitRateAfter' => 0,
     *         'LimitRatePerSecond' => 0,
     *         'BurstSize' => 0,
     *         'WAFEnabled' => false,
     *         'WAFDisabledRuleGroups' => [],
     *         'WAFDisabledRules' => [],
     *         'WAFEnableRequestHeaderLogging' => false,
     *         'WAFRequestHeaderIgnores' => [],
     *         'ErrorPageEnableCustomCode' => false,
     *         'ErrorPageCustomCode' => null,
     *         'ErrorPageEnableStatuspageWidget' => false,
     *         'ErrorPageStatuspageCode' => null,
     *         'ErrorPageWhitelabel' => false,
     *         'OptimizerEnabled' => false,
     *         'OptimizerDesktopMaxWidth' => 1600,
     *         'OptimizerMobileMaxWidth' => 800,
     *         'OptimizerImageQuality' => 85,
     *         'OptimizerMobileImageQuality' => 70,
     *         'OptimizerEnableWebP' => true,
     *         'OptimizerEnableManipulationEngine' => true,
     *         'OptimizerMinifyCSS' => true,
     *         'OptimizerMinifyJavaScript' => true,
     *         'OptimizerWatermarkEnabled' => true,
     *         'OptimizerWatermarkUrl' => '',
     *         'OptimizerWatermarkPosition' => 0,
     *         'OptimizerWatermarkOffset' => 3,
     *         'OptimizerWatermarkMinImageSize' => 300,
     *         'OptimizerAutomaticOptimizationEnabled' => true,
     *         'OptimizerClasses' => [],
     *         'OptimizerForceClasses' => false,
     *         'Type' => 0,
     *         'OriginRetries' => 0,
     *         'OriginConnectTimeout' => 10,
     *         'OriginResponseTimeout' => 60,
     *         'UseStaleWhileUpdating' => false,
     *         'UseStaleWhileOffline' => false,
     *         'OriginRetry5XXResponses' => false,
     *         'OriginRetryConnectionTimeout' => true,
     *         'OriginRetryResponseTimeout' => true,
     *         'OriginRetryDelay' => 0,
     *         'DnsOriginPort' => 0,
     *         'DnsOriginScheme' => '',
     *         'QueryStringVaryParameters' => [],
     *         'OriginShieldEnableConcurrencyLimit' => false,
     *         'OriginShieldMaxConcurrentRequests' => 5000,
     *         'EnableCookieVary' => false,
     *         'CookieVaryParameters' => [],
     *         'EnableSafeHop' => false,
     *         'OriginShieldQueueMaxWaitTime' => 30,
     *         'UseBackgroundUpdate' => false,
     *         'OriginShieldMaxQueuedRequests' => 5000,
     *         'EnableAutoSSL' => false,
     *         'LogAnonymizationType' => 0,
     *         'StorageZoneId' => 0,
     *         'EdgeScriptId' => 0,
     *         'OriginType' => 0,
     *         'LogFormat' => 0,
     *         'LogForwardingFormat' => 0,
     *         'ShieldDDosProtectionType' => 1,
     *         'ShieldDDosProtectionEnabled' => false,
     *         'OriginHostHeader' => '',
     *         'EnableSmartCache' => false,
     *         'EnableRequestCoalescing' => false,
     *         'RequestCoalescingTimeout' => 30,
     *         'Name' => 'New Pull Zone'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `Type` possible values:
     *   - 0 = Premium
     *   - 1 = Volume
     * - `OriginType possible values (undocumented):
     *   - 0 = URL
     *   - 1 = -
     *   - 2 = Storage Zone
     *   - 3 = -
     *   - 4 = Script
     * - `LogAnonymizationType` possible values (undocumented):
     *   - 0 = Remove one octet
     *   - 1 = Drop IP
     * - `CacheControlBrowserMaxAgeOverride` and `CacheControlBrowserMaxAgeOverride` accept any values in seconds. The UI will
     * show the value `Match Server Cache Expiration` but the value updated through the API will be honored.
     * - `OriginShieldZoneCode` accepts the 2-digit code `FR` (France, Paris) or `IL` (Illinois, Chicago).
     * - `WAF` related settings are not implemented yet. This feature is currently being worked on and does not have an ETA.
     * It is advised **not** to update these values until the feature is implemented, therefore these options
     * are removed from the example above.
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_updatepullzone
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Delete Pull Zone.
     *
     * ```php
     * $bunnyBase->deletePullZone(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_delete
     *
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
     * Pull Zone | Delete Edge Rule.
     *
     * ```php
     * $bunnyBase->deleteEdgeRule(
     *     pullZoneId: 1,
     *     edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_deleteedgerule
     *
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
     * Pull Zone | Add/Update Edge Rule.
     *
     * ```php
     * $bunnyBase->deleteEdgeRule(
     *     pullZoneId: 1,
     *     body: [
     *         'Guid' => 'c71d9594-3bc6-4639-9896-ba3e96217587',
     *         'ActionType' => 4,
     *         'ActionParameter1' => '',
     *         'ActionParameter2' => '',
     *         'Triggers' => [
     *             [
     *                 'Type' => 0,
     *                 'PatternMatches' => [
     *                     'https://example.b-cdn.net/images/*',
     *                     'https://example.b-cdn.net/videos/*'
     *                 ]
     *                 'PatternMatchingType' => 0,
     *                 'Parameter1' => ''
     *             ]
     *         ],
     *         'TriggerMatchingType' => 0,
     *         'Description' => '',
     *         'Enabled' => true
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - `ActionType` possible values:
     *   - 0 = Force SSL
     *   - 1 = Redirect To URL
     *   - 2 = Change Origin URL
     *   - 3 = Override Cache Time
     *   - 4 = Block Request
     *   - 5 = Set Response header
     *   - 6 = Set Request Header
     *   - 7 = Force Download
     *   - 8 = Disable Token Authentication
     *   - 9 = Enable Token Authentication
     *   - 10 = Override Cache Time Public
     *   - 11 = Ignore Cache Vary: URL Query String
     *   - 12 = Disable Bunny Optimizer
     *   - 13 = Force Compression
     *   - 14 = Set Status Code
     *   - 15 = Bypass Perma-Cache
     *   - 16 = Override Browser Cache Time
     * - `Type` in a `Trigger` object can have the following possible values:
     *   - 0 = URL
     *   - 1 = Request Header
     *   - 2 = Response Header
     *   - 3 = File/URL Extension
     *   - 4 = Country Code (2 letter)
     *   - 5 = Remote IP
     *   - 6 = Query String
     *   - 7 = Random Chance (%)
     *   - 8 = Status Code
     *   - 9 = Request method
     * - `TriggerMatchingType` possible values:
     *   - 0 = URL
     *   - 1 = Request Header
     *   - 2 = Response Header
     *   - 3 = File/URL Extension
     *   - 4 = Country Code (2 letter)
     *   - 5 = Remote IP
     *   - 6 = Query String
     *   - 7 = Random Chance (%)
     *   - 8 = Status Code
     *   - 9 = Request method
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addedgerule
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Add/Update Edge Rule.
     *
     * ```php
     * $bunnyBase->deleteEdgeRule(
     *     pullZoneId: 1,
     *     edgeRuleId: 'c71d9594-3bc6-4639-9896-ba3e96217587',
     *     body: [
     *         'Id' => 1,
     *         'Value' => true
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - The `Id` in the body denotes the pull zone ID (the same as the first argument) and is (for some reason) a required parameter.
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_setedgeruleenabled
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Get Origin Shield Queue Statistics.
     *
     * ```php
     * $bunnyBase->getOriginShieldQueueStatistics(
     *     pullZoneId: 1,
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y',
     *         'hourly' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_originshieldconcurrencystatistics
     *
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
     * Pull Zone | Get SafeHop Statistics.
     *
     * ```php
     * $bunnyBase->getSafeHopStatistics(
     *     pullZoneId: 1,
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y',
     *         'hourly' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_safehopstatistics
     *
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
     * Pull Zone | Get Optimizer Statistics.
     *
     * ```php
     * $bunnyBase->getOptimizerStatistics(
     *     pullZoneId: 1,
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y',
     *         'hourly' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_optimizerstatistics
     *
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
     * Pull Zone | Get WAF Statistics (undocumented).
     *
     * ```php
     * $bunnyBase->getWAFStatistics(
     *     pullZoneId: 1,
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y',
     *         'hourly' => false
     *     ]
     * );
     * ```
     *
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
     * Pull Zone | Load Free Certificate.
     *
     * ```php
     * $bunnyBase->loadFreeCertificate(
     *     query: [
     *         'hostname' => 'cdn.example.com'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_loadfreecertificate
     *
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
     * Pull Zone | Purge Cache (by tag).
     *
     * ```php
     * $bunnyBase->purgePullZoneCache(
     *     id: 1,
     *     body: [
     *         'CacheTag' => 'mytag-region-*'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_purgecachepostbytag
     * @link https://bunny.net/blog/introducing-tag-based-cdn-cache-purging/
     *
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return ResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     * @note Changed `purgeCache` to `purgePullZoneCache` with option body params `CacheTag`.
     */
    public function purgePullZoneCache(int $id, array $body = []): ResponseInterface
    {
        $endpoint = new PurgeCache();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Check Pull Zone Availability.
     *
     * ```php
     * $bunnyBase->checkPullZoneAvailability(
     *     body: [
     *         'Name' => 'test'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_checkavailability
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Add Custom Certificate.
     *
     * ```php
     * $bunnyBase->addCustomCertificate(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'cdn.example.com',
     *         'Certificate' => '<base64-encoded-cert-pem>',
     *         'CertificateKey' => '<base64-encoded-key-pem>'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - Both `Certificate` and `CertificateKey` require the file contents to be sent as base64 encoded strings.
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addcertificate
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Remove Custom Certificate.
     *
     * ```php
     * $bunnyBase->removeCertificate(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'cdn.example.com'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_removecertificate
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Add Custom Hostname.
     *
     * ```php
     * $bunnyBase->addCustomHostname(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'cdn.example.com'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addhostname
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Remove Custom Hostname.
     *
     * ```php
     * $bunnyBase->removeCustomHostname(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'cdn.example.com'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_removehostname
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Set Force SSL.
     *
     * ```php
     * $bunnyBase->setForceSSL(
     *     id: 1,
     *     body: [
     *         'Hostname' => 'cdn.example.com',
     *         'ForceSSL' => true
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_setforcessl
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Reset Token Key.
     *
     * ```php
     * $bunnyBase->resetPullZoneTokenKey(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_resetsecuritykey
     *
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
     * Pull Zone | Add Allowed Referer.
     *
     * ```php
     * $bunnyBase->addPullZoneAllowedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => '*.example.com,*.example.org'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - Adding of allowed referer allows for multiple domains through comma separated values.
     *   - Other endpoints, like removing the allowed referer, or adding/removing blocked referer do not support this.
     * ---
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addallowedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Remove Allowed Referer.
     *
     * ```php
     * $bunnyBase->removePullZoneAllowedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => '*.example.com'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_removeallowedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Add Blocked Referer.
     *
     * ```php
     * $bunnyBase->addPullZoneBlockedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => '*.evil.org'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addblockedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Remove Blocked Referer.
     *
     * ```php
     * $bunnyBase->removePullZoneBlockedReferer(
     *     id: 1,
     *     body: [
     *         'Hostname' => '*.evil.org'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_removeblockedreferrer
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Add Blocked IP.
     *
     * ```php
     * $bunnyBase->addPullZoneBlockedIP(
     *     id: 1,
     *     body: [
     *         'BlockedIp' => '12.345.67.89'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_addblockedip
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Pull Zone | Remove Blocked IP.
     *
     * ```php
     * $bunnyBase->removePullZoneBlockedIP(
     *     id: 1,
     *     body: [
     *         'BlockedIp' => '12.345.67.89'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/pullzonepublic_removeblockedip
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Purge | Purge URL.
     *
     * ```php
     * $bunnyBase->purgeUrl(
     *     query: [
     *         'url' => 'https://example.b-cdn.net/images/*',
     *         'async' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/purgepublic_indexpost
     *
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
     * Purge | Purge URL (by header).
     *
     * ```php
     * $bunnyBase->purgeUrlByHeader(
     *     query: [
     *         'url' => 'https://example.b-cdn.net/images/*',
     *         'headerName' => '',
     *         'headerValue' => '',
     *         'async' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/purgepublic_index
     *
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
     * Statistics | Get Statistics (traffic, cache hit & bandwidth).
     *
     * ```php
     * $bunnyBase->getStatistics(
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y',
     *         'pullZone' => -1,
     *         'serverZoneId' => -1,
     *         'loadErrors' => false,
     *         'hourly' => false
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/statisticspublic_index
     *
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
     * Storage Zone | List Storage Zones.
     *
     * ```php
     * $bunnyBase->listStorageZones(
     *     query: [
     *         'page' => 0,
     *         'perPage' => 1000,
     *         'includeDeleted' => 1000
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_index
     *
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
     * Storage Zone | Add Storage Zone.
     *
     * ```php
     * $bunnyBase->addStorageZone(
     *     body: [
     *         'OriginUrl' => '',
     *         'Name' => 'Test',
     *         'Region' => 'DE',
     *         'ReplicationRegions' => '',
     *         'ZoneTier' => 0
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - The `OriginUrl` parameter allows you to specify a backup data source, in case the file does not exist on the Storage Zone
     * So for example, you would request `/image.png`. Assuming `image.png` doesn't exist on the storage zone,
     * the system will try to proxy and fetch it from the `OriginUrl` instead. You can omit it unless needed.
     * - `ZoneTier` possible values (undocumented):
     *   - 0 = Standard = HDD
     *   - 1 = Edge = SSD
     * - `Region` possible values:
     *   - DE = Falkenstein / Frankfurt (Germany) | HDD + SSD
     *   - UK = London (United Kingdom) | HDD
     *   - SE = Norway (Stockholm) | HDD
     *   - NY = New York (United States) | HDD
     *   - LA = Los Angeles (United States) | HDD
     *   - SG = Singapore (Singapore) | HDD
     *   - SYD = Sydney (Oceania) | HDD
     *   - BR = Sao Paolo (Brazil) | HDD
     *   - JH = Johannesburg (Africa) | HDD
     * - `ReplicationRegions` possible values:
     *   - DE = Frankfurt (Germany) | SSD
     *   - UK = London (United Kingdom) | HDD + SSD
     *   - SE = Norway (Stockholm) | HDD + SSD
     *   - CZ = Prague (Czech Republic) | SSD
     *   - ES = Madrid (Spain) | SSD
     *   - NY = New York (United States East) | HDD + SSD
     *   - LA = Los Angeles (United States West) | HDD + SSD
     *   - WA = Seattle (United States West) | SSD
     *   - MI = Miami (United States East) | SSD
     *   - SG = Singapore (Singapore) | HDD + SSD
     *   - HK = Hong Kong (SAR of China) | SSD
     *   - JP = Tokyo (Japan) | SSD
     *   - SYD = Sydney (Oceania) | HDD + SSD
     *   - BR = Sao Paolo (Brazil) | HDD + SSD
     *   - JH = Johannesburg (Africa) | HDD + SSD
     * ---
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_add
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Storage Zone | Check Storage Zone Availability.
     *
     * ```php
     * $bunnyBase->checkStorageZoneAvailability();
     * ```
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_checkavailability
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Storage Zone | Get Storage Zone.
     *
     * ```php
     * $bunnyBase->checkStorageZoneAvailability(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_index2
     *
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
     * Storage Zone | Update Storage Zone.
     *
     * ```php
     * $bunnyBase->addStorageZone(
     *     body: [
     *         'ReplicationRegions' => '',
     *         'OriginUrl' => '',
     *         'Custom404FilePath' => 'my-custom-404.html',
     *         'Rewrite404To200' => false,
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - The `OriginUrl` parameter allows you to specify a backup data source, in case the file does not exist on the Storage Zone
     * So for example, you would request `/image.png`. Assuming `image.png` doesn't exist on the storage zone,
     * the system will try to proxy and fetch it from the `OriginUrl` instead. You can omit it unless needed.
     * - `ZoneTier` possible values (undocumented):
     *   - 0 = Standard = HDD
     *   - 1 = Edge = SSD
     * - `Region` possible values:
     *   - DE = Falkenstein / Frankfurt (Germany) | HDD + SSD
     *   - UK = London (United Kingdom) | HDD
     *   - SE = Norway (Stockholm) | HDD
     *   - NY = New York (United States) | HDD
     *   - LA = Los Angeles (United States) | HDD
     *   - SG = Singapore (Singapore) | HDD
     *   - SYD = Sydney (Oceania) | HDD
     *   - BR = Sao Paolo (Brazil) | HDD
     *   - JH = Johannesburg (Africa) | HDD
     * - `ReplicationRegions` possible values:
     *   - DE = Frankfurt (Germany) | SSD
     *   - UK = London (United Kingdom) | HDD + SSD
     *   - SE = Norway (Stockholm) | HDD + SSD
     *   - CZ = Prague (Czech Republic) | SSD
     *   - ES = Madrid (Spain) | SSD
     *   - NY = New York (United States East) | HDD + SSD
     *   - LA = Los Angeles (United States West) | HDD + SSD
     *   - WA = Seattle (United States West) | SSD
     *   - MI = Miami (United States East) | SSD
     *   - SG = Singapore (Singapore) | HDD + SSD
     *   - HK = Hong Kong (SAR of China) | SSD
     *   - JP = Tokyo (Japan) | SSD
     *   - SYD = Sydney (Oceania) | HDD + SSD
     *   - BR = Sao Paolo (Brazil) | HDD + SSD
     *   - JH = Johannesburg (Africa) | HDD + SSD
     * ---
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_update
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Storage Zone | Delete Storage Zone.
     *
     * ```php
     * $bunnyBase->deleteStorageZone(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_delete
     *
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
     * Storage Zone | Reset Password.
     *
     * ```php
     * $bunnyBase->resetStorageZonePassword(
     *     id: 1
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_resetpassword
     *
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
     * Storage Zone | Reset Read-Only Password.
     *
     * ```php
     * $bunnyBase->resetStorageZoneReadOnlyPassword(
     *     query: [
     *         'id' => 1
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/storagezonepublic_resetreadonlypassword
     *
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
     * User | Get Home Feed.
     *
     * ```php
     * $bunnyBase->getHomeFeed();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_homefeed
     *
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
     * User | Get User Details.
     *
     * ```php
     * $bunnyBase->getUserDetails();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_index
     *
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
     * User | Update User Details.
     *
     * ```php
     * $bunnyBase->updateUserDetails(
     *     body: [
     *         'FirstName' => 'John',
     *         'Email' => 'john.doe@example.com',
     *         'BillingEmail' => 'john.doe@example.com',
     *         'LastName' => 'Doe',
     *         'StreetAddress' => '1985 Robinson Court',
     *         'City' => 'Windom',
     *         'ZipCode' => '75492',
     *         'Country' => 'US',
     *         'CompanyName' => '',
     *         'VATNumber' => '',
     *         'ReceiveNotificationEmails' => true,
     *         'ReceivePromotionalEmails' => false,
     *         'Password' => '1234Abcd',
     *         'OldPassword' => 'Abcd1234'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_updateuser
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * User | Resend Email Confirmation.
     *
     * ```php
     * $bunnyBase->resendEmailConfirmation();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_resendemailconfirmation
     *
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
     * User | Reset API Key.
     *
     * ```php
     * $bunnyBase->resetUserApiKey();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_resetapikey
     *
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
     * User | List Close Account Reasons.
     *
     * ```php
     * $bunnyBase->listCloseAccountReasons();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_listcloseaccountreasons
     *
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
     * User | Close Account.
     *
     * ```php
     * $bunnyBase->closeAccount(
     *     body: [
     *         'Password' => 'LoremIpsumDolor',
     *         'Reason' => 'No longer needed.'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_closeaccount
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * User | Get DPA Details.
     *
     * ```php
     * $bunnyBase->getDPADetails();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_dpa
     *
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
     * User | Accept DPA.
     *
     * ```php
     * $bunnyBase->acceptDPA();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_dpaaccept
     *
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
     * User | Get DPA Details (HTML).
     *
     * ```php
     * $bunnyBase->getDPADetailsHTML();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_dpapdfhhtml
     *
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
     * User | Set Notifications Opened.
     *
     * ```php
     * $bunnyBase->setNotificationsOpened();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_setnotificationsopened
     *
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
     * User | Get What's New Items.
     *
     * ```php
     * $bunnyBase->getWhatsNewItems();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_whatsnew
     *
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
     * User | Reset What's New.
     *
     * ```php
     * $bunnyBase->resetWhatsNew();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_whatsnewreset
     *
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
     * User | Generate 2FA Verification.
     *
     * ```php
     * $bunnyBase->generate2FAVerification();
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_twofactorgenerateverification
     *
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
     * User | Disable 2FA.
     *
     * ```php
     * $bunnyBase->disable2FA(
     *     body: [
     *         'Password' => 'LoremIpsumDolor'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_twofactordisable
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * User | Enable 2FA.
     *
     * ```php
     * $bunnyBase->disable2FA(
     *     body: [
     *         'SecretValidator' => '',
     *         'Secret' => '',
     *         'TestPin' => '123456'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_twofactorenable
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * User | Verify 2FA Code.
     *
     * ```php
     * $bunnyBase->verify2FACode(
     *     body: [
     *         'SecretValidator' => '',
     *         'Secret' => '',
     *         'TestPin' => '123456'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/userpublic_twofactorverify
     *
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
            body: EndpointHelper::getBody($body),
        );
    }
}
