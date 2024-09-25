<?php

declare(strict_types=1);

namespace App\Feature\IndexPage\Http;

use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing): void {
    $routing
        ->add('index', '/')
        ->methods(['GET'])
        ->controller(TemplateController::class)
        ->defaults([
            'template' => '@IndexPage/Http/index.html.twig',
            'maxAge' => 86400,
            'sharedAge' => 86400,
            'private' => false,
        ])
    ;
};
