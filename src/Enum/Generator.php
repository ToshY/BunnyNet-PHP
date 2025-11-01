<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

/**
 * @internal
 */
enum Generator: string
{
    case BASE = 'Base';

    case EDGE_SCRIPTING = 'EdgeScripting';

    case EDGE_STORAGE = 'EdgeStorage';

    case LOGGING = 'Logging';

    case SHIELD = 'Shield';

    case STREAM = 'Stream';

    case ORIGIN_ERRORS = 'OriginErrors';
}
