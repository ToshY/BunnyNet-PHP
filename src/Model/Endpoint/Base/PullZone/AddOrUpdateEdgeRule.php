<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\PullZone;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class AddOrUpdateEdgeRule implements GenericEndpointInterface
{
    public function getMethod(): string
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
                'type' => 'string',
            ],
            'ActionType' => [
                'required' => true,
                'type' => 'int',
            ],
            'ActionParameter1' => [
                'type' => 'string',
            ],
            'ActionParameter2' => [
                'type' => 'string',
            ],
            'Triggers' => [
                'type' => 'array',
                'options' => [
                    'Type' => [
                        'type' => 'int',
                    ],
                    'PatternMatches' => [
                        'type' => 'array',
                        'options' => [
                            'type' => 'string',
                        ],
                    ],
                    'PatternMatchingType' => [
                        'type' => 'int',
                    ],
                    'Parameter1' => [
                        'type' => 'string',
                    ],
                ],
            ],
            'TriggerMatchingType' => [
                'required' => true,
                'type' => 'int',
            ],
            'Description' => [
                'type' => 'string',
            ],
            'Enabled' => [
                'required' => true,
                'type' => 'bool',
            ],
        ];
    }
}
