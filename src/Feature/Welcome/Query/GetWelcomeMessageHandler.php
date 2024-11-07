<?php

declare(strict_types=1);

namespace App\Feature\Welcome\Query;

use App\Feature\Welcome\GetWelcomeMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class GetWelcomeMessageHandler
{
    public function __construct(
        private string $welcomeMessage,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(GetWelcomeMessage $query): string
    {
        return $this->welcomeMessage;
    }
}
