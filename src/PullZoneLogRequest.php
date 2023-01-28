<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\Log\LogEndpoint;
use ToshY\BunnyNet\Enum\UuidType;
use ToshY\BunnyNet\Exception\KeyFormatNotSupportedException;

/**
 * @link https://docs.bunny.net/docs/cdn-logging
 */
final class PullZoneLogRequest extends BunnyClient
{
    /**
     * @throws KeyFormatNotSupportedException
     */
    public function __construct(
        string $accountApiKey
    ) {
        $this->setApiKey($accountApiKey);

        parent::__construct(Host::API_ENDPOINT);
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @throws KeyFormatNotSupportedException
     */
    public function setApiKey(string $key): PullZoneLogRequest
    {
        if (preg_match(UuidType::UUID_72, $key) !== 1) {
            throw new KeyFormatNotSupportedException(
                'Invalid API key: does not conform to the UUID 72 characters format.'
            );
        }
        $this->apiKey = $key;
        return $this;
    }

    /**
     * @throws Exception\InvalidQueryParameterRequirementException
     * @throws Exception\InvalidQueryParameterTypeException
     */
    public function getLog(int $pullZoneId, DateTimeInterface $dateTime, array $query = []): array
    {
        $endpoint = LogEndpoint::GET_LOGGING;
        $dateTimeFormat = $dateTime->format('m-d-y');
        $query = $this->validateQueryField($query, $endpoint['query']);

        return $this->request(
            $endpoint,
            [$dateTimeFormat, $pullZoneId],
            $query
        );
    }
}
