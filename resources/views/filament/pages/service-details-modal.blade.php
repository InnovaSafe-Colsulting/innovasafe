@php
    $details = \Illuminate\Support\Facades\DB::table('type_services_detail')
        ->where('type_service_id', $service->id)
        ->orderBy('type_module')
        ->orderBy('module')
        ->get();
@endphp

<style>
.sd-wrap { font-family: inherit; }
.sd-table-wrap { overflow-x: auto; }
.sd-table { width: 100%; border-collapse: collapse; font-size: .82rem; }
.sd-table thead tr { background: #0d1117; }
.sd-table th { padding: .7rem 1rem; text-align: left; font-size: .68rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .06em; white-space: nowrap; border-bottom: 1px solid #1e293b; }
.sd-table th.center { text-align: center; }
.sd-table tbody tr { border-bottom: 1px solid #1e293b; transition: background .15s; }
.sd-table tbody tr:last-child { border-bottom: none; }
.sd-table tbody tr:hover { background: #0d1117; }
.sd-table td { padding: .75rem 1rem; color: #cbd5e1; vertical-align: middle; }
.sd-table td.center { text-align: center; }
.sd-num { color: #334155; font-size: .75rem; font-weight: 600; }
.sd-badge { display: inline-flex; align-items: center; gap: .3rem; padding: .25rem .7rem; border-radius: 9999px; font-size: .7rem; font-weight: 700; white-space: nowrap; }
.sd-badge-basic    { background: rgba(59,130,246,.15); color: #60a5fa; border: 1px solid rgba(59,130,246,.25); }
.sd-badge-adicional { background: rgba(249,115,22,.15); color: #fb923c; border: 1px solid rgba(249,115,22,.25); }
.sd-toggle-wrap { display: inline-flex; align-items: center; gap: .5rem; }
.sd-toggle { position: relative; display: inline-flex; width: 2.25rem; height: 1.25rem; border-radius: 9999px; border: none; cursor: pointer; transition: background .2s; flex-shrink: 0; }
.sd-toggle.on  { background: #22c55e; }
.sd-toggle.off { background: #334155; }
.sd-toggle span { position: absolute; top: .15rem; width: .95rem; height: .95rem; border-radius: 50%; background: #fff; transition: transform .2s; box-shadow: 0 1px 3px rgba(0,0,0,.3); }
.sd-toggle.on  span { transform: translateX(1.1rem); }
.sd-toggle.off span { transform: translateX(.15rem); }
.sd-toggle-label { font-size: .72rem; font-weight: 600; }
.sd-toggle-label.on  { color: #22c55e; }
.sd-toggle-label.off { color: #475569; }
.sd-module-text { font-weight: 500; color: #f1f5f9; padding: .25rem .4rem; border-radius: .3rem; cursor: pointer; transition: background .15s; display: inline-block; }
.sd-module-text:hover { background: #1e293b; }
.sd-module-input { background: #0d1117; border: 1px solid #3b82f6; border-radius: .35rem; padding: .3rem .5rem; color: #f1f5f9; font-size: .82rem; outline: none; width: 100%; min-width: 140px; }
.sd-date { font-size: .75rem; color: #475569; white-space: nowrap; }
.sd-btn-del { display: inline-flex; align-items: center; justify-content: center; width: 1.9rem; height: 1.9rem; border-radius: .4rem; border: none; cursor: pointer; background: rgba(239,68,68,.1); color: #f87171; transition: background .15s; }
.sd-btn-del:hover { background: rgba(239,68,68,.25); }
.sd-empty { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 3rem 1rem; gap: .75rem; }
.sd-empty-ico { width: 3rem; height: 3rem; border-radius: 50%; background: rgba(71,85,105,.15); display: flex; align-items: center; justify-content: center; }
.sd-empty h4 { font-size: .9rem; font-weight: 600; color: #94a3b8; margin: 0; }
.sd-empty p  { font-size: .78rem; color: #475569; margin: 0; }
.sd-cards { display: none; flex-direction: column; gap: .75rem; padding: 1rem; }
.sd-card { background: #0d1117; border: 1px solid #1e293b; border-radius: .75rem; padding: 1rem; display: flex; flex-direction: column; gap: .75rem; }
.sd-card-header { display: flex; align-items: flex-start; justify-content: space-between; gap: .5rem; }
.sd-card-module { font-size: .88rem; font-weight: 600; color: #f1f5f9; }
.sd-card-row { display: flex; align-items: center; justify-content: space-between; font-size: .78rem; }
.sd-card-label { color: #475569; font-weight: 500; }
.sd-card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: .5rem; border-top: 1px solid #1e293b; }
.sd-field-input { background: #0d1117; border: 1px solid #1e293b; border-radius: .4rem; padding: .5rem .75rem; color: #f1f5f9; font-size: .82rem; outline: none; transition: border-color .15s; width: 100%; box-sizing: border-box; }
.sd-field-input:focus { border-color: #3b82f6; }
.sd-field-select { background: #0d1117; border: 1px solid #1e293b; border-radius: .4rem; padding: .5rem .75rem; color: #f1f5f9; font-size: .82rem; outline: none; transition: border-color .15s; width: 100%; box-sizing: border-box; }
.sd-field-select:focus { border-color: #3b82f6; }
@media (max-width: 640px) {
    .sd-table-wrap { display: none; }
    .sd-cards { display: flex; }
}
</style>

<div class="sd-wrap">

    {{-- Botón Agregar --}}
    <div style="display:flex;justify-content:flex-end;margin-bottom:.875rem;">
        <button id="sd-btn-add" onclick="sdAddInlineRow()" style="display:inline-flex;align-items:center;gap:.4rem;padding:.45rem 1rem;background:#1d4ed8;color:#fff;border:none;border-radius:.5rem;font-size:.8rem;font-weight:600;cursor:pointer;">
            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Agregar Módulo
        </button>
    </div>

    @if($details->count() > 0)
        {{-- Desktop --}}
        <div class="sd-table-wrap">
            <table class="sd-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Módulo</th>
                        <th>Tipo</th>
                        <th class="center">Estado</th>
                        <th>Fecha Creación</th>
                        <th class="center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $i => $detail)
                    <tr data-id="{{ $detail->id }}">
                        <td><span class="sd-num">{{ $i + 1 }}</span></td>
                        <td>
                            <span class="sd-module-text" data-id="{{ $detail->id }}" data-original="{{ $detail->module }}">{{ $detail->module }}</span>
                        </td>
                        <td>
                            <span class="sd-badge {{ $detail->type_module === 'Basico' ? 'sd-badge-basic' : 'sd-badge-adicional' }}">
                                {{ $detail->type_module === 'Basico' ? 'Básico' : 'Adicional' }}
                            </span>
                        </td>
                        <td class="center">
                            <div class="sd-toggle-wrap">
                                <button class="sd-toggle {{ $detail->status ? 'on' : 'off' }}" data-id="{{ $detail->id }}"><span></span></button>
                                <span class="sd-toggle-label {{ $detail->status ? 'on' : 'off' }}">{{ $detail->status ? 'Activo' : 'Inactivo' }}</span>
                            </div>
                        </td>
                        <td><span class="sd-date">{{ \Carbon\Carbon::parse($detail->created_at)->format('d/m/Y H:i') }}</span></td>
                        <td class="center">
                            <button class="sd-btn-del" data-id="{{ $detail->id }}" data-module="{{ $detail->module }}">
                                <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile --}}
        <div class="sd-cards">
            @foreach($details as $detail)
            <div class="sd-card" data-id="{{ $detail->id }}">
                <div class="sd-card-header">
                    <div>
                        <div class="sd-card-module">{{ $detail->module }}</div>
                        <div style="margin-top:.3rem;">
                            <span class="sd-badge {{ $detail->type_module === 'Basico' ? 'sd-badge-basic' : 'sd-badge-adicional' }}">
                                {{ $detail->type_module === 'Basico' ? 'Básico' : 'Adicional' }}
                            </span>
                        </div>
                    </div>
                    <button class="sd-btn-del" data-id="{{ $detail->id }}" data-module="{{ $detail->module }}">
                        <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
                <div class="sd-card-row">
                    <span class="sd-card-label">Fecha creación</span>
                    <span class="sd-date">{{ \Carbon\Carbon::parse($detail->created_at)->format('d/m/Y H:i') }}</span>
                </div>
                <div class="sd-card-footer">
                    <span class="sd-card-label">Estado</span>
                    <div class="sd-toggle-wrap">
                        <button class="sd-toggle {{ $detail->status ? 'on' : 'off' }}" data-id="{{ $detail->id }}"><span></span></button>
                        <span class="sd-toggle-label {{ $detail->status ? 'on' : 'off' }}">{{ $detail->status ? 'Activo' : 'Inactivo' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="sd-empty">
            <div class="sd-empty-ico">
                <svg style="width:1.4rem;height:1.4rem;color:#475569" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h4>Sin módulos</h4>
            <p>Este servicio no tiene módulos configurados.</p>
        </div>
    @endif
</div>

<input type="hidden" id="sd-type-service-id" value="{{ $service->id }}">

{{-- Toast --}}
<div id="sd-toast" style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:999999;padding:.65rem 1.25rem;border-radius:.5rem;font-size:.82rem;font-weight:500;color:#fff;background:#22c55e;display:none;box-shadow:0 4px 12px rgba(0,0,0,.3);"></div>

<script>
(function() {
    var toast = document.getElementById('sd-toast');
    if (toast) document.body.appendChild(toast);

    document.querySelectorAll('.sd-toggle').forEach(function(btn) { btn.addEventListener('click', sdToggleHandler); });
    document.querySelectorAll('.sd-module-text').forEach(function(el) { el.addEventListener('click', sdModuleEditHandler); });
    document.querySelectorAll('.sd-btn-del').forEach(function(btn) { btn.addEventListener('click', sdDelHandler); });
})();

function sdShowToast(msg, success) {
    var t = document.getElementById('sd-toast');
    t.textContent = msg;
    t.style.background = success === false ? '#ef4444' : '#22c55e';
    t.style.display = 'block';
    setTimeout(function() { t.style.display = 'none'; }, 3500);
}

function sdAddInlineRow() {
    if (document.getElementById('sd-inline-row')) return; // solo una fila a la vez
    document.getElementById('sd-btn-add').disabled = true;

    var inpStyle = 'background:#0d1117;border:1px solid #3b82f6;border-radius:.35rem;padding:.3rem .5rem;color:#f1f5f9;font-size:.8rem;outline:none;width:100%;min-width:120px;box-sizing:border-box;';
    var selStyle = 'background:#0d1117;border:1px solid #3b82f6;border-radius:.35rem;padding:.3rem .4rem;color:#f1f5f9;font-size:.8rem;outline:none;';

    var tr = document.createElement('tr');
    tr.id = 'sd-inline-row';
    tr.style.background = '#0f172a';
    tr.innerHTML =
        '<td><span class="sd-num">—</span></td>'+
        '<td><input id="sd-il-module" type="text" placeholder="Nombre del módulo" style="'+inpStyle+'"></td>'+
        '<td><select id="sd-il-type" style="'+selStyle+'"><option value="">Tipo</option><option value="Basico">Básico</option><option value="Adicional">Adicional</option></select></td>'+
        '<td class="center"><select id="sd-il-status" style="'+selStyle+'"><option value="1">Activo</option><option value="0">Inactivo</option></select></td>'+
        '<td><span class="sd-date">—</span></td>'+
        '<td class="center" style="white-space:nowrap;">'+
            '<button onclick="sdSaveInlineRow()" title="Guardar" style="display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:.4rem;border:none;cursor:pointer;background:rgba(34,197,94,.15);color:#22c55e;margin-right:.3rem;">'+
                '<svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>'+
            '</button>'+
            '<button onclick="sdCancelInlineRow()" title="Cancelar" style="display:inline-flex;align-items:center;justify-content:center;width:1.9rem;height:1.9rem;border-radius:.4rem;border:none;cursor:pointer;background:rgba(239,68,68,.1);color:#f87171;">'+
                '<svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>'+
            '</button>'+
        '</td>';

    // Si no hay tbody (tabla vacía), mostrar la tabla primero
    var tableWrap = document.querySelector('.sd-table-wrap');
    var tbody = document.querySelector('.sd-table tbody');
    if (!tbody) {
        // Reemplazar el empty state con la tabla
        var empty = document.querySelector('.sd-empty');
        if (empty) empty.style.display = 'none';
        tableWrap.style.display = 'block';
        tbody = document.querySelector('.sd-table tbody');
    }
    tbody.appendChild(tr);
    document.getElementById('sd-il-module').focus();
}

function sdCancelInlineRow() {
    var row = document.getElementById('sd-inline-row');
    if (row) row.remove();
    document.getElementById('sd-btn-add').disabled = false;
}

function sdSaveInlineRow() {
    var module = document.getElementById('sd-il-module').value.trim();
    var type   = document.getElementById('sd-il-type').value;
    var status = document.getElementById('sd-il-status').value;
    var svcId  = document.getElementById('sd-type-service-id').value;

    if (!module) { document.getElementById('sd-il-module').style.borderColor='#f87171'; document.getElementById('sd-il-module').focus(); return; }
    if (!type)   { document.getElementById('sd-il-type').style.borderColor='#f87171'; return; }

    var saveBtn = document.querySelector('#sd-inline-row button:first-of-type');
    saveBtn.disabled = true;

    var fd = new FormData();
    fd.append('module', module);
    fd.append('type_module', type);
    fd.append('type_service_id', svcId);
    fd.append('status', status);
    fd.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    fetch('/admin/type-services-detail', { method: 'POST', body: fd })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) {
            sdCancelInlineRow();
            sdShowToast('Almacenamiento de módulo exitoso', true);
            sdAppendRow(data.record);
        } else {
            saveBtn.disabled = false;
            if (data.errors && data.errors.module) { document.getElementById('sd-il-module').style.borderColor='#f87171'; }
            if (data.errors && data.errors.type_module) { document.getElementById('sd-il-type').style.borderColor='#f87171'; }
        }
    })
    .catch(function() {
        saveBtn.disabled = false;
        sdShowToast('Error al guardar. Intenta nuevamente.', false);
    });
}

function sdAppendRow(r) {
    var isBasico = r.type_module === 'Basico';
    var isActive = r.status == '1';
    var d = new Date(r.created_at);
    var date = ('0'+d.getDate()).slice(-2)+'/'+('0'+(d.getMonth()+1)).slice(-2)+'/'+d.getFullYear();
    var badgeClass = isBasico ? 'sd-badge-basic' : 'sd-badge-adicional';
    var badgeLabel = isBasico ? 'Básico' : 'Adicional';
    var toggleClass = isActive ? 'on' : 'off';
    var toggleLabel = isActive ? 'Activo' : 'Inactivo';
    var delSvg = '<svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>';

    // Tabla desktop
    var tbody = document.querySelector('.sd-table tbody');
    if (tbody) {
        var num = tbody.querySelectorAll('tr').length + 1;
        var tr = document.createElement('tr');
        tr.setAttribute('data-id', r.id);
        tr.innerHTML =
            '<td><span class="sd-num">'+num+'</span></td>'+
            '<td><span class="sd-module-text" data-id="'+r.id+'" data-original="'+r.module+'">'+r.module+'</span></td>'+
            '<td><span class="sd-badge '+badgeClass+'">'+badgeLabel+'</span></td>'+
            '<td class="center"><div class="sd-toggle-wrap"><button class="sd-toggle '+toggleClass+'" data-id="'+r.id+'"><span></span></button><span class="sd-toggle-label '+toggleClass+'">'+toggleLabel+'</span></div></td>'+
            '<td><span class="sd-date">'+date+'</span></td>'+
            '<td class="center"><button class="sd-btn-del" data-id="'+r.id+'" data-module="'+r.module+'">'+delSvg+'</button></td>';
        tbody.appendChild(tr);
        tr.querySelector('.sd-toggle').addEventListener('click', sdToggleHandler);
        tr.querySelector('.sd-btn-del').addEventListener('click', sdDelHandler);
        tr.querySelector('.sd-module-text').addEventListener('click', sdModuleEditHandler);
    }

    // Cards mobile
    var cards = document.querySelector('.sd-cards');
    if (cards) {
        var card = document.createElement('div');
        card.className = 'sd-card'; card.setAttribute('data-id', r.id);
        card.innerHTML =
            '<div class="sd-card-header"><div><div class="sd-card-module">'+r.module+'</div><div style="margin-top:.3rem"><span class="sd-badge '+badgeClass+'">'+badgeLabel+'</span></div></div>'+
            '<button class="sd-btn-del" data-id="'+r.id+'" data-module="'+r.module+'">'+delSvg+'</button></div>'+
            '<div class="sd-card-row"><span class="sd-card-label">Fecha creación</span><span class="sd-date">'+date+'</span></div>'+
            '<div class="sd-card-footer"><span class="sd-card-label">Estado</span><div class="sd-toggle-wrap"><button class="sd-toggle '+toggleClass+'" data-id="'+r.id+'"><span></span></button><span class="sd-toggle-label '+toggleClass+'">'+toggleLabel+'</span></div></div>';
        cards.appendChild(card);
        card.querySelector('.sd-toggle').addEventListener('click', sdToggleHandler);
        card.querySelector('.sd-btn-del').addEventListener('click', sdDelHandler);
    }
}

function sdToggleHandler() {
    var isOn = this.classList.contains('on');
    this.classList.toggle('on', !isOn);
    this.classList.toggle('off', isOn);
    var label = this.nextElementSibling;
    if (label && label.classList.contains('sd-toggle-label')) {
        label.textContent = isOn ? 'Inactivo' : 'Activo';
        label.classList.toggle('on', !isOn);
        label.classList.toggle('off', isOn);
    }
}

function sdDelHandler() {
    var modulo = this.dataset.module;
    if (!confirm('¿Eliminar el módulo "' + modulo + '"? Esta acción no se puede deshacer.')) return;
    var id = this.dataset.id;
    var row = document.querySelector('.sd-table tbody tr[data-id="'+id+'"]');
    if (row) { row.style.opacity='0'; row.style.transition='opacity .3s'; setTimeout(function(){row.remove();},300); }
    var card = document.querySelector('.sd-card[data-id="'+id+'"]');
    if (card) { card.style.opacity='0'; card.style.transition='opacity .3s'; setTimeout(function(){card.remove();},300); }
}

function sdModuleEditHandler() {
    if (this.querySelector('input')) return;
    var el = this, original = el.dataset.original;
    var input = document.createElement('input');
    input.type = 'text'; input.value = original; input.className = 'sd-module-input';
    el.innerHTML = ''; el.appendChild(input); input.focus(); input.select();
    var restore = function(val) { el.innerHTML = val; el.dataset.original = val; };
    input.addEventListener('blur', function() { restore(this.value.trim() || original); });
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); restore(this.value.trim() || original); }
        if (e.key === 'Escape') restore(original);
    });
}
</script>
