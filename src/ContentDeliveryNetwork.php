<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\UuidType;
use ToshY\BunnyNet\Exception\KeyFormatNotSupported;

/**
 * Class ContentDeliveryNetwork
 */
class ContentDeliveryNetwork extends AbstractRequest
{
    /** @var string Account API key */
    private string $accountApiKey;

    /**
     * ContentDeliveryNetwork constructor.
     * @param string|null $accountApiKey
     * @throws KeyFormatNotSupported
     */
    public function __construct(
        string $accountApiKey
    ) {
        $this->setAccountApiKey($accountApiKey);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function getAccountApiKey(): string
    {
        return $this->accountApiKey;
    }

    /**
     * @param string $key
     * @return ContentDeliveryNetwork
     * @throws KeyFormatNotSupported
     */
    public function setAccountApiKey(string $key): ContentDeliveryNetwork
    {
        if (preg_match(UuidType::UUID_72, $key) !== 1) {
            throw new KeyFormatNotSupported(
                'Invalid API key: does not conform to the UUID 72 characters format.'
            );
        }
        $this->accountApiKey = $key;
        return $this;
    }

    /**
     * @param float $bytes
     * @param int $precision
     * @param array|string[] $unitCollection
     * @return array
     */
    private function convertBytes(
        float $bytes,
        int $precision = 2,
        array $unitCollection = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB']
    ): array {
        $i = 0;
        while ($bytes > 1024) {
            $bytes /= 1024;
            $i++;
        }

        $value = round($bytes, $precision);
        $unit = $unitCollection[$i];

        return [
            'value' => $value,
            'unit' => $unit,
        ];
    }
}
