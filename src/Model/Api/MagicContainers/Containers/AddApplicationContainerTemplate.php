<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\MagicContainers\Containers;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class AddApplicationContainerTemplate implements ModelInterface, BodyModelInterface
{
    /**
     * @param string $appId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly string $appId,
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'apps/%s/containers';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON_ALL,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'name', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'image', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'imageName', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'imageNamespace', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'imageTag', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'imageDigest', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'imageRegistryId', type: Type::STRING_TYPE, required: true),
            new AbstractParameter(name: 'imagePullPolicy', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'entryPoint', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'command', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'commandArray', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'arguments', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'argumentsArray', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'workingDirectory', type: Type::STRING_TYPE),
            ]),
            new AbstractParameter(name: 'probes', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'startup', type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'initialDelaySeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'periodSeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'timeoutSeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'failureThreshold', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'successThreshold', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'httpGet', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'path', type: Type::STRING_TYPE),
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                        ]),
                        new AbstractParameter(name: 'response', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'expectedStatusCode', type: Type::STRING_TYPE),
                        ]),
                    ]),
                    new AbstractParameter(name: 'tcpSocket', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                        ]),
                    ]),
                    new AbstractParameter(name: 'grpc', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                            new AbstractParameter(name: 'serviceName', type: Type::STRING_TYPE),
                        ]),
                    ]),
                ]),
                new AbstractParameter(name: 'readiness', type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'initialDelaySeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'periodSeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'timeoutSeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'failureThreshold', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'successThreshold', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'httpGet', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'path', type: Type::STRING_TYPE),
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                        ]),
                        new AbstractParameter(name: 'response', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'expectedStatusCode', type: Type::STRING_TYPE),
                        ]),
                    ]),
                    new AbstractParameter(name: 'tcpSocket', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                        ]),
                    ]),
                    new AbstractParameter(name: 'grpc', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                            new AbstractParameter(name: 'serviceName', type: Type::STRING_TYPE),
                        ]),
                    ]),
                ]),
                new AbstractParameter(name: 'liveness', type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'initialDelaySeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'periodSeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'timeoutSeconds', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'failureThreshold', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'successThreshold', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'httpGet', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'path', type: Type::STRING_TYPE),
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                        ]),
                        new AbstractParameter(name: 'response', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'expectedStatusCode', type: Type::STRING_TYPE),
                        ]),
                    ]),
                    new AbstractParameter(name: 'tcpSocket', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                        ]),
                    ]),
                    new AbstractParameter(name: 'grpc', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'request', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'portNumber', type: Type::INT_TYPE),
                            new AbstractParameter(name: 'serviceName', type: Type::STRING_TYPE),
                        ]),
                    ]),
                ]),
            ]),
            new AbstractParameter(name: 'environmentVariables', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'name', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'value', type: Type::STRING_TYPE),
                ]),
            ]),
            new AbstractParameter(name: 'endpoints', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'displayName', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'cdn', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'isSslEnabled', type: Type::BOOLEAN_TYPE),
                        new AbstractParameter(name: 'stickySessions', type: Type::OBJECT_TYPE, children: [
                            new AbstractParameter(name: 'enabled', type: Type::BOOLEAN_TYPE),
                            new AbstractParameter(name: 'sessionHeaders', type: Type::ARRAY_TYPE, required: true, children: [
                                new AbstractParameter(name: null, type: Type::STRING_TYPE),
                            ]),
                            new AbstractParameter(name: 'cookieName', type: Type::STRING_TYPE),
                        ]),
                        new AbstractParameter(name: 'pullZoneId', type: Type::INT_TYPE),
                        new AbstractParameter(name: 'portMappings', type: Type::ARRAY_TYPE, children: [
                            new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                                new AbstractParameter(name: 'containerPort', type: Type::INT_TYPE, required: true),
                                new AbstractParameter(name: 'exposedPort', type: Type::INT_TYPE),
                                new AbstractParameter(name: 'protocols', type: Type::ARRAY_TYPE, children: [
                                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                                ]),
                            ]),
                        ]),
                    ]),
                    new AbstractParameter(name: 'anycast', type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'type', type: Type::STRING_TYPE, required: true),
                        new AbstractParameter(name: 'portMappings', type: Type::ARRAY_TYPE, required: true, children: [
                            new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                                new AbstractParameter(name: 'containerPort', type: Type::INT_TYPE, required: true),
                                new AbstractParameter(name: 'exposedPort', type: Type::INT_TYPE),
                                new AbstractParameter(name: 'protocols', type: Type::ARRAY_TYPE, children: [
                                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                                ]),
                            ]),
                        ]),
                    ]),
                ]),
            ]),
            new AbstractParameter(name: 'volumeMounts', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'name', type: Type::STRING_TYPE, required: true),
                    new AbstractParameter(name: 'mountPath', type: Type::STRING_TYPE, required: true),
                ]),
            ]),
        ];
    }
}
