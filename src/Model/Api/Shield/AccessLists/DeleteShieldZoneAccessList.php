<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\AccessLists;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteShieldZoneAccessList implements ModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param int $id
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
        #[PathProperty]
        public readonly int $id,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'shield/shield-zone/%d/access-lists/%d';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
