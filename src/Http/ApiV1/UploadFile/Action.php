<?php

declare(strict_types=1);

namespace App\Http\ApiV1\UploadFile;

use App\Infrastructure\MessageBus\Symfony\MessageBus;
use App\Infrastructure\S3\UploadFileToS3;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/upload-file', methods: ['POST'])]
    public function __invoke(#[MapUploadedFile] UploadedFile $file, MessageBus $messageBus): Response
    {
        $messageBus->execute(new UploadFileToS3($file));

        return new Response();
    }
}
