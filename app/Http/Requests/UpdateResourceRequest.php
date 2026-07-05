<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $isBlog = $this->route('type') === 'blog';

        $rules = [
            'title'  => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];

        if ($isBlog) {
            $rules['description'] = 'required|string|max:1000';
            $rules['url_link']    = 'required|url|max:500';
            $rules['image']       = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['type_resource_id'] = 'required|exists:resources_types,id';
            $rules['path']             = 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'       => 'El título es obligatorio.',
            'title.max'            => 'El título no puede exceder 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'url_link.required'    => 'El enlace es obligatorio.',
            'url_link.url'         => 'El enlace debe ser una URL válida.',
            'path.file'            => 'Debe seleccionar un archivo válido.',
            'path.mimes'           => 'El archivo debe ser PDF, DOC, DOCX, XLS, XLSX, PPT o PPTX.',
            'path.max'             => 'El archivo no puede exceder 10MB.',
            'image.image'          => 'El archivo debe ser una imagen.',
            'image.mimes'          => 'La imagen debe ser JPEG, PNG, JPG o GIF.',
            'image.max'            => 'La imagen no puede exceder 2MB.',
            'status.required'      => 'El estado es obligatorio.',
        ];
    }
}
