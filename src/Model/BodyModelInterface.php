<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model;

interface BodyModelInterface
{
    /**
     * @return array<AbstractParameter>
     */
    public function getBody(): array;
}
