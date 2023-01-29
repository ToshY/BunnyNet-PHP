<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Model\Client\Response;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\ListVideoStatistics;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\ReencodeVideo;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Endpoint\Stream\ManageVideos\UploadVideo;

/**
 * @link https://docs.bunny.net/reference/api-overview
 */
final class VideoStreamRequest extends BunnyClient
{
    public function __construct(
        protected string $apiKey,
    ) {
        parent::__construct(Host::STREAM_ENDPOINT);
    }

    public function getCollection(int $libraryId, string $collectionId): Response
    {
        $endpoint = new GetCollection();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $collectionId],
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateCollection(
        int $libraryId,
        string $collectionId,
        array $body
    ): Response {
        $endpoint = new UpdateCollection();
        $body = $this->validateBodyField($body, $endpoint->getBody());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $collectionId],
            body: $body,
        );
    }

    public function deleteCollection(int $libraryId, string $collectionId): Response
    {
        $endpoint = new DeleteCollection();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $collectionId],
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @return Response
     * @param int $libraryId
     * @param array $query
     */
    public function getCollectionList(int $libraryId, array $query = []): Response
    {
        $endpoint = new ListCollections();
        $query = $this->validateQueryField($query, $endpoint->getQuery());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function createCollection(int $libraryId, array $body): Response
    {
        $endpoint = new CreateCollection();
        $body = $this->validateBodyField($body, $endpoint->getBody());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId],
            body: $body,
        );
    }

    public function getVideo(int $libraryId, string $videoId): Response
    {
        $endpoint = new GetVideo();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function updateVideo(int $libraryId, string $videoId, array $body): Response
    {
        $endpoint = new UpdateVideo();
        $body = $this->validateBodyField($body, $endpoint->getBody());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
            body: $body,
        );
    }

    public function deleteVideo(int $libraryId, string $videoId): Response
    {
        $endpoint = new DeleteVideo();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws FileDoesNotExistException
     */
    public function uploadVideo(
        int $libraryId,
        string $videoId,
        string $localFilePath,
        array $query = [],
    ): Response {
        $endpoint = new UploadVideo();
        $body = $this->openFileStream($localFilePath);
        $query = $this->validateQueryField($query, $endpoint->getQuery());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
            query: $query,
            body: $body,
        );
    }

    public function getVideoHeatmap(int $libraryId, string $videoId): Response
    {
        $endpoint = new GetVideoHeatmap();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getVideoStatistics(int $libraryId, array $query = []): Response
    {
        $endpoint = new ListVideoStatistics();
        $query = $this->validateQueryField($query, $endpoint->getQuery());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId],
            query: $query,
        );
    }

    public function reencodeVideo(int $libraryId, string $videoId): Response
    {
        $endpoint = new ReencodeVideo();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function listVideos(int $libraryId, array $query = []): Response
    {
        $endpoint = new ListVideos();
        $query = $this->validateQueryField($query, $endpoint->getQuery());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function createVideo(int $libraryId, array $body): Response
    {
        $endpoint = new CreateVideo();
        $body = $this->validateBodyField($body, $endpoint->getBody());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId],
            body: $body,
        );
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function setThumbnail(int $libraryId, string $videoId, array $query): Response
    {
        $endpoint = new SetThumbnail();
        $query = $this->validateQueryField($query, $endpoint->getQuery());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId],
            query: $query,
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function fetchVideo(int $libraryId, array $body, array $query = []): Response
    {
        $endpoint = new FetchVideo();
        $query = $this->validateQueryField($query, $endpoint->getQuery());
        $body = $this->validateBodyField($body, $endpoint->getBody());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId],
            query: $query,
            body: $body,
        );
    }

    /**
     * @throws Exception\InvalidBodyParameterTypeException
     */
    public function addCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage,
        array $body
    ): Response {
        $endpoint = new AddCaption();
        $body = $this->validateBodyField($body, $endpoint->getBody());

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId, $sourceLanguage],
            body: $body,
        );
    }

    public function deleteCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage
    ): Response {
        $endpoint = new DeleteCaption();

        return $this->request(
            endpoint: $endpoint,
            pathParameters: [$libraryId, $videoId, $sourceLanguage],
        );
    }
}
