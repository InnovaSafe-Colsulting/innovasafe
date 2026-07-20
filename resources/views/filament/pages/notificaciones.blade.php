<x-filament-panels::page>
<style>
.notif-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.25rem; }
.notif-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; padding:1.5rem; display:flex; flex-direction:column; gap:1rem; }
.notif-card-icon { width:2.75rem; height:2.75rem; border-radius:50%; display:flex; align-items:center; justify-content:center; }
.notif-card-title { font-size:.95rem; font-weight:600; color:#f1f5f9; }
.notif-card-count { font-size:.78rem; color:#94a3b8; }
.notif-badge { display:inline-flex; align-items:center; justify-content:center; min-width:1.5rem; height:1.5rem; padding:0 .4rem; border-radius:9999px; background:#ef4444; color:#fff; font-size:.72rem; font-weight:700; }
.notif-btn-read { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem 1rem; background:#1d4ed8; color:#fff; border:none; border-radius:.5rem; font-size:.8rem; font-weight:600; cursor:pointer; transition:background .15s; }
.notif-btn-read:hover { background:#1e40af; }
.notif-btn-read:disabled { background:#334155; color:#64748b; cursor:not-allowed; }

/* Modal */
.notif-overlay { position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.65); display:flex; align-items:center; justify-content:center; padding:1rem; }
.notif-modal { background:#111827; border:1px solid #1e293b; border-radius:.875rem; width:100%; max-width:580px; max-height:85vh; display:flex; flex-direction:column; box-shadow:0 20px 60px rgba(0,0,0,.6); }
.notif-modal-hd { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #1e293b; flex-shrink:0; }
.notif-modal-hd h3 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin:0; }
.notif-modal-body { overflow-y:auto; flex:1; padding:.5rem 0; }
.notif-item { border-bottom:1px solid #1e293b; }
.notif-item:last-child { border-bottom:none; }
.notif-item-row { display:flex; align-items:center; justify-content:space-between; padding:.75rem 1.25rem; gap:.75rem; }
.notif-item-title { font-size:.85rem; color:#f1f5f9; font-weight:500; flex:1; }
.notif-item-date { font-size:.72rem; color:#475569; white-space:nowrap; }
.notif-item-actions { display:flex; align-items:center; gap:.4rem; flex-shrink:0; }
.notif-btn-check { width:1.9rem; height:1.9rem; border-radius:.4rem; border:none; cursor:pointer; background:#14532d; color:#4ade80; display:inline-flex; align-items:center; justify-content:center; transition:background .15s; }
.notif-btn-check:hover { background:#166534; }
.notif-btn-del { width:1.9rem; height:1.9rem; border-radius:.4rem; border:none; cursor:pointer; background:#7f1d1d; color:#f87171; display:inline-flex; align-items:center; justify-content:center; transition:background .15s; }
.notif-btn-del:hover { background:#991b1b; }
.notif-detail { background:#0d1117; border-top:1px solid #1e293b; padding:1rem 1.25rem; font-size:.82rem; color:#94a3b8; line-height:1.7; white-space:pre-line; }
.notif-detail-footer { display:flex; justify-content:flex-end; margin-top:.75rem; }
.notif-btn-accept { padding:.4rem .9rem; background:#1d4ed8; color:#fff; border:none; border-radius:.5rem; font-size:.78rem; font-weight:600; cursor:pointer; transition:background .15s; }
.notif-btn-accept:hover { background:#1e40af; }
.notif-empty { text-align:center; padding:2.5rem 1rem; color:#475569; font-size:.82rem; }
.notif-btn-close { background:none; border:none; cursor:pointer; color:#64748b; display:inline-flex; padding:.2rem; border-radius:.3rem; }
.notif-btn-close:hover { color:#94a3b8; background:#1e293b; }
</style>

<div class="notif-grid">

    {{-- Card: Solicitar Información --}}
    @php $counts = $this->getCounts(); @endphp

    <div class="notif-card">
        <div style="display:flex;align-items:center;gap:.75rem;">
            <div class="notif-card-icon" style="background:rgba(59,130,246,.15);">
                <svg style="width:1.25rem;height:1.25rem;color:#3b82f6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3v-3z"/></svg>
            </div>
            <div>
                <div class="notif-card-title">Solicitar Información</div>
                <div class="notif-card-count">
                    @if(!empty($counts['solicitar_informacion']) && $counts['solicitar_informacion'] > 0)
                        <span class="notif-badge">{{ $counts['solicitar_informacion'] }}</span>
                        <span style="margin-left:.4rem;">sin leer</span>
                    @else
                        Sin notificaciones
                    @endif
                </div>
            </div>
        </div>
        <button class="notif-btn-read"
            wire:click="openModal('solicitar_informacion')"
            {{ empty($counts['solicitar_informacion']) ? 'disabled' : '' }}>
            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Leer
        </button>
    </div>

    {{-- Card: Planes --}}
    <div class="notif-card">
        <div style="display:flex;align-items:center;gap:.75rem;">
            <div class="notif-card-icon" style="background:rgba(34,197,94,.15);">
                <svg style="width:1.25rem;height:1.25rem;color:#22c55e" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <div class="notif-card-title">Planes</div>
                <div class="notif-card-count">
                    @if(!empty($counts['planes']) && $counts['planes'] > 0)
                        <span class="notif-badge">{{ $counts['planes'] }}</span>
                        <span style="margin-left:.4rem;">sin leer</span>
                    @else
                        Sin notificaciones
                    @endif
                </div>
            </div>
        </div>
        <button class="notif-btn-read"
            wire:click="openModal('planes')"
            {{ empty($counts['planes']) ? 'disabled' : '' }}>
            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Leer
        </button>
    </div>

</div>

{{-- Modal --}}
@if($showModal)
<div class="notif-overlay" wire:click.self="closeModal">
    <div class="notif-modal">
        <div class="notif-modal-hd">
            <h3>
                {{ $activeModule === 'planes' ? 'Planes' : 'Solicitar Información' }}
                @if(count($notifications) > 0)
                    <span class="notif-badge" style="margin-left:.5rem;">{{ count($notifications) }}</span>
                @endif
            </h3>
            <button class="notif-btn-close" wire:click="closeModal">
                <svg style="width:18px;height:18px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="notif-modal-body">
            @if(count($notifications) === 0)
                <div class="notif-empty">No hay notificaciones pendientes.</div>
            @else
                @foreach($notifications as $n)
                <div class="notif-item">
                    <div class="notif-item-row">
                        <div>
                            <div class="notif-item-title">{{ $n->title }}</div>
                            <div class="notif-item-date">{{ \Carbon\Carbon::parse($n->created_at)->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="notif-item-actions">
                            <button class="notif-btn-check" wire:click="toggleDetail({{ $n->id }})" title="Ver detalle">
                                <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </button>
                            <button class="notif-btn-del" wire:click="delete({{ $n->id }})" title="Eliminar">
                                <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    @if($expandedId === $n->id)
                    <div class="notif-detail">
                        {{ $n->description }}
                        <div class="notif-detail-footer">
                            <button class="notif-btn-accept" wire:click="markAsRead({{ $n->id }})">Aceptar</button>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endif

</x-filament-panels::page>
