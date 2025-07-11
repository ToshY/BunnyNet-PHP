<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\BunnyClientResponseException;
use ToshY\BunnyNet\Exception\JSONException;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\GetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\SetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\AddEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\DeleteEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScriptStatistics;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\ListEdgeScripts;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\RotateDeploymentKey;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\UpdateEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\GetActiveReleases;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\GetReleases;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\PublishRelease;
use ToshY\BunnyNet\Model\API\EdgeScripting\Release\PublishReleaseByPathParameter;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\AddSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\DeleteSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\ListSecrets;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\UpdateSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Secret\UpsertSecret;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\AddVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\DeleteVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\GetVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpdateVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpsertVariable;
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Validation\BunnyValidator;

class EdgeScriptingAPI
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
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function getCode(int $id): BunnyClientResponseInterface
    {
        $endpoint = new GetCode();

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
    public function setCode(
        int $id,
        array $body = [],
    ): BunnyClientResponseInterface {
        $endpoint = new SetCode();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws BunnyClientResponseException
     * @throws JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $id
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function deleteEdgeScript(int $id, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new DeleteEdgeScript();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
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
    public function getEdgeScript(int $id): BunnyClientResponseInterface
    {
        $endpoint = new GetEdgeScript();

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
    public function updateEdgeScript(int $id, array $body): BunnyClientResponseInterface
    {
        $endpoint = new UpdateEdgeScript();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws BunnyClientResponseException
     * @throws JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $id
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function getEdgeScriptStatistics(int $id, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new GetEdgeScriptStatistics();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function listEdgeScripts(array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new ListEdgeScripts();

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
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param array<string,mixed> $body
     */
    public function addEdgeScript(array $body): BunnyClientResponseInterface
    {
        $endpoint = new AddEdgeScript();

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
     * @param int $id
     */
    public function rotateDeploymentKey(int $id): BunnyClientResponseInterface
    {
        $endpoint = new RotateDeploymentKey();

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
    public function addVariable(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new AddVariable();

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
     * @param int $variableId
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function deleteVariable(
        int $id,
        int $variableId,
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteVariable();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $variableId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param int $variableId
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function getVariable(
        int $id,
        int $variableId,
    ): BunnyClientResponseInterface {
        $endpoint = new GetVariable();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $variableId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $variableId
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function updateVariable(
        int $id,
        int $variableId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateVariable();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $variableId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function upsertVariable(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpsertVariable();

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
    public function addSecret(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new AddSecret();

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
     * @param int $id
     * @return BunnyClientResponseInterface
     */
    public function listSecrets(int $id): BunnyClientResponseInterface
    {
        $endpoint = new ListSecrets();

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
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function upsertSecret(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpsertSecret();

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
     * @param int $secretId
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function deleteSecret(
        int $id,
        int $secretId,
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteSecret();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $secretId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $secretId
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function updateSecret(
        int $id,
        int $secretId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateSecret();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $secretId],
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
    public function getActiveRelease(int $id): BunnyClientResponseInterface
    {
        $endpoint = new GetActiveReleases();

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
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function getReleases(
        int $id,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new GetReleases();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function publishRelease(
        int $id,
        array $body = [],
    ): BunnyClientResponseInterface {
        $endpoint = new PublishRelease();

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
     * @param string $uuid
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function publishReleaseByUuid(
        int $id,
        string $uuid,
        array $body = [],
    ): BunnyClientResponseInterface {
        $endpoint = new PublishReleaseByPathParameter();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id, $uuid],
            body: BodyContentHelper::getBody($body),
        );
    }
}
