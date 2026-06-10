<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|digits_between:7,10',
            'service_id' => 'required|exists:type_services,id',
            'recaptcha_token' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto válido.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.max' => 'El correo electrónico no puede exceder 255 caracteres.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 10 dígitos.',
            'service_id.required' => 'Debes seleccionar un servicio.',
            'service_id.exists' => 'El servicio seleccionado no es válido.',
            'recaptcha_token.required' => 'Verificación de seguridad requerida.',
        ];
    }

    protected function prepareForValidation()
    {
        // Limpiar el teléfono de espacios y caracteres especiales, mantener solo números
        if ($this->phone) {
            $this->merge([
                'phone' => preg_replace('/[^0-9]/', '', $this->phone)
            ]);
        }
    }
}