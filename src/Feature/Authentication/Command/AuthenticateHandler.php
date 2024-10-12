<?php

declare(strict_types=1);

namespace App\Feature\Authentication\Command;

use App\Feature\Authentication\Authenticate;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class AuthenticateHandler
{
    public function __construct(
        private JWTEncoderInterface $jwtEncoder,
    ) {
    }

    /**
     * @throws JWTEncodeFailureException
     */
    #[AsMessageHandler]
    public function __invoke(Authenticate $message): ?string
    {
        return $this->jwtEncoder->encode([
            'username' => 'api',
        ]);
    }
}
