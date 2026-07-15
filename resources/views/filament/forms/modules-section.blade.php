<div style="margin-top: 1%;">
    <!-- Título -->
    <h2 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 24px;">
        Módulos del Servicio
    </h2>
    
    <!-- Campos en línea -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 10px;">
                Nombre del Módulo
            </label>
            <input 
                type="text" 
                id="module_name_input"
                style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem;"
            />
        </div>
        
        <div>
            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 10px;">
                Tipo
            </label>
            <select 
                id="module_type_select"
                style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.15s ease-in-out; background-color: white; color: #111827; cursor: pointer;"
                onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37, 99, 235, 0.1)'"
                onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='0 1px 2px 0 rgba(0, 0, 0, 0.05)'"
            >
                <option value="">Seleccionar</option>
                <option value="Basico">Básico</option>
                <option value="Adicional">Adicional</option>
            </select>
        </div>
    </div>
    
    <!-- Botón centrado -->
    <div style="text-align: center; margin-bottom: 24px;">
        <button 
            type="button"
            id="add_module_btn"
            style="background-color: #2563eb; color: white; padding: 8px 16px; border: none; border-radius: 6px; font-weight: 500; cursor: pointer;"
            onmouseover="this.style.backgroundColor='#1d4ed8'"
            onmouseout="this.style.backgroundColor='#2563eb'"
        >
            Agregar
        </button>
    </div>
    
    <!-- Lista de módulos -->
    <div id="modules_list" style="display: none;">
        <h4 style="font-size: 1rem; font-weight: 500; color: #374151; margin-bottom: 12px;">
            Módulos Agregados (<span id="modules_count">0</span>)
        </h4>
        <div id="modules_container" style="space-y: 8px;"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let modules = [];
    
    const moduleNameInput = document.getElementById('module_name_input');
    const moduleTypeSelect = document.getElementById('module_type_select');
    const addBtn = document.getElementById('add_module_btn');
    const modulesList = document.getElementById('modules_list');
    const modulesContainer = document.getElementById('modules_container');
    const modulesCount = document.getElementById('modules_count');
    
    addBtn.addEventListener('click', function() {
        const name = moduleNameInput.value.trim();
        const type = moduleTypeSelect.value;
        
        if (name && type) {
            const exists = modules.some(module => module.name === name);
            
            if (!exists) {
                modules.push({ name, type });
                moduleNameInput.value = '';
                moduleTypeSelect.value = '';
                updateModulesList();
                updateHiddenInput();
            } else {
                alert('Este módulo ya existe');
            }
        } else {
            alert('Por favor completa todos los campos');
        }
    });
    
    function updateModulesList() {
        if (modules.length > 0) {
            modulesList.style.display = 'block';
            modulesCount.textContent = modules.length;
            
            modulesContainer.innerHTML = modules.map((module, index) => `
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background-color: #f9fafb; border-radius: 6px; margin-bottom: 8px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="color: #374151;">${module.name}</span>
                        <span style="padding: 4px 8px; font-size: 0.75rem; border-radius: 9999px; ${module.type === 'Basico' ? 'background-color: #dbeafe; color: #1e40af;' : 'background-color: #dcfce7; color: #166534;'}">${module.type === 'Basico' ? 'Básico' : 'Adicional'}</span>
                    </div>
                    <button type="button" onclick="removeModule(${index})" style="color: #ef4444; background: none; border: none; cursor: pointer; padding: 4px;">✕</button>
                </div>
            `).join('');
        } else {
            modulesList.style.display = 'none';
        }
    }
    
    function updateHiddenInput() {
        // Actualizar campo hidden de Filament
        const hiddenInput = document.querySelector('input[name="modules"]');
        if (hiddenInput) {
            hiddenInput.value = JSON.stringify(modules);
        }
    }
    
    window.removeModule = function(index) {
        modules.splice(index, 1);
        updateModulesList();
        updateHiddenInput();
    };
});
</script>