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
 * @link https://docs.bunny.net/docs/cdn-logging
 * @note Requires the account API key.
 */
class PullZoneLogRequest
{
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client->setBaseUrl(Host::LOGGING_ENDPOINT);
    }

    /**
     * @throws Exception\InvalidJSONForBodyException
     * @throws Exception\InvalidTypeForKeyValueException
     * @throws Exception\InvalidTypeForListValueException
     * @throws Exception\ParameterIsRequiredException
     * @throws ClientExceptionInterface
     */
    public function getLog(int $pullZoneId, DateTimeInterface $dateTime, array $query = []): ResponseInterface
    {
        $endpoint = new GetPullZoneLogging();
        $dateTimeFormat = $dateTime->format('m-d-y');

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$dateTimeFormat, $pullZoneId],
            query: $query
        );
    }
}
