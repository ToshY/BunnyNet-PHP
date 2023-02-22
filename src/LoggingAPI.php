<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Model\Logging\GetLog;
use ToshY\BunnyNet\Validator\ParameterValidator;

class LoggingAPI
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
        $endpoint = new GetLog();
        $dateTimeFormat = $dateTime->format('m-d-y');

        ParameterValidator::validate($query, $endpoint->getQuery());

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$dateTimeFormat, $pullZoneId],
            query: $query,
        );
    }
}
