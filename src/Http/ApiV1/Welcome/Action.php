<?php

declare(strict_types=1);

namespace App\Http\ApiV1\Welcome;

use App\Feature\Welcome\GetWelcomeMessage;
use App\Infrastructure\MessageBus\Symfony\MessageBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/welcome', methods: ['GET'])]
    public function __invoke(MessageBus $messageBus): JsonResponse
    {
        return new JsonResponse($messageBus->execute(new GetWelcomeMessage()));
    }
}
