@php
    $details = \Illuminate\Support\Facades\DB::table('type_services_detail')
        ->where('type_service_id', $service->id)
        ->orderBy('type_module')
        ->orderBy('module')
        ->get();
@endphp

<div class="bg-white rounded-lg font-sans">

    @if($details->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider border border-gray-200">Módulo</th>
                        <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider border border-gray-200">Tipo</th>
                        <th class="px-4 py-3 text-center font-bold text-gray-700 uppercase tracking-wider border border-gray-200">Estado</th>
                        <th class="px-4 py-3 text-left font-bold text-gray-700 uppercase tracking-wider border border-gray-200">Fecha Creación</th>
                        <th class="px-4 py-3 text-center font-bold text-gray-700 uppercase tracking-wider border border-gray-200">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($details as $detail)
                    <tr class="hover:bg-blue-50 transition-colors" data-detail-id="{{ $detail->id }}">
                        <td class="px-4 py-3 border border-gray-200">
                            <div class="editable-field cursor-pointer hover:bg-blue-100 rounded px-2 py-1 transition-colors"
                                 data-field="module" data-id="{{ $detail->id }}" data-original="{{ $detail->module }}">
                                <span class="font-medium text-gray-900">{{ $detail->module }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 border border-gray-200">
                            <div class="editable-select cursor-pointer"
                                 data-field="type_module" data-id="{{ $detail->id }}" data-original="{{ $detail->type_module }}">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $detail->type_module === 'Basico' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                    {{ $detail->type_module === 'Basico' ? 'Básico' : 'Adicional' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center border border-gray-200">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only status-toggle"
                                       data-id="{{ $detail->id }}" {{ $detail->status ? 'checked' : '' }}>
                                <div class="w-11 h-6 rounded-full transition-colors duration-300 toggle-bg {{ $detail->status ? 'bg-green-500' : 'bg-gray-300' }}">
                                    <div class="w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-300 toggle-dot mt-0.5
                                        {{ $detail->status ? 'translate-x-5' : 'translate-x-0.5' }}"></div>
                                </div>
                            </label>
                        </td>
                        <td class="px-4 py-3 border border-gray-200 text-gray-600">
                            {{ \Carbon\Carbon::parse($detail->created_at)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-center border border-gray-200">
                            <button type="button" class="delete-detail inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full transition-all"
                                    data-id="{{ $detail->id }}" data-module="{{ $detail->module }}">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-10 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
            <svg class="mx-auto h-8 w-8 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-base font-semibold text-gray-900 mb-1">Sin módulos</h3>
            <p class="text-sm text-gray-500">Este servicio no tiene módulos configurados.</p>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editable-field').forEach(field => {
        field.addEventListener('click', function() {
            if (this.querySelector('input')) return;
            const originalText = this.dataset.original;
            const input = document.createElement('input');
            input.type = 'text';
            input.value = originalText;
            input.className = 'w-full px-2 py-1 border border-blue-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm';
            this.innerHTML = '';
            this.appendChild(input);
            input.focus(); input.select();
            const restore = (val) => {
                field.innerHTML = `<span class="font-medium text-gray-900">${val}</span>`;
                field.dataset.original = val;
            };
            input.addEventListener('blur', () => restore(input.value.trim() || originalText));
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') { e.preventDefault(); restore(input.value.trim() || originalText); }
                if (e.key === 'Escape') restore(originalText);
            });
        });
    });

    document.querySelectorAll('.editable-select').forEach(field => {
        field.addEventListener('click', function() {
            if (this.querySelector('select')) return;
            const originalValue = this.dataset.original;
            const select = document.createElement('select');
            select.className = 'px-2 py-1 border border-blue-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500';
            select.innerHTML = `
                <option value="Basico" ${originalValue === 'Basico' ? 'selected' : ''}>Básico</option>
                <option value="Adicional" ${originalValue === 'Adicional' ? 'selected' : ''}>Adicional</option>
            `;
            this.innerHTML = '';
            this.appendChild(select);
            select.focus();
            const restore = (val) => {
                field.innerHTML = `<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold ${val === 'Basico' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800'}">${val === 'Basico' ? 'Básico' : 'Adicional'}</span>`;
                field.dataset.original = val;
            };
            select.addEventListener('blur', () => restore(select.value));
            select.addEventListener('change', () => restore(select.value));
            select.addEventListener('keydown', e => { if (e.key === 'Escape') restore(originalValue); });
        });
    });

    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const bg = this.nextElementSibling;
            const dot = bg.querySelector('div');
            if (this.checked) {
                bg.classList.replace('bg-gray-300', 'bg-green-500');
                dot.classList.replace('translate-x-0.5', 'translate-x-5');
            } else {
                bg.classList.replace('bg-green-500', 'bg-gray-300');
                dot.classList.replace('translate-x-5', 'translate-x-0.5');
            }
        });
    });

    document.querySelectorAll('.delete-detail').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm(`¿Borrar el módulo "${this.dataset.module}"? Esta acción no se puede deshacer.`)) {
                const row = this.closest('tr');
                row.style.opacity = '0.4';
                row.style.pointerEvents = 'none';
                setTimeout(() => { row.remove(); }, 400);
            }
        });
    });
});
</script>
