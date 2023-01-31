<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Enum\Log\LogEndpoint;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\InvalidQueryParameterRequirementException;
use ToshY\BunnyNet\Exception\InvalidQueryParameterTypeException;
use ToshY\BunnyNet\Exception\KeyFormatNotSupportedException;
use ToshY\BunnyNet\Model\Client\Response;
use ToshY\BunnyNet\Model\Endpoint\Logging\GetPullZoneLogging;

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

        parent::__construct(Host::LOGGING_ENDPOINT);
    }

    /**
     * @throws KeyFormatNotSupportedException
     */
    public function setApiKey(string $key): PullZoneLogRequest
    {
        if (preg_match(Type::UUID72_TYPE->value, $key) !== 1) {
            throw new KeyFormatNotSupportedException(
                'Invalid API key: does not conform to the UUID 72 characters format.'
            );
        }
        $this->apiKey = $key;
        return $this;
    }


    /**
     * @throws InvalidQueryParameterTypeException
     * @throws InvalidQueryParameterRequirementException
     */
    public function getLog(int $pullZoneId, DateTimeInterface $dateTime, array $query = []): Response
    {
        $endpoint = new GetPullZoneLogging();
        $dateTimeFormat = $dateTime->format('m-d-y');
        $query = $this->validateQueryField($query, $endpoint->getQuery());

        return $this->request(
            $endpoint,
            [$dateTimeFormat, $pullZoneId],
            $query
        );
    }
}
