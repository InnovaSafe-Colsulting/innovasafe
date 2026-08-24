<x-filament-panels::page>
<style>
.ban-wrap { width:100%; }
.ban-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
.ban-card-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-wrap:wrap; gap:.75rem; }
.ban-card-header h2 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }
.btn-new { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem 1rem; background:#1d4ed8; color:#fff; border:none; border-radius:.5rem; font-size:.8rem; font-weight:600; cursor:pointer; text-decoration:none; }
.btn-new:hover { background:#1e40af; }
.ban-table-wrap { overflow-x:auto; }
table.ban-table { width:100%; border-collapse:collapse; font-size:.82rem; }
table.ban-table thead tr { background:#0d1117; }
table.ban-table th { padding:.75rem 1rem; text-align:left; font-size:.7rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; white-space:nowrap; }
table.ban-table tbody tr { border-top:1px solid #1e293b; transition:background .15s; }
table.ban-table tbody tr:hover { background:#0d1117; }
table.ban-table td { padding:.75rem 1rem; color:#cbd5e1; vertical-align:middle; }
.ban-preview { width:120px; height:50px; object-fit:cover; border-radius:.375rem; border:1px solid #1e293b; }
.status-btn { display:inline-flex; align-items:center; gap:.3rem; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:600; border:none; cursor:pointer; transition:opacity .15s; }
.status-btn:hover { opacity:.8; }
.status-on  { background:#14532d; color:#4ade80; }
.status-off { background:#7f1d1d; color:#f87171; }
.aff-actions { display:flex; align-items:center; gap:.4rem; }
.btn-icon { display:inline-flex; align-items:center; justify-content:center; width:1.9rem; height:1.9rem; border-radius:.4rem; border:none; cursor:pointer; transition:background .15s; }
.btn-edit { background:#1e3a5f; color:#60a5fa; }
.btn-edit:hover { background:#1e40af; }
.btn-del { background:#7f1d1d; color:#f87171; }
.btn-del:hover { background:#991b1b; }
.ban-empty { text-align:center; padding:3rem 1rem; color:#475569; }
</style>

<div class="ban-wrap">
    <div class="ban-card">
        <div class="ban-card-header">
            <h2>Listado de Banners</h2>
            <a href="{{ route('filament.admin.pages.banners-crear-page') }}" class="btn-new">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Crear Banner
            </a>
        </div>

        @if(count($banners) === 0)
            <div class="ban-empty">
                <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="margin:0 auto .75rem;display:block;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 21h18M3.75 3h16.5A.75.75 0 0121 3.75v13.5a.75.75 0 01-.75.75H3.75A.75.75 0 013 17.25V3.75A.75.75 0 013.75 3z"/>
                </svg>
                No hay banners registrados.
            </div>
        @else
        <div class="ban-table-wrap">
            <table class="ban-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Posición</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td style="color:#475569;">{{ $banner->id }}</td>
                        <td style="color:#f1f5f9;font-weight:500;">{{ $banner->name }}</td>
                        <td>{{ $banner->position }}</td>
                        <td>
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->name }}" class="ban-preview">
                        </td>
                        <td>
                            <button class="status-btn {{ $banner->status ? 'status-on' : 'status-off' }}"
                                wire:click="toggleStatus({{ $banner->id }})">
                                {{ $banner->status ? 'Activo' : 'Inactivo' }}
                            </button>
                        </td>
                        <td>
                            <div class="aff-actions">
                                <a href="{{ route('filament.admin.pages.banners-editar-page', ['id' => $banner->id]) }}" class="btn-icon btn-edit" title="Editar">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                </a>
                                <button class="btn-icon btn-del" title="Eliminar"
                                    wire:click="confirmDelete({{ $banner->id }})">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- Modal confirmar borrado --}}
@if($showDeleteModal)
<div style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.65);display:flex;align-items:center;justify-content:center;padding:1rem;">
    <div style="background:#111827;border:1px solid #1e293b;border-radius:.875rem;width:100%;max-width:380px;padding:1.5rem;">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;">
            <div style="width:2.5rem;height:2.5rem;background:#7f1d1d;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#f87171" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            </div>
            <div>
                <p style="font-size:.9rem;font-weight:600;color:#f1f5f9;margin:0;">¿Eliminar banner?</p>
                <p style="font-size:.78rem;color:#64748b;margin:.25rem 0 0;">Esta acción no se puede deshacer.</p>
            </div>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <button wire:click="closeDeleteModal" style="padding:.45rem 1rem;background:#1e293b;color:#94a3b8;border:none;border-radius:.5rem;font-size:.82rem;cursor:pointer;">Cancelar</button>
            <button wire:click="delete" style="padding:.45rem 1rem;background:#dc2626;color:#fff;border:none;border-radius:.5rem;font-size:.82rem;font-weight:600;cursor:pointer;">Eliminar</button>
        </div>
    </div>
</div>
@endif
</x-filament-panels::page>
