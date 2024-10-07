<?php

declare(strict_types=1);

namespace App\Feature\Consumer;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(ConsumerCommand::class)
        ->autoconfigure()
        ->autowire()
    ;
};
