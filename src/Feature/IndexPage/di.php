<?php

declare(strict_types=1);

namespace App\Feature\IndexPage;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $di->extension('twig', [
        'paths' => [__DIR__ => 'IndexPage'],
    ]);
};
