<?php

declare(strict_types=1);

namespace App\Infrastructure\Jwt\LexikJWTIntegration;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

final class User implements JWTUserInterface
{
    public static function createFromPayload($username, array $payload): self
    {
        return new self();
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return 'api';
    }
}
