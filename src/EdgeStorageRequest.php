<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Exception\RegionDoesNotExistException;
use ToshY\BunnyNet\Helper\EndpointHelper;
use ToshY\BunnyNet\Model\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\UploadFile;

/**
 * Browse and manage files through the Edge Storage API.
 *
 * Provide the API key of the specific storage zone you want to use, available at the **FTP & API Access** section.
 *
 * ```php
 * <?php
 *
 * require 'vendor/autoload.php';
 *
 * use ToshY\BunnyNet\Client\BunnyClient;
 * use ToshY\BunnyNet\EdgeStorageRequest;
 * use ToshY\BunnyNet\Enum\Region;
 *
 * // Create a BunnyClient using any HTTP client implementing Psr\Http\Client\ClientInterface
 * $bunnyClient = new BunnyClient(
 *     client: new \Symfony\Component\HttpClient\HttpClient()
 * );
 *
 * $bunnyEdgeStorage = new EdgeStorageRequest(
 *     apiKey: '6bf3d93a-5078-4d65-a437-501c44576fe6',
 *     regionCode: Region::FS,
 *     client: $bunnyClient
 * );
 * ```
 *
 * @link https://docs.bunny.net/reference/storage-api
 */
class EdgeStorageRequest
{
    /**
     * @throws RegionDoesNotExistException
     * @param BunnyClient $client
     * @param Region|string $regionCode
     * @param string $apiKey
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
        Region|string $regionCode = 'FS',
    ) {
        $this->client->setBaseUrl(
            $this->setHost($regionCode)
        );
    }

    /**
     * @throws RegionDoesNotExistException
     * @return string
     * @param Region|string $hostCode
     */
    public function setHost(Region|string $hostCode): string
    {
        if (true === $hostCode instanceof Region) {
            return $hostCode->host();
        }

        $filteredRegionCollection = array_filter(
            Region::cases(),
            function (Region $region) use ($hostCode) {
                if (strtoupper($region->name) === strtoupper($hostCode)) {
                    return $region;
                }
            },
        );

        $foundRegion = array_pop($filteredRegionCollection);
        if (null === $foundRegion) {
            throw RegionDoesNotExistException::withHostCode(
                hostCode: $hostCode
            );
        }

        return $foundRegion->host();
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $path
     * @param string $fileName
     * @return ResponseInterface
     * @param string $storageZoneName
     */
    public function downloadFile(
        string $storageZoneName,
        string $path,
        string $fileName
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
     * @param string $fileName
     * @param string $localFilePath
     * @param array<string,mixed> $headers
     * @return ResponseInterface
     * @param string $storageZoneName
     * @param string $path
     */
    public function uploadFile(
        string $storageZoneName,
        string $path,
        string $fileName,
        string $localFilePath,
        array $headers = [],
    ): ResponseInterface {
        $endpoint = new UploadFile();

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
            body: EndpointHelper::openFileStream($localFilePath),
            headers: $headers
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @param string $path
     * @param string $fileName
     * @return ResponseInterface
     * @param string $storageZoneName
     */
    public function deleteFile(
        string $storageZoneName,
        string $path,
        string $fileName
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
