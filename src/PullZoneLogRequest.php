<?php

/**
 * Written by ToshY, <2-11-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use GuzzleHttp\Exception\GuzzleException;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\Log\LogEndpoint;

/**
 * Class Logging
 * @link https://docs.bunny.net/docs/cdn-logging
 */
final class PullZoneLogRequest extends AbstractRequest
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
     * @return array
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     * @throws GuzzleException
     */
    public function getLogging(DateTimeInterface $dateTime, int $pullZoneId, array $query): array
    {
        $endpoint = LogEndpoint::GET_LOGGING;
        $dateTimeFormat = $dateTime->format('d-m-y');
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->createRequest(
            $endpoint,
            [$dateTimeFormat, $pullZoneId],
            $query
        );
    }
}
