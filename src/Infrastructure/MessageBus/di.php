<?php

declare(strict_types=1);

namespace App\Infrastructure\MessageBus;

use App\Infrastructure\MessageBus\Symfony\MessageBus;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(MessageBus::class)
        ->autoconfigure()
        ->autowire()
    ;
};
