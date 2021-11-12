<?php

/**
 * Written by ToshY, <25-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum\Base;

use ToshY\BunnyNet\Enum\Header;

/**
 * Class BillingEndpoint
 */
final class BillingEndpoint
{
    /** @var array */
    public const GET_BILLING_DETAILS = [
        'method' => 'GET',
        'path' => 'billing',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const GET_BILLING_SUMMARY = [
        'method' => 'GET',
        'path' => 'billing/summary',
        'headers' => [
            Header::ACCEPT_JSON,
        ],
        'query' => [],
        'body' => [],
    ];

    /** @var array */
    public const APPLY_PROMO_CODE = [
        'method' => 'GET',
        'path' => 'billing/applycode',
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
