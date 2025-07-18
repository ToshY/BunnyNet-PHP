<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\EdgeStorage\ManageFiles;

use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\HeaderProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Model\ModelInterface;

class UploadFile implements ModelInterface
{
    /**
     * @param string $storageZoneName
     * @param string $path
     * @param string $fileName
     * @param mixed $body
     * @param array<string,string> $headers
     */
    public function __construct(
        #[PathProperty]
        public readonly string $storageZoneName,
        #[PathProperty]
        public readonly string $path,
        #[PathProperty]
        public readonly string $fileName,
        #[BodyProperty]
        public readonly mixed $body,
        #[HeaderProperty]
        public readonly array $headers = [],
    ) {
    }

    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return '%s/%s/%s';
    }

    public function getHeaders(): array
    {
        return [
            Header::CONTENT_TYPE_OCTET_STREAM,
        ];
    }
}
