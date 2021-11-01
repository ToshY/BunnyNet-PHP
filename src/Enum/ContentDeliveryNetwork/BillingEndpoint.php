<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\ContentDeliveryNetwork;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class BillingEndpoint
 */
final class BillingEndpoint
{
    /** @var array */
    public const GET_BILLING_DETAILS = [
        'method' => 'GET',
        'path' => [
            'url' => 'billing',
            'params' => [],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const GET_BILLING_SUMMARY = [
        'method' => 'GET',
        'path' => [
            'url' => 'billing/summary',
            'params' => [],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const APPLY_PROMO_CODE = [
        'method' => 'GET',
        'path' => [
            'url' => 'billing/applycode',
            'params' => [],
        ],
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [
            'CouponCode' => [
                'required' => true,
                'type' => 'string',
            ],
        ],
        'body' => [],
    ];
}
