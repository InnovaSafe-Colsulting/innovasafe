<x-filament-panels::page>
<style>
.pl-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
.pl-card-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-wrap:wrap; gap:.75rem;
}
.pl-card-header h2 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }

.pl-table-wrap { overflow-x:auto; }
table.pl-table { width:100%; border-collapse:collapse; font-size:.82rem; }
table.pl-table thead tr { background:#0d1117; }
table.pl-table th {
    padding:.75rem 1rem; text-align:left;
    font-size:.7rem; font-weight:600; color:#64748b;
    text-transform:uppercase; letter-spacing:.05em; white-space:nowrap;
}
table.pl-table tbody tr { border-top:1px solid #1e293b; transition:background .15s; }
table.pl-table tbody tr:hover { background:#0d1117; }
table.pl-table td { padding:.75rem 1rem; color:#cbd5e1; vertical-align:middle; }
table.pl-table td.pl-name { color:#f1f5f9; font-weight:500; }

.badge { display:inline-flex; align-items:center; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:600; white-space:nowrap; }
.badge-green { background:#14532d; color:#4ade80; }
.badge-red   { background:#7f1d1d; color:#f87171; }

.btn-primary {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.5rem 1rem; border-radius:.5rem; border:none; cursor:pointer;
    background:#1d4ed8; color:#fff; font-size:.82rem; font-weight:600; transition:background .15s;
}
.btn-primary:hover { background:#1e40af; }
.btn-cancel {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.5rem 1rem; border-radius:.5rem; border:1px solid #334155;
    cursor:pointer; background:transparent; color:#94a3b8; font-size:.82rem; font-weight:600; transition:background .15s;
}
.btn-cancel:hover { background:#1e293b; }
.btn-danger {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.5rem 1rem; border-radius:.5rem; border:none; cursor:pointer;
    background:#991b1b; color:#fca5a5; font-size:.82rem; font-weight:600; transition:background .15s;
}
.btn-danger:hover { background:#7f1d1d; }
.btn-icon {
    display:inline-flex; align-items:center; justify-content:center;
    width:1.9rem; height:1.9rem; border-radius:.4rem; border:none; cursor:pointer; transition:background .15s;
}
.btn-edit { background:#1e3a5f; color:#60a5fa; }
.btn-edit:hover { background:#1e40af; }
.btn-del  { background:#7f1d1d; color:#f87171; }
.btn-del:hover  { background:#991b1b; }
.btn-actions { display:flex; align-items:center; gap:.4rem; }

.pl-empty { text-align:center; padding:3rem 1rem; color:#475569; }

.pl-overlay {
    position:fixed; inset:0; z-index:9999;
    background:rgba(0,0,0,.65); display:flex; align-items:center; justify-content:center; padding:1rem;
}
.pl-modal {
    background:#111827; border:1px solid #1e293b; border-radius:.875rem;
    width:100%; max-width:580px; max-height:90vh; overflow-y:auto;
    box-shadow:0 20px 60px rgba(0,0,0,.6);
}
.pl-modal-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:1rem 1.25rem; border-bottom:1px solid #1e293b;
}
.pl-modal-header h3 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }
.pl-modal-body { padding:1.25rem; }
.pl-modal-footer {
    display:flex; justify-content:flex-end; gap:.75rem;
    padding:1rem 1.25rem; border-top:1px solid #1e293b;
}

.pl-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
.pl-form-group { display:flex; flex-direction:column; gap:.3rem; }
.pl-form-group.full { grid-column:1/-1; }
.pl-form-group label { font-size:.75rem; font-weight:500; color:#94a3b8; }
.pl-form-group input,
.pl-form-group select,
.pl-form-group textarea {
    background:#0d1117; border:1px solid #1e293b; border-radius:.4rem;
    padding:.5rem .75rem; color:#f1f5f9; font-size:.82rem; outline:none; transition:border-color .15s;
}
.pl-form-group textarea { resize:vertical; min-height:70px; }
.pl-form-group input:focus,
.pl-form-group select:focus,
.pl-form-group textarea:focus { border-color:#3b82f6; }
.pl-form-group .err { font-size:.72rem; color:#f87171; margin-top:.15rem; }

@media (max-width:768px) {
    .pl-table-wrap { display:none; }
    .pl-mobile-list { display:block; }
    .pl-mobile-card { border-top:1px solid #1e293b; padding:1rem 1.25rem; }
    .pl-mobile-card .mc-name { font-size:.9rem; font-weight:600; color:#f1f5f9; margin-bottom:.5rem; }
    .pl-mobile-card .mc-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:.4rem; font-size:.78rem; }
    .pl-mobile-card .mc-label { color:#64748b; }
    .pl-mobile-card .mc-actions { display:flex; gap:.5rem; margin-top:.75rem; }
    .pl-form-grid { grid-template-columns:1fr; }
}
@media (min-width:769px) { .pl-mobile-list { display:none; } }
</style>

<div class="pl-card">
    <div class="pl-card-header">
        <h2>Planes</h2>
        <button class="btn-primary" wire:click="openCreate">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Nuevo plan
        </button>
    </div>

    @if(empty($plans))
        <div class="pl-empty">No hay planes registrados.</div>
    @else

    {{-- Desktop --}}
    <div class="pl-table-wrap">
        <table class="pl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Moneda</th>
                    <th>Período</th>
                    <th>Servicios</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $p)
                <tr>
                    <td style="color:#475569;">{{ $p->id }}</td>
                    <td class="pl-name">{{ $p->name }}</td>
                    <td style="max-width:220px;font-size:.78rem;color:#94a3b8;">{{ $p->description ?: '-' }}</td>
                    <td style="white-space:nowrap;">${{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->currency }}</td>
                    <td>{{ ucfirst($p->billing_period) }}</td>
                    <td style="font-size:.75rem;color:#94a3b8;">
                        @if(!empty($p->services))
                            {{ implode(', ', $p->services) }}
                        @else
                            <span style="color:#475569;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $p->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $p->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-actions">
                            <button class="btn-icon btn-edit" wire:click="openEdit({{ $p->id }})" title="Editar">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                            </button>
                            <button class="btn-icon btn-del" wire:click="confirmDelete({{ $p->id }})" title="Eliminar">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile --}}
    <div class="pl-mobile-list">
        @foreach($plans as $p)
        <div class="pl-mobile-card">
            <div class="mc-name">{{ $p->name }}</div>
            <div class="mc-row"><span class="mc-label">Precio</span><span>${{ number_format($p->price, 0, ',', '.') }}</span></div>
            <div class="mc-row"><span class="mc-label">Período</span><span>{{ ucfirst($p->billing_period) }}</span></div>
            <div class="mc-row">
                <span class="mc-label">Servicios</span>
                <span style="font-size:.75rem;">{{ !empty($p->services) ? implode(', ', $p->services) : '—' }}</span>
            </div>
            <div class="mc-row">
                <span class="mc-label">Estado</span>
                <span class="badge {{ $p->is_active ? 'badge-green' : 'badge-red' }}">
                    {{ $p->is_active ? 'Activo' : 'Inactivo' }}
                </span>
            </div>
            <div class="mc-actions">
                <button class="btn-icon btn-edit" wire:click="openEdit({{ $p->id }})">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                </button>
                <button class="btn-icon btn-del" wire:click="confirmDelete({{ $p->id }})">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    @endif
</div>

{{-- Create / Edit Modal --}}
@if($showModal)
<div class="pl-overlay" wire:click.self="closeModal">
    <div class="pl-modal">
        <div class="pl-modal-header">
            <h3>{{ $editingId ? 'Editar plan' : 'Nuevo plan' }}</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="pl-modal-body">
            <div class="pl-form-grid">
                <div class="pl-form-group full">
                    <label>Nombre <span style="color:#f87171">*</span></label>
                    <input type="text" wire:model="name" placeholder="Ej: Plan Starter">
                    @if(isset($formErrors['name']))<div class="err">{{ $formErrors['name'] }}</div>@endif
                </div>
                <div class="pl-form-group full">
                    <label>Descripción</label>
                    <textarea wire:model="description" placeholder="Descripción del plan..."></textarea>
                </div>
                <div class="pl-form-group">
                    <label>Slug</label>
                    <input type="text" wire:model="planSlug" placeholder="Auto-generado del nombre">
                </div>
                <div class="pl-form-group">
                    <label>Precio <span style="color:#f87171">*</span></label>
                    <input type="number" wire:model="price" placeholder="Ej: 197900">
                    @if(isset($formErrors['price']))<div class="err">{{ $formErrors['price'] }}</div>@endif
                </div>
                <div class="pl-form-group">
                    <label>Moneda</label>
                    <select wire:model="currency">
                        <option value="COP">COP</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="pl-form-group">
                    <label>Período de facturación</label>
                    <select wire:model="billing_period">
                        <option value="monthly">Mensual</option>
                        <option value="quarterly">Trimestral</option>
                        <option value="semiannual">Semestral</option>
                        <option value="annual">Anual</option>
                        <option value="custom">Personalizado</option>
                    </select>
                </div>
                <div class="pl-form-group">
                    <label>Estado</label>
                    <select wire:model="is_active">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                @if(count($services) > 0)
                <div class="pl-form-group full">
                    <label>Servicios incluidos</label>
                    <div style="display:flex;flex-direction:column;gap:.4rem;margin-top:.25rem;">
                        @foreach($services as $svc)
                        <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:#cbd5e1;font-weight:400;cursor:pointer;">
                            <input type="checkbox" wire:model="selectedServices" value="{{ $svc->id }}"
                                style="width:1rem;height:1rem;accent-color:#3b82f6;cursor:pointer;">
                            {{ $svc->name }}
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="pl-modal-footer">
            <button class="btn-cancel" wire:click="closeModal">Cancelar</button>
            <button class="btn-primary" wire:click="save">{{ $editingId ? 'Actualizar' : 'Guardar' }}</button>
        </div>
    </div>
</div>
@endif

{{-- Delete modal --}}
@if($showDeleteModal)
<div class="pl-overlay" wire:click.self="closeModal">
    <div class="pl-modal" style="max-width:380px;">
        <div class="pl-modal-header">
            <h3>Confirmar eliminación</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="pl-modal-body">
            <p style="color:#cbd5e1;font-size:.85rem;margin:0;">
                ¿Estás seguro de que deseas eliminar este plan? Esta acción no se puede deshacer.
            </p>
        </div>
        <div class="pl-modal-footer">
            <button class="btn-cancel" wire:click="closeModal">Cancelar</button>
            <button class="btn-danger" wire:click="delete">Eliminar</button>
        </div>
    </div>
</div>
@endif
</x-filament-panels::page>
