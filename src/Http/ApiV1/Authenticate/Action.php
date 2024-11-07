<?php

declare(strict_types=1);

namespace App\Http\ApiV1\Authenticate;

use App\Feature\Authentication\Authenticate;
use App\Infrastructure\MessageBus\Symfony\MessageBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/authenticate', methods: ['POST'])]
    public function __invoke(MessageBus $messageBus): JsonResponse
    {
        return new JsonResponse(
            ['token' => $messageBus->execute(new Authenticate())],
        );
    }
}
