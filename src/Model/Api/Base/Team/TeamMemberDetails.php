<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Team;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class TeamMemberDetails implements ModelInterface
{
    /**
     * @param string $userId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $userId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'team/member/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
