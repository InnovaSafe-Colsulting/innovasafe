<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Recaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip reCAPTCHA validation in local environment for development
        if (app()->environment('local')) {
            return;
        }

        $response = Http::withoutVerifying()->asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
        ]);

        $body = $response->json();

        Log::info('reCAPTCHA response', $body);

        if (!($body['success'] ?? false) || ($body['score'] ?? 0) < 0.5) {
            $fail('La verificación de seguridad falló. Intenta nuevamente.');
        }
    }
}
