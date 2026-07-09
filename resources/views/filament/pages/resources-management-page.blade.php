<x-filament-panels::page>
    <div>
        {{-- Botón crear --}}
        <div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
            <a href="{{ route('admin.resources.create') }}"
               style="display:inline-flex; align-items:center; gap:0.4rem; padding:0.5rem 1.2rem; background:#2563eb; color:#fff; border-radius:0.5rem; font-size:0.85rem; font-weight:600; text-decoration:none;">
                + Crear Recurso
            </a>
        </div>

        {{-- Tabla --}}
        @if($resources && $resources->count() > 0)
            <div style="overflow-x:auto; border-radius:0.75rem; border:1px solid #374151;">
                <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
                    <thead>
                        <tr style="background:#1f2937; color:#9ca3af; text-transform:uppercase; font-size:0.75rem;">
                            <th style="padding:0.75rem 1rem; text-align:left;">Título</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Descripción</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Link</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Imagen</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Archivo</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Tipo</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Estado</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Creado</th>
                            <th style="padding:0.75rem 1rem; text-align:left;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                            <tr style="border-top:1px solid #374151;">
                                <td style="padding:0.75rem 1rem; color:#f9fafb; font-weight:500;">{{ $resource->title }}</td>
                                <td style="padding:0.75rem 1rem; color:#d1d5db; max-width:200px;">
                                    {{ $resource->description ? Str::limit($resource->description, 50) : '-' }}
                                </td>
                                <td style="padding:0.75rem 1rem;">
                                    @if($resource->link)
                                        <a href="{{ $resource->link }}" target="_blank" style="color:#60a5fa;">{{ Str::limit($resource->link, 25) }}</a>
                                    @else
                                        <span style="color:#6b7280;">-</span>
                                    @endif
                                </td>
                                <td style="padding:0.75rem 1rem;">
                                    @if($resource->image)
                                        <img src="{{ asset('storage/' . $resource->image) }}" style="height:2.5rem; width:2.5rem; border-radius:0.375rem; object-fit:cover;">
                                    @else
                                        <span style="color:#6b7280;">-</span>
                                    @endif
                                </td>
                                <td style="padding:0.75rem 1rem;">
                                    @if($resource->path)
                                        <a href="{{ asset('storage/' . $resource->path) }}" target="_blank" style="color:#60a5fa;">Ver archivo</a>
                                    @else
                                        <span style="color:#6b7280;">-</span>
                                    @endif
                                </td>
                                <td style="padding:0.75rem 1rem;">
                                    <span style="padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.75rem; font-weight:600; background:{{ $resource->source_table == 'blog' ? '#4c1d95' : '#1e3a5f' }}; color:{{ $resource->source_table == 'blog' ? '#c4b5fd' : '#93c5fd' }};">
                                        {{ $resource->type_name }}
                                    </span>
                                </td>
                                <td style="padding:0.75rem 1rem;">
                                    @if($resource->status == 1)
                                        <span style="padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.75rem; font-weight:600; background:#14532d; color:#86efac;">Activo</span>
                                    @else
                                        <span style="padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.75rem; font-weight:600; background:#7f1d1d; color:#fca5a5;">Inactivo</span>
                                    @endif
                                </td>
                                <td style="padding:0.75rem 1rem; color:#9ca3af; white-space:nowrap;">
                                    {{ $resource->created_at ? \Carbon\Carbon::parse($resource->created_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td style="padding:0.75rem 1rem;">
                                    <div style="display:flex; gap:0.75rem; align-items:center;">
                                        <a href="{{ route('admin.resources.edit', [$resource->id, $resource->source_table]) }}"
                                           style="color:#60a5fa; font-weight:500; text-decoration:none;">Editar</a>
                                        <button onclick="confirmDelete({{ $resource->id }}, '{{ $resource->source_table }}', '{{ addslashes($resource->title) }}')"
                                                style="color:#f87171; font-weight:500; background:none; border:none; cursor:pointer; padding:0;">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align:center; padding:3rem; background:#1f2937; border-radius:0.75rem;">
                <p style="color:#9ca3af; margin-bottom:1rem;">No hay recursos registrados.</p>
                <a href="{{ route('admin.resources.create') }}"
                   style="padding:0.5rem 1.2rem; background:#2563eb; color:#fff; border-radius:0.5rem; font-size:0.85rem; font-weight:600; text-decoration:none;">
                    Crear Recurso
                </a>
            </div>
        @endif
    </div>

    {{-- Modal eliminación --}}
    <div id="deleteModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.6); align-items:center; justify-content:center;">
        <div style="background:#1f2937; border-radius:0.75rem; padding:1.5rem; max-width:28rem; width:90%; box-shadow:0 20px 60px rgba(0,0,0,0.5);">
            <h3 style="color:#f9fafb; font-size:1.1rem; font-weight:600; margin-bottom:0.75rem;">Confirmar eliminación</h3>
            <p style="color:#9ca3af; font-size:0.9rem; margin-bottom:1.5rem;">
                ¿Estás seguro de que quieres eliminar <strong id="resourceTitle" style="color:#f9fafb;"></strong>? Esta acción no se puede deshacer.
            </p>
            <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
                <button onclick="closeDeleteModal()"
                        style="padding:0.5rem 1rem; background:#374151; color:#d1d5db; border:none; border-radius:0.5rem; cursor:pointer; font-size:0.875rem;">
                    Cancelar
                </button>
                <button onclick="deleteResource()"
                        style="padding:0.5rem 1rem; background:#dc2626; color:#fff; border:none; border-radius:0.5rem; cursor:pointer; font-size:0.875rem; font-weight:600;">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let resourceToDelete = null;

        function confirmDelete(id, type, title) {
            resourceToDelete = { id, type };
            document.getElementById('resourceTitle').textContent = title;
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'flex';
        }

        function closeDeleteModal() {
            resourceToDelete = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        function deleteResource() {
            if (!resourceToDelete) return;
            fetch(`/admin/gestionar-recursos/${resourceToDelete.id}/${resourceToDelete.type}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { closeDeleteModal(); location.reload(); }
                else alert('Error al eliminar el recurso');
            })
            .catch(() => alert('Error al eliminar el recurso'));
        }
    </script>
</x-filament-panels::page>
