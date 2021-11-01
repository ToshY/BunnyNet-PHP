<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use ToshY\BunnyNet\Enum\Storage\BrowseEndpoint;
use ToshY\BunnyNet\Enum\Storage\ManageEndpoint;
use ToshY\BunnyNet\Enum\Storage\StorageRegion;
use ToshY\BunnyNet\Exception\FileDoesNotExist;
use ToshY\BunnyNet\Exception\RegionDoesNotExist;

/**
 * Class EdgeStorage
 */
final class EdgeStorage extends AbstractRequest
{
    /** @var array */
    private array $host;

    /** @var string */
    protected string $apiKey;

    /**
     * EdgeStorage constructor.
     * @throws RegionDoesNotExist
     */
    public function __construct(
        string $apiKey,
        string $hostCode = 'FS'
    ) {
        $this->apiKey = $apiKey;
        $this->setHost($hostCode);

        parent::__construct();
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
     * @return EdgeStorage
     * @throws RegionDoesNotExist
     */
    public function setHost(string $hostCode): EdgeStorage
    {
        $upperCaseHostCode = strtoupper($hostCode);
        if (array_key_exists($upperCaseHostCode, StorageRegion::LOCATION) !== true) {
            throw new RegionDoesNotExist(
                sprintf(
                    'The region abbreviation `%s` is not a valid primary storage region.'
                    . ' Please check your storage dashboard for the correct hostname.',
                    $hostCode
                )
            );
        }

        $this->host = StorageRegion::LOCATION[$upperCaseHostCode];
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
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function downloadFile(string $storageZoneName, string $path, string $fileName): StreamInterface
    {
        $endpoint = ManageEndpoint::DOWNLOAD_FILE;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$storageZoneName, $path, $fileName]);

        return $this->createRequest(
            $endpoint['method'],
            $this->getHostUrl(),
            $urlPath,
            [],
            $endpoint['headers']
        );
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     * @param string $localFilePath
     * @return StreamInterface
     * @throws GuzzleException
     * @throws FileDoesNotExist
     */
    public function uploadFile(
        string $storageZoneName,
        string $path,
        string $fileName,
        string $localFilePath
    ): StreamInterface {
        $endpoint = ManageEndpoint::UPLOAD_FILE;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$storageZoneName, $path, $fileName]);
        $body = $this->openFileStream($localFilePath);

        return $this->createRequest(
            $endpoint['method'],
            $this->getHostUrl(),
            $urlPath,
            [],
            $endpoint['headers'],
            $body
        );
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function deleteFile(string $storageZoneName, string $path, string $fileName): StreamInterface
    {
        $endpoint = ManageEndpoint::DELETE_FILE;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$storageZoneName, $path, $fileName]);

        return $this->createRequest(
            $endpoint['method'],
            $this->getHostUrl(),
            $urlPath,
            [],
            $endpoint['headers']
        );
    }

    /**
     * @param string $storageZoneName
     * @param string $path
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function listFileCollection(string $storageZoneName, string $path): StreamInterface
    {
        $endpoint = BrowseEndpoint::LIST_FILE_COLLECTION;
        $urlPath = $this->createUrlPath($endpoint['path']['url'], [$storageZoneName, $path]);

        return $this->createRequest(
            $endpoint['method'],
            $this->getHostUrl(),
            $urlPath,
            [],
            $endpoint['headers']
        );
    }
}
