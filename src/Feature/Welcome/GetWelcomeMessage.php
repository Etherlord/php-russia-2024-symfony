<?php

declare(strict_types=1);

namespace App\Feature\Welcome;

use App\Infrastructure\MessageBus\Message;

/**
 * @psalm-immutable
 * @implements Message<string>
 */
final readonly class GetWelcomeMessage implements Message
{
}
