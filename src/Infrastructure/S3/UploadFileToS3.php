<?php

declare(strict_types=1);

namespace App\Infrastructure\S3;

use App\Infrastructure\MessageBus\Message;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @psalm-immutable
 * @implements Message<string>
 */
final readonly class UploadFileToS3 implements Message
{
    public function __construct(
        public UploadedFile $file,
    ) {
    }
}
