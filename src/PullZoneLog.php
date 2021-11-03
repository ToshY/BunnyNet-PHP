<?php

/**
 * Written by ToshY, <2-11-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\Log\Log;

/**
 * Class Logging
 * @link https://docs.bunny.net/docs/cdn-logging
 */
final class PullZoneLog extends AbstractRequest
{
    /** @var string */
    protected string $apiKey;

    /**
     * Stream constructor.
     * @param string $apiKey
     */
    public function __construct(
        string $apiKey
    ) {
        $this->apiKey = $apiKey;

        parent::__construct(Host::LOG_ENDPOINT);
    }

    /**
     * @param DateTimeInterface $dateTime
     * @param int $pullZoneId
     * @param array $query
     * @return StreamInterface
     * @throws Exception\InvalidQueryParameterRequirement
     * @throws Exception\InvalidQueryParameterType
     * @throws GuzzleException
     */
    public function getLogging(DateTimeInterface $dateTime, int $pullZoneId, array $query): StreamInterface
    {
        $endpoint = Log::GET_LOGGING;
        $dateTimeFormat = $dateTime->format('d-m-y');
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [$dateTimeFormat, $pullZoneId],
            $query
        );
    }
}
