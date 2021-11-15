<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Region;
use ToshY\BunnyNet\Enum\Storage\BrowseEndpoint;
use ToshY\BunnyNet\Enum\Storage\ManageEndpoint;
use ToshY\BunnyNet\Exception\FileDoesNotExistException;
use ToshY\BunnyNet\Exception\RegionDoesNotExistException;

/**
 * Class EdgeStorage
 * @link https://docs.bunny.net/reference/storage-api
 */
final class EdgeStorageRequest extends BunnyClient
{
    /** @var array */
    private array $host;

    /** @var string */
    protected string $apiKey;

    /**
     * EdgeStorage constructor.
     * @throws RegionDoesNotExistException
     */
    public function __construct(
        string $apiKey,
        string $hostCode = 'FS'
    ) {
        $this->apiKey = $apiKey;
        $this->setHost($hostCode);

        parent::__construct($this->getHostUrl());
    }

    /**
     * @return array
     */
    public function getHost(): array
    {
        return $this->host;
    }

    /**
     * @param string $hostCode
     * @return EdgeStorageRequest
     * @throws RegionDoesNotExistException
     */
    public function setHost(string $hostCode): EdgeStorageRequest
    {
        $upperCaseHostCode = strtoupper($hostCode);
        if (array_key_exists($upperCaseHostCode, Region::STORAGE_STANDARD) !== true) {
            throw new RegionDoesNotExistException(
                sprintf(
                    'The region abbreviation `%s` is not a valid primary storage region.'
                    . ' Please check your storage dashboard for the correct hostname.',
                    $hostCode
                )
            );
        }

        $this->host = Region::STORAGE_STANDARD[$upperCaseHostCode];
        return $this;
    }

    /**
     * @return string
     */
    public function getHostName(): string
    {
        return $this->getHost()['name'];
    }

    /**
     * @return string
     */
    public function getHostUrl(): string
    {
        return $this->getHost()['url'];
    }

    /**
     * @return string
     */
    public function getHostCost(): string
    {
        return $this->getHost()['cost'];
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     * @return array
     */
    public function downloadFile(string $storageZoneName, string $path, string $fileName): array
    {
        $endpoint = ManageEndpoint::DOWNLOAD_FILE;

        return $this->request(
            $endpoint,
            [$storageZoneName, $path, $fileName]
        );
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     * @param string $localFilePath
     * @return array
     * @throws FileDoesNotExistException
     */
    public function uploadFile(
        string $storageZoneName,
        string $path,
        string $fileName,
        string $localFilePath
    ): array {
        $endpoint = ManageEndpoint::UPLOAD_FILE;
        $body = $this->openFileStream($localFilePath);

        return $this->request(
            $endpoint,
            [$storageZoneName, $path, $fileName],
            [],
            $body
        );
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     * @return array
     */
    public function deleteFile(string $storageZoneName, string $path, string $fileName): array
    {
        $endpoint = ManageEndpoint::DELETE_FILE;

        return $this->request(
            $endpoint,
            [$storageZoneName, $path, $fileName],
        );
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @return array
     */
    public function listFiles(string $storageZoneName, string $path = ''): array
    {
        $endpoint = BrowseEndpoint::LIST_FILE_COLLECTION_DIRECTORY;
        $pathParameters = [$storageZoneName, $path];
        if (empty($path) === true) {
            $endpoint = BrowseEndpoint::LIST_FILE_COLLECTION_ROOT;
            $pathParameters = [$storageZoneName];
        }

        return $this->request(
            $endpoint,
            $pathParameters,
        );
    }
}
