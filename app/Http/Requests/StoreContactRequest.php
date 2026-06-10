<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\Recaptcha;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'names' => 'required|regex:/^[\pL\s]+$/u',
            'last_names' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email',
            'cellphone' => 'required|regex:/^[0-9]+$/',
            'service_id' => 'required|exists:type_services,id',
            'message' => 'nullable|max:1000',
            'recaptcha_token' => ['required', new Recaptcha],
        ];
    }

    public function messages(): array
    {
        return [
            'names.required' => 'Los nombres son obligatorios.',
            'names.regex' => 'Los nombres solo pueden contener letras y espacios.',
            'last_names.required' => 'Los apellidos son obligatorios.',
            'last_names.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'cellphone.required' => 'El número telefónico es obligatorio.',
            'cellphone.regex' => 'El teléfono solo puede contener números.',
            'service_id.required' => 'Selecciona un servicio de interés.',
            'service_id.exists' => 'El servicio seleccionado no es válido.',
            'message.max' => 'El mensaje no puede superar los 1000 caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
