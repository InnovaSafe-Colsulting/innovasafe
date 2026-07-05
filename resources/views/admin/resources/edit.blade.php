@extends('layouts.app')

@section('title', 'Editar Recurso')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-3">
                <a href="{{ route('admin.resources.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h1 class="text-xl font-bold text-gray-900">Editar Recurso</h1>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-base font-semibold text-gray-700">Información del Recurso</h2>
            </div>

            <form action="{{ route('admin.resources.update', [$resource->id, $type]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                {{-- Tipo (solo lectura) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Recurso</label>
                    <div class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 text-gray-600">
                        @if($type == 'blog') Blog
                        @else {{ $resourceTypes->firstWhere('id', $resource->resource_type_id)->resource ?? 'Documento' }}
                        @endif
                    </div>
                    @if($type != 'blog')
                        <input type="hidden" name="type_resource_id" value="{{ $resource->resource_type_id }}">
                    @endif
                </div>

                {{-- Título --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $resource->title) }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-400 @enderror">
                    @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                @if($type == 'blog')
                    {{-- Descripción --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-400 @enderror">{{ old('description', $resource->description) }}</textarea>
                        @error('description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Enlace --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Enlace <span class="text-red-500">*</span></label>
                        <input type="url" name="url_link" value="{{ old('url_link', $resource->url_link) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('url_link') border-red-400 @enderror"
                            placeholder="https://...">
                        @error('url_link')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Imagen --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Imagen <span class="text-gray-400 font-normal">(opcional)</span></label>
                        @if($resource->image)
                            <div class="mb-2 flex items-center gap-3">
                                <img src="{{ asset('storage/' . $resource->image) }}" alt="" class="h-16 w-16 rounded-lg object-cover border border-gray-200">
                                <span class="text-xs text-gray-400">Imagen actual — sube una nueva para reemplazarla</span>
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('image') border-red-400 @enderror">
                        <p class="mt-1 text-xs text-gray-400">JPEG, PNG, GIF — máx. 2MB</p>
                        @error('image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                @else
                    {{-- Archivo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo <span class="text-gray-400 font-normal">(opcional — deja vacío para mantener el actual)</span></label>
                        @if($resource->path)
                            <div class="mb-2 flex items-center gap-2">
                                <a href="{{ asset('storage/' . $resource->path) }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 hover:underline text-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Ver archivo actual
                                </a>
                            </div>
                        @endif
                        <input type="file" name="path"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('path') border-red-400 @enderror">
                        <p class="mt-1 text-xs text-gray-400">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX — máx. 10MB</p>
                        @error('path')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                @endif

                {{-- Estado --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado <span class="text-red-500">*</span></label>
                    <select name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-400 @enderror">
                        <option value="1" {{ old('status', $resource->status) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status', $resource->status) == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                @error('error')
                    <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ $message }}</div>
                @enderror

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.resources.index') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium transition">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
