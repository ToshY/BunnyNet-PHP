<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\PullZone;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteEdgeRule implements ModelInterface
{
    /**
     * @param int $pullZoneId
     * @param string $edgeRuleId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $pullZoneId,
        #[PathProperty]
        public readonly string $edgeRuleId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/edgerules/%s';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
