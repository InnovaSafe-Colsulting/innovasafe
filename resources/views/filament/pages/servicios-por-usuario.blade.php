<x-filament-panels::page>
<style>
.spu-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
.spu-card-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-wrap:wrap; gap:.75rem; }
.spu-card-header h2 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }
.spu-search { background:#0d1117; border:1px solid #1e293b; border-radius:.5rem; padding:.45rem .75rem; color:#f1f5f9; font-size:.82rem; outline:none; width:220px; transition:border-color .15s; }
.spu-search:focus { border-color:#3b82f6; }
.spu-table-wrap { overflow-x:auto; }
table.spu-table { width:100%; border-collapse:collapse; font-size:.82rem; }
table.spu-table thead tr { background:#0d1117; }
table.spu-table th { padding:.75rem 1rem; text-align:left; font-size:.7rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; white-space:nowrap; }
table.spu-table tbody tr { border-top:1px solid #1e293b; transition:background .15s; }
table.spu-table tbody tr:hover { background:#0d1117; }
table.spu-table td { padding:.75rem 1rem; color:#cbd5e1; vertical-align:middle; }
.spu-empty { text-align:center; padding:3rem 1rem; color:#475569; font-size:.82rem; }
.spu-badge { display:inline-flex; align-items:center; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:600; white-space:nowrap; }
.spu-badge-green  { background:#14532d; color:#4ade80; }
.spu-badge-yellow { background:#713f12; color:#fbbf24; }
.spu-badge-red    { background:#7f1d1d; color:#f87171; }
.spu-badge-gray   { background:#1e293b; color:#94a3b8; }
.spu-toggle { position:relative; display:inline-flex; width:2.25rem; height:1.25rem; border-radius:9999px; border:none; cursor:pointer; transition:background .2s; flex-shrink:0; }
.spu-toggle.on  { background:#22c55e; }
.spu-toggle.off { background:#334155; }
.spu-toggle span { position:absolute; top:.15rem; width:.95rem; height:.95rem; border-radius:50%; background:#fff; transition:transform .2s; }
.spu-toggle.on  span { transform:translateX(1.1rem); }
.spu-toggle.off span { transform:translateX(.15rem); }
.spu-toggle-label { font-size:.7rem; font-weight:600; margin-left:.4rem; }
.spu-toggle-wrap { display:inline-flex; align-items:center; }
/* Mobile cards */
.spu-mobile-list { display:none; }
.spu-mobile-card { border-top:1px solid #1e293b; padding:1rem 1.25rem; }
.spu-mc-name { font-size:.88rem; font-weight:600; color:#f1f5f9; margin-bottom:.15rem; }
.spu-mc-email { font-size:.72rem; color:#475569; margin-bottom:.6rem; }
.spu-mc-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:.35rem; font-size:.78rem; }
.spu-mc-label { color:#64748b; font-weight:500; }
.spu-mc-footer { display:flex; align-items:center; justify-content:space-between; padding-top:.6rem; margin-top:.25rem; border-top:1px solid #1e293b; }
@media (max-width:768px) {
    .spu-table-wrap { display:none; }
    .spu-mobile-list { display:block; }
    .spu-search { width:100%; }
    .spu-card-header { flex-direction:column; align-items:stretch; }
}
</style>

<div class="spu-card">
    <div class="spu-card-header">
        <h2>Servicios Por Usuario</h2>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;">
            <input type="text" class="spu-search" placeholder="Buscar usuario..." oninput="spuFilter(this.value)">
            <button wire:click="openCreate" style="display:inline-flex;align-items:center;gap:.4rem;padding:.45rem 1rem;background:#1d4ed8;color:#fff;border:none;border-radius:.5rem;font-size:.8rem;font-weight:600;cursor:pointer;white-space:nowrap;">
                <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Nuevo Registro
            </button>
        </div>
    </div>

    @if(empty($records))
        <div class="spu-empty">No hay servicios registrados por usuario.</div>
    @else

    {{-- Desktop --}}
    <div class="spu-table-wrap">
        <table class="spu-table" id="spu-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Plan</th>
                    <th>Servicio</th>
                    <th>Período</th>
                    <th>Fecha Pago</th>
                    <th>Expira</th>
                    <th>Tipo Pago</th>
                    <th>Estado Pago</th>
                    <th>Estado</th>
                    <th>Acceso</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $r)
                @php
                    $exp = $r->expires_at ? \Carbon\Carbon::parse($r->expires_at) : null;
                    $statusClass = match($r->status) { 'active' => 'spu-badge-green', 'expired' => 'spu-badge-yellow', default => 'spu-badge-red' };
                    $statusLabel = match($r->status) { 'active' => 'Activo', 'expired' => 'Expirado', default => 'Cancelado' };
                @endphp
                <tr data-search="{{ strtolower($r->user_names . ' ' . $r->user_last_names . ' ' . $r->user_email) }}">
                    <td style="color:#475569;">{{ $r->id }}</td>
                    <td>
                        <div style="font-weight:500;color:#f1f5f9;">{{ $r->user_names }} {{ $r->user_last_names }}</div>
                        <div style="font-size:.72rem;color:#475569;">{{ $r->user_email }}</div>
                    </td>
                    <td style="color:#f1f5f9;font-weight:500;">{{ $r->plan_name }}</td>
                    <td>{{ $r->service_name ?? '—' }}</td>
                    <td>
                        <span class="spu-badge spu-badge-gray">
                            {{ $r->billing_period === 'monthly' ? 'Mensual' : 'Anual' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap;">{{ $r->payment_date ? \Carbon\Carbon::parse($r->payment_date)->format('d/m/Y') : '—' }}</td>
                    <td style="white-space:nowrap;">
                        @if($exp)
                            <span style="color:{{ $exp->isPast() ? '#f87171' : '#cbd5e1' }};">{{ $exp->format('d/m/Y') }}</span>
                        @else —
                        @endif
                    </td>
                    <td>{{ $r->payment_type_name ?? '—' }}</td>
                    <td>
                        @if($r->payment_status_name)
                            <span class="spu-badge" style="background:rgba(100,116,139,.15);color:#{{ $r->payment_status_color ?? '94a3b8' }};">
                                {{ $r->payment_status_name }}
                            </span>
                        @else
                            <span style="color:#334155;">—</span>
                        @endif
                    </td>
                    <td><span class="spu-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                    <td>
                        <div class="spu-toggle-wrap">
                            <button wire:click="toggleStatus({{ $r->id }}, '{{ $r->status }}')"
                                class="spu-toggle {{ $r->status === 'active' ? 'on' : 'off' }}">
                                <span></span>
                            </button>
                            <span class="spu-toggle-label" style="color:{{ $r->status === 'active' ? '#22c55e' : '#ef4444' }};">
                                {{ $r->status === 'active' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:.4rem;">
                            <button wire:click="openEdit({{ $r->id }})" style="display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:.4rem;border:none;cursor:pointer;background:#1e3a5f;color:#60a5fa;" title="Editar">
                                <svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                            </button>
                            <button wire:click="confirmDelete({{ $r->id }})" style="display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:.4rem;border:none;cursor:pointer;background:#7f1d1d;color:#f87171;" title="Eliminar">
                                <svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile --}}
    <div class="spu-mobile-list" id="spu-cards">
        @foreach($records as $r)
        @php
            $exp = $r->expires_at ? \Carbon\Carbon::parse($r->expires_at) : null;
            $statusClass = match($r->status) { 'active' => 'spu-badge-green', 'expired' => 'spu-badge-yellow', default => 'spu-badge-red' };
            $statusLabel = match($r->status) { 'active' => 'Activo', 'expired' => 'Expirado', default => 'Cancelado' };
        @endphp
        <div class="spu-mobile-card" data-search="{{ strtolower($r->user_names . ' ' . $r->user_last_names . ' ' . $r->user_email) }}">
            <div class="spu-mc-name">{{ $r->user_names }} {{ $r->user_last_names }}</div>
            <div class="spu-mc-email">{{ $r->user_email }}</div>
            <div class="spu-mc-row"><span class="spu-mc-label">Plan</span><span style="color:#f1f5f9;font-weight:500;">{{ $r->plan_name }}</span></div>
            <div class="spu-mc-row"><span class="spu-mc-label">Servicio</span><span>{{ $r->service_name ?? '—' }}</span></div>
            <div class="spu-mc-row"><span class="spu-mc-label">Período</span><span class="spu-badge spu-badge-gray">{{ $r->billing_period === 'monthly' ? 'Mensual' : 'Anual' }}</span></div>
            <div class="spu-mc-row"><span class="spu-mc-label">Expira</span>
                @if($exp)
                    <span style="color:{{ $exp->isPast() ? '#f87171' : '#cbd5e1' }};">{{ $exp->format('d/m/Y') }}</span>
                @else <span>—</span>
                @endif
            </div>
            <div class="spu-mc-row"><span class="spu-mc-label">Estado Pago</span>
                @if($r->payment_status_name)
                    <span class="spu-badge" style="background:rgba(100,116,139,.15);color:#{{ $r->payment_status_color ?? '94a3b8' }};">{{ $r->payment_status_name }}</span>
                @else <span style="color:#334155;">—</span>
                @endif
            </div>
            <div class="spu-mc-footer">
                <span class="spu-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                <div style="display:flex;align-items:center;gap:.5rem;">
                    <div class="spu-toggle-wrap">
                        <button wire:click="toggleStatus({{ $r->id }}, '{{ $r->status }}')"
                            class="spu-toggle {{ $r->status === 'active' ? 'on' : 'off' }}">
                            <span></span>
                        </button>
                        <span class="spu-toggle-label" style="color:{{ $r->status === 'active' ? '#22c55e' : '#ef4444' }};">
                            {{ $r->status === 'active' ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>
                    <button wire:click="openEdit({{ $r->id }})" style="display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:.4rem;border:none;cursor:pointer;background:#1e3a5f;color:#60a5fa;">
                        <svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                    </button>
                    <button wire:click="confirmDelete({{ $r->id }})" style="display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:.4rem;border:none;cursor:pointer;background:#7f1d1d;color:#f87171;">
                        <svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endif
</div>

@if($showModal)
<div style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.65);display:flex;align-items:center;justify-content:center;padding:1rem;" wire:click.self="closeModal">
    <div style="background:#111827;border:1px solid #1e293b;border-radius:.875rem;width:100%;max-width:560px;max-height:90vh;overflow-y:auto;box-shadow:0 20px 60px rgba(0,0,0,.6);">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #1e293b;">
            <h3 style="font-size:.95rem;font-weight:600;color:#f1f5f9;margin:0;">Nuevo Registro</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="spu-form" enctype="multipart/form-data" style="padding:1.25rem;display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
            @php $sel = 'background:#0d1117;border:1px solid #1e293b;border-radius:.4rem;padding:.5rem .75rem;color:#f1f5f9;font-size:.82rem;outline:none;width:100%;'; @endphp

            {{-- Contacto --}}
            <div style="grid-column:1/-1;display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Contacto <span style="color:#f87171">*</span></label>
                <select wire:model="user_id" style="{{ $sel }}">
                    <option value="">Seleccionar contacto</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->names }} {{ $u->last_names }}</option>
                    @endforeach
                </select>
                @if(isset($formErrors['user_id']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['user_id'] }}</span>@endif
            </div>

            {{-- Plan --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Plan <span style="color:#f87171">*</span></label>
                <select wire:model="plan_id" style="{{ $sel }}">
                    <option value="">Seleccionar plan</option>
                    @foreach($plans as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
                @if(isset($formErrors['plan_id']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['plan_id'] }}</span>@endif
            </div>

            {{-- Tipo de Pago --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Tipo de Pago <span style="color:#f87171">*</span></label>
                <select wire:model="payment_type_id" style="{{ $sel }}">
                    <option value="">Seleccionar tipo</option>
                    @foreach($typePayments as $tp)
                        <option value="{{ $tp->id }}">{{ $tp->name }}</option>
                    @endforeach
                </select>
                @if(isset($formErrors['payment_type_id']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['payment_type_id'] }}</span>@endif
            </div>

            {{-- Estado de Pago --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Estado de Pago</label>
                <select wire:model="payment_status_id" style="{{ $sel }}">
                    <option value="">Sin estado</option>
                    @foreach($paymentStatuses as $ps)
                        <option value="{{ $ps->id }}">{{ $ps->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tipo de Servicio --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Tipo de Servicio</label>
                <select wire:model="type_service_id" style="{{ $sel }}">
                    <option value="">Sin servicio</option>
                    @foreach($typeServices as $ts)
                        <option value="{{ $ts->id }}">{{ $ts->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Período --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Período</label>
                <select wire:model="billing_period" style="{{ $sel }}">
                    <option value="monthly">Mensual</option>
                    <option value="yearly">Anual</option>
                </select>
            </div>

            {{-- Fecha de Pago --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Fecha de Pago <span style="color:#f87171">*</span></label>
                <input type="date" wire:model="payment_date" style="{{ $sel }}">
                @if(isset($formErrors['payment_date']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['payment_date'] }}</span>@endif
            </div>

            {{-- Fecha de Expiración --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Fecha de Expiración <span style="color:#f87171">*</span></label>
                <input type="date" wire:model="expires_at" style="{{ $sel }}">
                @if(isset($formErrors['expires_at']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['expires_at'] }}</span>@endif
            </div>

            {{-- Estado del Servicio --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Estado del Servicio</label>
                <select wire:model="status" style="{{ $sel }}">
                    <option value="active">Activo</option>
                    <option value="expired">Expirado</option>
                    <option value="canceled">Cancelado</option>
                </select>
            </div>

            {{-- Comprobante de Pago --}}
            <div style="grid-column:1/-1;display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Comprobante de Pago</label>
                <input type="file" id="spu-proof" name="payment_proof" accept=".pdf,image/*" style="background:#0d1117;border:1px solid #1e293b;border-radius:.4rem;padding:.45rem .75rem;color:#94a3b8;font-size:.8rem;outline:none;width:100%;">
            </div>

        </form>
        <div style="display:flex;justify-content:flex-end;gap:.625rem;padding:1rem 1.25rem;border-top:1px solid #1e293b;">
            <button wire:click="closeModal" style="padding:.45rem 1.1rem;border:1px solid #334155;border-radius:.5rem;background:none;color:#94a3b8;font-size:.8rem;cursor:pointer;">Cancelar</button>
            <button onclick="spuSubmit(event)" style="padding:.45rem 1.1rem;border-radius:.5rem;background:#1d4ed8;color:#fff;font-size:.8rem;font-weight:600;border:none;cursor:pointer;">Guardar</button>
        </div>
    </div>
</div>
@endif

{{-- Modal Editar --}}
@if($showEditModal)
<div style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.65);display:flex;align-items:center;justify-content:center;padding:1rem;" wire:click.self="closeModal">
    <div style="background:#111827;border:1px solid #1e293b;border-radius:.875rem;width:100%;max-width:560px;max-height:90vh;overflow-y:auto;box-shadow:0 20px 60px rgba(0,0,0,.6);">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #1e293b;">
            <h3 style="font-size:.95rem;font-weight:600;color:#f1f5f9;margin:0;">Editar Registro</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="spu-edit-form" enctype="multipart/form-data" style="padding:1.25rem;display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
            @php $sel = 'background:#0d1117;border:1px solid #1e293b;border-radius:.4rem;padding:.5rem .75rem;color:#f1f5f9;font-size:.82rem;outline:none;width:100%;'; @endphp

            <div style="grid-column:1/-1;display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Contacto <span style="color:#f87171">*</span></label>
                <select wire:model="user_id" style="{{ $sel }}">
                    <option value="">Seleccionar contacto</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->names }} {{ $u->last_names }}</option>
                    @endforeach
                </select>
                @if(isset($formErrors['user_id']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['user_id'] }}</span>@endif
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Plan <span style="color:#f87171">*</span></label>
                <select wire:model="plan_id" style="{{ $sel }}">
                    <option value="">Seleccionar plan</option>
                    @foreach($plans as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
                @if(isset($formErrors['plan_id']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['plan_id'] }}</span>@endif
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Tipo de Pago <span style="color:#f87171">*</span></label>
                <select wire:model="payment_type_id" style="{{ $sel }}">
                    <option value="">Seleccionar tipo</option>
                    @foreach($typePayments as $tp)
                        <option value="{{ $tp->id }}">{{ $tp->name }}</option>
                    @endforeach
                </select>
                @if(isset($formErrors['payment_type_id']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['payment_type_id'] }}</span>@endif
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Estado de Pago</label>
                <select wire:model="payment_status_id" style="{{ $sel }}">
                    <option value="">Sin estado</option>
                    @foreach($paymentStatuses as $ps)
                        <option value="{{ $ps->id }}">{{ $ps->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Tipo de Servicio</label>
                <select wire:model="type_service_id" style="{{ $sel }}">
                    <option value="">Sin servicio</option>
                    @foreach($typeServices as $ts)
                        <option value="{{ $ts->id }}">{{ $ts->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Período</label>
                <select wire:model="billing_period" style="{{ $sel }}">
                    <option value="monthly">Mensual</option>
                    <option value="yearly">Anual</option>
                </select>
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Fecha de Pago <span style="color:#f87171">*</span></label>
                <input type="date" wire:model="payment_date" style="{{ $sel }}">
                @if(isset($formErrors['payment_date']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['payment_date'] }}</span>@endif
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Fecha de Expiración <span style="color:#f87171">*</span></label>
                <input type="date" wire:model="expires_at" style="{{ $sel }}">
                @if(isset($formErrors['expires_at']))<span style="font-size:.72rem;color:#f87171;">{{ $formErrors['expires_at'] }}</span>@endif
            </div>

            <div style="display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Estado del Servicio</label>
                <select wire:model="status" style="{{ $sel }}">
                    <option value="active">Activo</option>
                    <option value="expired">Expirado</option>
                    <option value="canceled">Cancelado</option>
                </select>
            </div>

            <div style="grid-column:1/-1;display:flex;flex-direction:column;gap:.3rem;">
                <label style="font-size:.75rem;font-weight:500;color:#94a3b8;">Comprobante de Pago</label>
                @if($currentProof)
                    <div style="font-size:.75rem;color:#64748b;margin-bottom:.3rem;">Actual: <span style="color:#60a5fa;">{{ basename($currentProof) }}</span></div>
                @endif
                <input type="file" id="spu-edit-proof" name="payment_proof" accept=".pdf,image/*" style="background:#0d1117;border:1px solid #1e293b;border-radius:.4rem;padding:.45rem .75rem;color:#94a3b8;font-size:.8rem;outline:none;width:100%;">
            </div>
        </form>
        <div style="display:flex;justify-content:flex-end;gap:.625rem;padding:1rem 1.25rem;border-top:1px solid #1e293b;">
            <button wire:click="closeModal" style="padding:.45rem 1.1rem;border:1px solid #334155;border-radius:.5rem;background:none;color:#94a3b8;font-size:.8rem;cursor:pointer;">Cancelar</button>
            <button onclick="spuSubmitEdit(event)" style="padding:.45rem 1.1rem;border-radius:.5rem;background:#1d4ed8;color:#fff;font-size:.8rem;font-weight:600;border:none;cursor:pointer;">Actualizar</button>
        </div>
    </div>
</div>
@endif

{{-- Modal Borrar --}}
@if($showDeleteModal)
<div style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.65);display:flex;align-items:center;justify-content:center;padding:1rem;" wire:click.self="closeModal">
    <div style="background:#111827;border:1px solid #1e293b;border-radius:.875rem;width:100%;max-width:380px;box-shadow:0 20px 60px rgba(0,0,0,.6);">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #1e293b;">
            <h3 style="font-size:.95rem;font-weight:600;color:#f1f5f9;margin:0;">Confirmar eliminación</h3>
            <button wire:click="closeModal" style="background:none;border:none;cursor:pointer;color:#64748b;display:inline-flex;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div style="padding:1.25rem;">
            <p style="color:#cbd5e1;font-size:.85rem;margin:0;">¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.</p>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:.625rem;padding:1rem 1.25rem;border-top:1px solid #1e293b;">
            <button wire:click="closeModal" style="padding:.45rem 1.1rem;border:1px solid #334155;border-radius:.5rem;background:none;color:#94a3b8;font-size:.8rem;cursor:pointer;">Cancelar</button>
            <button wire:click="delete" style="padding:.45rem 1.1rem;border-radius:.5rem;background:#991b1b;color:#fca5a5;font-size:.8rem;font-weight:600;border:none;cursor:pointer;">Eliminar</button>
        </div>
    </div>
</div>
@endif

<div id="spu-toast" style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:99999;padding:.65rem 1.25rem;border-radius:.5rem;font-size:.82rem;font-weight:500;color:#fff;display:none;box-shadow:0 4px 12px rgba(0,0,0,.3);transition:opacity .3s;"></div>

<script>
document.addEventListener('livewire:initialized', () => {
    Livewire.on('spu-toast', ({ message, type }) => {
        const t = document.getElementById('spu-toast');
        t.textContent = message;
        t.style.background = type === 'success' ? '#22c55e' : '#ef4444';
        t.style.display = 'block';
        t.style.opacity = '1';
        setTimeout(() => {
            t.style.opacity = '0';
            setTimeout(() => { t.style.display = 'none'; t.style.opacity = '1'; }, 300);
        }, 3500);
    });
});

function spuSubmitEdit(e) {
    e.preventDefault();
    var file = document.getElementById('spu-edit-proof') ? document.getElementById('spu-edit-proof').files[0] : null;
    if (!file) {
        @this.call('update');
        return;
    }
    var fd = new FormData();
    fd.append('payment_proof', file);
    fd.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    fetch('/admin/upload-payment-proof', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(data => {
        if (data.path) @this.set('uploadedProof', data.path);
        @this.call('update');
    })
    .catch(() => @this.call('update'));
}

function spuSubmit(e) {
    e.preventDefault();
    var file = document.getElementById('spu-proof').files[0];
    if (!file) {
        @this.call('save');
        return;
    }
    var fd = new FormData();
    fd.append('payment_proof', file);
    fd.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    fetch('/admin/upload-payment-proof', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(data => {
        if (data.path) {
            @this.set('uploadedProof', data.path);
        }
        @this.call('save');
    })
    .catch(() => @this.call('save'));
}

function spuFilter(val) {
    var q = val.toLowerCase();
    document.querySelectorAll('#spu-table tbody tr').forEach(function(tr) {
        tr.style.display = tr.dataset.search.includes(q) ? '' : 'none';
    });
    document.querySelectorAll('#spu-cards .spu-mobile-card').forEach(function(card) {
        card.style.display = card.dataset.search.includes(q) ? '' : 'none';
    });
}
</script>
</x-filament-panels::page>
