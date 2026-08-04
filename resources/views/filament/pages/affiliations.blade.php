<x-filament-panels::page>
<style>
/* ── Reset & base ── */
.aff-wrap { width:100%; }

/* ── Stats bar ── */
.aff-stats { display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem; }
.aff-stat-card {
    flex:1; min-width:140px; background:#111827;
    border:1px solid #1e293b; border-radius:.75rem;
    padding:1rem 1.25rem;
}
.aff-stat-card .label { font-size:.72rem; color:#64748b; text-transform:uppercase; letter-spacing:.05em; }
.aff-stat-card .value { font-size:1.6rem; font-weight:700; color:#f1f5f9; margin-top:.2rem; }
.aff-stat-card .value.green  { color:#4ade80; }
.aff-stat-card .value.yellow { color:#facc15; }
.aff-stat-card .value.red    { color:#f87171; }

/* ── Table card ── */
.aff-card {
    background:#111827; border:1px solid #1e293b;
    border-radius:.875rem; overflow:hidden;
}
.aff-card-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-wrap:wrap; gap:.75rem;
}
.aff-card-header h2 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }

/* ── Create modal ── */
.aff-modal-overlay { position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.65); display:flex; align-items:center; justify-content:center; padding:1rem; }
.aff-modal { background:#111827; border:1px solid #1e293b; border-radius:.875rem; width:100%; max-width:520px; max-height:90vh; overflow-y:auto; padding:1.5rem; }
.aff-modal h3 { font-size:1rem; font-weight:600; color:#f1f5f9; margin:0 0 1.25rem; }
.aff-form-group { margin-bottom:1rem; }
.aff-form-group label { display:block; font-size:.78rem; font-weight:500; color:#94a3b8; margin-bottom:.35rem; }
.aff-form-group input, .aff-form-group select { width:100%; padding:.55rem .75rem; background:#0d1117; border:1px solid #1e293b; border-radius:.5rem; color:#f1f5f9; font-size:.82rem; outline:none; }
.aff-form-group input:focus, .aff-form-group select:focus { border-color:#3b82f6; }
.aff-form-group input[readonly] { color:#475569; cursor:not-allowed; }
.aff-form-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
.aff-modal-footer { display:flex; justify-content:flex-end; gap:.75rem; margin-top:1.25rem; }
.btn-cancel { padding:.45rem 1rem; background:#1e293b; color:#94a3b8; border:none; border-radius:.5rem; font-size:.82rem; cursor:pointer; }
.btn-cancel:hover { background:#334155; }
.btn-save { padding:.45rem 1rem; background:#1d4ed8; color:#fff; border:none; border-radius:.5rem; font-size:.82rem; font-weight:600; cursor:pointer; }
.btn-save:hover { background:#1e40af; }
.btn-new { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem 1rem; background:#1d4ed8; color:#fff; border:none; border-radius:.5rem; font-size:.8rem; font-weight:600; cursor:pointer; }
.btn-new:hover { background:#1e40af; }

/* ── Table ── */
.aff-table-wrap { overflow-x:auto; }
table.aff-table { width:100%; border-collapse:collapse; font-size:.82rem; }
table.aff-table thead tr { background:#0d1117; }
table.aff-table th {
    padding:.75rem 1rem; text-align:left;
    font-size:.7rem; font-weight:600; color:#64748b;
    text-transform:uppercase; letter-spacing:.05em;
    white-space:nowrap;
}
table.aff-table tbody tr {
    border-top:1px solid #1e293b;
    transition:background .15s;
}
table.aff-table tbody tr:hover { background:#0d1117; }
table.aff-table td { padding:.75rem 1rem; color:#cbd5e1; vertical-align:middle; }
table.aff-table td.name { color:#f1f5f9; font-weight:500; }

/* ── Badges ── */
.badge {
    display:inline-flex; align-items:center; gap:.3rem;
    padding:.2rem .65rem; border-radius:9999px;
    font-size:.7rem; font-weight:600; white-space:nowrap;
}
.badge-green  { background:#14532d; color:#4ade80; }
.badge-yellow { background:#713f12; color:#facc15; }
.badge-red    { background:#7f1d1d; color:#f87171; }
.badge-gray   { background:#1e293b; color:#94a3b8; }
.badge-blue   { background:#1e3a5f; color:#60a5fa; }

/* ── Status toggle ── */
.status-btn {
    display:inline-flex; align-items:center; gap:.3rem;
    padding:.2rem .65rem; border-radius:9999px;
    font-size:.7rem; font-weight:600; border:none; cursor:pointer;
    transition:opacity .15s;
}
.status-btn:hover { opacity:.8; }
.status-on  { background:#14532d; color:#4ade80; }
.status-off { background:#7f1d1d; color:#f87171; }

/* ── Payment status dropdown ── */
.ps-wrap { position:relative; display:inline-block; }
.ps-btn {
    display:inline-flex; align-items:center; gap:.3rem;
    padding:.2rem .65rem; border-radius:9999px;
    font-size:.7rem; font-weight:600; border:none; cursor:pointer;
    transition:opacity .15s;
}
.ps-btn:hover { opacity:.8; }
.ps-dropdown {
    display:none; position:absolute; top:calc(100% + .3rem); left:0; z-index:50;
    background:#1e293b; border:1px solid #334155; border-radius:.5rem;
    min-width:140px; box-shadow:0 8px 24px rgba(0,0,0,.4);
}
.ps-wrap:hover .ps-dropdown,
.ps-wrap:focus-within .ps-dropdown { display:block; }
.ps-option {
    display:block; width:100%; padding:.5rem .75rem;
    font-size:.78rem; color:#cbd5e1; background:none; border:none;
    cursor:pointer; text-align:left; transition:background .1s;
}
.ps-option:hover { background:#334155; color:#f1f5f9; }

/* ── Action buttons ── */
.aff-actions { display:flex; align-items:center; gap:.4rem; }
.btn-icon {
    display:inline-flex; align-items:center; justify-content:center;
    width:1.9rem; height:1.9rem; border-radius:.4rem;
    border:none; cursor:pointer; transition:background .15s;
}
.btn-edit   { background:#1e3a5f; color:#60a5fa; }
.btn-edit:hover { background:#1e40af; }
.btn-del    { background:#7f1d1d; color:#f87171; }
.btn-del:hover  { background:#991b1b; }

/* ── Expand row ── */
.expand-btn {
    background:none; border:none; cursor:pointer; color:#475569;
    padding:.2rem; border-radius:.3rem; transition:color .15s, transform .2s;
    display:inline-flex;
}
.expand-btn:hover { color:#94a3b8; }
.expand-btn.open { transform:rotate(90deg); color:#60a5fa; }

/* ── Detail row ── */
.detail-row td { padding:0 !important; }
.detail-inner {
    padding:1rem 1.25rem 1.25rem 2.5rem;
    background:#0a0f1a; border-top:1px solid #1e293b;
}
.detail-inner h4 { font-size:.78rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; margin:0 0 .75rem; }
.modules-grid { display:flex; flex-wrap:wrap; gap:.5rem; }
.module-chip {
    padding:.25rem .65rem; border-radius:9999px;
    font-size:.72rem; font-weight:500;
    background:#1e293b; color:#94a3b8;
}
.module-chip.basic { background:#1e3a5f; color:#93c5fd; }
.module-chip.additional { background:#3b1f5e; color:#c4b5fd; }

/* ── Empty state ── */
.aff-empty { text-align:center; padding:3rem 1rem; color:#475569; }
.aff-empty svg { margin:0 auto .75rem; display:block; }

/* ── Responsive cards (mobile) ── */
@media (max-width: 768px) {
    .aff-table-wrap { display:none; }
    .aff-mobile-list { display:block; }
    .aff-mobile-card {
        border-top:1px solid #1e293b; padding:1rem 1.25rem;
    }
    .aff-mobile-card .mc-name { font-size:.9rem; font-weight:600; color:#f1f5f9; margin-bottom:.25rem; }
    .aff-mobile-card .mc-email { font-size:.75rem; color:#64748b; margin-bottom:.75rem; }
    .aff-mobile-card .mc-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:.5rem; font-size:.78rem; }
    .aff-mobile-card .mc-label { color:#64748b; }
    .aff-mobile-card .mc-actions { display:flex; gap:.5rem; margin-top:.75rem; flex-wrap:wrap; }
    .aff-stat-card .value { font-size:1.3rem; }
}
@media (min-width: 769px) {
    .aff-mobile-list { display:none; }
}
</style>

<div class="aff-wrap" wire:poll.30s="loadAffiliations">

    {{-- Stats ── ──────────────────────────────────────────── --}}
    @php
        $total   = count($affiliations);
        $activos = collect($affiliations)->where('status', 'active')->count();
        $exitoso = collect($affiliations)->where('payment_status_name', 'Pago Exitoso')->count();
        $pendiente = collect($affiliations)->where('payment_status_name', 'Pago Pendiente')->count();
        $moroso  = collect($affiliations)->where('payment_status_name', 'Moroso')->count();
    @endphp

    <div class="aff-stats">
        <div class="aff-stat-card">
            <div class="label">Total afiliaciones</div>
            <div class="value">{{ $total }}</div>
        </div>
        <div class="aff-stat-card">
            <div class="label">Activos</div>
            <div class="value green">{{ $activos }}</div>
        </div>
        <div class="aff-stat-card">
            <div class="label">Pago Exitoso</div>
            <div class="value green">{{ $exitoso }}</div>
        </div>
        <div class="aff-stat-card">
            <div class="label">Pago Pendiente</div>
            <div class="value yellow">{{ $pendiente }}</div>
        </div>
        <div class="aff-stat-card">
            <div class="label">Morosos</div>
            <div class="value red">{{ $moroso }}</div>
        </div>
    </div>

    {{-- Table card ── ─────────────────────────────────────── --}}
    <div class="aff-card">
        <div class="aff-card-header">
            <h2>Listado de Afiliaciones</h2>
            <button class="btn-new" wire:click="openCreateModal">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Nueva Afiliación
            </button>
        </div>

        @if($affiliations->isEmpty())
            <div class="aff-empty">
                <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                </svg>
                No hay afiliaciones registradas.
            </div>
        @else

        {{-- ── DESKTOP TABLE ── --}}
        <div class="aff-table-wrap">
            <table class="aff-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Usuario</th>
                        <th>Plan</th>
                        <th>Período</th>
                        <th>F. Pago</th>
                        <th>Vence</th>
                        <th>Orden</th>
                        <th>Total</th>
                        <th>Estado Pago</th>
                        <th>Acceso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($affiliations as $aff)
                    <tr>
                        <td>
                            <button class="expand-btn {{ $expandedRow === $aff->id ? 'open' : '' }}"
                                wire:click="toggleExpand({{ $aff->id }})" title="Ver módulos">
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                </svg>
                            </button>
                        </td>
                        <td>
                            <div class="name">{{ $aff->user_name }}</div>
                            <div style="font-size:.7rem;color:#475569;">{{ $aff->email }}</div>
                            @if($aff->cellphone)
                                <div style="font-size:.7rem;color:#475569;">{{ $aff->cellphone }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-blue">{{ $aff->plan_name }}</span>
                        </td>
                        <td style="white-space:nowrap;">
                            <span class="badge badge-gray">{{ ucfirst($aff->billing_period ?? '-') }}</span>
                        </td>
                        <td style="white-space:nowrap;font-size:.75rem;">
                            {{ $aff->payment_date ? \Carbon\Carbon::parse($aff->payment_date)->format('d/m/Y') : '-' }}
                        </td>
                        <td style="white-space:nowrap;font-size:.75rem;">
                            @if($aff->expires_at)
                                @php $exp = \Carbon\Carbon::parse($aff->expires_at); @endphp
                                <span style="color:{{ $exp->isPast() ? '#f87171' : '#94a3b8' }}">
                                    {{ $exp->format('d/m/Y') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td style="font-size:.75rem;">{{ $aff->order_number ?? '-' }}</td>
                        <td style="white-space:nowrap;font-size:.75rem;">
                            @if($aff->order_total)
                                ${{ number_format($aff->order_total, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="ps-wrap">
                                @php
                                    $psColor = $aff->payment_status_color ?? 'gray';
                                    $psName  = $aff->payment_status_name  ?? 'Sin estado';
                                @endphp
                                <button class="ps-btn badge-{{ $psColor }}">
                                    {{ $psName }}
                                    <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </button>
                                <div class="ps-dropdown">
                                    @foreach($paymentStatuses as $ps)
                                        <button class="ps-option"
                                            wire:click="updatePaymentStatus({{ $aff->id }}, {{ $ps->id }})">
                                            {{ $ps->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="status-btn {{ $aff->status === 'active' ? 'status-on' : 'status-off' }}"
                                wire:click="toggleStatus({{ $aff->id }})">
                                {{ $aff->status === 'active' ? 'Activo' : 'Inactivo' }}
                            </button>
                        </td>
                        <td>
                            <div class="aff-actions">
                                <button class="btn-icon btn-edit" title="Editar">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                    </svg>
                                </button>
                                <button class="btn-icon btn-del" title="Eliminar">
                                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Detail row ── --}}
                    @if($expandedRow === $aff->id)
                    <tr class="detail-row">
                        <td colspan="11">
                            <div class="detail-inner">
                                <h4>Módulos del servicio</h4>
                                @if(count($modules) > 0)
                                    @php $grouped = collect($modules)->groupBy('service_name'); @endphp
                                    @foreach($grouped as $serviceName => $mods)
                                        <div style="margin-bottom:.75rem;">
                                            <div style="font-size:.72rem;color:#60a5fa;font-weight:600;margin-bottom:.4rem;">{{ $serviceName }}</div>
                                            <div class="modules-grid">
                                                @foreach($mods as $mod)
                                                    <span class="module-chip {{ $mod->type_module === 'basic' ? 'basic' : 'additional' }}">
                                                        {{ $mod->module }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <span style="color:#475569;font-size:.78rem;">No hay módulos registrados.</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ── MOBILE CARDS ── --}}
        <div class="aff-mobile-list">
            @foreach($affiliations as $aff)
            <div class="aff-mobile-card">
                <div class="mc-name">{{ $aff->user_name }}</div>
                <div class="mc-email">{{ $aff->email }}@if($aff->cellphone) · {{ $aff->cellphone }}@endif</div>

                <div class="mc-row">
                    <span class="mc-label">Plan</span>
                    <span class="badge badge-blue">{{ $aff->plan_name }}</span>
                </div>
                <div class="mc-row">
                    <span class="mc-label">Período</span>
                    <span class="badge badge-gray">{{ ucfirst($aff->billing_period ?? '-') }}</span>
                </div>
                <div class="mc-row">
                    <span class="mc-label">Vence</span>
                    <span style="font-size:.78rem;color:{{ $aff->expires_at && \Carbon\Carbon::parse($aff->expires_at)->isPast() ? '#f87171' : '#94a3b8' }}">
                        {{ $aff->expires_at ? \Carbon\Carbon::parse($aff->expires_at)->format('d/m/Y') : '-' }}
                    </span>
                </div>
                <div class="mc-row">
                    <span class="mc-label">Total</span>
                    <span style="font-size:.78rem;color:#f1f5f9;">
                        {{ $aff->order_total ? '$'.number_format($aff->order_total,0,',','.') : '-' }}
                    </span>
                </div>
                <div class="mc-row">
                    <span class="mc-label">Estado pago</span>
                    <div class="ps-wrap">
                        @php $psColor = $aff->payment_status_color ?? 'gray'; $psName = $aff->payment_status_name ?? 'Sin estado'; @endphp
                        <button class="ps-btn badge-{{ $psColor }}">{{ $psName }} ▾</button>
                        <div class="ps-dropdown">
                            @foreach($paymentStatuses as $ps)
                                <button class="ps-option" wire:click="updatePaymentStatus({{ $aff->id }}, {{ $ps->id }})">{{ $ps->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mc-actions">
                    <button class="status-btn {{ $aff->status === 'active' ? 'status-on' : 'status-off' }}"
                        wire:click="toggleStatus({{ $aff->id }})">
                        {{ $aff->status === 'active' ? 'Activo' : 'Inactivo' }}
                    </button>
                    <button class="expand-btn {{ $expandedRow === $aff->id ? 'open' : '' }}"
                        wire:click="toggleExpand({{ $aff->id }})" style="padding:.3rem .75rem;border-radius:.4rem;background:#1e293b;color:#94a3b8;font-size:.75rem;display:inline-flex;align-items:center;gap:.3rem;">
                        Módulos
                    </button>
                    <button class="btn-icon btn-edit" title="Editar">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                    </button>
                    <button class="btn-icon btn-del" title="Eliminar">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    </button>
                </div>

                @if($expandedRow === $aff->id && count($modules) > 0)
                <div class="detail-inner" style="margin-top:.75rem;border-radius:.5rem;">
                    <h4>Módulos</h4>
                    @php $grouped = collect($modules)->groupBy('service_name'); @endphp
                    @foreach($grouped as $serviceName => $mods)
                        <div style="margin-bottom:.75rem;">
                            <div style="font-size:.72rem;color:#60a5fa;font-weight:600;margin-bottom:.4rem;">{{ $serviceName }}</div>
                            <div class="modules-grid">
                                @foreach($mods as $mod)
                                    <span class="module-chip {{ $mod->type_module === 'basic' ? 'basic' : 'additional' }}">{{ $mod->module }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
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
<div class="aff-modal-overlay" wire:click.self="closeCreateModal">
    <div class="aff-modal">
        <h3>Nueva Afiliación</h3>

        <div class="aff-form-group">
            <label>Contacto</label>
            <select wire:model="form_contact_id" wire:change="loadContactInfo">
                <option value="">-- Selecciona un contacto --</option>
                @foreach($contacts as $c)
                    <option value="{{ $c->id }}">{{ $c->names }} {{ $c->last_names }} — {{ $c->email }}</option>
                @endforeach
            </select>
        </div>

        @if($form_contact_name)
        <div class="aff-form-grid">
            <div class="aff-form-group">
                <label>Nombre</label>
                <input type="text" value="{{ $form_contact_name }}" readonly>
            </div>
            <div class="aff-form-group">
                <label>Teléfono</label>
                <input type="text" value="{{ $form_contact_phone }}" readonly>
            </div>
        </div>
        <div class="aff-form-group">
            <label>Email</label>
            <input type="text" value="{{ $form_contact_email }}" readonly>
        </div>
        @endif

        <div class="aff-form-group">
            <label>Plan</label>
            <select wire:model="form_plan_id">
                <option value="">-- Selecciona un plan --</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="aff-form-grid">
            <div class="aff-form-group">
                <label>Período de facturación</label>
                <select wire:model="form_billing_period">
                    <option value="">-- Selecciona --</option>
                    <option value="monthly">Mensual</option>
                    <option value="yearly">Anual</option>
                </select>
            </div>
            <div class="aff-form-group">
                <label>Estado de pago</label>
                <select wire:model="form_payment_status_id">
                    <option value="">-- Selecciona --</option>
                    @foreach($paymentStatuses as $ps)
                        <option value="{{ $ps->id }}">{{ $ps->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="aff-form-grid">
            <div class="aff-form-group">
                <label>Fecha de pago</label>
                <input type="date" wire:model="form_payment_date">
            </div>
            <div class="aff-form-group">
                <label>Fecha de vencimiento</label>
                <input type="date" wire:model="form_expires_at">
            </div>
        </div>

        <div class="aff-modal-footer">
            <button class="btn-cancel" wire:click="closeCreateModal">Cancelar</button>
            <button class="btn-save" wire:click="createAffiliation" wire:loading.attr="disabled" wire:target="createAffiliation">
                <span wire:loading.remove wire:target="createAffiliation">Guardar</span>
                <span wire:loading wire:target="createAffiliation">Procesando...</span>
            </button>
        </div>
    </div>
</div>
@endif

</x-filament-panels::page>
