<?php

declare(strict_types=1);

namespace App\Http\ApiV1\SendTaskToConsumer;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @psalm-suppress MissingConstructor
 */
final class Request
{
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^[a-zA-Z0-9]+$/', message: 'Message must contains only symbols and numbers')]
    public string $message;
}
