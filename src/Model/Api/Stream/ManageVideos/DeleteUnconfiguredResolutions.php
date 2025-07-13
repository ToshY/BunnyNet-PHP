<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Api\Stream\ManageVideos;

use ToshY\BunnyNet\Enum\Header;
use ToshY\BunnyNet\Enum\Method;
use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Model\AbstractParameter;
use ToshY\BunnyNet\Model\ModelInterface;
use ToshY\BunnyNet\Model\QueryModelInterface;

class DeleteUnconfiguredResolutions implements ModelInterface, QueryModelInterface
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
            new AbstractParameter(name: 'resolutionsToDelete', type: Type::STRING_TYPE),
            new AbstractParameter(name: 'deleteNonConfiguredResolutions', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'deleteOriginal', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'deleteMp4Files', type: Type::BOOLEAN_TYPE),
            new AbstractParameter(name: 'dryRun', type: Type::BOOLEAN_TYPE),
        ];
    }
}
