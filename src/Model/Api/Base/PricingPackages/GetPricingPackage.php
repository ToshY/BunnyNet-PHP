<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Base\PricingPackages;

use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class GetPricingPackage implements ModelInterface
{
    /**
     * @param string $pricingPackageId
     */
    public function __construct(
        #[PathProperty]
        public readonly string $pricingPackageId,
    ) {
    }

    public function getMethod(): Method
    {
        return Method::GET;
    }

    public function getPath(): string
    {
        return 'v3.0/pricing-packages/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }
}
