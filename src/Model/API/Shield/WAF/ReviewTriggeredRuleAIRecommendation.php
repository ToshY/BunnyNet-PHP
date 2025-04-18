<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Shield\WAF;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\EndpointInterface;

class ReviewTriggeredRuleAIRecommendation implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/waf/rules/review-triggered/ai-recommendation/%d/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
