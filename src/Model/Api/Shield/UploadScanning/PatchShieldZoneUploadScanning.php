<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Shield\UploadScanning;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\BodyModelInterface;
use ToshY\BunnyNet\Model\ModelInterface;

class PatchShieldZoneUploadScanning implements ModelInterface, BodyModelInterface
{
    /**
     * @param int $shieldZoneId
     * @param array<string,mixed> $body
     */
    public function __construct(
        #[PathProperty]
        public readonly int $shieldZoneId,
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
        return 'shield/shield-zone/%d/upload-scanning';
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
            new AbstractParameter(name: 'shieldZoneId', type: Type::INT_TYPE),
            new AbstractParameter(name: 'isEnabled', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'csamScanningMode', type: Type::INT_TYPE),
            new AbstractParameter(name: 'antivirusScanningMode', type: Type::INT_TYPE),
        ];
    }
}
