<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Client\BunnyClient;
use ToshY\BunnyNet\Enum\Host;

class EdgeScriptingAPI
{
    /**
     * @param string $apiKey
     * @param BunnyClient $client
     */
    public function __construct(
        protected readonly string $apiKey,
        protected readonly BunnyClient $client,
    ) {
        $this->client
            ->setApiKey($this->apiKey)
            ->setBaseUrl(Host::API_ENDPOINT);
    }
}
