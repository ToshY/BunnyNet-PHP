<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model;

interface QueryModelInterface
{
    /**
     * @return array<AbstractParameter>
     */
    public function getQuery(): array;
}
