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
 */
final class Stream extends AbstractRequest
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
        parent::__construct();
        $this->apiKey = $apiKey;
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
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $collectionId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers']
        );
    }

    /**
     * @param int $libraryId
     * @param string $collectionId
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function updateCollection(int $libraryId, string $collectionId, array $body): StreamInterface
    {
        $endpoint = CollectionEndpoint::UPDATE_COLLECTION;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $collectionId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function createCollection(int $libraryId, array $body): StreamInterface
    {
        $endpoint = CollectionEndpoint::CREATE_COLLECTION;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
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
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $collectionId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers']
        );
    }

    /**
     * @param int $libraryId
     * @param array $query
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getCollectionList(int $libraryId, array $query): StreamInterface
    {
        $endpoint = CollectionEndpoint::GET_COLLECTION_LIST;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            $query,
            $endpoint['headers']
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
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers']
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function updateVideo(int $libraryId, string $videoId, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::UPDATE_VIDEO;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
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
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers']
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
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);
        $body = $this->openFileStream($localFilePath);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
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
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers']
        );
    }

    /**
     * @param int $libraryId
     * @param array $query
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function listVideos(int $libraryId, array $query): StreamInterface
    {
        $endpoint = VideoEndpoint::LIST_VIDEOS;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            $query,
            $endpoint['headers']
        );
    }

    /**
     * @param int $libraryId
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function createVideo(int $libraryId, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::CREATE_VIDEO;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array $query
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function setThumbnail(int $libraryId, string $videoId, array $query): StreamInterface
    {
        $endpoint = VideoEndpoint::SET_THUMBNAIL;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            $query,
            $endpoint['headers'],
        );
    }

    /**
     * @param int $libraryId
     * @param array $query
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function fetchVideoToCollection(int $libraryId, array $query, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::FETCH_VIDEO_TO_COLLECTION;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            $query,
            $endpoint['headers'],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function fetchVideoById(int $libraryId, string $videoId, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::FETCH_VIDEO_ID;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param string $sourceLanguage
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function addCaption(int $libraryId, string $videoId, string $sourceLanguage, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::ADD_CAPTION;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId, $sourceLanguage]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
            $body
        );
    }

    /**
     * @param int $libraryId
     * @param string $videoId
     * @param string $sourceLanguage
     * @param array $body
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function deleteCaption(int $libraryId, string $videoId, string $sourceLanguage, array $body): StreamInterface
    {
        $endpoint = VideoEndpoint::DELETE_CAPTION;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$libraryId, $videoId, $sourceLanguage]);

        return $this->createRequest(
            $endpoint['method'],
            Host::STREAM_ENDPOINT,
            $urlPath,
            [],
            $endpoint['headers'],
            $body
        );
    }
}
