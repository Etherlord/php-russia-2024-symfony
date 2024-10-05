<?php

declare(strict_types=1);

namespace App\Http;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->load(__NAMESPACE__ . '\\', __DIR__ . '/**/Action.php')
        ->tag('controller.service_arguments')
    ;
};
