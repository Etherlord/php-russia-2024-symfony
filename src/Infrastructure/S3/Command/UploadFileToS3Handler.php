<?php

declare(strict_types=1);

namespace App\Infrastructure\S3\Command;

use App\Infrastructure\S3\Storage\S3FileStorage;
use App\Infrastructure\S3\UploadFileToS3;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class UploadFileToS3Handler
{
    public function __construct(
        private S3FileStorage $storage,
        private string $bucketName,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(UploadFileToS3 $command): string
    {
        $this->storage->upload(
            bucket: $this->bucketName,
            filename: $command->file->getClientOriginalName(),
            fileContent: $command->file->getContent(),
        );

        return $this->storage->getPermanentDownloadUrl($this->bucketName, $command->file->getClientOriginalName());
    }
}
