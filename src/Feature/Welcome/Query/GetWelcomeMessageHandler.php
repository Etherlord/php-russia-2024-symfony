<?php

declare(strict_types=1);

namespace App\Feature\Welcome\Query;

use App\Feature\Welcome\GetWelcomeMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class GetWelcomeMessageHandler
{
    public function __construct(
        private string $welcomeMessage,
        private LoggerInterface $logger,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(GetWelcomeMessage $query): string
    {
        $this->logger->info('Request welcome message');

        return json_encode($this->welcomeMessage);
    }
}
