<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model\Client\Interface;

use Psr\Http\Message\ResponseInterface;

interface BunnyClientResponseInterface
{
    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * @return mixed
     */
    public function getContents(): mixed;
}
