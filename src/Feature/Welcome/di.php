<?php

declare(strict_types=1);

namespace App\Feature\Welcome;

use App\Feature\Welcome\Query\GetWelcomeMessageHandler;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(GetWelcomeMessageHandler::class)
        ->args([
            '$welcomeMessage' => '%env(WELCOME_MESSAGE)%',
        ])
        ->autoconfigure()
        ->autowire()
    ;
};
