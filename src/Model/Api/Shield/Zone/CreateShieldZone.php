<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\Zone;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class CreateShieldZone implements ModelInterface, BodyModelInterface
{
    /**
     * @param array<string,mixed> $body
     */
    public function __construct(
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
        return 'shield/shield-zone';
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
            new AbstractParameter(name: 'shieldZone', type: Type::OBJECT_TYPE, children: [
                new AbstractParameter(name: 'shieldZoneId', type: Type::INT_TYPE),
                new AbstractParameter(name: 'premiumPlan', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'learningMode', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'learningModeUntil', type: Type::STRING_TYPE),
                new AbstractParameter(name: 'wafEnabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'wafExecutionMode', type: Type::INT_TYPE),
                new AbstractParameter(name: 'wafDisabledRules', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'wafLogOnlyRules', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'wafRequestHeaderLoggingEnabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'wafRequestIgnoredHeaders', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::STRING_TYPE),
                ]),
                new AbstractParameter(name: 'wafRealtimeThreatIntelligenceEnabled', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'wafProfileId', type: Type::INT_TYPE),
                new AbstractParameter(name: 'wafEngineConfig', type: Type::ARRAY_TYPE, children: [
                    new AbstractParameter(name: null, type: Type::OBJECT_TYPE, children: [
                        new AbstractParameter(name: 'name', type: Type::STRING_TYPE, required: true),
                        new AbstractParameter(name: 'valueEncoded', type: Type::STRING_TYPE, required: true),
                    ]),
                ]),
                new AbstractParameter(name: 'dDoSShieldSensitivity', type: Type::INT_TYPE),
                new AbstractParameter(name: 'dDoSExecutionMode', type: Type::INT_TYPE),
                new AbstractParameter(name: 'dDoSChallengeWindow', type: Type::INT_TYPE),
                new AbstractParameter(name: 'blockVpn', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'blockTor', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'blockDatacentre', type: Type::BOOLEAN_TYPE),
                new AbstractParameter(name: 'whitelabelResponsePages', type: Type::BOOLEAN_TYPE),
            ]),
            new AbstractParameter(name: 'pullZoneId', type: Type::INT_TYPE, required: true),
        ];
    }
}
