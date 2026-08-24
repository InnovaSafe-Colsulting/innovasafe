<x-filament-panels::page>
<style>
.bform-wrap { max-width:36rem; margin:2rem auto; padding:0 1rem; }
.bform-card { background:#111827; border:1px solid #1e293b; border-radius:.875rem; overflow:hidden; }
.bform-hd { display:flex; align-items:center; gap:.625rem; padding:.875rem 1.25rem; border-bottom:1px solid #1e293b; }
.bform-hd-back { color:#475569; background:none; border:none; cursor:pointer; padding:.2rem; border-radius:.3rem; text-decoration:none; display:flex; }
.bform-hd-back:hover { color:#94a3b8; background:#1e293b; }
.bform-hd h2 { font-size:.9rem; font-weight:600; color:#f1f5f9; margin:0; }
.bform-body { padding:1.25rem; display:flex; flex-direction:column; gap:1rem; }
.bform-group { display:flex; flex-direction:column; gap:.3rem; }
.bform-label { font-size:.78rem; font-weight:500; color:#94a3b8; }
.bform-label span { color:#ef4444; }
.bform-input, .bform-select { width:100%; background:#0d1117; border:1px solid #1e293b; border-radius:.5rem; padding:.5rem .75rem; font-size:.82rem; color:#f1f5f9; outline:none; transition:border-color .15s; box-sizing:border-box; }
.bform-input:focus, .bform-select:focus { border-color:#3b82f6; }
.bform-input.error, .bform-select.error { border-color:#ef4444; }
.bform-file { width:100%; background:#0d1117; border:1px solid #1e293b; border-radius:.5rem; padding:.45rem .75rem; font-size:.78rem; color:#94a3b8; box-sizing:border-box; }
.bform-file.error { border-color:#ef4444; }
.bform-hint { font-size:.7rem; color:#475569; }
.bform-err { font-size:.72rem; color:#ef4444; }
.bform-footer { display:flex; justify-content:flex-end; gap:.625rem; padding:1rem 1.25rem; border-top:1px solid #1e293b; }
.bform-btn-cancel { padding:.45rem 1.1rem; border:1px solid #1e293b; border-radius:.5rem; background:none; color:#64748b; font-size:.8rem; cursor:pointer; text-decoration:none; }
.bform-btn-cancel:hover { background:#1e293b; color:#94a3b8; }
.bform-btn-submit { padding:.45rem 1.1rem; border-radius:.5rem; background:#3b82f6; color:#fff; font-size:.8rem; font-weight:600; border:none; cursor:pointer; }
.bform-btn-submit:hover { background:#2563eb; }
.bform-btn-submit:disabled { opacity:.6; cursor:not-allowed; }
</style>

<div class="bform-wrap">
    <div class="bform-card">
        <div class="bform-hd">
            <a href="{{ route('filament.admin.pages.banners-page') }}" class="bform-hd-back">
                <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2>Crear Banner</h2>
        </div>

        <div class="bform-body">
            <div class="bform-group">
                <label class="bform-label">Nombre <span>*</span></label>
                <input type="text" wire:model="name" class="bform-input {{ $errors->has('name') ? 'error' : '' }}">
                @error('name')<p class="bform-err">{{ $message }}</p>@enderror
            </div>

            <div class="bform-group">
                <label class="bform-label">Posición <span>*</span></label>
                <input type="number" wire:model="position" min="0" class="bform-input {{ $errors->has('position') ? 'error' : '' }}">
                <p class="bform-hint">Orden de aparición (0 = primero)</p>
                @error('position')<p class="bform-err">{{ $message }}</p>@enderror
            </div>

            <div class="bform-group">
                <label class="bform-label">Imagen <span>*</span></label>
                <input type="file" wire:model="image" accept="image/jpeg,image/png,image/webp" class="bform-file {{ $errors->has('image') ? 'error' : '' }}">
                <p class="bform-hint">JPEG, PNG, WEBP — máx. 2MB</p>
                @error('image')<p class="bform-err">{{ $message }}</p>@enderror
            </div>

            <div class="bform-group">
                <label class="bform-label">Status <span>*</span></label>
                <select wire:model="status" class="bform-select {{ $errors->has('status') ? 'error' : '' }}">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                @error('status')<p class="bform-err">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="bform-footer">
            <a href="{{ route('filament.admin.pages.banners-page') }}" class="bform-btn-cancel">Cancelar</a>
            <button wire:click="save" wire:loading.attr="disabled" class="bform-btn-submit">
                <span wire:loading.remove wire:target="save">Guardar</span>
                <span wire:loading wire:target="save">Guardando...</span>
            </button>
        </div>
    </div>
</div>
</x-filament-panels::page>
