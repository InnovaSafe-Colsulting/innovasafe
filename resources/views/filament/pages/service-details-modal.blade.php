<div class="bg-white rounded-lg font-sans">
    <!-- Título centrado -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">{{ $service->name }}</h2>
    </div>

    @if($service->details && $service->details->count() > 0)
        <div class="text-center">
            <div class="shadow-xl rounded-xl border border-gray-100 inline-block" style="margin: 0 auto; display: inline-block !important;">
                <table class="border-collapse" style="border: 1px solid #d1d5db; border-collapse: collapse; margin: 0 auto;">
                <thead class="bg-linear-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider" style="border: 1px solid #d1d5db;">
                            Módulo
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider" style="border: 1px solid #d1d5db;">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider" style="border: 1px solid #d1d5db;">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider" style="border: 1px solid #d1d5db;">
                            Fecha Creación
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider" style="border: 1px solid #d1d5db;">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($service->details as $detail)
                        <tr class="hover:bg-blue-50 transition-all duration-200" data-detail-id="{{ $detail->id }}">
                            <td class="px-6 py-4" style="border: 1px solid #d1d5db;">
                                <div class="editable-field cursor-pointer hover:bg-blue-100 rounded-lg px-3 py-2 transition-colors" 
                                     data-field="module" 
                                     data-id="{{ $detail->id }}"
                                     data-original="{{ $detail->module }}">
                                    <span class="text-sm font-medium text-gray-900">{{ $detail->module }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4" style="border: 1px solid #d1d5db;">
                                <div class="editable-select cursor-pointer" 
                                     data-field="type_module" 
                                     data-id="{{ $detail->id }}"
                                     data-original="{{ $detail->type_module }}">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $detail->type_module === 'Basico' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ $detail->type_module }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center" style="border: 1px solid #d1d5db;">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" 
                                           class="sr-only status-toggle" 
                                           data-id="{{ $detail->id }}"
                                           {{ $detail->status ? 'checked' : '' }}>
                                    <div class="w-12 h-6 bg-gray-300 rounded-full shadow-inner transition-all duration-300 ease-in-out toggle-bg
                                        {{ $detail->status ? 'bg-green-500!' : '' }}">
                                        <div class="w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 ease-in-out toggle-dot
                                            {{ $detail->status ? 'translate-x-6' : 'translate-x-0.5' }} mt-0.5"></div>
                                    </div>
                                </label>
                            </td>
                            <td class="px-6 py-4" style="border: 1px solid #d1d5db;">
                                <span class="text-sm font-medium text-gray-600">
                                    {{ date('d/m/Y H:i', strtotime($detail->created_at)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center" style="border: 1px solid #d1d5db;">
                                <button type="button" 
                                        class="delete-detail inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full transition-all duration-200 group"
                                        data-id="{{ $detail->id }}"
                                        data-module="{{ $detail->module }}">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Sin módulos</h3>
            <p class="text-sm text-gray-500">Este servicio no tiene módulos configurados.</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edición inline de campos de texto
        document.querySelectorAll('.editable-field').forEach(field => {
            field.addEventListener('click', function() {
                if (this.querySelector('input')) return;
                
                const originalText = this.textContent.trim();
                const fieldName = this.dataset.field;
                const recordId = this.dataset.id;
                
                const input = document.createElement('input');
                input.type = 'text';
                input.value = originalText;
                input.className = 'w-full px-2 py-1 border border-blue-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500';
                
                this.innerHTML = '';
                this.appendChild(input);
                input.focus();
                input.select();
                
                function saveField() {
                    const newValue = input.value.trim();
                    if (newValue !== originalText && newValue !== '') {
                        // Aquí iría la llamada AJAX para guardar
                        console.log(`Guardando ${fieldName}: ${newValue} para ID: ${recordId}`);
                        
                        // Restaurar el HTML completo del span
                        field.innerHTML = `
                            <span class="text-sm font-medium text-gray-900">${newValue}</span>
                        `;
                        field.classList.add('bg-green-50');
                        setTimeout(() => field.classList.remove('bg-green-50'), 1000);
                    } else {
                        // Restaurar contenido original
                        field.innerHTML = `
                            <span class="text-sm font-medium text-gray-900">${originalText}</span>
                        `;
                    }
                    field.dataset.original = newValue || originalText;
                }
                
                input.addEventListener('blur', saveField);
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        saveField();
                    }
                    if (e.key === 'Escape') {
                        field.innerHTML = `
                            <span class="text-sm font-medium text-gray-900">${originalText}</span>
                        `;
                    }
                });
            });
        });
        
        // Edición de select de tipo
        document.querySelectorAll('.editable-select').forEach(field => {
            field.addEventListener('click', function() {
                if (this.querySelector('select')) return;
                
                const originalValue = this.dataset.original;
                const recordId = this.dataset.id;
                
                const select = document.createElement('select');
                select.className = 'px-2 py-1 border border-blue-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500';
                select.innerHTML = `
                    <option value="Basico" ${originalValue === 'Basico' ? 'selected' : ''}>Básico</option>
                    <option value="Adicional" ${originalValue === 'Adicional' ? 'selected' : ''}>Adicional</option>
                `;
                
                this.innerHTML = '';
                this.appendChild(select);
                select.focus();
                
                function saveSelect() {
                    const newValue = select.value;
                    if (newValue !== originalValue) {
                        console.log(`Guardando tipo: ${newValue} para ID: ${recordId}`);
                    }
                    
                    const badge = document.createElement('span');
                    badge.className = `inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors ${
                        newValue === 'Basico' ? 'bg-blue-100 text-blue-800 hover:bg-blue-200' : 'bg-orange-100 text-orange-800 hover:bg-orange-200'
                    }`;
                    badge.textContent = newValue;
                    
                    field.innerHTML = '';
                    field.appendChild(badge);
                    field.dataset.original = newValue;
                    
                    if (newValue !== originalValue) {
                        field.classList.add('bg-green-50');
                        setTimeout(() => field.classList.remove('bg-green-50'), 1000);
                    }
                }
                
                select.addEventListener('blur', saveSelect);
                select.addEventListener('change', saveSelect);
                select.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        const badge = document.createElement('span');
                        badge.className = `inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${
                            originalValue === 'Basico' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800'
                        }`;
                        badge.textContent = originalValue;
                        field.innerHTML = '';
                        field.appendChild(badge);
                    }
                });
            });
        });
        
        // Toggle de estado
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const recordId = this.dataset.id;
                const newStatus = this.checked;
                const toggleDiv = this.nextElementSibling;
                const slider = toggleDiv.querySelector('div');
                
                console.log(`Guardando estado: ${newStatus} para ID: ${recordId}`);
                
                // Actualizar colores
                if (newStatus) {
                    toggleDiv.classList.remove('bg-gray-300');
                    toggleDiv.classList.add('bg-green-500');
                    slider.classList.add('translate-x-5');
                    slider.classList.remove('translate-x-0');
                } else {
                    toggleDiv.classList.remove('bg-green-500');
                    toggleDiv.classList.add('bg-gray-300');
                    slider.classList.remove('translate-x-5');
                    slider.classList.add('translate-x-0');
                }
            });
        });
        
        // Borrar detalle
        document.querySelectorAll('.delete-detail').forEach(button => {
            button.addEventListener('click', function() {
                const recordId = this.dataset.id;
                const moduleName = this.dataset.module;
                
                if (confirm(`¿Estás seguro de borrar el módulo "${moduleName}"?\n\nEsta acción no se puede deshacer.`)) {
                    console.log(`Borrando detalle ID: ${recordId}`);
                    
                    // Aquí iría la llamada AJAX para borrar
                    const row = this.closest('tr');
                    row.style.opacity = '0.5';
                    row.style.pointerEvents = 'none';
                    
                    // Simular eliminación exitosa
                    setTimeout(() => {
                        row.remove();
                        
                        // Si no quedan filas, mostrar mensaje vacío
                        const tbody = document.querySelector('tbody');
                        if (!tbody.children.length) {
                            location.reload(); // Recargar para mostrar estado vacío
                        }
                    }, 500);
                }
            });
        });
    });
</script>