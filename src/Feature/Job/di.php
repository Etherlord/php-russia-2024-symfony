<?php

declare(strict_types=1);

namespace App\Feature\Producer;

use App\Feature\Job\Consumer\ConsumerCommand;
use App\Feature\Job\Producer\Command\SendTaskToConsumerHandler;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(SendTaskToConsumerHandler::class)
        ->args([
            '$queue' => '%env(RR_JOB_QUEUE)%',
            '$rpcDsn' => '%env(RR_RPC)%',
        ])
        ->autoconfigure()
        ->autowire()
    ;

    $services
        ->set(ConsumerCommand::class)
        ->autoconfigure()
        ->autowire()
    ;
};
