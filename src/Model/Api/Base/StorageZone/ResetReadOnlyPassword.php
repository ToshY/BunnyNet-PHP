<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\StorageZone;

use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class ResetReadOnlyPassword implements ModelInterface, QueryModelInterface
{
    /**
     * @param array<string,mixed> $query
     */
    public function __construct(
        #[QueryProperty]
        public readonly array $query = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'storagezone/resetReadOnlyPassword';
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'id', type: Type::INT_TYPE),
        ];
    }
}
