<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Model\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\Stream\ManageVideos\ListVideoStatistics;
use ToshY\BunnyNet\Model\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Validator\ParameterValidator;

class StreamAPI
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
            ->setBaseUrl(Host::STREAM_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $collectionId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getCollection(int $libraryId, string $collectionId): BunnyClientResponseInterface
    {
        $endpoint = new GetCollection();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param string $collectionId
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function updateCollection(
        int $libraryId,
        string $collectionId,
        array $body
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateCollection();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**

     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $collectionId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function deleteCollection(int $libraryId, string $collectionId): BunnyClientResponseInterface
    {
        $endpoint = new DeleteCollection();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
        );
    }

    /**

     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function listCollections(int $libraryId, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new ListCollections();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function createCollection(int $libraryId, array $body): BunnyClientResponseInterface
    {
        $endpoint = new CreateCollection();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getVideo(int $libraryId, string $videoId): BunnyClientResponseInterface
    {
        $endpoint = new GetVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param string $videoId
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function updateVideo(int $libraryId, string $videoId, array $body): BunnyClientResponseInterface
    {
        $endpoint = new UpdateVideo();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function deleteVideo(int $libraryId, string $videoId): BunnyClientResponseInterface
    {
        $endpoint = new DeleteVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @throws FileDoesNotExistException
     * @param int $libraryId
     * @param string $videoId
     * @param string $localFilePath
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function uploadVideo(
        int $libraryId,
        string $videoId,
        string $localFilePath,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new UploadVideo();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            query: $query,
            body: BodyContentHelper::openFileStream($localFilePath),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getVideoHeatmap(int $libraryId, string $videoId): BunnyClientResponseInterface
    {
        $endpoint = new GetVideoHeatmap();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getVideoStatistics(int $libraryId, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new ListVideoStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function reEncodeVideo(int $libraryId, string $videoId): BunnyClientResponseInterface
    {
        $endpoint = new ReEncodeVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function listVideos(int $libraryId, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new ListVideos();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function createVideo(int $libraryId, array $body): BunnyClientResponseInterface
    {
        $endpoint = new CreateVideo();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function setThumbnail(int $libraryId, string $videoId, array $query): BunnyClientResponseInterface
    {
        $endpoint = new SetThumbnail();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $body
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function fetchVideo(int $libraryId, array $body, array $query = []): BunnyClientResponseInterface
    {
        $endpoint = new FetchVideo();

        ParameterValidator::validate($query, $endpoint->getQuery());
        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $libraryId
     * @param string $videoId
     * @param string $sourceLanguage
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     */
    public function addCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage,
        array $body
    ): BunnyClientResponseInterface {
        $endpoint = new AddCaption();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $sourceLanguage],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JsonException
     * @param string $videoId
     * @param string $sourceLanguage
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function deleteCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteCaption();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $sourceLanguage],
        );
    }
}
