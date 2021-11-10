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
            $gbSize = $this->convertBytes($intersectValues[$regionAbbreviation], $unit, 'GB', true, 2);
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
     * @param $value
     * @param string $inputUnit
     * @param string $outputUnit
     * @param bool $binary
     * @param int $precision
     * @return array
     */
    public function convertBytes(
        $value,
        string $inputUnit = 'MB',
        string $outputUnit = 'GB',
        bool $binary = true,
        int $precision = 2
    ): array {
        switch ($binary) {
            case false:
                $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
                $mod = 1000;
                break;
            case true:
            default:
                $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
                $mod = 1024;
        }

        $indexInputUnit = array_search($inputUnit, $units, true);
        $indexOutputUnit = array_search($outputUnit, $units, true);

        $power = $indexOutputUnit - $indexInputUnit;
        if ($power === false) {
            $power = ($value > 0) ? floor(log($value, $mod)) : 0;
        }

        return [
            'value' => round($value / pow($mod, $power), $precision),
            'unit' => $units[$indexOutputUnit],
        ];
    }
}
