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
        'Code' => "import * as BunnySDK from \"https://esm.sh/@bunny.net/edgescript-sdk@0.11.2\";\n\n/**\n * Returns an HTTP response.\n * @param {Request} request - The Fetch API Request object.\n * @return {Response} The HTTP response or string.\n */\nBunnySDK.net.http.serve(async (request: Request): Response | Promise<Response> => {\n  const url = new URL(request.url);\n  return new Response(\"Hello from \" + url.pathname);\n});\n",
    ],
);
```

### Edge Script

#### [List Edge Scripts](https://docs.bunny.net/reference/listedgescriptsendpoint_listedgescriptsbyaccount)

```php
$edgeScriptingApi->listEdgeScripts(
    query: [
        'page' => 1,
        'perPage' => 1000,
        'search' => 'Test',
        'includeLinkedPullzones' => false,
        'integrationId' => 1234,
    ],
);
```

#### [Add Edge Script](https://docs.bunny.net/reference/createedgescriptendpoint_addscript)

```php
$edgeScriptingApi->addEdgeScript(
    body: [
        'Name' => 'Test Script Modified',
        'Code' => "import * as BunnySDK from \"https://esm.sh/@bunny.net/edgescript-sdk@0.11.2\";\n\n/**\n * Returns an HTTP response.\n * @param {Request} request - The Fetch API Request object.\n * @return {Response} The HTTP response or string.\n */\nBunnySDK.net.http.serve(async (request: Request): Response | Promise<Response> => {\n  const url = new URL(request.url);\n  return new Response(\"Hello from \" + url.pathname);\n});\n",
        'ScriptType' => 1,
        'CreateLinkedPullZone' => true,
        'LinkedPullZoneName' => 'MyPullZone',
        'Integration' => [
            'IntegrationId' => 1234,
            'RepositorySettings' => [
                'Id' => 1234,  
                'Name' => 'Test Repo',  
                'Private' => true,  
                'TemplateUrl' => 'https://example.com',  
            ],
            'DeployConfiguration' => [
                'Branch' => 1234,  
                'InstallCommand' => 'Test Repo',  
                'BuildCommand' => 'true',  
                'EntryFile' => 'test.js',  
                'CreateWorkflow' => false,  
            ],
        ],
    ],
);
```

!!! note

    - The key `ScriptType` has the following possible values:
        - `0` = DNS (DNS scripts)
        - `1` = Standalone (Standalone scripts are ideal for a wide range of applications, such as building RESTful APIs, delivering UI applications, and processing data at the edge.)
        - `2` = Middleware (Middleware scripts common use cases include user authentication, error handling, logging, security enhancements, A/B testing, HTML manipulation, and more.)


#### [Get Edge Script](https://docs.bunny.net/reference/getedgescriptbyidendpoint_getedgescriptbyid)

```php
$edgeScriptingApi->getEdgeScript(
    id: 1,
);
```

#### [Get Edge Script Statistics](https://docs.bunny.net/reference/edgescriptstatisticsendpoint_getedgescriptstatisticsendpoint)

```php
$edgeScriptingApi->getEdgeScriptStatistics(
    id: 1,
    query: [
        'dateFrom' => 'm-d-Y',
        'dateTo' => 'm-d-Y',
        'loadLatest' => false,
        'hourly' => false,
    ],
);
```

#### [Update Edge Script](https://docs.bunny.net/reference/updateedgescriptendpoint_update)

```php
$edgeScriptingApi->updateEdgeScript(
    id: 1,
    body: [
        'Name' => 'Test Script',
        'ScriptType' => 1,
    ],
);
```

!!! note

    - The key `ScriptType` has the following possible values:
        - `0` = DNS (DNS scripts)
        - `1` = Standalone (Standalone scripts are ideal for a wide range of applications, such as building RESTful APIs, delivering UI applications, and processing data at the edge.)
        - `2` = Middleware (Middleware scripts common use cases include user authentication, error handling, logging, security enhancements, A/B testing, HTML manipulation, and more.)

#### [Delete Edge Script](https://docs.bunny.net/reference/deleteedgescriptendpoint_delete)

```php
$edgeScriptingApi->deleteEdgeScript(
    id: 1,
    query: [
        'deleteLinkedPullZones' => false,
    ],
);
```

### Variable

#### [Get Variable](https://docs.bunny.net/reference/getedgescriptvariableendpoint_getvariable)

```php
$edgeScriptingApi->getVariable(
    id: 1,
    variableId: 2,
);
```

#### [Add Variable](https://docs.bunny.net/reference/addedgescriptvariableendpoint_addedgescriptvariable)

```php
$edgeScriptingApi->addVariable(
    id: 1,
    body: [
        'Name' => 'New Variable',
        'Required' => true,
        'DefaultValue' => 'Hello World',
    ],
);
```

#### [Update Variable](https://docs.bunny.net/reference/updateedgescriptvariableendpoint_updatevariable)

```php
$edgeScriptingApi->updateVariable(
    id: 1,
    variableId: 2,
    body: [
        'Required' => false,
        'DefaultValue' => 'Hello World the Sequel',
    ],
);
```

#### [Upsert Variable](https://docs.bunny.net/reference/upsertedgescriptvariableendpoint_upsertedgescriptvariable)

```php
$edgeScriptingApi->upsertVariable(
    id: 1,
    body: [
        'Name' => 'New Variable',
        'Required' => true,
        'DefaultValue' => 'Hello World the Third',
    ],
);
```

#### [Delete Variable](https://docs.bunny.net/reference/deleteedgescriptvariableendpoint_deletevariable)

```php
$edgeScriptingApi->deleteVariable(
    id: 1,
    variableId: 2,
);
```

### Secret

#### [List Secrets](https://docs.bunny.net/reference/listedgescriptsecretsendpoint_listedgescriptsecrets)

```php
$edgeScriptingApi->listSecrets(
    id: 1,
);
```

#### [Add Secret](https://docs.bunny.net/reference/addedgescriptsecretendpoint_addedgescriptsecret)

```php
$edgeScriptingApi->addSecret(
    id: 1,
    body: [
        'Name' => 'VerySecretKey',
        'Secret' => 'V2UncmUgbm8gc3RyYW5nZXJzIHRvIGxvdmUKWW91IGtub3cgdGhlIHJ1bGVzIGFuZCBzbyBkbyBJIChEbyBJKQpBIGZ1bGwgY29tbWl0bWVudCdzIHdoYXQgSSdtIHRoaW5raW5nIG9mCllvdSB3b3VsZG4ndCBnZXQgdGhpcyBmcm9tIGFueSBvdGhlciBndXk=',
    ],
);
```

#### [Update Secret](https://docs.bunny.net/reference/updateedgescriptsecretendpoint_updateedgescriptsecret)

```php
$edgeScriptingApi->updateSecret(
    id: 1,
    secretId: 2,
    body: [
        'Secret' => 'TmV2ZXIgZ29ubmEgZ2l2ZSB5b3UgdXAKTmV2ZXIgZ29ubmEgbGV0IHlvdSBkb3duCk5ldmVyIGdvbm5hIHJ1biBhcm91bmQgYW5kIGRlc2VydCB5b3UKTmV2ZXIgZ29ubmEgbWFrZSB5b3UgY3J5Ck5ldmVyIGdvbm5hIHNheSBnb29kYnllCk5ldmVyIGdvbm5hIHRlbGwgYSBsaWUgYW5kIGh1cnQgeW91',
    ],
);
```

#### [Upsert Secret](https://docs.bunny.net/reference/upsertedgescriptsecretendpoint_upsertedgescriptsecret)

```php
$edgeScriptingApi->upsertSecret(
    id: 1,
    body: [
        'Name' => 'VerySecretKey',
        'Secret' => 'SSBqdXN0IHdhbm5hIHRlbGwgeW91IGhvdyBJJ20gZmVlbGluZwpHb3R0YSBtYWtlIHlvdSB1bmRlcnN0YW5k',
    ],
);
```

#### [Delete Secret](https://docs.bunny.net/reference/deleteedgescriptsecretendpoint_deletesecret)

```php
$edgeScriptingApi->deleteSecret(
    id: 1,
    secretId: 2,
);
```

### Release

#### [Get Releases](https://docs.bunny.net/reference/getedgescriptreleaseendpoint_getreleases)

```php
$edgeScriptingApi->getReleases(
    id: 1,
    query: [
        'page' => 1,
        'perPage' => 1000,
    ],
);
```

#### [Get Active Release](https://docs.bunny.net/reference/getedgescriptactivereleaseendpoint_getcurrentlyactivereleaseendpoint)

```php
$edgeScriptingApi->getActiveRelease(
    id: 1,
);
```

#### [Publish Release](https://docs.bunny.net/reference/publishedgescriptreleaseendpoint_publish)

```php
$edgeScriptingApi->publishRelease(
    id: 1,
    body: [
        'Note' => 'Initial release',
    ],
);
```

#### [Publish Release (by path parameter)](https://docs.bunny.net/reference/publishedgescriptreleaseendpoint_publish2)

```php
$edgeScriptingApi->publishReleaseByUuid(
    id: 1,
    uuid: '173d4dfc-a8dd-42f5-a55c-cba765c75aa5',
    body: [
        'Note' => 'Initial release',
    ],
);
```

## Reference

* [Edge Scripting API](https://docs.bunny.net/reference/getedgescriptcodeendpoint_getcode)
* [Blog "Introducing Edge Scripting: A better way to build and run applications at the edge!" (07-11-2024)](https://bunny.net/blog/introducing-bunny-edge-scripting-a-better-way-to-build-and-deploy-applications-at-the-edge/)
