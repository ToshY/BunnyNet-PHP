<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Team;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class EditTeamMember implements ModelInterface, BodyModelInterface
{
    /**
     * @param string $userId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly string $userId,
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'team/member/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'Email', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'FirstName', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'LastName', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'Password', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Roles', type: Type::ARRAY_TYPE, required: true, children: [
                new AbstractParameter(name: null, type: Type::STRING_TYPE),
            ]),
        ];
    }
}
