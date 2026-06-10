<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function attempt(array $credentials, bool $remember = false): bool;
    public function logout(): void;
}
