<?php

declare(strict_types=1);

namespace App\Feature\Producer;

use App\Infrastructure\MessageBus\Message;

/**
 * @psalm-immutable
 * @implements Message<void>
 */
final readonly class SendTaskToConsumer implements Message
{
    public function __construct(
        public string $message,
    ) {
    }
}
