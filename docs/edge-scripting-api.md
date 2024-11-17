# Edge Scripting API

Edge Scripting is a  serverless JavaScript platform built on top of Deno, designed to help developers build, deploy, and run JavaScript applications on our massive global network without worrying about hardware, scaling, or load balancing ever again.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\EdgeScriptingAPI;
use ToshY\BunnyNet\Client\BunnyClient;

// Create a BunnyClient using any HTTP client implementing "Psr\Http\Client\ClientInterface".
$bunnyClient = new BunnyClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
);

// Provide the API key available at the "Account Settings > API" section.
$edgeScriptingApi = new EdgeScriptingAPI(
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    client: $bunnyClient,
);
```

## Usage

### Code

#### [Get Code](https://docs.bunny.net/reference/getedgescriptcodeendpoint_getcode)

```php
$edgeScriptingApi->getCode(
    id: 1,
);
```

#### [Set Code](https://docs.bunny.net/reference/uploadedgescriptcodeendpoint_setcode)

```php
$edgeScriptingApi->setCode(
    id: 1,
    body: [
        'Code' => "export default function handleQuery(event) {\n    console.log(\"Hello world!\")\n    return new TxtRecord(\"Hello world!\");\n}",
    ],
);
```

## Reference

* [Edge Scripting API](https://docs.bunny.net/reference/getedgescriptcodeendpoint_getcode)
* [Blog "Introducing Edge Scripting: A better way to build and run applications at the edge!" (07-11-2024)](https://bunny.net/blog/introducing-bunny-edge-scripting-a-better-way-to-build-and-deploy-applications-at-the-edge/)
