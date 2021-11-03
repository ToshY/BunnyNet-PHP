<?php

/**
 * Written by ToshY, <3-11-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\Region;

/**
 * Class SecureUrl
 */
final class PricingCalculator
{
    /**
     * Calculate zone and total cost.
     * @param array $regionCollection
     * @param string $unit
     * @param int $precision
     * @return array
     */
    public function calculateRegionCost(array $regionCollection, string $unit, int $precision = 2): array
    {
        $regionCollection = array_change_key_case($regionCollection, 1);
        $intersectTemplate = array_intersect_key(Region::STORAGE_STANDARD, $regionCollection);
        $intersectValues = array_intersect_key($regionCollection, Region::STORAGE_STANDARD);

        return $this->calculateUserTotalCost($intersectTemplate, $intersectValues, $unit, $precision);
    }

    /**
     * @param array $regionCollection
     * @param string $unit
     * @param int $precision
     * @return array[]
     */
    public function calculateStandardCDNCost(array $regionCollection, string $unit, int $precision = 2): array
    {
        $regionCollection = array_change_key_case($regionCollection, 1);
        $intersectTemplate = array_intersect_key(Region::CDN_STANDARD, $regionCollection);
        $intersectValues = array_intersect_key($regionCollection, Region::CDN_STANDARD);

        return $this->calculateUserTotalCost($intersectTemplate, $intersectValues, $unit, $precision);
    }

    /**
     * @param array $regionCollection
     * @param string $unit
     * @param int $precision
     * @return array[]
     */
    public function calculateVolumeCDNCost(array $regionCollection, string $unit, int $precision = 2): array
    {
        $regionCollection = array_change_key_case($regionCollection, 1);
        $intersectTemplate = array_intersect_key(Region::CDN_VOLUME, $regionCollection);
        $intersectValues = array_intersect_key($regionCollection, Region::CDN_VOLUME);

        return $this->calculateUserTotalCost($intersectTemplate, $intersectValues, $unit, $precision);
    }

    /**
     * @param array $intersectTemplate
     * @param array $intersectValues
     * @param string $unit
     * @param int $precision
     * @return array|array[]
     */
    private function calculateUserTotalCost(
        array $intersectTemplate,
        array $intersectValues,
        string $unit,
        int $precision
    ): array {
        $userReportCost = [
            'ALL' => [
                'location' => '',
                'GB' => 0,
                'cost' => 0,
            ]
        ];

        foreach ($intersectTemplate as $regionAbbreviation => $details) {
            $gbSize = $this->convertBytes($intersectValues[$regionAbbreviation], $unit, 'GB', 2);
            $regionTotalCost = round($gbSize['value'] * $details['cost'], $precision);
            $userReportCost[$regionAbbreviation] = [
                'location' => $details['location'],
                'GB' => $gbSize,
                'cost' => sprintf('$%s', $regionTotalCost),
            ];

            $userReportCost['ALL']['location'] = isset($userReportCost['ALL']['location']) === true
                ? implode('; ', $userReportCost['ALL']['location'])
                : 'N/A';
            $userReportCost['ALL']['GB'] = $userReportCost['ALL']['GB'] + $gbSize;
            $userReportCost['ALL']['cost'] = $userReportCost['ALL']['cost'] + $regionTotalCost;
        }
        return $userReportCost;
    }

    /**
     * @param float $value
     * @param string $inputUnit
     * @param string $outputUnit
     * @param int $precision
     * @return array
     */
    private function convertBytes(
        float $value,
        string $inputUnit = 'MB',
        string $outputUnit = 'GB',
        int $precision = 2
    ): array {
        $unitCollection = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        $indexInputUnit = array_search($inputUnit, $unitCollection, true);
        $indexOutputUnit = array_search($outputUnit, $unitCollection, true);

        $outputValue = round(
            $value * pow(1000, $indexOutputUnit - $indexInputUnit),
            $precision
        );

        return [
            'value' => $outputValue,
            'unit' => $outputUnit,
        ];
    }
}
