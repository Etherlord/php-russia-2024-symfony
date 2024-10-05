<?php

declare(strict_types=1);

namespace App\Http\ApiV1\Welcome;

use App\Feature\Welcome\GetWelcomeMessage;
use App\Infrastructure\MessageBus\Symfony\MessageBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/welcome', methods: ['GET'])]
    public function __invoke(MessageBus $messageBus): Response
    {
        return new Response(content: $messageBus->execute(new GetWelcomeMessage()));
    }
}
