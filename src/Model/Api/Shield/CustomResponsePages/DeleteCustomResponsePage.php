<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\CustomResponsePages;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class DeleteCustomResponsePage implements ModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param string $pageType
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
        #[PathProperty]
        public readonly string $pageType,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::DELETE;
    }

    public function getPath(): string
    {
        return 'shield/shield-zone/%d/custom-page/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
