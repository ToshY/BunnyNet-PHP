<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Model\Logging\GetPullZoneLogging;
use ToshY\BunnyNet\Validator\ParameterValidator;

/**
 * The logging service provides an easy-to-use API endpoint for downloading the raw log files.
 *
 * Provide the API key available at the **[Account Settings](https://panel.bunny.net/account)** section.
 *
 * ```php
 * <?php
 *
 * require 'vendor/autoload.php';
 *
 * use ToshY\BunnyNet\Client\BunnyClient;
 * use ToshY\BunnyNet\PullZoneLogRequest;
 *
 * // Create a BunnyClient using any HTTP client implementing Psr\Http\Client\ClientInterface
 * $bunnyClient = new BunnyClient(
 *     client: new \Symfony\Component\HttpClient\HttpClient()
 * );
 *
 * $bunnyLog = new PullZoneLogRequest(
 *     apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
 *     client: $bunnyClient
 * );
 * ```
 *
 * @link https://docs.bunny.net/docs/cdn-logging
 */
class PullZoneLogRequest
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client->setBaseUrl(Host::LOGGING_ENDPOINT);
    }

    /**
     * Generate URL with optimization parameters.
     *
     * ```php
     * // Logging of yesterday.
     * $bunnyLog->getLog(
     *     pullZoneId: 1,
     *     dateTime: new DateTime('-1 day')
     * );
     *
     * // Logging of yesterday with start/end lines, ordering, status codes and search term.
     * $bunnyLog->getLog(
     *     pullZoneId: 1,
     *     dateTime: new DateTime('-1 day'),
     *     query: [
     *         'start' => 10,
     *         'end' => 20,
     *         'order' => 'asc',
     *         'status' => [
     *             100,
     *             200,
     *             300,
     *             400,
     *             500,
     *         ],
     *         'search' => 'bunny.jpg'
     *     ]
     * );
     * ```
     *
     * @throws ClientExceptionInterface
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @param int $pullZoneId
     * @param DateTimeInterface $dateTime
     * @param array<string,mixed> $query
     * @return ResponseInterface
     */
    public function getLog(int $pullZoneId, DateTimeInterface $dateTime, array $query = []): ResponseInterface
    {
        $endpoint = new GetPullZoneLogging();
        $dateTimeFormat = $dateTime->format('m-d-y');

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$dateTimeFormat, $pullZoneId],
            query: $query,
        );
    }
}
