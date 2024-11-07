<?php

declare(strict_types=1);

namespace App\Feature\Job\Producer\Command;

use App\Feature\Job\Producer\SendTaskToConsumer;
use Spiral\Goridge\RPC\RPC;
use Spiral\RoadRunner\Jobs\Exception\JobsException;
use Spiral\RoadRunner\Jobs\Jobs;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class SendTaskToConsumerHandler
{
    /**
     * @param non-empty-string $rpcDsn
     */
    public function __construct(
        private string $rpcDsn,
    ) {
    }

    /**
     * @throws JobsException
     */
    #[AsMessageHandler]
    public function __invoke(SendTaskToConsumer $command): void
    {
        $jobs = new Jobs(RPC::create($this->rpcDsn));
        $queue = $jobs->connect('local');
        $task = $queue->create(
            name: 'ping',
            payload: $command->message,
        );

        $queue->dispatch($task);
    }
}
