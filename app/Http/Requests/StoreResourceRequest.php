<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'type_resource_id' => 'required',
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];

        // Validaciones específicas según el tipo de recurso
        if ($this->type_resource_id === 'blog') {
            $rules['description'] = 'required|string|max:1000';
            $rules['link'] = 'required|url|max:500';
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['type_resource_id'] = 'required|exists:resources_types,id';
            $rules['path'] = 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'type_resource_id.required' => 'El tipo de recurso es obligatorio.',
            'type_resource_id.exists' => 'El tipo de recurso seleccionado no es válido.',
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria para recursos de blog.',
            'description.max' => 'La descripción no puede exceder los 1000 caracteres.',
            'link.required' => 'El enlace es obligatorio para recursos de blog.',
            'link.url' => 'El enlace debe ser una URL válida.',
            'link.max' => 'El enlace no puede exceder los 500 caracteres.',
            'path.required' => 'El archivo es obligatorio para documentos.',
            'path.file' => 'Debe seleccionar un archivo válido.',
            'path.mimes' => 'El archivo debe ser de tipo: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX.',
            'path.max' => 'El archivo no puede exceder los 10MB.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo: JPEG, PNG, JPG, GIF.',
            'image.max' => 'La imagen no puede exceder los 2MB.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser activo o inactivo.',
        ];
    }
}