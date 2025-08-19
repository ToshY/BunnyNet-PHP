<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\AbuseCase;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

/**
 * @note no longer in OpenAPI spec
 */
class ResolveAbuseCase implements ModelInterface
{
    /**
     * @param int $id
     */
    public function __construct(
        #[PathProperty]
        public readonly int $id,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'abusecase/%d/resolve';
    }

    public function getHeaders(): array
    {
        return [];
    }
}
