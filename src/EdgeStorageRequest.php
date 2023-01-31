<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\Enum\Storage\BrowseEndpoint;
use ToshY\BunnyNet\Enum\Storage\ManageEndpoint;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Exception\RegionDoesNotExistException;
use ToshY\BunnyNet\Model\Client\Response;
use ToshY\BunnyNet\Model\Endpoint\EdgeStorage\BrowseFiles\ListFiles;
use ToshY\BunnyNet\Model\Endpoint\EdgeStorage\ManageFiles\DeleteFile;
use ToshY\BunnyNet\Model\Endpoint\EdgeStorage\ManageFiles\DownloadFile;
use ToshY\BunnyNet\Model\Endpoint\EdgeStorage\ManageFiles\UploadFile;

/**
 * @link https://docs.bunny.net/reference/storage-api
 */
final class EdgeStorageRequest extends BunnyClient
{
    private string $host;

    /**
     * @throws RegionDoesNotExistException
     */
    public function __construct(
        protected string $apiKey,
        Region|string $hostCode = 'FS'
    ) {
        $this->setHost($hostCode);

        parent::__construct($this->host);
    }

    /**
     * @throws RegionDoesNotExistException
     */
    public function setHost(Region|string $hostCode): EdgeStorageRequest
    {
        if ($hostCode instanceof Region === true) {
            $this->host = $hostCode->host();
            return $this;
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
        if ($foundRegion === null) {
            throw new RegionDoesNotExistException(
                sprintf(
                    'The region abbreviation `%s` is not a valid primary storage region.'
                    . ' Please check your storage dashboard for the correct hostname.',
                    $hostCode
                )
            );
        }

        $this->host = $foundRegion->host();
        return $this;
    }

    public function downloadFile(
        string $storageZoneName,
        string $path,
        string $fileName
    ): Response {
        $endpoint = new DownloadFile();

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName]
        );
    }

    /**
     * @throws FileDoesNotExistException
     */
    public function uploadFile(
        string $storageZoneName,
        string $path,
        string $fileName,
        string $localFilePath,
        array $headers = [],
    ): Response {
        $endpoint = new UploadFile();
        $body = $this->openFileStream($localFilePath);

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
            body: $body,
            headers: $headers
        );
    }

    public function deleteFile(
        string $storageZoneName,
        string $path,
        string $fileName
    ): Response {
        $endpoint = new DeleteFile();

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path, $fileName],
        );
    }

    public function listFiles(string $storageZoneName, string $path = ''): Response
    {
        $endpoint = new ListFiles();

        return $this->request(
            endpoint: $endpoint,
            parameters: [$storageZoneName, $path],
        );
    }
}
