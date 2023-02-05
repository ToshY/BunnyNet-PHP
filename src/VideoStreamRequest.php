<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Helper\EndpointHelper;
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
use ToshY\BunnyNet\Model\Stream\ManageVideos\ReencodeVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Validator\ParameterValidator;

/**
 * @link https://docs.bunny.net/reference/api-overview
 * @note Requires the desired stream video library API key.
 */
class VideoStreamRequest
{
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client->setBaseUrl(Host::STREAM_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function getCollection(int $libraryId, string $collectionId): ResponseInterface
    {
        $endpoint = new GetCollection();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function updateCollection(
        int $libraryId,
        string $collectionId,
        array $body
    ): ResponseInterface {
        $endpoint = new UpdateCollection();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function deleteCollection(int $libraryId, string $collectionId): ResponseInterface
    {
        $endpoint = new DeleteCollection();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function getCollectionList(int $libraryId, array $query = []): ResponseInterface
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
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function createCollection(int $libraryId, array $body): ResponseInterface
    {
        $endpoint = new CreateCollection();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function getVideo(int $libraryId, string $videoId): ResponseInterface
    {
        $endpoint = new GetVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function updateVideo(int $libraryId, string $videoId, array $body): ResponseInterface
    {
        $endpoint = new UpdateVideo();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function deleteVideo(int $libraryId, string $videoId): ResponseInterface
    {
        $endpoint = new DeleteVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @throws FileDoesNotExistException
     */
    public function uploadVideo(
        int $libraryId,
        string $videoId,
        string $localFilePath,
        array $query = [],
    ): ResponseInterface {
        $endpoint = new UploadVideo();
        $body = EndpointHelper::openFileStream($localFilePath);

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            query: $query,
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function getVideoHeatmap(int $libraryId, string $videoId): ResponseInterface
    {
        $endpoint = new GetVideoHeatmap();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function getVideoStatistics(int $libraryId, array $query = []): ResponseInterface
    {
        $endpoint = new ListVideoStatistics();

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    public function reEncodeVideo(int $libraryId, string $videoId): ResponseInterface
    {
        $endpoint = new ReencodeVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @throws ClientExceptionInterface
     */
    public function listVideos(int $libraryId, array $query = []): ResponseInterface
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
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function createVideo(int $libraryId, array $body): ResponseInterface
    {
        $endpoint = new CreateVideo();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function setThumbnail(int $libraryId, string $videoId, array $query): ResponseInterface
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
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function fetchVideo(int $libraryId, array $body, array $query = []): ResponseInterface
    {
        $endpoint = new FetchVideo();

        ParameterValidator::validate($query, $endpoint->getQuery());
        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     */
    public function addCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage,
        array $body
    ): ResponseInterface {
        $endpoint = new AddCaption();

        ParameterValidator::validate($body, $endpoint->getBody());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $sourceLanguage],
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function deleteCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage
    ): ResponseInterface {
        $endpoint = new DeleteCaption();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $sourceLanguage],
        );
    }
}
