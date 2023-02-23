<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Helper\BodyContentHelper;
use ToshY\BunnyNet\Model\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\UploadFile;

class EdgeStorageAPI
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     * @param Region $region
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
        Region $region = Region::FS,
    ) {
        $this->client
            ->setAPIKey($this->apiKey)
            ->setBaseUrl($region->host());
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $fileName
     * @param string $path
     * @return ResponseInterface
     * @param string $storageZoneName
     */
    public function downloadFile(
        string $storageZoneName,
        string $fileName,
        string $path = ''
    ): ResponseInterface {
        $endpoint = new DownloadFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName]
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws FileDoesNotExistException
     * @param string $localFilePath
     * @param string $path
     * @param array<string,mixed> $headers
     * @return ResponseInterface
     * @param string $storageZoneName
     * @param string $fileName
     */
    public function uploadFile(
        string $storageZoneName,
        string $fileName,
        string $localFilePath,
        string $path = '',
        array $headers = [],
    ): ResponseInterface {
        $endpoint = new UploadFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
            body: BodyContentHelper::openFileStream($localFilePath),
            headers: $headers
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $fileName
     * @param string $path
     * @return ResponseInterface
     * @param string $storageZoneName
     */
    public function deleteFile(
        string $storageZoneName,
        string $fileName,
        string $path = ''
    ): ResponseInterface {
        $endpoint = new DeleteFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $path
     * @return ResponseInterface
     * @param string $storageZoneName
     */
    public function listFiles(string $storageZoneName, string $path = ''): ResponseInterface
    {
        $endpoint = new ListFiles();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path],
        );
    }
}
