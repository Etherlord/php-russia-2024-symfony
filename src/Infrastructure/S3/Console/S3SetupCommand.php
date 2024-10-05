<?php

declare(strict_types=1);

namespace App\Infrastructure\S3\Console;

use App\Infrastructure\S3\Storage\S3FileStorage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 's3:setup')]
final class S3SetupCommand extends Command
{
    public function __construct(
        private readonly S3FileStorage $storage,
        private readonly string $bucketName,
        ?string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->storage->isBucketExist($this->bucketName)) {
            $this->storage->createBucket($this->bucketName);
        }

        return self::SUCCESS;
    }
}
