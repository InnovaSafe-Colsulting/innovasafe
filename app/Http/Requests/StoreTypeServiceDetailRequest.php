<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTypeServiceDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'module'          => 'required|string|max:150',
            'type_module'     => 'required|in:Basico,Adicional',
            'type_service_id' => 'required|exists:type_services,id',
            'status'          => 'required|in:1,0',
        ];
    }

    public function messages(): array
    {
        return [
            'module.required'          => 'El nombre del módulo es obligatorio.',
            'module.max'               => 'El módulo no puede superar 150 caracteres.',
            'type_module.required'     => 'El tipo de módulo es obligatorio.',
            'type_module.in'           => 'El tipo debe ser Básico o Adicional.',
            'type_service_id.required' => 'El servicio es obligatorio.',
            'type_service_id.exists'   => 'El servicio seleccionado no existe.',
            'status.required'          => 'El estado es obligatorio.',
            'status.in'                => 'El estado debe ser 1 o 0.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}
