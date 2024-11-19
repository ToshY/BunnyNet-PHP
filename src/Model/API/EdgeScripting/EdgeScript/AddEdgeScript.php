<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\EdgeScripting\EdgeScript;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointBodyInterface;
use ToshY\BunnyNet\Model\EndpointInterface;

class AddEdgeScript implements EndpointInterface, EndpointBodyInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'compute/script';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
            Header::CONTENT_TYPE_JSON,
        ];
    }

    public function getBody(): array
    {
        return [
            new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Code', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ScriptType', type: Type::INT_TYPE),
            new AbstractParameter(name: 'CreateLinkedPullZone', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'LinkedPullZoneName', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'Integration', type: Type::ARRAY_TYPE, children: [
                new AbstractParameter(name: 'IntegrationId', type: Type::INT_TYPE),
                new AbstractParameter(name: 'RepositorySettings', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: 'Id', type: Type::INT_TYPE),
                    new AbstractParameter(name: 'Name', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'Private', type: Type::BOOLEAN_TYPE),
                    new AbstractParameter(name: 'TemplateUrl', type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'DeployConfiguration', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: 'Branch', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'InstallCommand', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'BuildCommand', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'EntryFile', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'CreateWorkflow', type: Type::BOOLEAN_TYPE),
                ]),
            ]),
        ];
    }
}
