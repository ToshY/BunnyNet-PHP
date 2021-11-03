<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\Stream\CollectionEndpoint;
use ToshY\BunnyNet\Enum\Stream\VideoEndpoint;
use ToshY\BunnyNet\Exception\FileDoesNotExist;

/**
 * Class Stream
 * @link https://docs.bunny.net/reference/api-overview
 */
final class VideoStream extends AbstractRequest
{
    /** @var string */
    protected string $apiKey;

    /**
     * Stream constructor.
     * @param string $apiKey
     */
    public function __construct(
        string $apiKey
    ) {
        $this->apiKey = $apiKey;

        parent::__construct(Host::STREAM_ENDPOINT);
    }

    /**
     * @param int $libraryId
     * @param string $collectionId
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getCollection(int $libraryId, string $collectionId): StreamInterface
    {
        $endpoint = CollectionEndpoint::GET_COLLECTION;

        return $this->createRequest(
            $endpoint,
            [$libraryId, $collectionId],
        );
    }

    /**
     * @param int $libraryId
     * @param string $collectionId
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function updateCollection(int $libraryId, string $collectionId, array $body): StreamInterface
    {
        $endpoint = CollectionEndpoint::UPDATE_COLLECTION;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $collectionId],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function createCollection(int $libraryId, array $body): StreamInterface
    {
        $endpoint = CollectionEndpoint::CREATE_COLLECTION;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $collectionId
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function deleteCollection(int $libraryId, string $collectionId): StreamInterface
    {
        $endpoint = CollectionEndpoint::DELETE_COLLECTION;

        return $this->createRequest(
            $endpoint['method'],
            [$libraryId, $collectionId],
        );
    }

    /**
     * @param int $libraryId
     * @param array $query
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function getCollectionList(int $libraryId, array $query): StreamInterface
    {
        $endpoint = CollectionEndpoint::GET_COLLECTION_LIST;
        $query = $this->validateBodyField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [$libraryId],
            $query,
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getVideo(int $libraryId, string $videoId): StreamInterface
    {
        $endpoint = VideoEndpoint::GET_VIDEO;

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId],
            []
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function updateVideo(int $libraryId, string $videoId, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::UPDATE_VIDEO;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function deleteVideo(int $libraryId, string $videoId): StreamInterface
    {
        $endpoint = VideoEndpoint::DELETE_VIDEO;

        return $this->createRequest(
            $endpoint['method'],
            [$libraryId, $videoId]
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param string $localFilePath
     * @return StreamInterface
     * @throws FileDoesNotExist
     * @throws GuzzleException
     */
    public function uploadVideo(int $libraryId, string $videoId, string $localFilePath): StreamInterface
    {
        $endpoint = VideoEndpoint::UPLOAD_VIDEO;
        $body = $this->openFileStream($localFilePath);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function reencodeVideo(int $libraryId, string $videoId): StreamInterface
    {
        $endpoint = VideoEndpoint::REENCODE_VIDEO;

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId],
        );
    }

    /**
     * @param int $libraryId
     * @param array $query
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function listVideos(int $libraryId, array $query): StreamInterface
    {
        $endpoint = VideoEndpoint::LIST_VIDEOS;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [$libraryId],
            $query
        );
    }

    /**
     * @param int $libraryId
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function createVideo(int $libraryId, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::CREATE_VIDEO;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array $query
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function setThumbnail(int $libraryId, string $videoId, array $query): StreamInterface
    {
        $endpoint = VideoEndpoint::SET_THUMBNAIL;
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId],
            $query
        );
    }

    /**
     * @param int $libraryId
     * @param array $query
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function fetchVideoToCollection(int $libraryId, array $query, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::FETCH_VIDEO_TO_COLLECTION;
        $query = $this->validateQueryField($query, $endpoint['query']);
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId],
            $query,
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function fetchVideoById(int $libraryId, string $videoId, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::FETCH_VIDEO_ID;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param string $sourceLanguage
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function addCaption(int $libraryId, string $videoId, string $sourceLanguage, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::ADD_CAPTION;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId, $sourceLanguage],
            [],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param string $sourceLanguage
     * @param array $body
     * @return StreamInterface
     * @throws Exception\InvalidBodyParameterType
     * @throws GuzzleException
     */
    public function deleteCaption(int $libraryId, string $videoId, string $sourceLanguage, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::DELETE_CAPTION;
        $body = $this->validateBodyField($body, $endpoint['body']);

        return $this->createRequest(
            $endpoint,
            [$libraryId, $videoId, $sourceLanguage],
            [],
            $body
        );
    }
}
