<?php

declare(strict_types=1);

namespace App\Http\ApiV1;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing): void {
    $routing
        ->import(__DIR__, 'attribute')
        ->prefix($prefix = '/api/v1', false)
        ->defaults(['prefix' => $prefix])
        ->format('json')
    ;
};
