<?php

declare(strict_types=1);

namespace App\Http\ApiV1\UploadFile;

use App\Infrastructure\MessageBus\Symfony\MessageBus;
use App\Infrastructure\S3\UploadFileToS3;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/upload-file', methods: ['POST'])]
    public function __invoke(#[MapUploadedFile] UploadedFile $file, MessageBus $messageBus): JsonResponse
    {
        return new JsonResponse([
            'url' => $messageBus->execute(new UploadFileToS3($file)),
        ]);
    }
}
