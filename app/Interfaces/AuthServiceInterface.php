<?php

namespace App\Interfaces;

interface AuthServiceInterface
{
    public function login(array $credentials, bool $remember = false): bool;
    public function logout(): void;
}
