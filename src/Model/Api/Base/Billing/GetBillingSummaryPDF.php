<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\Billing;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

/**
 * @note no longer in OpenAPI spec
 */
class GetBillingSummaryPDF implements ModelInterface
{
    /**
     * @param int $billingRecordId
     */
    public function __construct(
        #[PathProperty]
        public readonly int $billingRecordId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'billing/summary/%d/pdf';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
