<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Exception\RegionDoesNotExistException;
use ToshY\BunnyNet\Model\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\EdgeStorage\ManageFiles\UploadFile;

/**
 * @link https://docs.bunny.net/reference/storage-api
 * @note Requires the desired storage zone API key.
 */
class EdgeStorageRequest
{
    private string $host;

    /**
     * @throws RegionDoesNotExistException
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
            throw new RegionDoesNotExistException(
                sprintf(
                    RegionDoesNotExistException::MESSAGE,
                    $hostCode
                )
            );
        }

        return $foundRegion->host();
    }

    /**
     * @throws Exception\InvalidJSONForBodyException
     * @throws ClientExceptionInterface
     */
    public function downloadFile(
        string $storageZoneName,
        string $path,
        string $fileName
    ): ResponseInterface {
        $endpoint = new DownloadFile();

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName]
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     * @throws FileDoesNotExistException
     */
    public function uploadFile(
        string $storageZoneName,
        string $path,
        string $fileName,
        string $localFilePath,
        array $headers = [],
    ): ResponseInterface {
        $endpoint = new UploadFile();
        $body = $this->openFileStream($localFilePath);

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
            body: $body,
            headers: $headers
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function deleteFile(
        string $storageZoneName,
        string $path,
        string $fileName
    ): ResponseInterface {
        $endpoint = new DeleteFile();

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidJSONForBodyException
     */
    public function listFiles(string $storageZoneName, string $path = ''): ResponseInterface
    {
        $endpoint = new ListFiles();

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path],
        );
    }
}
