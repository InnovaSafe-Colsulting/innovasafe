@extends('layouts.app')

@section('title', 'Crear Recurso')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-3">
                <a href="{{ route('admin.resources.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h1 class="text-xl font-bold text-gray-900">Crear Recurso</h1>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-700">Información del Recurso</h2>
            </div>

            <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf

                {{-- Tipo de Recurso --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Recurso <span class="text-red-500">*</span></label>
                    <select name="type_resource_id" id="type_resource_id" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type_resource_id') border-red-400 @enderror"
                        onchange="toggleFields(this.value)">
                        <option value="">Seleccionar tipo</option>
                        <option value="blog" {{ old('type_resource_id') == 'blog' ? 'selected' : '' }}>Blog</option>
                        @foreach($resourceTypes as $type)
                            <option value="{{ $type->id }}" {{ old('type_resource_id') == $type->id ? 'selected' : '' }}>{{ $type->resource }}</option>
                        @endforeach
                    </select>
                    @error('type_resource_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Título --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-400 @enderror">
                    @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Campos Blog --}}
                <div id="fields-blog" class="space-y-5 hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                        @error('description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Enlace <span class="text-red-500">*</span></label>
                        <input type="url" name="url_link" value="{{ old('url_link') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('url_link') border-red-400 @enderror"
                            placeholder="https://...">
                        @error('url_link')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen <span class="text-gray-400 font-normal">(opcional)</span></label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('image') border-red-400 @enderror">
                        <p class="mt-1 text-xs text-gray-400">JPEG, PNG, GIF — máx. 2MB</p>
                        @error('image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Campos Documento --}}
                <div id="fields-document" class="space-y-5 hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo <span class="text-red-500">*</span></label>
                        <input type="file" name="path"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('path') border-red-400 @enderror">
                        <p class="mt-1 text-xs text-gray-400">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX — máx. 10MB</p>
                        @error('path')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Estado --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado <span class="text-red-500">*</span></label>
                    <select name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-400 @enderror">
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                @error('error')
                    <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ $message }}</div>
                @enderror

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.resources.index') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium transition">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition">Crear Recurso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleFields(value) {
    document.getElementById('fields-blog').classList.add('hidden');
    document.getElementById('fields-document').classList.add('hidden');

    if (value === 'blog') {
        document.getElementById('fields-blog').classList.remove('hidden');
    } else if (value !== '') {
        document.getElementById('fields-document').classList.remove('hidden');
    }
}

// Restaurar estado si hay old input
document.addEventListener('DOMContentLoaded', () => {
    const val = document.getElementById('type_resource_id').value;
    if (val) toggleFields(val);
});
</script>
@endsection
