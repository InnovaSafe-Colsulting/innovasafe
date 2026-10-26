<x-filament-panels::page>
<style>
.aff-wrap { width:100%; }

.aff-stats { display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem; }
.aff-stat-card { flex:1; min-width:140px; background:#111827; border:1px solid #1e293b; border-radius:.75rem; padding:1rem 1.25rem; }
.aff-stat-card .label { font-size:.72rem; color:#64748b; text-transform:uppercase; letter-spacing:.05em; }
.aff-stat-card .value { font-size:1.6rem; font-weight:700; color:#f1f5f9; margin-top:.2rem; }
.aff-stat-card .value.green  { color:#4ade80; }
.aff-stat-card .value.yellow { color:#facc15; }
.aff-stat-card .value.red    { color:#f87171; }

.aff-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
.aff-card-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-wrap:wrap; gap:.75rem; }
.aff-card-header h2 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }

.aff-table-wrap { overflow-x:auto; }
table.aff-table { width:100%; border-collapse:collapse; font-size:.82rem; }
table.aff-table thead tr { background:#0d1117; }
table.aff-table th { padding:.75rem 1rem; text-align:left; font-size:.7rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; white-space:nowrap; }
table.aff-table tbody tr { border-top:1px solid #1e293b; transition:background .15s; }
table.aff-table tbody tr:hover { background:#0d1117; }
table.aff-table td { padding:.75rem 1rem; color:#cbd5e1; vertical-align:middle; }

.badge { display:inline-flex; align-items:center; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:600; white-space:nowrap; }
.badge-green  { background:#14532d; color:#4ade80; }
.badge-red    { background:#7f1d1d; color:#f87171; }
.badge-blue   { background:#1e3a5f; color:#60a5fa; }
.badge-gray   { background:#1e293b; color:#94a3b8; }
.badge-yellow { background:#713f12; color:#facc15; }

.status-btn { display:inline-flex; align-items:center; gap:.3rem; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:600; border:none; cursor:pointer; transition:opacity .15s; }
.status-btn:hover { opacity:.8; }
.status-on  { background:#14532d; color:#4ade80; }
.status-off { background:#7f1d1d; color:#f87171; }

.aff-actions { display:flex; align-items:center; gap:.4rem; }
.btn-icon { display:inline-flex; align-items:center; justify-content:center; width:1.9rem; height:1.9rem; border-radius:.4rem; border:none; cursor:pointer; transition:background .15s; }
.btn-del  { background:#7f1d1d; color:#f87171; }
.btn-del:hover { background:#991b1b; }

.expand-btn { background:none; border:none; cursor:pointer; color:#475569; padding:.2rem; border-radius:.3rem; transition:color .15s, transform .2s; display:inline-flex; }
.expand-btn:hover { color:#94a3b8; }
.expand-btn.open { transform:rotate(90deg); color:#60a5fa; }

.detail-row td { padding:0 !important; }
.detail-inner { padding:1rem 1.25rem 1.25rem 2.5rem; background:#0a0f1a; border-top:1px solid #1e293b; }
.detail-inner h4 { font-size:.78rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; margin:0 0 .75rem; }
.svc-grid { display:flex; flex-wrap:wrap; gap:.5rem; }
.svc-chip { padding:.25rem .65rem; border-radius:9999px; font-size:.72rem; font-weight:500; }
.svc-chip.active   { background:#1e3a5f; color:#93c5fd; }
.svc-chip.inactive { background:#1e293b; color:#64748b; }

.aff-empty { text-align:center; padding:3rem 1rem; color:#475569; }

/* Modal */
.aff-overlay { position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.65); display:flex; align-items:center; justify-content:center; padding:1rem; }
.aff-modal { background:#111827; border:1px solid #1e293b; border-radius:.875rem; width:100%; max-width:600px; max-height:90vh; overflow-y:auto; box-shadow:0 20px 60px rgba(0,0,0,.6); }
.aff-modal-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #1e293b; }
.aff-modal-header h3 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }
.aff-modal-body { padding:1.25rem; }
.aff-modal-footer { display:flex; justify-content:flex-end; gap:.75rem; padding:1rem 1.25rem; border-top:1px solid #1e293b; }
.aff-section-title { font-size:.72rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; margin:1rem 0 .5rem; }
.aff-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
.aff-form-group { display:flex; flex-direction:column; gap:.3rem; }
.aff-form-group.full { grid-column:1/-1; }
.aff-form-group label { font-size:.75rem; font-weight:500; color:#94a3b8; }
.aff-form-group input, .aff-form-group select { background:#0d1117; border:1px solid #1e293b; border-radius:.4rem; padding:.5rem .75rem; color:#f1f5f9; font-size:.82rem; outline:none; transition:border-color .15s; }
.aff-form-group input:focus, .aff-form-group select:focus { border-color:#3b82f6; }
.aff-form-group .err { font-size:.72rem; color:#f87171; }
.svc-preview { display:flex; flex-wrap:wrap; gap:.4rem; margin-top:.4rem; }
.svc-tag { padding:.2rem .6rem; border-radius:9999px; font-size:.72rem; background:#1e3a5f; color:#93c5fd; }

.btn-primary { display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem; border-radius:.5rem; border:none; cursor:pointer; background:#1d4ed8; color:#fff; font-size:.82rem; font-weight:600; transition:background .15s; }
.btn-primary:hover { background:#1e40af; }
.btn-cancel { display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem; border-radius:.5rem; border:1px solid #334155; cursor:pointer; background:transparent; color:#94a3b8; font-size:.82rem; font-weight:600; }
.btn-cancel:hover { background:#1e293b; }
.btn-danger { display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem; border-radius:.5rem; border:none; cursor:pointer; background:#991b1b; color:#fca5a5; font-size:.82rem; font-weight:600; }
.btn-danger:hover { background:#7f1d1d; }

@media (max-width:768px) {
    .aff-table-wrap { display:none; }
    .aff-mobile-list { display:block; }
    .aff-mobile-card { border-top:1px solid #1e293b; padding:1rem 1.25rem; }
    .aff-mobile-card .mc-name { font-size:.9rem; font-weight:600; color:#f1f5f9; margin-bottom:.25rem; }
    .aff-mobile-card .mc-sub  { font-size:.75rem; color:#64748b; margin-bottom:.75rem; }
    .aff-mobile-card .mc-row  { display:flex; justify-content:space-between; align-items:center; margin-bottom:.5rem; font-size:.78rem; }
    .aff-mobile-card .mc-label { color:#64748b; }
    .aff-mobile-card .mc-actions { display:flex; gap:.5rem; margin-top:.75rem; flex-wrap:wrap; }
    .aff-form-grid { grid-template-columns:1fr; }
    .aff-form-group.full { grid-column:1; }
}
@media (min-width:769px) { .aff-mobile-list { display:none; } }
</style>

<div class="aff-wrap" wire:poll.30s="loadSubscriptions">

    @php
        $total    = count($subscriptions);
        $activos  = collect($subscriptions)->where('status', 'active')->count();
        $inactivos = collect($subscriptions)->where('status', 'inactive')->count();
    @endphp

    <div class="aff-stats">
        <div class="aff-stat-card">
            <div class="label">Total</div>
            <div class="value">{{ $total }}</div>
        </div>
        <div class="aff-stat-card">
            <div class="label">Activas</div>
            <div class="value green">{{ $activos }}</div>
        </div>
        <div class="aff-stat-card">
            <div class="label">Inactivas</div>
            <div class="value red">{{ $inactivos }}</div>
        </div>
    </div>

    <div class="aff-card">
        <div class="aff-card-header">
            <h2>Afiliaciones</h2>
            <button class="btn-primary" wire:click="openCreateModal">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Nueva Afiliación
            </button>
        </div>

        @if($subscriptions->isEmpty())
            <div class="aff-empty">No hay afiliaciones registradas.</div>
        @else

        {{-- Desktop --}}
        <div class="aff-table-wrap">
            <table class="aff-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Referencia</th>
                        <th>Empresa</th>
                        <th>Plan</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Total</th>
                        <th>Auto renew</th>
                        <th>Acceso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $sub)
                    <tr>
                        <td>
                            <button class="expand-btn {{ $expandedRow === $sub->id ? 'open' : '' }}" wire:click="toggleExpand({{ $sub->id }})">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </button>
                        </td>
                        <td style="font-size:.72rem;color:#475569;">{{ $sub->reference }}</td>
                        <td>
                            <div style="color:#f1f5f9;font-weight:500;">{{ $sub->tenant_name }}</div>
                            <div style="font-size:.7rem;color:#475569;">{{ $sub->tenant_email }}</div>
                        </td>
                        <td><span class="badge badge-blue">{{ $sub->plan_name }}</span></td>
                        <td style="font-size:.75rem;white-space:nowrap;">{{ \Carbon\Carbon::parse($sub->start_date)->format('d/m/Y') }}</td>
                        <td style="font-size:.75rem;white-space:nowrap;">
                            @php $end = \Carbon\Carbon::parse($sub->end_date); @endphp
                            <span style="color:{{ $end->isPast() ? '#f87171' : '#94a3b8' }}">{{ $end->format('d/m/Y') }}</span>
                        </td>
                        <td style="white-space:nowrap;font-size:.82rem;">${{ number_format($sub->total, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $sub->auto_renew ? 'badge-green' : 'badge-gray' }}">
                                {{ $sub->auto_renew ? 'Sí' : 'No' }}
                            </span>
                        </td>
                        <td>
                            <button class="status-btn {{ $sub->status === 'active' ? 'status-on' : 'status-off' }}" wire:click="toggleStatus({{ $sub->id }})">
                                {{ $sub->status === 'active' ? 'Activo' : 'Inactivo' }}
                            </button>
                        </td>
                        <td>
                            <div class="aff-actions">
                                <button class="btn-icon btn-del" wire:click="confirmDelete({{ $sub->id }})" title="Eliminar">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    @if($expandedRow === $sub->id)
                    <tr class="detail-row">
                        <td colspan="10">
                            <div class="detail-inner">
                                <h4>Servicios incluidos</h4>
                                @if(count($expandedServices) > 0)
                                    <div class="svc-grid">
                                        @foreach($expandedServices as $svc)
                                            <span class="svc-chip {{ $svc->status === 'active' ? 'active' : 'inactive' }}">
                                                {{ $svc->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span style="color:#475569;font-size:.78rem;">Sin servicios registrados.</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile --}}
        <div class="aff-mobile-list">
            @foreach($subscriptions as $sub)
            <div class="aff-mobile-card">
                <div class="mc-name">{{ $sub->tenant_name }}</div>
                <div class="mc-sub">{{ $sub->reference }}</div>
                <div class="mc-row"><span class="mc-label">Plan</span><span class="badge badge-blue">{{ $sub->plan_name }}</span></div>
                <div class="mc-row"><span class="mc-label">Vence</span><span style="font-size:.78rem;">{{ \Carbon\Carbon::parse($sub->end_date)->format('d/m/Y') }}</span></div>
                <div class="mc-row"><span class="mc-label">Total</span><span>${{ number_format($sub->total, 0, ',', '.') }}</span></div>
                <div class="mc-actions">
                    <button class="status-btn {{ $sub->status === 'active' ? 'status-on' : 'status-off' }}" wire:click="toggleStatus({{ $sub->id }})">
                        {{ $sub->status === 'active' ? 'Activo' : 'Inactivo' }}
                    </button>
                    <button class="expand-btn {{ $expandedRow === $sub->id ? 'open' : '' }}" wire:click="toggleExpand({{ $sub->id }})" style="padding:.3rem .75rem;border-radius:.4rem;background:#1e293b;color:#94a3b8;font-size:.75rem;display:inline-flex;align-items:center;gap:.3rem;">
                        Servicios
                    </button>
                    <button class="btn-icon btn-del" wire:click="confirmDelete({{ $sub->id }})">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    </button>
                </div>
                @if($expandedRow === $sub->id && count($expandedServices) > 0)
                <div class="detail-inner" style="margin-top:.75rem;border-radius:.5rem;">
                    <div class="svc-grid">
                        @foreach($expandedServices as $svc)
                            <span class="svc-chip {{ $svc->status === 'active' ? 'active' : 'inactive' }}">{{ $svc->name }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @endif
    </div>
</div>

{{-- Modal Nueva Afiliación --}}
@if($showCreateModal)
<div class="aff-overlay" wire:click.self="closeModal">
    <div class="aff-modal">
        <div class="aff-modal-header">
            <h3>Nueva Afiliación</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="aff-modal-body">

            <div class="aff-section-title">Empresa y Plan</div>
            <div class="aff-form-grid">
                <div class="aff-form-group full">
                    <label>Empresa <span style="color:#f87171">*</span></label>
                    <select wire:model="form_tenant_id">
                        <option value="">-- Selecciona una empresa --</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                    @if(isset($formErrors['tenant_id']))<div class="err">{{ $formErrors['tenant_id'] }}</div>@endif
                </div>
                <div class="aff-form-group full">
                    <label>Plan <span style="color:#f87171">*</span></label>
                    <select wire:model.live="form_plan_id">
                        <option value="">-- Selecciona un plan --</option>
                        @foreach($plans as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} — ${{ number_format($p->price, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    @if(isset($formErrors['plan_id']))<div class="err">{{ $formErrors['plan_id'] }}</div>@endif
                </div>
                @if(count($form_plan_services) > 0)
                <div class="aff-form-group full">
                    <label>Servicios incluidos</label>
                    <div class="svc-preview">
                        @foreach($form_plan_services as $svcName)
                            <span class="svc-tag">{{ $svcName }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="aff-section-title">Período</div>
            <div class="aff-form-grid">
                <div class="aff-form-group">
                    <label>Fecha inicio <span style="color:#f87171">*</span></label>
                    <input type="date" wire:model="form_start_date">
                    @if(isset($formErrors['start_date']))<div class="err">{{ $formErrors['start_date'] }}</div>@endif
                </div>
                <div class="aff-form-group">
                    <label>Fecha fin <span style="color:#f87171">*</span></label>
                    <input type="date" wire:model="form_end_date">
                    @if(isset($formErrors['end_date']))<div class="err">{{ $formErrors['end_date'] }}</div>@endif
                </div>
                <div class="aff-form-group">
                    <label>Estado</label>
                    <select wire:model="form_status">
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                        <option value="pending">Pendiente</option>
                    </select>
                </div>
                <div class="aff-form-group" style="justify-content:flex-end;flex-direction:row;align-items:center;gap:.75rem;">
                    <label style="margin:0;">Auto renovar</label>
                    <input type="checkbox" wire:model="form_auto_renew" style="width:1rem;height:1rem;accent-color:#3b82f6;cursor:pointer;">
                </div>
            </div>

            <div class="aff-section-title">Valores</div>
            <div class="aff-form-grid">
                <div class="aff-form-group">
                    <label>Subtotal <span style="color:#f87171">*</span></label>
                    <input type="number" wire:model.live="form_subtotal" placeholder="0">
                </div>
                <div class="aff-form-group">
                    <label>Descuento</label>
                    <input type="number" wire:model.live="form_discount" placeholder="0">
                </div>
                <div class="aff-form-group">
                    <label>Impuesto (%)</label>
                    <input type="number" wire:model.live="form_tax" placeholder="0">
                </div>
                <div class="aff-form-group">
                    <label>Total <span style="color:#f87171">*</span></label>
                    <input type="number" wire:model="form_total" placeholder="0">
                    @if(isset($formErrors['total']))<div class="err">{{ $formErrors['total'] }}</div>@endif
                </div>
            </div>

            <div class="aff-section-title">Pago</div>
            <div class="aff-form-grid">
                <div class="aff-form-group">
                    <label>Fecha de pago</label>
                    <input type="date" wire:model="form_payment_date">
                </div>
                <div class="aff-form-group">
                    <label>Método de pago</label>
                    <select wire:model="form_payment_method">
                        <option value="">-- Selecciona --</option>
                        <option value="cash">Efectivo</option>
                        <option value="transfer">Transferencia</option>
                        <option value="card">Tarjeta</option>
                        <option value="other">Otro</option>
                    </select>
                </div>
                <div class="aff-form-group full">
                    <label>Referencia de transacción</label>
                    <input type="text" wire:model="form_payment_reference" placeholder="Ej: TRX-123456">
                </div>
            </div>

        </div>
        <div class="aff-modal-footer">
            <button class="btn-cancel" wire:click="closeModal">Cancelar</button>
            <button class="btn-primary" wire:click="createSubscription" wire:loading.attr="disabled" wire:target="createSubscription">
                <span wire:loading.remove wire:target="createSubscription">Guardar</span>
                <span wire:loading wire:target="createSubscription">Procesando...</span>
            </button>
        </div>
    </div>
</div>
@endif

{{-- Modal Eliminar --}}
@if($showDeleteModal)
<div class="aff-overlay" wire:click.self="closeModal">
    <div class="aff-modal" style="max-width:380px;">
        <div class="aff-modal-header">
            <h3>Confirmar eliminación</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="aff-modal-body">
            <p style="color:#cbd5e1;font-size:.85rem;margin:0;">¿Estás seguro? Se eliminará la suscripción y todos sus servicios y pagos asociados.</p>
        </div>
        <div class="aff-modal-footer">
            <button class="btn-cancel" wire:click="closeModal">Cancelar</button>
            <button class="btn-danger" wire:click="delete">Eliminar</button>
        </div>
    </div>
</div>
@endif

</x-filament-panels::page>
