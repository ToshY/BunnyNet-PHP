<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Exception\BunnyClientResponseException;
use ToshY\BunnyNet\Exception\JSONException;
use ToshY\BunnyNet\Exception\Validation\BunnyValidatorExceptionInterface;
use ToshY\BunnyNet\Exception\Validation\InvalidTypeForKeyValueException;
use ToshY\BunnyNet\Exception\Validation\InvalidTypeForListValueException;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\CreateCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\DeleteCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\GetCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\ListCollections;
use ToshY\BunnyNet\Model\API\Stream\ManageCollections\UpdateCollection;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\AddCaption;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\AddOutputCodecToVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\CreateVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteCaption;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteUnconfiguredResolutions;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\DeleteVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\FetchVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoHeatmap;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoPlayData;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\GetVideoResolutionsInfo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ListVideos;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ListVideoStatistics;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\ReEncodeVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\RepackageVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\SetThumbnail;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\TranscribeVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UpdateVideo;
use ToshY\BunnyNet\Model\API\Stream\ManageVideos\UploadVideo;
use ToshY\BunnyNet\Model\API\Stream\OEmbed\GetOEmbed;
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Validation\BunnyValidator;

class StreamAPI
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
            ->setBaseUrl(Host::STREAM_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param string $collectionId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getCollection(
        int $libraryId,
        string $collectionId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new GetCollection();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param string $collectionId
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function updateCollection(
        int $libraryId,
        string $collectionId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateCollection();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $collectionId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function deleteCollection(
        int $libraryId,
        string $collectionId,
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteCollection();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $collectionId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function listCollections(
        int $libraryId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new ListCollections();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function createCollection(
        int $libraryId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new CreateCollection();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getVideo(
        int $libraryId,
        string $videoId,
    ): BunnyClientResponseInterface {
        $endpoint = new GetVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param string $videoId
     * @param array<string,mixed> $body
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function updateVideo(
        int $libraryId,
        string $videoId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new UpdateVideo();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function deleteVideo(
        int $libraryId,
        string $videoId,
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     * @param array<string,mixed> $body
     */
    public function createVideo(
        int $libraryId,
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new CreateVideo();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $libraryId
     * @param string $videoId
     * @param mixed $body
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function uploadVideo(
        int $libraryId,
        string $videoId,
        mixed $body,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new UploadVideo();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            query: $query,
            body: $body,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function getVideoHeatmap(
        int $libraryId,
        string $videoId,
    ): BunnyClientResponseInterface {
        $endpoint = new GetVideoHeatmap();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws BunnyClientResponseException
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws JSONException
     * @throws BunnyValidatorExceptionInterface
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function getVideoPlayData(
        int $libraryId,
        string $videoId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new GetVideoPlayData();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
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
     * @param int $libraryId
     */
    public function getVideoStatistics(
        int $libraryId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new ListVideoStatistics();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $videoId
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function reEncodeVideo(
        int $libraryId,
        string $videoId,
    ): BunnyClientResponseInterface {
        $endpoint = new ReEncodeVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param int $libraryId
     * @param string $videoId
     * @param int $outputCodecId
     * @return BunnyClientResponseInterface
     */
    public function addOutputCodecToVideo(
        int $libraryId,
        string $videoId,
        int $outputCodecId,
    ): BunnyClientResponseInterface {
        $endpoint = new AddOutputCodecToVideo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $outputCodecId],
        );
    }

    /**
     * @throws BunnyClientResponseException
     * @throws ClientExceptionInterface
     * @throws InvalidTypeForKeyValueException
     * @throws InvalidTypeForListValueException
     * @throws JSONException
     * @throws BunnyValidatorExceptionInterface
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function repackageVideo(
        int $libraryId,
        string $videoId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new RepackageVideo();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
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
     * @param int $libraryId
     */
    public function listVideos(
        int $libraryId,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new ListVideos();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function setThumbnail(
        int $libraryId,
        string $videoId,
        array $query,
    ): BunnyClientResponseInterface {
        $endpoint = new SetThumbnail();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param array<string,mixed> $body
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function fetchVideo(
        int $libraryId,
        array $body,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new FetchVideo();

        $this->validator->query($query, $endpoint);
        $this->validator->body($body, $endpoint);

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
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
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
        array $body,
    ): BunnyClientResponseInterface {
        $endpoint = new AddCaption();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $sourceLanguage],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $videoId
     * @param string $sourceLanguage
     * @return BunnyClientResponseInterface
     * @param int $libraryId
     */
    public function deleteCaption(
        int $libraryId,
        string $videoId,
        string $sourceLanguage,
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteCaption();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId, $sourceLanguage],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function transcribeVideo(
        int $libraryId,
        string $videoId,
        array $query,
    ): BunnyClientResponseInterface {
        $endpoint = new TranscribeVideo();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
            query: $query,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param int $libraryId
     * @param string $videoId
     * @return BunnyClientResponseInterface
     */
    public function videoResolutionsInfo(
        int $libraryId,
        string $videoId,
    ): BunnyClientResponseInterface {
        $endpoint = new GetVideoResolutionsInfo();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $libraryId
     * @param string $videoId
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function cleanupUnconfiguredResolutions(
        int $libraryId,
        string $videoId,
        array $query,
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteUnconfiguredResolutions();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$libraryId, $videoId],
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
    public function getOEmbed(
        array $query,
    ): BunnyClientResponseInterface {
        $endpoint = new GetOEmbed();

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            query: $query,
        );
    }
}
