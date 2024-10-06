<?php

declare(strict_types=1);

namespace App\Infrastructure\S3\Storage;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

/**
 * @psalm-internal App\Infrastructure\S3
 */
final readonly class S3FileStorage
{
    public function __construct(
        private S3Client $client,
    ) {
    }

    public function createBucket(string $bucket): void
    {
        $this->client->createBucket([
            'ACL' => 'private',
            'Bucket' => $bucket,
        ]);

        $this->client->putBucketPolicy([
            'Bucket' => $bucket,
            'Policy' => <<<JSON
                {
                    "Version": "2012-10-17",
                    "Statement": [
                        {
                            "Action": [
                                "s3:GetObject"
                            ],
                            "Effect": "Allow",
                            "Principal": {
                                "AWS": [
                                    "*"
                                ]
                            },
                            "Resource": [
                                "arn:aws:s3:::{$bucket}/*"
                            ],
                            "Sid": ""
                        }
                    ]
                }
                JSON,
        ]);
    }

    public function isBucketExist(string $bucket): bool
    {
        try {
            $this->client->headBucket([
                'Bucket' => $bucket,
            ]);

            return true;
        } catch (S3Exception $exception) {
            if ($exception->getStatusCode() === 404) {
                return false;
            }

            throw $exception;
        }
    }

    public function upload(
        string $bucket,
        string $filename,
        string $fileContent,
    ): void {
        $this->client->upload($bucket, $filename, $fileContent);
    }

    public function getPermanentDownloadUrl(string $bucket, string $filename): ?string
    {
        try {
            $objectUrl = $this->client->getObjectUrl(
                bucket: $bucket,
                key: $filename,
            );
        } catch (S3Exception $exception) {
            if ($exception->getStatusCode() === 404) {
                return null;
            }

            throw $exception;
        }

        return $objectUrl;
    }
}
