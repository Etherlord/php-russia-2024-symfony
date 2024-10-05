<?php

declare(strict_types=1);

namespace App\Infrastructure\MessageBus\Symfony;

use App\Infrastructure\MessageBus\Message;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessageBus
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    /**
     * @template TResult
     * @template TMessage of Message<TResult>|object
     * @param TMessage $message
     * @return (TMessage is Message ? TResult : mixed)
     */
    public function execute(object $message): mixed
    {
        /** @var TResult */
        return $this->handle($message);
    }
}
