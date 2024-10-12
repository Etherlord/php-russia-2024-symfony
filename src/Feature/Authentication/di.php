<?php

declare(strict_types=1);

namespace App\Feature\Authentication;

use App\Feature\Authentication\Command\AuthenticateHandler;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(AuthenticateHandler::class)
        ->autoconfigure()
        ->autowire()
    ;
};
