<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Model;

use ToshY\BunnyNet\Enum\Type;

interface ParameterInterface
{
    public function getName(): string|null;

    public function getType(): Type;

    public function isRequired(): bool;
}
