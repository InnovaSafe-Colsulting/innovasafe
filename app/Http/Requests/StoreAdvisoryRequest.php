<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\Recaptcha;

class StoreAdvisoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone' => preg_replace('/\s+/', '', $this->phone),
        ]);
    }

    public function rules(): array
    {
        return [
            'names' => 'required|regex:/^[\pL\s]+$/u',
            'last_names' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]+$/',
            'type_service' => 'required|array|min:1',
            'type_service.*' => 'exists:type_services,id',
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
            'phone.required' => 'El número telefónico es obligatorio.',
            'phone.regex' => 'El teléfono solo puede contener números.',
            'type_service.required' => 'Selecciona al menos un tipo de servicio.',
            'type_service.array'    => 'El tipo de servicio debe ser un arreglo.',
            'type_service.min'      => 'Selecciona al menos un tipo de servicio.',
            'type_service.*.exists' => 'Uno de los servicios seleccionados no es válido.',
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
