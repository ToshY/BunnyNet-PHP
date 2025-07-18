<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\API\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\DownloadZip;
use ToshY\BunnyNet\Model\API\EdgeStorage\ManageFiles\UploadFile;
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Validation\BunnyValidator;

class EdgeStorageAPI
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     * @param Region $region
     * @param BunnyValidator $validator
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
        Region $region = Region::FS,
        protected readonly BunnyValidator $validator = new BunnyValidator(),
    ) {
        $this->client
            ->setApiKey($this->apiKey)
            ->setBaseUrl($region->host());
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $fileName
     * @param string $path
     * @return BunnyClientResponseInterface
     * @param string $storageZoneName
     */
    public function downloadFile(
        string $storageZoneName,
        string $fileName,
        string $path = '',
    ): BunnyClientResponseInterface {
        $endpoint = new DownloadFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param string $storageZoneName
     * @param mixed $body
     * @return BunnyClientResponseInterface
     */
    public function downloadZip(
        string $storageZoneName,
        mixed $body,
    ): BunnyClientResponseInterface {
        $endpoint = new DownloadZip();

        $this->validator->body($body, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName],
            body: BodyContentHelper::getBody($body),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param mixed $body
     * @param string $path
     * @param array<string,mixed> $headers
     * @return BunnyClientResponseInterface
     * @param string $storageZoneName
     * @param string $fileName
     */
    public function uploadFile(
        string $storageZoneName,
        string $fileName,
        mixed $body,
        string $path = '',
        array $headers = [],
    ): BunnyClientResponseInterface {
        $endpoint = new UploadFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
            body: $body,
            headers: $headers,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $fileName
     * @param string $path
     * @return BunnyClientResponseInterface
     * @param string $storageZoneName
     */
    public function deleteFile(
        string $storageZoneName,
        string $fileName,
        string $path = '',
    ): BunnyClientResponseInterface {
        $endpoint = new DeleteFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @param string $path
     * @return BunnyClientResponseInterface
     * @param string $storageZoneName
     */
    public function listFiles(
        string $storageZoneName,
        string $path = '',
    ): BunnyClientResponseInterface {
        $endpoint = new ListFiles();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path],
        );
    }
}
