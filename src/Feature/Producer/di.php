<?php

declare(strict_types=1);

namespace App\Feature\Producer;

use App\Feature\Producer\Command\SendTaskToConsumerHandler;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(SendTaskToConsumerHandler::class)
        ->args([
            '$rpcDsn' => '%env(RR_RPC)%',
        ])
        ->autoconfigure()
        ->autowire()
    ;
};
