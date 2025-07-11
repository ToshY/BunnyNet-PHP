<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use DateTimeInterface;
use Psr\Http\Client\ClientExceptionInterface;
use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;
use ToshY\BunnyNet\Model\API\Logging\GetLog;
use ToshY\BunnyNet\Model\Client\Interface\BunnyClientResponseInterface;
use ToshY\BunnyNet\Validation\BunnyValidator;

class LoggingAPI
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     * @param BunnyValidator $validator
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
        protected readonly BunnyValidator $validator = new BunnyValidator(),
    ) {
        $this->client
            ->setApiKey($this->apiKey)
            ->setBaseUrl(Host::LOGGING_ENDPOINT);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Exception\BunnyClientResponseException
     * @throws Exception\JSONException
     * @throws Exception\Validation\BunnyValidatorExceptionInterface
     * @param int $pullZoneId
     * @param DateTimeInterface $dateTime
     * @param array<string,mixed> $query
     * @return BunnyClientResponseInterface
     */
    public function getLog(
        int $pullZoneId,
        DateTimeInterface $dateTime,
        array $query = [],
    ): BunnyClientResponseInterface {
        $endpoint = new GetLog();
        $dateTimeFormat = $dateTime->format('m-d-y');

        $this->validator->query($query, $endpoint);

        return $this->client->request(
            endpoint: $endpoint,
            parameters: [$dateTimeFormat, $pullZoneId],
            query: $query,
        );
    }
}
