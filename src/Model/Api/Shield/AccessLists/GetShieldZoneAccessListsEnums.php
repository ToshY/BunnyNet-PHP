<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\AccessLists;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetShieldZoneAccessListsEnums implements ModelInterface
{
    /**
     * @param string $shieldZoneId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $shieldZoneId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'shield/shield-zone/%s/access-lists/enums';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
