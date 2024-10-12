<?php

declare(strict_types=1);

namespace App\Http\ApiV1\Authenticate;

use App\Feature\Authentication\Authenticate;
use App\Infrastructure\MessageBus\Symfony\MessageBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/authenticate', methods: ['POST'])]
    public function __invoke(MessageBus $messageBus): Response
    {
        return new Response(
            json_encode(['token' => $messageBus->execute(new Authenticate())]),
        );
    }
}
