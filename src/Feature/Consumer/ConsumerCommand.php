<?php

declare(strict_types=1);

namespace App\Feature\Consumer;

use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\Jobs\Consumer;
use Spiral\RoadRunner\Jobs\Exception\ReceivedTaskException;
use Spiral\RoadRunner\Jobs\Exception\SerializationException;
use Spiral\RoadRunner\Jobs\Task\ReceivedTaskInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'consume')]
final class ConsumerCommand extends Command
{
    public function __construct(
        private readonly LoggerInterface $logger,
        ?string $name = null,
    ) {
        parent::__construct($name);
    }

    /**
     * @throws SerializationException
     * @throws ReceivedTaskException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $consumer = new Consumer();

        /** @var ReceivedTaskInterface $task */
        while ($task = $consumer->waitTask()) {
            try {
                $name = $task->getName();
                $payload = $task->getPayload();

                match ($name) {
                    'ping' => $this->logger->info(\sprintf('PONG = %s', $payload)),
                    default => $this->logger->info('Unknown command')
                };

                $task->ack();
            } catch (\Throwable $e) {
                $task->requeue($e);
            }
        }

        return self::SUCCESS;
    }
}
