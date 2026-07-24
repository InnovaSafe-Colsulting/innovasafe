<x-filament-panels::page>
<style>
    .rec-toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; }
    .rec-btn-create { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem 1rem; background:#3b82f6; color:#fff; border-radius:.5rem; font-size:.8rem; font-weight:600; text-decoration:none; border:none; cursor:pointer; transition:background .15s; }
    .rec-btn-create:hover { background:#2563eb; }
    .rec-filters { display:flex; flex-wrap:wrap; gap:1rem; background:#111827; border:1px solid #1e293b; border-radius:.75rem; padding:.75rem 1.25rem; margin-bottom:1rem; }
    .rec-filters label { display:flex; align-items:center; gap:.4rem; font-size:.8rem; color:#94a3b8; cursor:pointer; }
    .rec-filters input[type=radio] { accent-color:#3b82f6; }
    .rec-panel { background:#111827; border:1px solid #1e293b; border-radius:.75rem; overflow:hidden; margin-bottom:1rem; }
    .rec-panel-hd { padding:.6rem 1.25rem; border-bottom:1px solid #1e293b; font-size:.72rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; }
    .rec-table { width:100%; border-collapse:collapse; }
    .rec-table th { padding:.6rem 1rem; text-align:left; font-size:.72rem; font-weight:600; color:#64748b; text-transform:uppercase; background:#0d1117; border-bottom:1px solid #1e293b; }
    .rec-table td { padding:.65rem 1rem; font-size:.8rem; color:#cbd5e1; border-bottom:1px solid #0d1117; vertical-align:middle; }
    .rec-table tr:last-child td { border-bottom:none; }
    .rec-table tr:hover td { background:#0d1117; }
    .rec-thumb { width:2.5rem; height:2.5rem; border-radius:.4rem; object-fit:cover; }
    .rec-thumb-ph { width:2.5rem; height:2.5rem; border-radius:.4rem; background:#1e293b; display:flex; align-items:center; justify-content:center; }
    .rec-toggle { position:relative; display:inline-flex; width:2.25rem; height:1.25rem; border-radius:9999px; border:none; cursor:pointer; transition:background .2s; }
    .rec-toggle.on  { background:#22c55e; }
    .rec-toggle.off { background:#334155; }
    .rec-toggle span { position:absolute; top:.15rem; width:.95rem; height:.95rem; border-radius:50%; background:#fff; transition:transform .2s; }
    .rec-toggle.on  span { transform:translateX(1.1rem); }
    .rec-toggle.off span { transform:translateX(.15rem); }
    .rec-actions { display:flex; align-items:center; gap:.5rem; }
    .rec-btn-edit { color:#3b82f6; background:none; border:none; cursor:pointer; padding:.2rem; border-radius:.3rem; }
    .rec-btn-edit:hover { background:#1e293b; }
    .rec-btn-del  { color:#ef4444; background:none; border:none; cursor:pointer; padding:.2rem; border-radius:.3rem; }
    .rec-btn-del:hover  { background:#1e293b; }
    .rec-empty { text-align:center; padding:2.5rem 1rem; color:#475569; font-size:.82rem; }
    .rec-link { color:#3b82f6; text-decoration:none; font-size:.78rem; }
    .rec-link:hover { text-decoration:underline; }
    /* Modal */
    .rec-modal-bg { position:fixed; inset:0; background:rgba(0,0,0,.65); z-index:50; display:none; align-items:center; justify-content:center; }
    .rec-modal-bg.open { display:flex; }
    .rec-modal { background:#1e293b; border:1px solid #334155; border-radius:.875rem; width:100%; max-width:26rem; margin:1rem; padding:1.5rem; position:relative; z-index:51; }
    .rec-modal-ico { width:2.75rem; height:2.75rem; border-radius:50%; background:rgba(239,68,68,.15); display:flex; align-items:center; justify-content:center; margin-bottom:.875rem; }
    .rec-modal h3 { font-size:.95rem; font-weight:600; color:#f1f5f9; margin-bottom:.4rem; }
    .rec-modal p  { font-size:.8rem; color:#94a3b8; line-height:1.55; }
    .rec-modal-footer { display:flex; justify-content:flex-end; gap:.625rem; margin-top:1.25rem; }
    .rec-btn-cancel { padding:.45rem 1.1rem; border:1px solid #334155; border-radius:.5rem; background:none; color:#94a3b8; font-size:.8rem; cursor:pointer; }
    .rec-btn-cancel:hover { background:#334155; }
    .rec-btn-confirm { padding:.45rem 1.1rem; border-radius:.5rem; background:#ef4444; color:#fff; font-size:.8rem; font-weight:600; border:none; cursor:pointer; }
    .rec-btn-confirm:hover { background:#dc2626; }
    /* Toast */
    .rec-toast { position:fixed; bottom:1.5rem; right:1.5rem; z-index:60; padding:.65rem 1.25rem; border-radius:.5rem; font-size:.82rem; font-weight:500; color:#fff; background:#22c55e; display:none; box-shadow:0 4px 12px rgba(0,0,0,.3); }
</style>

<div class="rec-toolbar">
    <div></div>
    <a href="{{ route('filament.admin.pages.recursos-crear-page') }}" class="rec-btn-create">
        <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Crear Recurso
    </a>
</div>

{{-- Filtros --}}
<div class="rec-filters">
    @foreach($resourceTypes as $type)
        @php $val = strtolower($type->resource) === 'blog' ? 'blog' : $type->id; @endphp
        <label>
            <input type="radio" name="rec_filter" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} onchange="recFilter('{{ $val }}')">
            {{ $type->resource }}
        </label>
    @endforeach
</div>

{{-- Tabla Blog --}}
<div id="rec-blog" class="rec-panel">
    <div class="rec-panel-hd">Blog</div>
    @if(count($blogs) > 0)
        <div style="overflow-x:auto">
            <table class="rec-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Enlace</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset('storage/'.$blog->image) }}" class="rec-thumb" alt="">
                                @else
                                    <div class="rec-thumb-ph">
                                        <svg style="width:14px;height:14px;color:#475569" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight:500;color:#f1f5f9">{{ $blog->title }}</td>
                            <td style="max-width:200px;color:#64748b">{{ \Illuminate\Support\Str::limit($blog->description ?? '', 55) }}</td>
                            <td>
                                @if($blog->url_link)
                                    <a href="{{ $blog->url_link }}" target="_blank" class="rec-link">{{ \Illuminate\Support\Str::limit($blog->url_link, 28) }}</a>
                                @else
                                    <span style="color:#334155">—</span>
                                @endif
                            </td>
                            <td style="white-space:nowrap;color:#64748b">{{ $blog->created_at }}</td>
                            <td>
                                <button wire:click="toggleStatus({{ $blog->id }}, 'blog', {{ $blog->status ? 0 : 1 }})"
                                    class="rec-toggle {{ $blog->status ? 'on' : 'off' }}">
                                    <span></span>
                                </button>
                            </td>
                            <td>
                                <div class="rec-actions">
                                    <a href="{{ route('filament.admin.pages.recursos-editar-page', ['id'=>$blog->id,'type'=>'blog']) }}" class="rec-btn-edit" title="Editar">
                                        <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button onclick="recConfirmDelete({{ $blog->id }}, 'blog', '{{ addslashes($blog->title) }}')" class="rec-btn-del" title="Eliminar">
                                        <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="rec-empty">No hay blogs creados.</div>
    @endif
</div>

{{-- Tablas por tipo documento --}}
@foreach($resourceTypes as $type)
    @php $filtered = array_filter($documents, fn($d) => $d->resource_type_id == $type->id); @endphp
    <div id="rec-{{ $type->id }}" class="rec-panel" style="display:none">
        <div class="rec-panel-hd">{{ $type->resource }}</div>
        @if(count($filtered) > 0)
            <div style="overflow-x:auto">
                <table class="rec-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Archivo</th>
                            <th>Creado</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filtered as $doc)
                            <tr>
                                <td style="font-weight:500;color:#f1f5f9">{{ $doc->title }}</td>
                                <td>
                                    @if($doc->path)
                                        <a href="{{ asset('storage/'.$doc->path) }}" target="_blank" class="rec-link" style="display:inline-flex;align-items:center;gap:.3rem">
                                            <svg style="width:13px;height:13px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            Descargar
                                        </a>
                                    @else
                                        <span style="color:#334155">—</span>
                                    @endif
                                </td>
                                <td style="white-space:nowrap;color:#64748b">{{ $doc->created_at }}</td>
                                <td>
                                    <button wire:click="toggleStatus({{ $doc->id }}, 'document', {{ $doc->status ? 0 : 1 }})"
                                        class="rec-toggle {{ $doc->status ? 'on' : 'off' }}">
                                        <span></span>
                                    </button>
                                </td>
                                <td>
                                    <div class="rec-actions">
                                        <a href="{{ route('filament.admin.pages.recursos-editar-page', ['id'=>$doc->id,'type'=>'document']) }}" class="rec-btn-edit" title="Editar">
                                            <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <button onclick="recConfirmDelete({{ $doc->id }}, 'document', '{{ addslashes($doc->title) }}')" class="rec-btn-del" title="Eliminar">
                                            <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="rec-empty">No hay {{ strtolower($type->resource) }} creados.</div>
        @endif
    </div>
@endforeach

{{-- Modal --}}
<div id="recModal" class="rec-modal-bg">
    <div class="rec-modal">
        <div class="rec-modal-ico">
            <svg style="width:20px;height:20px;color:#ef4444" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h3>¿Desea eliminar este recurso?</h3>
        <p>El recurso <strong id="recDelTitle" style="color:#f1f5f9"></strong> será eliminado permanentemente. <span style="color:#ef4444">Una vez borrado no se podrá recuperar.</span></p>
        <div class="rec-modal-footer">
            <button onclick="recCloseModal()" class="rec-btn-cancel">No</button>
            <button onclick="recExecuteDelete()" class="rec-btn-confirm">Sí, eliminar</button>
        </div>
    </div>
</div>

<div id="recToast" class="rec-toast"></div>

<script>
let recDelTarget = null;

function recFilter(val) {
    document.getElementById('rec-blog').style.display = 'none';
    @foreach($resourceTypes as $type)
        document.getElementById('rec-{{ $type->id }}').style.display = 'none';
    @endforeach
    if (val === 'blog') {
        document.getElementById('rec-blog').style.display = 'block';
    } else {
        document.getElementById('rec-' + val).style.display = 'block';
    }
}

function recConfirmDelete(id, type, title) {
    recDelTarget = { id, type };
    document.getElementById('recDelTitle').textContent = title;
    document.getElementById('recModal').classList.add('open');
}

function recCloseModal() {
    recDelTarget = null;
    document.getElementById('recModal').classList.remove('open');
}

function recExecuteDelete() {
    if (!recDelTarget) return;
    @this.call('deleteResource', recDelTarget.id, recDelTarget.type);
    recCloseModal();
}

document.addEventListener('livewire:initialized', () => {
    Livewire.on('resource-deleted', () => recShowToast('Elemento borrado con éxito.'));
});

function recShowToast(msg) {
    const t = document.getElementById('recToast');
    t.textContent = msg;
    t.style.display = 'block';
    setTimeout(() => t.style.display = 'none', 3000);
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') recCloseModal(); });
</script>
</x-filament-panels::page>
