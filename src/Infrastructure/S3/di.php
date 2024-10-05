<?php

declare(strict_types=1);

namespace App\Infrastructure\S3;

use App\Infrastructure\S3\Command\UploadFileToS3Handler;
use App\Infrastructure\S3\Console\S3SetupCommand;
use App\Infrastructure\S3\Storage\S3FileStorage;
use Aws\S3\S3Client;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->set(S3Client::class)
        ->args([
            '$args' => [
                'region' => '%env(S3_REGION)%',
                'endpoint' => '%env(S3_ENDPOINT)%',
                'use_path_style_endpoint' => true,
                'credentials' => [
                    'key' => '%env(S3_USER)%',
                    'secret' => '%env(S3_PASSWORD)%',
                ],
            ],
        ])
    ;

    $services
        ->set(S3FileStorage::class)
        ->autoconfigure()
        ->autowire()
    ;

    $services
        ->set(S3SetupCommand::class)
        ->args([
            '$bucketName' => '%env(S3_BUCKET_NAME)%',
        ])
        ->autowire()
        ->autoconfigure()
    ;

    $services
        ->set(UploadFileToS3Handler::class)
        ->args([
            '$bucketName' => '%env(S3_BUCKET_NAME)%',
        ])
        ->autowire()
        ->autoconfigure()
    ;
};
