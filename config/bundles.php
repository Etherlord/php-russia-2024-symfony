<?php

declare(strict_types=1);

use Baldinof\RoadRunnerBundle\BaldinofRoadRunnerBundle;
use Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

return [
    FrameworkBundle::class => ['all' => true],
    BaldinofRoadRunnerBundle::class => ['all' => true],
    MonologBundle::class => ['all' => true],
    TwigBundle::class => ['all' => true],
    SecurityBundle::class => ['all' => true],
    LexikJWTAuthenticationBundle::class => ['all' => true],
];
