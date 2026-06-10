<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {}

    public function login(array $credentials, bool $remember = false): bool
    {
        return $this->authRepository->attempt($credentials, $remember);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
