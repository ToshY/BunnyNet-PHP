# Pull Zone Log Request

Get pull zone logging for a certain date.

## Usage

Provide the API key available from the **Account Settings** panel.

```php
require 'vendor/autoload.php';

use ToshY\BunnyNet\PullZoneLogRequest;

$bunnyLog = new PullZoneLogRequest(
    '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
);
```

---

## Options

The pull zone log requests has the following methods available:

* [Log](#log)

---

### Log

```php
// Logging of yesterday
$bunnyLog->getLog(1, new DateTime('-1 day'));

// Logging of yesterday, specifying start/end lines, ordering, status codes and search term
$bunnyLog->getLog(1, new DateTime('-1 day'), [
    'start' => 10,
    'end' => 20,
    'order' => 'asc',
    'status' => [
        100,
        200,
        300,
        400,
        500
    ],
    'search' => 'bunny.jpg'
]);
```