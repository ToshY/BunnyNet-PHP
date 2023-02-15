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
use ToshY\BunnyNet\Model\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Validator\ParameterValidator;

/**
 * Manage videos and collections through the Stream API.
 *
 * Provide the **API key** available at the **API > API Key** section of your specific video library.
 *
 * ```php
 * <?php
 *
 * require 'vendor/autoload.php';
 *
 * use ToshY\BunnyNet\Client\BunnyClient;
 * use ToshY\BunnyNet\VideoStreamRequest;
 *
 * // Create a BunnyClient using any HTTP client implementing Psr\Http\Client\ClientInterface
 * $bunnyClient = new BunnyClient(
 *     client: new \Symfony\Component\HttpClient\HttpClient()
 * );
 *
 * $bunnyStream = new VideoStreamRequest(
 *     apiKey: '710d5fb6-d923-43d6-87f8-ea65c09e76dc',
 *     client: $bunnyClient
 * );
 * ```
 *
 * @link https://docs.bunny.net/reference/api-overview
 */
class VideoStreamRequest
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
     * Manage Collections | Get Collection.
     *
     * ```php
     * $bunnyStream->getCollection(
     *     libraryId: 1,
     *     collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/collection_getcollection
     *
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
     * Manage Collections | Update Collection.
     *
     * ```php
     * $bunnyStream->updateCollection(
     *     libraryId: 1,
     *     collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144',
     *     body: [
     *         'name' => 'Bunny Hopping Collection V2'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/collection_updatecollection
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Manage Collections | Delete Collection.
     *
     * ```php
     * $bunnyStream->deleteCollection(
     *     libraryId: 1,
     *     collectionId: '97f20caa-649b-4302-9f6e-1d286e0da144'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/collection_deletecollection
     *
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
     * Manage Collections | List Collections.
     *
     * ```php
     * $bunnyStream->listCollections(
     *     libraryId: 1,
     *     query: [
     *         'page' => 1,
     *         'perPage' => 100,
     *         'search' => 'bunny',
     *         'orderBy' => 'date'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/collection_list
     *
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
     * Manage Collections | Create Video.
     *
     * ```php
     * $bunnyStream->createCollection(
     *     libraryId: 1,
     *     body: [
     *         'name' => 'Bunny Collection'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/collection_createcollection
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Manage Videos | Get Video.
     *
     * ```php
     * $bunnyStream->getVideo(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_getvideo
     *
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
     * Manage Videos | Update Video.
     *
     * ```php
     * $bunnyStream->updateVideo(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
     *     body: [
     *         'title' => 'Bunny Hoppers',
     *         'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144',
     *         'chapters' => [
     *             [
     *                 'title' => 'Chapter 1',
     *                 'start' => 0,
     *                 'end' => 300
     *             ],
     *             [
     *                 'title' => 'Chapter 2',
     *                 'start' => 301,
     *                 'end' => 500
     *             ],
     *         ]
     *         'moments' => [
     *             [
     *                 'label' => 'Awesome Scene 1',
     *                 'timestamp' => 70
     *             ],
     *             [
     *                 'title' => 'Awesome Scene 2',
     *                 'timestamp' => 120
     *             ],
     *         ]
     *         'metaTags' => [
     *             [
     *                 'property' => 'description',
     *                 'value' => 'My Video Description'
     *             ],
     *             [
     *                 'property' => 'robots',
     *                 'value' => 'noindex,nofollow'
     *             ]
     *         ]
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_updatevideo
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Manage Videos | Delete Video.
     *
     * ```php
     * $bunnyStream->deleteVideo(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_deletevideo
     *
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
     * Manage Videos | Upload Video.
     *
     * ```php
     * $bunnyStream->uploadVideo(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     *     localFilePath: './bunny-hop.mp4',
     *     query: [
     *         'enabledResolutions' => '240p,360p,480p,720p,1080p,1440p,2160p'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_uploadvideo
     *
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
            body: EndpointHelper::openFileStream($localFilePath),
        );
    }

    /**
     * Manage Videos | Get Video Heatmap.
     *
     * ```php
     * $bunnyStream->getVideoHeatmap(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_getvideoheatmap
     *
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
     * Manage Videos | Get Video Statistics.
     *
     * ```php
     * $bunnyStream->getVideoStatistics(
     *     libraryId: 1,
     *     query: [
     *         'dateFrom' => 'm-d-Y',
     *         'dateTo' => 'm-d-Y',
     *         'hourly' => false,
     *         'videoGuid' => 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_getvideostatistics
     *
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
     * Manage Videos | Re-encode Video.
     *
     * ```php
     * $bunnyStream->reEncodeVideo(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_reencodevideo
     *
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
     * Manage Videos | List Videos.
     *
     * ```php
     * $bunnyStream->listCollections(
     *     libraryId: 1,
     *     query: [
     *         'page' => 1,
     *         'itemsPerPage' => 100,
     *         'search' => 'bunny',
     *         'collection' => '97f20caa-649b-4302-9f6e-1d286e0da144',
     *         'orderBy' => 'date'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_list
     *
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
     * Manage Videos | Create Video.
     *
     * ```php
     * $bunnyStream->createVideo(
     *     libraryId: 1,
     *     body: [
     *         'title' => 'Bunny Hoppers',
     *         'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144'
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - The title does not need to match or require a file extension.
     * - A `collectionId` is not required.
     * - The response returns the video's GUID, which is required for video upload (see `uploadVideo`).
     * ---
     *
     * @link https://docs.bunny.net/reference/video_createvideo
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Manage Videos | Create Video.
     *
     * ```php
     * $bunnyStream->setThumbnail(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     *     query: [
     *         'thumbnailUrl' => 'https://cdn.example.com/thumbnail.jpg'
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_setthumbnail
     *
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
     * Manage Videos | Fetch Video.
     *
     * ```php
     * $bunnyStream->fetchVideo(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd'
     *     query: [
     *         'collectionId' => '97f20caa-649b-4302-9f6e-1d286e0da144'
     *     ],
     *     body: [
     *         'url' =>'https://example.com/bunny-hop.mp4',
     *         'headers' => [
     *             'newKey' => 'New Value',
     *             'newKey-1' => 'New Value',
     *             'newKey-2' => 'New Value'
     *         ]
     *     ]
     * );
     * ```
     *
     * @link https://docs.bunny.net/reference/video_fetchnewvideo
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Manage Videos | Add Caption.
     *
     * ```php
     * $bunnyStream->addCaption(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
     *     sourceLanguage: 'jp',
     *     body: [
     *         'srclang' =>'https://example.com/bunny-hop.mp4',
     *         'label' =>'Subtitles (Japanese)',
     *         'captionsFile' =>'MQowMDowMDowMCwwMDAgLS0+IDAwOjAxOjAwLDAwMApOZXZlciBnb25uYSBnaXZlIHlvdSB1cC4K',
     *     ]
     * );
     * ```
     * ---
     * Notes:
     * - The `sourceLanguage` / `srclang` is the [language shortcode](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) for the caption.
     * - The `captionsFile` requires the file contents to be sent as a base64 encoded string.
     * ---
     *
     * @link https://docs.bunny.net/reference/video_addcaption
     *
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
            body: EndpointHelper::getBody($body),
        );
    }

    /**
     * Manage Videos | Delete Caption.
     *
     * ```php
     * $bunnyStream->deleteCaption(
     *     libraryId: 1,
     *     videoId: 'e7e9b99a-ea2a-434a-b200-f6615e7b6abd',
     *     sourceLanguage: 'jp'
     * );
     * ```
     * ---
     * Notes:
     * - The `srclang` is the [language shortcode](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) for the caption.
     * ---
     *
     * @link https://docs.bunny.net/reference/video_deletecaption
     *
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
