<x-filament-panels::page>
<style>
    .rform-wrap { max-width:36rem; }
    .rform-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
    .rform-hd { display:flex; align-items:center; gap:.625rem; padding:.875rem 1.25rem; border-bottom:1px solid #1e293b; }
    .rform-hd-back { color:#475569; background:none; border:none; cursor:pointer; padding:.2rem; border-radius:.3rem; text-decoration:none; display:flex; }
    .rform-hd-back:hover { color:#94a3b8; background:#1e293b; }
    .rform-hd h2 { font-size:.9rem; font-weight:600; color:#f1f5f9; margin:0; }
    .rform-body { padding:1.25rem; display:flex; flex-direction:column; gap:1rem; }
    .rform-group { display:flex; flex-direction:column; gap:.3rem; }
    .rform-label { font-size:.78rem; font-weight:500; color:#94a3b8; }
    .rform-label span { color:#ef4444; }
    .rform-label em { color:#475569; font-style:normal; }
    .rform-input, .rform-select, .rform-textarea {
        width:100%; background:#0d1117; border:1px solid #1e293b; border-radius:.5rem;
        padding:.5rem .75rem; font-size:.82rem; color:#f1f5f9; outline:none;
        transition:border-color .15s; box-sizing:border-box;
    }
    .rform-input:focus, .rform-select:focus, .rform-textarea:focus { border-color:#3b82f6; }
    .rform-input.err, .rform-select.err, .rform-textarea.err { border-color:#ef4444; }
    .rform-textarea { resize:vertical; min-height:90px; }
    .rform-file { width:100%; background:#0d1117; border:1px solid #1e293b; border-radius:.5rem; padding:.45rem .75rem; font-size:.78rem; color:#94a3b8; box-sizing:border-box; }
    .rform-hint { font-size:.7rem; color:#475569; }
    .rform-err  { font-size:.72rem; color:#ef4444; }
    .rform-footer { display:flex; justify-content:flex-end; gap:.625rem; padding:1rem 1.25rem; border-top:1px solid #1e293b; }
    .rform-btn-cancel { padding:.45rem 1.1rem; border:1px solid #1e293b; border-radius:.5rem; background:none; color:#64748b; font-size:.8rem; cursor:pointer; text-decoration:none; }
    .rform-btn-cancel:hover { background:#1e293b; color:#94a3b8; }
    .rform-btn-submit { padding:.45rem 1.1rem; border-radius:.5rem; background:#3b82f6; color:#fff; font-size:.8rem; font-weight:600; border:none; cursor:pointer; }
    .rform-btn-submit:hover { background:#2563eb; }
    .rform-alert { padding:.65rem .875rem; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); border-radius:.5rem; font-size:.78rem; color:#fca5a5; }
</style>

<div class="rform-wrap">
    <div class="rform-card">
        <div class="rform-hd">
            <a href="{{ route('filament.admin.pages.recursos-page') }}" class="rform-hd-back">
                <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2>Información del Recurso</h2>
        </div>

        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="rform-body">

                {{-- Tipo --}}
                <div class="rform-group">
                    <label class="rform-label">Tipo de Recurso <span>*</span></label>
                    <select name="type_resource_id" id="rtype" required onchange="rtoggle(this.value)"
                        class="rform-select {{ $errors->has('type_resource_id') ? 'err' : '' }}">
                        <option value="">Seleccionar tipo</option>
                        @foreach($resourceTypes as $type)
                            <option value="{{ $type->id }}" {{ old('type_resource_id') == $type->id ? 'selected' : '' }}>{{ $type->resource }}</option>
                        @endforeach
                    </select>
                    @error('type_resource_id')<p class="rform-err">{{ $message }}</p>@enderror
                </div>

                {{-- Título --}}
                <div class="rform-group">
                    <label class="rform-label">Título <span>*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="rform-input {{ $errors->has('title') ? 'err' : '' }}">
                    @error('title')<p class="rform-err">{{ $message }}</p>@enderror
                </div>

                {{-- Campos Blog --}}
                <div id="rfields-blog" style="display:none;display:flex;flex-direction:column;gap:1rem" class="hidden-section">
                    <div class="rform-group">
                        <label class="rform-label">Descripción <span>*</span></label>
                        <textarea name="description" class="rform-textarea {{ $errors->has('description') ? 'err' : '' }}">{{ old('description') }}</textarea>
                        @error('description')<p class="rform-err">{{ $message }}</p>@enderror
                    </div>
                    <div class="rform-group">
                        <label class="rform-label">Enlace <span>*</span></label>
                        <input type="url" name="url_link" value="{{ old('url_link') }}" placeholder="https://..."
                            class="rform-input {{ $errors->has('url_link') ? 'err' : '' }}">
                        @error('url_link')<p class="rform-err">{{ $message }}</p>@enderror
                    </div>
                    <div class="rform-group">
                        <label class="rform-label">Imagen <em>(opcional)</em></label>
                        <input type="file" name="image" accept="image/*" class="rform-file">
                        <p class="rform-hint">JPEG, PNG, GIF — máx. 2MB</p>
                        @error('image')<p class="rform-err">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Campos Documento --}}
                <div id="rfields-doc" style="display:none" class="hidden-section">
                    <div class="rform-group">
                        <label class="rform-label">Archivo <span>*</span></label>
                        <input type="file" name="path" class="rform-file {{ $errors->has('path') ? 'err' : '' }}">
                        <p class="rform-hint">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX — máx. 10MB</p>
                        @error('path')<p class="rform-err">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Estado --}}
                <div class="rform-group">
                    <label class="rform-label">Estado <span>*</span></label>
                    <select name="status" required class="rform-select">
                        <option value="1" {{ old('status','1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                @error('error')
                    <div class="rform-alert">{{ $message }}</div>
                @enderror

            </div>

            <div class="rform-footer">
                <a href="{{ route('filament.admin.pages.recursos-page') }}" class="rform-btn-cancel">Cancelar</a>
                <button type="submit" class="rform-btn-submit">Crear Recurso</button>
            </div>
        </form>
    </div>
</div>

<script>
const BLOG_ID = '{{ $resourceTypes ? collect($resourceTypes)->firstWhere("resource", "Blog")->id ?? 3 : 3 }}';
function rtoggle(val) {
    document.getElementById('rfields-blog').style.display = 'none';
    document.getElementById('rfields-doc').style.display  = 'none';
    if (val === BLOG_ID) document.getElementById('rfields-blog').style.display = 'flex';
    else if (val !== '') document.getElementById('rfields-doc').style.display  = 'flex';
}
document.addEventListener('DOMContentLoaded', () => {
    const v = document.getElementById('rtype').value;
    if (v) rtoggle(v);
});
</script>
</x-filament-panels::page>
