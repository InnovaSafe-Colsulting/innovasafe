<x-filament-panels::page>
<style>
.pm-wrap { width:100%; }

/* Card */
.pm-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
.pm-card-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-wrap:wrap; gap:.75rem;
}
.pm-card-header h2 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }

/* Table */
.pm-table-wrap { overflow-x:auto; }
table.pm-table { width:100%; border-collapse:collapse; font-size:.82rem; }
table.pm-table thead tr { background:#0d1117; }
table.pm-table th {
    padding:.75rem 1rem; text-align:left;
    font-size:.7rem; font-weight:600; color:#64748b;
    text-transform:uppercase; letter-spacing:.05em; white-space:nowrap;
}
table.pm-table tbody tr { border-top:1px solid #1e293b; transition:background .15s; }
table.pm-table tbody tr:hover { background:#0d1117; }
table.pm-table td { padding:.75rem 1rem; color:#cbd5e1; vertical-align:middle; }
table.pm-table td.pm-name { color:#f1f5f9; font-weight:500; }

/* Badges */
.badge { display:inline-flex; align-items:center; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:600; white-space:nowrap; }
.badge-green  { background:#14532d; color:#4ade80; }
.badge-red    { background:#7f1d1d; color:#f87171; }
.badge-gray   { background:#1e293b; color:#94a3b8; }

/* Buttons */
.btn-primary {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.5rem 1rem; border-radius:.5rem; border:none; cursor:pointer;
    background:#1d4ed8; color:#fff; font-size:.82rem; font-weight:600;
    transition:background .15s;
}
.btn-primary:hover { background:#1e40af; }
.btn-icon {
    display:inline-flex; align-items:center; justify-content:center;
    width:1.9rem; height:1.9rem; border-radius:.4rem; border:none; cursor:pointer; transition:background .15s;
}
.btn-edit { background:#1e3a5f; color:#60a5fa; }
.btn-edit:hover { background:#1e40af; }
.btn-del  { background:#7f1d1d; color:#f87171; }
.btn-del:hover  { background:#991b1b; }
.btn-actions { display:flex; align-items:center; gap:.4rem; }

/* Empty */
.pm-empty { text-align:center; padding:3rem 1rem; color:#475569; }

/* Modal overlay */
.pm-overlay {
    position:fixed; inset:0; z-index:9999;
    background:rgba(0,0,0,.65); display:flex; align-items:center; justify-content:center; padding:1rem;
}
.pm-modal {
    background:#111827; border:1px solid #1e293b; border-radius:.875rem;
    width:100%; max-width:560px; max-height:90vh; overflow-y:auto;
    box-shadow:0 20px 60px rgba(0,0,0,.6);
}
.pm-modal-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:1rem 1.25rem; border-bottom:1px solid #1e293b;
}
.pm-modal-header h3 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }
.pm-modal-body { padding:1.25rem; }
.pm-modal-footer {
    display:flex; justify-content:flex-end; gap:.75rem;
    padding:1rem 1.25rem; border-top:1px solid #1e293b;
}

/* Form */
.pm-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
.pm-form-group { display:flex; flex-direction:column; gap:.3rem; }
.pm-form-group.full { grid-column:1/-1; }
.pm-form-group label { font-size:.75rem; font-weight:500; color:#94a3b8; }
.pm-form-group input,
.pm-form-group select {
    background:#0d1117; border:1px solid #1e293b; border-radius:.4rem;
    padding:.5rem .75rem; color:#f1f5f9; font-size:.82rem; outline:none;
    transition:border-color .15s;
}
.pm-form-group input:focus,
.pm-form-group select:focus { border-color:#3b82f6; }
.pm-form-group .err { font-size:.72rem; color:#f87171; margin-top:.15rem; }
.pm-section-label {
    font-size:.72rem; font-weight:600; color:#64748b;
    text-transform:uppercase; letter-spacing:.05em;
    grid-column:1/-1; margin-top:.5rem; padding-top:.75rem;
    border-top:1px solid #1e293b;
}

/* Btn cancel */
.btn-cancel {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.5rem 1rem; border-radius:.5rem; border:1px solid #334155;
    cursor:pointer; background:transparent; color:#94a3b8; font-size:.82rem; font-weight:600;
    transition:background .15s;
}
.btn-cancel:hover { background:#1e293b; }
.btn-danger {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.5rem 1rem; border-radius:.5rem; border:none; cursor:pointer;
    background:#991b1b; color:#fca5a5; font-size:.82rem; font-weight:600;
    transition:background .15s;
}
.btn-danger:hover { background:#7f1d1d; }

/* Mobile cards */
@media (max-width:768px) {
    .pm-table-wrap { display:none; }
    .pm-mobile-list { display:block; }
    .pm-mobile-card { border-top:1px solid #1e293b; padding:1rem 1.25rem; }
    .pm-mobile-card .mc-name { font-size:.9rem; font-weight:600; color:#f1f5f9; margin-bottom:.5rem; }
    .pm-mobile-card .mc-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:.4rem; font-size:.78rem; }
    .pm-mobile-card .mc-label { color:#64748b; }
    .pm-mobile-card .mc-actions { display:flex; gap:.5rem; margin-top:.75rem; }
    .pm-form-grid { grid-template-columns:1fr; }
}
@media (min-width:769px) {
    .pm-mobile-list { display:none; }
}
</style>

<div class="pm-wrap">

    {{-- Table card --}}
    <div class="pm-card">
        <div class="pm-card-header">
            <h2>Tipos de Pago</h2>
            <button class="btn-primary" wire:click="openCreate">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Nuevo tipo
            </button>
        </div>

        @if(empty($payments))
            <div class="pm-empty">No hay tipos de pago registrados.</div>
        @else

        {{-- Desktop --}}
        <div class="pm-table-wrap">
            <table class="pm-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Banco</th>
                        <th>Titular</th>
                        <th>NIT</th>
                        <th>Cuenta</th>
                        <th>Celular</th>
                        <th>Valor</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                    <tr>
                        <td style="color:#475569;">{{ $p->id }}</td>
                        <td class="pm-name">{{ $p->name }}</td>
                        <td>{{ $p->bank ?: '-' }}</td>
                        <td>{{ $p->holder ?: '-' }}</td>
                        <td>{{ $p->nit ?: '-' }}</td>
                        <td>
                            @if($p->account_number)
                                <div style="font-size:.75rem;">{{ $p->account_type }}</div>
                                <div style="font-size:.72rem;color:#475569;">{{ $p->account_number }}</div>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $p->cellphone ?: '-' }}</td>
                        <td style="white-space:nowrap;">
                            @if($p->value)
                                ${{ number_format($p->value, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $p->status == '1' ? 'badge-green' : 'badge-red' }}">
                                {{ $p->status == '1' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-actions">
                                <button class="btn-icon btn-edit" wire:click="openEdit({{ $p->id }})" title="Editar">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                    </svg>
                                </button>
                                <button class="btn-icon btn-del" wire:click="confirmDelete({{ $p->id }})" title="Eliminar">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile --}}
        <div class="pm-mobile-list">
            @foreach($payments as $p)
            <div class="pm-mobile-card">
                <div class="mc-name">{{ $p->name }}</div>
                <div class="mc-row"><span class="mc-label">Banco</span><span>{{ $p->bank ?: '-' }}</span></div>
                <div class="mc-row"><span class="mc-label">Titular</span><span>{{ $p->holder ?: '-' }}</span></div>
                <div class="mc-row"><span class="mc-label">Celular</span><span>{{ $p->cellphone ?: '-' }}</span></div>
                <div class="mc-row">
                    <span class="mc-label">Estado</span>
                    <span class="badge {{ $p->status == '1' ? 'badge-green' : 'badge-red' }}">
                        {{ $p->status == '1' ? 'Activo' : 'Inactivo' }}
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
    <div class="pm-overlay" wire:click.self="closeModal">
        <div class="pm-modal">
            <div class="pm-modal-header">
                <h3>{{ $editingId ? 'Editar tipo de pago' : 'Nuevo tipo de pago' }}</h3>
                <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="pm-modal-body">
                <div class="pm-form-grid">
                    {{-- Nombre --}}
                    <div class="pm-form-group full">
                        <label>Nombre <span style="color:#f87171">*</span></label>
                        <input type="text" wire:model="name" placeholder="Ej: Consignación Bancaria">
                        @if(isset($errors['name']))<div class="err">{{ $errors['name'] }}</div>@endif
                    </div>

                    {{-- Estado --}}
                    <div class="pm-form-group">
                        <label>Estado</label>
                        <select wire:model="status">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    {{-- Detalles section --}}
                    <div class="pm-section-label">Detalles bancarios / de pago</div>

                    <div class="pm-form-group">
                        <label>Banco</label>
                        <input type="text" wire:model="bank" placeholder="Ej: Bancolombia">
                    </div>
                    <div class="pm-form-group">
                        <label>Tipo de cuenta</label>
                        <input type="text" wire:model="account_type" placeholder="Ej: Ahorros">
                    </div>
                    <div class="pm-form-group">
                        <label>Número de cuenta</label>
                        <input type="text" wire:model="account_number" placeholder="Ej: 123-456789-00">
                    </div>
                    <div class="pm-form-group">
                        <label>Titular <span style="color:#f87171">*</span></label>
                        <input type="text" wire:model="holder" placeholder="Ej: InnovaSafe SAS">
                        @if(isset($errors['holder']))<div class="err">{{ $errors['holder'] }}</div>@endif
                    </div>
                    <div class="pm-form-group">
                        <label>NIT</label>
                        <input type="text" wire:model="nit" placeholder="Ej: 900.123.456-7">
                    </div>
                    <div class="pm-form-group">
                        <label>Celular</label>
                        <input type="text" wire:model="cellphone" placeholder="Ej: 312 2777482">
                    </div>
                    <div class="pm-form-group">
                        <label>Convenio</label>
                        <input type="text" wire:model="agreement">
                    </div>
                    <div class="pm-form-group">
                        <label>Referencia</label>
                        <input type="text" wire:model="reference">
                    </div>
                    <div class="pm-form-group">
                        <label>Valor</label>
                        <input type="number" wire:model="value" placeholder="Ej: 150000">
                        @if(isset($errors['value']))<div class="err">{{ $errors['value'] }}</div>@endif
                    </div>
                </div>
            </div>
            <div class="pm-modal-footer">
                <button class="btn-cancel" wire:click="closeModal">Cancelar</button>
                <button class="btn-primary" wire:click="save">
                    {{ $editingId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Delete confirmation modal --}}
    @if($showDeleteModal)
    <div class="pm-overlay" wire:click.self="closeModal">
        <div class="pm-modal" style="max-width:380px;">
            <div class="pm-modal-header">
                <h3>Confirmar eliminación</h3>
                <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="pm-modal-body">
                <p style="color:#cbd5e1;font-size:.85rem;margin:0;">
                    ¿Estás seguro de que deseas eliminar este tipo de pago? Esta acción también eliminará sus detalles y no se puede deshacer.
                </p>
            </div>
            <div class="pm-modal-footer">
                <button class="btn-cancel" wire:click="closeModal">Cancelar</button>
                <button class="btn-danger" wire:click="delete">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

</div>
</x-filament-panels::page>
