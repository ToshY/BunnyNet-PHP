# Validation

The library ships with an optional validator that can be used to (pre-)validate your query and body parameters against the model schema before sending the actual API request.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyValidator;

$bunnyValidator = new BunnyValidator(
    validationType: ValidationType::MODEL,
    modelStrategyOverride: []
);
```

## Usage

```php
<?php
try {
    $bunnyValidator->query(
        new \ToshY\BunnyNet\Model\Api\Base\AbuseCase\ListAbuseCases(
            query: [
                'page' => 1,
                'perPage' => 1000,
            ],
        )
    )
} catch (BunnyValidatorExceptionInterface) {
    // ...
}
```
