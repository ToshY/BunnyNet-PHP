<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\Endpoint\EndpointInterface;

class AddOrUpdateEdgeRule implements EndpointInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'pullzone/%d/edgerules/addOrUpdate';
    }

    public function getHeaders(): array
    {
        return [
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            'Guid' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ActionType' => [
                'required' => true,
                'type' => Type::INT_TYPE->value,
            ],
            'ActionParameter1' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'ActionParameter2' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Triggers' => [
                'type' => Type::ARRAY_TYPE->value,
                'options' => [
                    'Type' => [
                        'type' => Type::INT_TYPE->value,
                    ],
                    'PatternMatches' => [
                        'type' => Type::ARRAY_TYPE->value,
                        'options' => [
                            'type' => Type::STRING_TYPE->value,
                        ],
                    ],
                    'PatternMatchingType' => [
                        'type' => Type::INT_TYPE->value,
                    ],
                    'Parameter1' => [
                        'type' => Type::STRING_TYPE->value,
                    ],
                ],
            ],
            'TriggerMatchingType' => [
                'required' => true,
                'type' => Type::INT_TYPE->value,
            ],
            'Description' => [
                'type' => Type::STRING_TYPE->value,
            ],
            'Enabled' => [
                'required' => true,
                'type' => Type::BOOLEAN_TYPE->value,
            ],
        ];
    }
}
