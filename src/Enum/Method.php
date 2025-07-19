<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Enum;

/**
 * @internal
 */
enum Method: string
{
    case GET = 'GET';

    case POST = 'POST';

    case PUT = 'PUT';

    case PATCH = 'PATCH';

    case DELETE = 'DELETE';
}
