<?php

declare(strict_types=1);

use ComposerUnused\ComposerUnused\Configuration\Configuration;
use ComposerUnused\ComposerUnused\Configuration\NamedFilter;

return static fn(Configuration $config): Configuration => $config
    ->addNamedFilter(NamedFilter::fromString('ext-ctype'))
    ->addNamedFilter(NamedFilter::fromString('ext-iconv'))
    ->addNamedFilter(NamedFilter::fromString('baldinof/roadrunner-bundle'))
    ->addNamedFilter(NamedFilter::fromString('symfony/console'))
    ->addNamedFilter(NamedFilter::fromString('symfony/dotenv'))
    ->addNamedFilter(NamedFilter::fromString('symfony/flex'))
    ->addNamedFilter(NamedFilter::fromString('symfony/monolog-bundle'))
    ->addNamedFilter(NamedFilter::fromString('symfony/runtime'))
    ->addNamedFilter(NamedFilter::fromString('symfony/twig-bundle'))
    ->addNamedFilter(NamedFilter::fromString('symfony/validator'))
    ->addNamedFilter(NamedFilter::fromString('symfony/yaml'))
;
