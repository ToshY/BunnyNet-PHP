<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\API\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\EndpointInterface;
use ToshY\BunnyNet\Model\EndpointQueryInterface;

class DeleteUnconfiguredResolutions implements EndpointInterface, EndpointQueryInterface
{
    public function getMethod(): Method
    {
        return Method::POST;
    }

    public function getPath(): string
    {
        return 'library/%d/videos/%s/resolutions/cleanup';
    }

    public function getHeaders(): array
    {
        return [
            Header::ACCEPT_JSON,
        ];
    }

    public function getQuery(): array
    {
        return [
            new AbstractParameter(name: 'resolutionsToDelete', type: Type::STRING_TYPE, required: false),
            new AbstractParameter(name: 'deleteNonConfiguredResolutions', type: Type::BOOLEAN_TYPE, required: false),
            new AbstractParameter(name: 'deleteOriginal', type: Type::BOOLEAN_TYPE, required: false),
            new AbstractParameter(name: 'deleteMp4Files', type: Type::BOOLEAN_TYPE, required: false),
            new AbstractParameter(name: 'dryRun', type: Type::BOOLEAN_TYPE, required: false),
        ];
    }
}
