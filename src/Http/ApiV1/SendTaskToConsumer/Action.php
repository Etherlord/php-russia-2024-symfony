<?php

declare(strict_types=1);

namespace App\Http\ApiV1\SendTaskToConsumer;

use App\Feature\Job\Producer\SendTaskToConsumer;
use App\Infrastructure\MessageBus\Symfony\MessageBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class Action
{
    #[Route(path: '/send-task-to-consumer', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] Request $request, MessageBus $messageBus): Response
    {
        $messageBus->execute(new SendTaskToConsumer($request->message));

        return new Response();
    }
}
