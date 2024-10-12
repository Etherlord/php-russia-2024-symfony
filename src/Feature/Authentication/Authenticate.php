<?php

declare(strict_types=1);

namespace App\Feature\Authentication;

use App\Infrastructure\MessageBus\Message;

/**
 * @psalm-immutable
 * @implements Message<string>
 */
final readonly class Authenticate implements Message
{
}
