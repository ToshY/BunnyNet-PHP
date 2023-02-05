<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Helper;

use ToshY\BunnyNet\Exception\FileDoesNotExistException;

class EndpointHelper
{
    /**
     * @throws FileDoesNotExistException
     * @return false|resource
     */
    public static function openFileStream(string $filePath)
    {
        $fileRealPath = realpath($filePath);
        if ($fileRealPath === false) {
            throw new FileDoesNotExistException(
                sprintf(
                    FileDoesNotExistException::MESSAGE,
                    $filePath
                )
            );
        }

        return fopen($fileRealPath, 'r');
    }
}
