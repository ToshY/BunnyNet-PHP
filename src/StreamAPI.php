<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Helper\BodyContentHelper;
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
        $this->client->setBaseUrl(Host::STREAM_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $collectionId
     * @return ResponseInterface
     * @param int $libraryId
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
     * @param string $collectionId
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $libraryId
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
            body: BodyContentHelper::getBody($body),
        );
    }

    /**

     * @throws ClientExceptionInterface
     * @param string $collectionId
     * @return ResponseInterface
     * @param int $libraryId
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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $libraryId
     */
    public function listCollections(int $libraryId, array $query = []): ResponseInterface
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
     * @return ResponseInterface
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function createCollection(int $libraryId, array $body): ResponseInterface
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
     * @param string $videoId
     * @return ResponseInterface
     * @param int $libraryId
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
     * @param string $videoId
     * @param array<string,mixed> $body
     * @return ResponseInterface
     * @param int $libraryId
     */
    public function updateVideo(int $libraryId, string $videoId, array $body): ResponseInterface
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
     * @param string $videoId
     * @return ResponseInterface
     * @param int $libraryId
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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @throws FileDoesNotExistException
     * @param int $libraryId
     * @param string $videoId
     * @param string $localFilePath
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function uploadVideo(
        int $libraryId,
        string $videoId,
        string $localFilePath,
        array $query = [],
    ): ResponseInterface {
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
     * @param string $videoId
     * @return ResponseInterface
     * @param int $libraryId
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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $libraryId
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

    /**
     * @throws ClientExceptionInterface
     * @param string $videoId
     * @return ResponseInterface
     * @param int $libraryId
     */
    public function reEncodeVideo(int $libraryId, string $videoId): ResponseInterface
    {
        $endpoint = new ReEncodeVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $libraryId
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
     * @return ResponseInterface
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function createVideo(int $libraryId, array $body): ResponseInterface
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
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return ResponseInterface
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
     * @param array<string,mixed> $body
     * @param array<string,mixed> $query
     * @return ResponseInterface
     * @param int $libraryId
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
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $libraryId
     * @param string $videoId
     * @param string $sourceLanguage
     * @param array<string,mixed> $body
     * @return ResponseInterface
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
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $videoId
     * @param string $sourceLanguage
     * @return ResponseInterface
     * @param int $libraryId
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
