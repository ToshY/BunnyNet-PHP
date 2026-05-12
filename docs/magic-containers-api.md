# Magic Containers API

The Magic Containers API provides a RESTful interface for managing Bunny.net Magic Containers — running applications, container templates, registries, autoscaling, regions, volumes, log forwarding and more.

## Setup

```php
<?php

require 'vendor/autoload.php';

use ToshY\BunnyNet\BunnyHttpClient;
use ToshY\BunnyNet\Enum\Endpoint;

$bunnyHttpClient = new BunnyHttpClient(
    client: new \Symfony\Component\HttpClient\Psr18Client(),
    // Provide the account API key.
    apiKey: '2cebf4f8-4bff-429f-86f6-bce2c2163d7e89fb0a86-a1b2-463c-a142-11eba8811989',
    baseUrl: Endpoint::BASE
);
```

## Usage

### Applications

#### [List Applications](https://docs.bunny.net/api-reference/magic-containers/applications/list-applications)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\ListApplications(
        query: [
            'nextCursor' => 'string',
            'limit' => 100,
        ],
    )
);
```

#### [Add Application](https://docs.bunny.net/api-reference/magic-containers/applications/add-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\AddApplication(
        body: [
            'name' => 'my-app',
            'runtimeType' => 'string',
            'terminationGracePeriodSeconds' => 30,
            'repositorySettings' => [
                'templateRepository' => 'string',
                'repositoryName' => 'string',
                'owner' => 'string',
            ],
            'autoScaling' => [
                'min' => 1,
                'max' => 5,
            ],
            'regionSettings' => [
                'allowedRegionIds' => ['string'],
                'requiredRegionIds' => ['string'],
                'maxAllowedRegions' => 1,
                'nodeSelectors' => [],
            ],
            'containerTemplates' => [
                [
                    'id' => 'string',
                    'name' => 'string',
                    'image' => 'string',
                    'imageName' => 'string',
                    'imageNamespace' => 'string',
                    'imageTag' => 'latest',
                    'imageDigest' => 'string',
                    'imageRegistryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
                    'imagePullPolicy' => 'string',
                    'entryPoint' => [
                        'command' => 'string',
                        'commandArray' => ['string'],
                        'arguments' => 'string',
                        'argumentsArray' => ['string'],
                        'workingDirectory' => 'string',
                    ],
                    'probes' => [
                        'startup' => [
                            'initialDelaySeconds' => 0,
                            'periodSeconds' => 10,
                            'timeoutSeconds' => 1,
                            'failureThreshold' => 3,
                            'successThreshold' => 1,
                            'httpGet' => [
                                'request' => [
                                    'path' => '/health',
                                    'portNumber' => 8080,
                                ],
                                'response' => [
                                    'expectedStatusCode' => '200',
                                ],
                            ],
                            'tcpSocket' => [
                                'request' => [
                                    'portNumber' => 8080,
                                ],
                            ],
                            'grpc' => [
                                'request' => [
                                    'portNumber' => 8080,
                                    'serviceName' => 'string',
                                ],
                            ],
                        ],
                        'readiness' => [
                            'initialDelaySeconds' => 0,
                            'periodSeconds' => 10,
                            'timeoutSeconds' => 1,
                            'failureThreshold' => 3,
                            'successThreshold' => 1,
                            'httpGet' => [
                                'request' => [
                                    'path' => '/ready',
                                    'portNumber' => 8080,
                                ],
                                'response' => [
                                    'expectedStatusCode' => '200',
                                ],
                            ],
                            'tcpSocket' => [
                                'request' => [
                                    'portNumber' => 8080,
                                ],
                            ],
                            'grpc' => [
                                'request' => [
                                    'portNumber' => 8080,
                                    'serviceName' => 'string',
                                ],
                            ],
                        ],
                        'liveness' => [
                            'initialDelaySeconds' => 0,
                            'periodSeconds' => 10,
                            'timeoutSeconds' => 1,
                            'failureThreshold' => 3,
                            'successThreshold' => 1,
                            'httpGet' => [
                                'request' => [
                                    'path' => '/live',
                                    'portNumber' => 8080,
                                ],
                                'response' => [
                                    'expectedStatusCode' => '200',
                                ],
                            ],
                            'tcpSocket' => [
                                'request' => [
                                    'portNumber' => 8080,
                                ],
                            ],
                            'grpc' => [
                                'request' => [
                                    'portNumber' => 8080,
                                    'serviceName' => 'string',
                                ],
                            ],
                        ],
                    ],
                    'environmentVariables' => [
                        [
                            'name' => 'ENV_VAR_NAME',
                            'value' => 'string',
                        ],
                    ],
                    'endpoints' => [
                        [
                            'displayName' => 'my-endpoint',
                            'cdn' => [
                                'isSslEnabled' => true,
                                'stickySessions' => [
                                    'enabled' => false,
                                    'sessionHeaders' => ['string'],
                                    'cookieName' => 'string',
                                ],
                                'pullZoneId' => 1,
                                'portMappings' => [
                                    [
                                        'containerPort' => 8080,
                                        'exposedPort' => 80,
                                        'protocols' => ['string'],
                                    ],
                                ],
                            ],
                            'anycast' => [
                                'type' => 'string',
                                'portMappings' => [
                                    [
                                        'containerPort' => 8080,
                                        'exposedPort' => 80,
                                        'protocols' => ['string'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'volumeMounts' => [
                        [
                            'name' => 'data',
                            'mountPath' => '/var/data',
                        ],
                    ],
                ],
            ],
            'volumes' => [
                [
                    'name' => 'data',
                    'size' => 10,
                ],
            ],
        ],
    )
);
```

#### [Get Application](https://docs.bunny.net/api-reference/magic-containers/applications/get-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Update Application](https://docs.bunny.net/api-reference/magic-containers/applications/update-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\UpdateApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        body: [
            // Same body structure as `Add Application`.
            'name' => 'my-app',
            'runtimeType' => 'string',
            'autoScaling' => [
                'min' => 1,
                'max' => 5,
            ],
            'regionSettings' => [
                'allowedRegionIds' => ['string'],
                'requiredRegionIds' => ['string'],
                'maxAllowedRegions' => 1,
                'nodeSelectors' => [],
            ],
            'containerTemplates' => [],
            'volumes' => [],
        ],
    )
);
```

#### [Patch Application](https://docs.bunny.net/api-reference/magic-containers/applications/patch-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\PatchApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        body: [
            // All keys are optional; same shape as `Add Application`.
            'name' => 'my-app',
            'autoScaling' => [
                'min' => 1,
                'max' => 5,
            ],
        ],
    )
);
```

#### [Delete Application](https://docs.bunny.net/api-reference/magic-containers/applications/delete-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\DeleteApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Deploy Application](https://docs.bunny.net/api-reference/magic-containers/applications/deploy-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\DeployApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Undeploy Application](https://docs.bunny.net/api-reference/magic-containers/applications/undeploy-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\UndeployApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Restart Application](https://docs.bunny.net/api-reference/magic-containers/applications/restart-application)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\RestartApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Get Application Overview](https://docs.bunny.net/api-reference/magic-containers/applications/get-application-overview)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplicationOverview(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Get Application Statistics](https://docs.bunny.net/api-reference/magic-containers/applications/get-application-statistics)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplicationStatistics(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        query: [
            'fromDate' => 'Y-m-d\TH:i:s',
            'toDate' => 'Y-m-d\TH:i:s',
            'granularity' => 'hour',
        ],
    )
);
```

#### [Get Application Usage Summary](https://docs.bunny.net/api-reference/magic-containers/applications/get-application-usage-summary)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Applications\GetApplicationUsageSummary(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

### Autoscaling Settings

#### [Get Application Autoscaling](https://docs.bunny.net/api-reference/magic-containers/autoscalingsettings/get-application-autoscaling)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\AutoscalingSettings\GetApplicationAutoscaling(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Update Application Autoscaling](https://docs.bunny.net/api-reference/magic-containers/autoscalingsettings/update-application-autoscaling)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\AutoscalingSettings\UpdateApplicationAutoscaling(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        body: [
            'min' => 1,
            'max' => 5,
        ],
    )
);
```

### Container Registries

#### [List Container Registries](https://docs.bunny.net/api-reference/magic-containers/containerregistries/list-container-registries)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\ListContainerRegistries()
);
```

#### [Add Container Registry](https://docs.bunny.net/api-reference/magic-containers/containerregistries/add-container-registry)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\AddContainerRegistry(
        body: [
            'displayName' => 'My Registry',
            'type' => 'string',
            'passwordCredentials' => [
                'userName' => 'string',
                'password' => 'string',
            ],
        ],
    )
);
```

#### [Get Container Registry](https://docs.bunny.net/api-reference/magic-containers/containerregistries/get-container-registry)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetContainerRegistry(
        registryId: 1,
    )
);
```

#### [Update Container Registry](https://docs.bunny.net/api-reference/magic-containers/containerregistries/update-container-registry)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\UpdateContainerRegistry(
        registryId: 1,
        body: [
            'displayName' => 'My Registry',
            'type' => 'string',
            'passwordCredentials' => [
                'userName' => 'string',
                'password' => 'string',
            ],
        ],
    )
);
```

#### [Delete Container Registry](https://docs.bunny.net/api-reference/magic-containers/containerregistries/delete-container-registry)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\DeleteContainerRegistry(
        registryId: 1,
    )
);
```

#### [List Container Images](https://docs.bunny.net/api-reference/magic-containers/containerregistries/list-container-images)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\ListContainerImages(
        body: [
            'registryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
        ],
    )
);
```

#### [List Container Image Tags](https://docs.bunny.net/api-reference/magic-containers/containerregistries/list-container-image-tags)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\ListContainerImageTags(
        body: [
            'registryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'imageName' => 'nginx',
            'imageNamespace' => 'library',
        ],
    )
);
```

#### [Get Container Image Tag Digest](https://docs.bunny.net/api-reference/magic-containers/containerregistries/get-container-image-digest)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetContainerImageTagDigest(
        body: [
            'registryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'imageName' => 'nginx',
            'imageNamespace' => 'library',
            'tag' => 'latest',
        ],
    )
);
```

#### [Get Container Config Suggestions](https://docs.bunny.net/api-reference/magic-containers/containerregistries/get-container-config-suggestions)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\GetContainerConfigSuggestions(
        body: [
            'registryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'imageName' => 'nginx',
            'imageNamespace' => 'library',
            'tag' => 'latest',
        ],
    )
);
```

#### [Search For Public Container Images](https://docs.bunny.net/api-reference/magic-containers/containerregistries/search-public-container-images)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\ContainerRegistries\SearchForPublicContainerImages(
        body: [
            'registryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'prefix' => 'nginx',
            'size' => 25,
            'page' => 1,
        ],
    )
);
```

### Containers

#### [Add Application Container Template](https://docs.bunny.net/api-reference/magic-containers/containers/add-container-template)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Containers\AddApplicationContainerTemplate(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        body: [
            'name' => 'string',
            'image' => 'string',
            'imageName' => 'nginx',
            'imageNamespace' => 'library',
            'imageTag' => 'latest',
            'imageDigest' => 'string',
            'imageRegistryId' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'imagePullPolicy' => 'string',
            'entryPoint' => [
                'command' => 'string',
                'commandArray' => ['string'],
                'arguments' => 'string',
                'argumentsArray' => ['string'],
                'workingDirectory' => 'string',
            ],
            'probes' => [
                'startup' => [
                    'initialDelaySeconds' => 0,
                    'periodSeconds' => 10,
                    'timeoutSeconds' => 1,
                    'failureThreshold' => 3,
                    'successThreshold' => 1,
                    'httpGet' => [
                        'request' => [
                            'path' => '/health',
                            'portNumber' => 8080,
                        ],
                        'response' => [
                            'expectedStatusCode' => '200',
                        ],
                    ],
                    'tcpSocket' => [
                        'request' => [
                            'portNumber' => 8080,
                        ],
                    ],
                    'grpc' => [
                        'request' => [
                            'portNumber' => 8080,
                            'serviceName' => 'string',
                        ],
                    ],
                ],
                'readiness' => [
                    'initialDelaySeconds' => 0,
                    'periodSeconds' => 10,
                    'timeoutSeconds' => 1,
                    'failureThreshold' => 3,
                    'successThreshold' => 1,
                    'httpGet' => [
                        'request' => [
                            'path' => '/ready',
                            'portNumber' => 8080,
                        ],
                        'response' => [
                            'expectedStatusCode' => '200',
                        ],
                    ],
                    'tcpSocket' => [
                        'request' => [
                            'portNumber' => 8080,
                        ],
                    ],
                    'grpc' => [
                        'request' => [
                            'portNumber' => 8080,
                            'serviceName' => 'string',
                        ],
                    ],
                ],
                'liveness' => [
                    'initialDelaySeconds' => 0,
                    'periodSeconds' => 10,
                    'timeoutSeconds' => 1,
                    'failureThreshold' => 3,
                    'successThreshold' => 1,
                    'httpGet' => [
                        'request' => [
                            'path' => '/live',
                            'portNumber' => 8080,
                        ],
                        'response' => [
                            'expectedStatusCode' => '200',
                        ],
                    ],
                    'tcpSocket' => [
                        'request' => [
                            'portNumber' => 8080,
                        ],
                    ],
                    'grpc' => [
                        'request' => [
                            'portNumber' => 8080,
                            'serviceName' => 'string',
                        ],
                    ],
                ],
            ],
            'environmentVariables' => [
                [
                    'name' => 'ENV_VAR_NAME',
                    'value' => 'string',
                ],
            ],
            'endpoints' => [
                [
                    'displayName' => 'my-endpoint',
                    'cdn' => [
                        'isSslEnabled' => true,
                        'stickySessions' => [
                            'enabled' => false,
                            'sessionHeaders' => ['string'],
                            'cookieName' => 'string',
                        ],
                        'pullZoneId' => 1,
                        'portMappings' => [
                            [
                                'containerPort' => 8080,
                                'exposedPort' => 80,
                                'protocols' => ['string'],
                            ],
                        ],
                    ],
                    'anycast' => [
                        'type' => 'string',
                        'portMappings' => [
                            [
                                'containerPort' => 8080,
                                'exposedPort' => 80,
                                'protocols' => ['string'],
                            ],
                        ],
                    ],
                ],
            ],
            'volumeMounts' => [
                [
                    'name' => 'data',
                    'mountPath' => '/var/data',
                ],
            ],
        ],
    )
);
```

#### [Get Application Container Template](https://docs.bunny.net/api-reference/magic-containers/containers/get-container-template)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Containers\GetApplicationContainerTemplate(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        containerId: 'b1b9d4f0-1234-4abc-8def-0123456789ab',
    )
);
```

#### [Patch Application Container Template](https://docs.bunny.net/api-reference/magic-containers/containers/patch-container-template)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Containers\PatchApplicationContainerTemplate(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        containerId: 'b1b9d4f0-1234-4abc-8def-0123456789ab',
        body: [
            // All keys are optional; same shape as `Add Application Container Template`.
            'name' => 'string',
            'imageTag' => 'latest',
        ],
    )
);
```

#### [Delete Application Container Template](https://docs.bunny.net/api-reference/magic-containers/containers/delete-container-template)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Containers\DeleteApplicationContainerTemplate(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        containerId: 'b1b9d4f0-1234-4abc-8def-0123456789ab',
    )
);
```

#### [Set Container Environment Variables](https://docs.bunny.net/api-reference/magic-containers/containers/set-container-environment-variables)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Containers\SetContainerEnvironmentVariables(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        containerId: 'b1b9d4f0-1234-4abc-8def-0123456789ab',
        body: [
            'ENV_VAR_NAME' => 'string',
            'ANOTHER_ENV_VAR' => 'string',
        ],
    )
);
```

### Endpoints

#### [List Application Endpoints](https://docs.bunny.net/api-reference/magic-containers/endpoints/list-application-endpoints)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\ListApplicationEndpoints(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Add Application Endpoint](https://docs.bunny.net/api-reference/magic-containers/endpoints/add-application-endpoint)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\AddApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        containerId: 'b1b9d4f0-1234-4abc-8def-0123456789ab',
        body: [
            'displayName' => 'my-endpoint',
            'cdn' => [
                'isSslEnabled' => true,
                'stickySessions' => [
                    'enabled' => false,
                    'sessionHeaders' => ['string'],
                    'cookieName' => 'string',
                ],
                'pullZoneId' => 1,
                'portMappings' => [
                    [
                        'containerPort' => 8080,
                        'exposedPort' => 80,
                        'protocols' => ['string'],
                    ],
                ],
            ],
            'anycast' => [
                'type' => 'string',
                'portMappings' => [
                    [
                        'containerPort' => 8080,
                        'exposedPort' => 80,
                        'protocols' => ['string'],
                    ],
                ],
            ],
        ],
    )
);
```

#### [Update Application Endpoint](https://docs.bunny.net/api-reference/magic-containers/endpoints/update-application-endpoint)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\UpdateApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        endpointId: 'c2c8e5d1-2345-4bcd-9ef0-123456789abc',
        body: [
            'displayName' => 'my-endpoint',
            'cdn' => [
                'isSslEnabled' => true,
                'stickySessions' => [
                    'enabled' => false,
                    'sessionHeaders' => ['string'],
                    'cookieName' => 'string',
                ],
                'pullZoneId' => 1,
                'portMappings' => [
                    [
                        'containerPort' => 8080,
                        'exposedPort' => 80,
                        'protocols' => ['string'],
                    ],
                ],
            ],
            'anycast' => [
                'type' => 'string',
                'portMappings' => [
                    [
                        'containerPort' => 8080,
                        'exposedPort' => 80,
                        'protocols' => ['string'],
                    ],
                ],
            ],
        ],
    )
);
```

#### [Delete Application Endpoint](https://docs.bunny.net/api-reference/magic-containers/endpoints/delete-application-endpoint)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Endpoints\DeleteApplication(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        endpointId: 'c2c8e5d1-2345-4bcd-9ef0-123456789abc',
    )
);
```

### Limits

#### [Get Limits](https://docs.bunny.net/api-reference/magic-containers/limits/get-user-limits)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Limits\GetLimits()
);
```

### Log Forwarding

#### [List Log Forwarding Configurations](https://docs.bunny.net/api-reference/magic-containers/log-forwarding/list-log-forwarding-configurations)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\ListLogForwardingConfigurations()
);
```

#### [Create Log Forwarding Configuration](https://docs.bunny.net/api-reference/magic-containers/log-forwarding/create-log-forwarding-configuration)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\CreateLogForwardingConfiguration(
        body: [
            'app' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'type' => 'syslog',
            'endpoint' => 'logs.example.com',
            'port' => 514,
            'token' => 'string',
            'format' => 'json',
            'enabled' => true,
        ],
    )
);
```

#### [Get Log Forwarding Configuration](https://docs.bunny.net/api-reference/magic-containers/log-forwarding/get-log-forwarding-configuration)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\GetLogForwardingConfiguration(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Update Log Forwarding Configuration](https://docs.bunny.net/api-reference/magic-containers/log-forwarding/update-log-forwarding-configuration)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\UpdateLogForwardingConfiguration(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        body: [
            'app' => '46d1703e-7d63-4138-83b1-78695bee5a07',
            'type' => 'syslog',
            'endpoint' => 'logs.example.com',
            'port' => 514,
            'token' => 'string',
            'format' => 'json',
            'enabled' => true,
        ],
    )
);
```

#### [Delete Log Forwarding Configuration](https://docs.bunny.net/api-reference/magic-containers/log-forwarding/delete-log-forwarding-configuration)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\LogForwarding\DeleteLogForwardingConfiguration(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

### Nodes

#### [List Nodes](https://docs.bunny.net/api-reference/magic-containers/nodes/list-nodes)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Nodes\ListNodes(
        query: [
            'nextCursor' => 'string',
            'limit' => 100,
        ],
    )
);
```

#### [List Nodes (Plain)](https://docs.bunny.net/api-reference/magic-containers/nodes/list-node-ips-plain)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Nodes\ListNodesPlain()
);
```

### Pods

#### [Recreate Pod](https://docs.bunny.net/api-reference/magic-containers/pods/recreate-pod)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Pods\RecreatePod(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        podId: 'd3d9f6e2-3456-4cde-aef1-23456789abcd',
    )
);
```

### Region Settings

#### [Get Application Region Settings](https://docs.bunny.net/api-reference/magic-containers/regionsettings/get-application-region-settings)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\RegionSettings\GetApplicationRegionSettings(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Update Application Region Settings](https://docs.bunny.net/api-reference/magic-containers/regionsettings/update-application-region-settings)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\RegionSettings\UpdateApplicationRegionSettings(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        body: [
            'allowedRegionIds' => ['string'],
            'requiredRegionIds' => ['string'],
            'maxAllowedRegions' => 1,
            'nodeSelectors' => [],
        ],
    )
);
```

### Regions

#### [List Regions](https://docs.bunny.net/api-reference/magic-containers/regions/list-regions)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Regions\ListRegions(
        query: [
            'nextCursor' => 'string',
            'limit' => 100,
        ],
    )
);
```

#### [Get Optimal Base Region](https://docs.bunny.net/api-reference/magic-containers/regions/get-optimal-base-region)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Regions\GetOptimalBaseRegion(
        query: [
            'cdnServerToken' => 'string',
        ],
    )
);
```

### Volumes

#### [List Volumes](https://docs.bunny.net/api-reference/magic-containers/volumes/list-volumes)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\ListVolumes(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
    )
);
```

#### [Update Volume](https://docs.bunny.net/api-reference/magic-containers/volumes/update-volume)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\UpdateVolume(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        volumeId: 'e4eaf7f3-4567-4def-bfe2-3456789abcde',
        body: [
            'name' => 'data',
            'size' => 20,
        ],
    )
);
```

#### [Detach Volume](https://docs.bunny.net/api-reference/magic-containers/volumes/detach-volume)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\DetachVolume(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        volumeId: 'e4eaf7f3-4567-4def-bfe2-3456789abcde',
    )
);
```

#### [Delete All Volume Instances](https://docs.bunny.net/api-reference/magic-containers/volumes/delete-all-volume-instances)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\DeleteAllVolumeInstances(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        volumeId: 'e4eaf7f3-4567-4def-bfe2-3456789abcde',
    )
);
```

#### [Delete Volume Instance](https://docs.bunny.net/api-reference/magic-containers/volumes/delete-volume-instance)

```php
$bunnyHttpClient->request(
    new \ToshY\BunnyNet\Model\Api\MagicContainers\Volumes\DeleteVolumeInstance(
        appId: '46d1703e-7d63-4138-83b1-78695bee5a07',
        volumeId: 'e4eaf7f3-4567-4def-bfe2-3456789abcde',
        instanceId: 'f5fbf8f4-5678-4ef0-cff3-456789abcdef',
    )
);
```

## Reference

* [Magic Containers API](https://docs.bunny.net/api-reference/magic-containers/overview)


