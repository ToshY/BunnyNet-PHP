# Pricing Calculator

Calculate pricing for Edge Storage and CDN.

## Usage

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\PricingCalculator;

$bunnyPricingCalculator = new PricingCalculator();
```

---

## Options

The pricing calculator has the following methods available:

* [Storage](#storage)
* [Pull Zone](#pull-zone)
    * [Standard](#get-billing-details)
    * [Volume](#get-billing-summary)

---

### Storage

```php
// Calculate cost for storage region Falkenstein (5000 GB) and New York (1250 GB).
$bunnyPricingCalculator->calculateStorageRegionCost(['FS' => 5000, 'NY' => 1250], 'GB');
```

*Note*:

* Possible regions are: `FS`, `NY`, `LA`, `SG` and `SYD`.

---

### Pull Zone

#### Standard

```php
// Calculate standard cost for pull zone region Europe & North America (5000 GB) and Asia & Oceania (1250 GB).
$bunnyPricingCalculator->calculateStandardCdnCost(['EUROPE_NORTH_AMERICA' => 5000, 'ASIA_OCEANIA' => 1250], 'GB');
```

*Note*:

* Possible regions are: `EUROPE_NORTH_AMERICA`, `ASIA_OCEANIA`, `SOUTH_AMERICA` and `MIDDLE_EAST_AFRICA`.

---

#### Volume

```php
// Calculate volume cost for pull zone with tier 1 (5000 GB).
$bunnyPricingCalculator->calculateVolumeCdnCost(['TIER_01' => 5000], 'GB');
```

*Note*:

* Possible tiers are: `TIER_01`, `TIER_02` and `TIER_03`.