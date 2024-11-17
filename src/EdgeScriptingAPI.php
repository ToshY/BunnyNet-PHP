<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\BunnyClientResponseException;
use ToshY\BunnyNet\Exception\InvalidTypeForKeyValueException;
use ToshY\BunnyNet\Exception\InvalidTypeForListValueException;
use ToshY\BunnyNet\Exception\JSONException;
use ToshY\BunnyNet\Exception\ParameterIsRequiredException;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\AddEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\DeleteEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\GetEdgeScriptStatistics;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\ListEdgeScripts;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\RotateDeploymentKey;
use ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript\UpdateEdgeScript;
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\GetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\Code\SetCode;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\AddVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\DeleteVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\GetVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpdateVariable;
use ToshY\BunnyNet\Model\API\EdgeScripting\Variable\UpsertVariable;
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Validator\ParameterValidator;

class EdgeScriptingAPI
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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return BunnyClientResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function setCode(
        int $id,
        array $body = [],
    ): BunnyClientResponseInterface {
        $endpoint = new SetCode();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws BunnyClientResponseException
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws JSONException
     * @throws ParameterIsRequiredException
     * @param int $id
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function deleteEdgeScript(int $id, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new DeleteEdgeScript();

        ParameterValidator::validate($query, $endpoint->getQuery());

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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return BunnyClientResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function updateEdgeScript(int $id, array $body): BunnyClientResponseInterface
    {
        $endpoint = new UpdateEdgeScript();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws BunnyClientResponseException
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws JSONException
     * @throws ParameterIsRequiredException
     * @param int $id
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function getEdgeScriptStatistics(int $id, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new GetEdgeScriptStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function listEdgeScripts(array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new ListEdgeScripts();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }


    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return BunnyClientResponseInterface
     * @param array<string,mixed> $body
     */
    public function addEdgeScript(array $body): BunnyClientResponseInterface
    {
        $endpoint = new AddEdgeScript();

        ParameterValidator::validate($body, $endpoint->getBody());

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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return BunnyClientResponseInterface
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function addVariable(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new AddVariable();

        ParameterValidator::validate($body, $endpoint->getBody());

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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
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

        ParameterValidator::validate($body, $endpoint->getBody());

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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $id
     */
    public function upsertVariable(
        int $id,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpsertVariable();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$id],
            body: BodyContentHelper::getBody($body),
        );
    }
}
