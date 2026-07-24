@extends('layouts.app')

@section('title', 'Gestión de Recursos')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Gestión de Recursos</h1>
                        <p class="text-sm text-gray-500 mt-1">Administra los blogs, descargables y guías prácticas del sitio.</p>
                    </div>
                    <a href="{{ route('admin.resources.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Crear Recurso
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filtro por tipo --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 px-6 py-4">
            <div class="flex flex-wrap gap-6">
                @foreach($resourceTypes as $type)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="filter_type" value="{{ strtolower($type->resource) === 'blog' ? 'blog' : $type->id }}" class="text-blue-600" {{ $loop->first ? 'checked' : '' }} onchange="filterTable(this.value)">
                        <span class="text-sm font-medium text-gray-700 flex items-center gap-1">
                            @if($type->id == 2)
                                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            @elseif(strtolower($type->resource) === 'blog')
                                <svg class="w-4 h-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 13h6M9 17h4"/></svg>
                            @else
                                <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @endif
                            {{ $type->resource }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Tablas --}}
        @foreach($resourceTypes as $type)
            @php $isBlog = strtolower($type->resource) === 'blog'; @endphp
            <div id="table-{{ $isBlog ? 'blog' : $type->id }}" class="{{ $loop->first ? '' : 'hidden' }} bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-3 border-b border-gray-100">
                    <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">{{ $type->resource }}</h2>
                </div>

                @if($isBlog)
                    @if($blogs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enlace</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Creado</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($blogs as $blog)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3">
                                                @if($blog->image)
                                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="h-12 w-12 rounded-lg object-cover">
                                                @else
                                                    <div class="h-12 w-12 rounded-lg bg-purple-50 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $blog->title }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-500 max-w-xs">{{ Str::limit($blog->description, 60) }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($blog->url_link)
                                                    <a href="{{ $blog->url_link }}" target="_blank" class="text-blue-600 hover:underline">{{ Str::limit($blog->url_link, 30) }}</a>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $blog->created_at }}</td>
                                            <td class="px-4 py-3">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer" {{ $blog->status ? 'checked' : '' }}
                                                        onchange="toggleStatus({{ $blog->id }}, 'blog', this.checked ? 1 : 0)">
                                                    <div class="w-10 h-5 bg-gray-300 peer-checked:bg-green-500 rounded-full transition peer-focus:ring-2 peer-focus:ring-green-300 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition peer-checked:after:translate-x-5"></div>
                                                </label>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('admin.resources.edit', [$blog->id, 'blog']) }}" class="text-blue-600 hover:text-blue-800" title="Editar">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                    </a>
                                                    <button onclick="confirmDelete({{ $blog->id }}, 'blog', '{{ addslashes($blog->title) }}')" class="text-red-500 hover:text-red-700" title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-400">
                            <svg class="mx-auto w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/></svg>
                            <p class="text-sm">No hay blogs creados.</p>
                        </div>
                    @endif
                @else
                    @php $filtered = $documents->where('resource_type_id', $type->id); @endphp
                    @if($filtered->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Archivo</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Creado</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($filtered as $doc)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $doc->title }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($doc->path)
                                                    <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                        Descargar
                                                    </a>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $doc->created_at }}</td>
                                            <td class="px-4 py-3">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" class="sr-only peer" {{ $doc->status ? 'checked' : '' }}
                                                        onchange="toggleStatus({{ $doc->id }}, 'document', this.checked ? 1 : 0)">
                                                    <div class="w-10 h-5 bg-gray-300 peer-checked:bg-green-500 rounded-full transition peer-focus:ring-2 peer-focus:ring-green-300 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition peer-checked:after:translate-x-5"></div>
                                                </label>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('admin.resources.edit', [$doc->id, 'document']) }}" class="text-blue-600 hover:text-blue-800" title="Editar">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                    </a>
                                                    <button onclick="confirmDelete({{ $doc->id }}, 'document', '{{ addslashes($doc->title) }}')" class="text-red-500 hover:text-red-700" title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-400">
                            <svg class="mx-auto w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-sm">No hay {{ strtolower($type->resource) }} creados.</p>
                        </div>
                    @endif
                @endif
            </div>
        @endforeach

    </div>
</div>

{{-- Modal Eliminar --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="fixed inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-xl w-full max-w-md mx-4 z-10 p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">¿Desea eliminar este recurso?</h3>
                <p class="text-sm text-gray-500 mt-1">El recurso <span id="deleteTitle" class="font-medium text-gray-800"></span> será eliminado permanentemente. <span class="text-red-600 font-medium">Una vez borrado no se podrá recuperar.</span></p>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button onclick="closeDeleteModal()" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium transition">No</button>
            <button onclick="deleteResource()" class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition">Sí, eliminar</button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden px-5 py-3 rounded-lg shadow-lg text-sm font-medium text-white transition-all"></div>

<script>
let deleteTarget = null;

function filterTable(value) {
    @foreach($resourceTypes as $type)
        @php $tid = strtolower($type->resource) === 'blog' ? 'blog' : $type->id; @endphp
        document.getElementById('table-{{ $tid }}').classList.add('hidden');
    @endforeach
    document.getElementById('table-' + value).classList.remove('hidden');
}

function toggleStatus(id, type, status) {
    fetch(`/admin/gestionar-recursos/${id}/${type}/status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status })
    }).then(r => r.json()).then(data => {
        showToast(data.success ? 'Estado actualizado.' : 'Error al actualizar.', data.success ? 'green' : 'red');
    });
}

function confirmDelete(id, type, title) {
    deleteTarget = { id, type };
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    deleteTarget = null;
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

function deleteResource() {
    if (!deleteTarget) return;
    fetch(`/admin/gestionar-recursos/${deleteTarget.id}/${deleteTarget.type}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    }).then(r => r.json()).then(data => {
        closeDeleteModal();
        showToast(data.message, data.success ? 'green' : 'red');
        if (data.success) setTimeout(() => location.reload(), 1200);
    });
}

function showToast(msg, color) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = `fixed bottom-6 right-6 z-50 px-5 py-3 rounded-lg shadow-lg text-sm font-medium text-white bg-${color}-600`;
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDeleteModal(); });
</script>
@endsection
