<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Endpoint\Base\Countries;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\Endpoint\GenericEndpointInterface;

class ListCountries implements GenericEndpointInterface
{
    public function getMethod(): string
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'country';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            'page' => [
                'required' => false,
                'type' => 'int',
            ],
            'perPage' => [
                'required' => false,
                'type' => 'int',
            ],
        ];
    }
}
