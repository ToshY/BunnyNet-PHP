<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\Waf;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class UpdateCustomWafRuleByPatch implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $id
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $id,
        #[BodyProperty]
        public readonly array $body = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::PATCH;
    }

    public function getPath(): string
    {
        return 'shield/waf/custom-rule/%d';
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
            new AbstractParameter(name: 'ruleName', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ruleDescription', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'ruleConfiguration', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'actionType', type: Type::INT_TYPE),
                new AbstractParameter(name: 'variableTypes', type: Type::OBJECT_TYPE, children: [
                    new AbstractParameter(name: 'REQUEST_URI', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_URI_RAW', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ARGS', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ARGS_COMBINED_SIZE', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ARGS_GET', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ARGS_GET_NAMES', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ARGS_POST', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'ARGS_POST_NAMES', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'FILES_NAMES', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'GEO', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REMOTE_ADDR', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'QUERY_STRING', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_BASENAME', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_BODY', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_COOKIES_NAMES', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_COOKIES', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_FILENAME', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_HEADERS_NAMES', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_HEADERS', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_LINE', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_METHOD', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'REQUEST_PROTOCOL', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'RESPONSE_BODY', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'RESPONSE_HEADERS', type: Type::STRING_TYPE),
                    new AbstractParameter(name: 'RESPONSE_STATUS', type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'operatorType', type: Type::INT_TYPE),
                new AbstractParameter(name: 'severityType', type: Type::INT_TYPE),
                new AbstractParameter(name: 'transformationTypes', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::INT_TYPE),
                ]),
                new AbstractParameter(name: 'value', type: Type::STRING_TYPE),
            ]),
        ];
    }
}
