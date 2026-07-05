<div x-data="moduleManager()" class="fi-fo-field-wrp">
    <!-- Título principal más grande con 1% margen arriba -->
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6" style="margin-top: 1%;">
        Módulos del Servicio
    </h2>
    
    <!-- Campos en línea horizontal -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white block mb-2" style="margin-bottom: 10px;">
                Nombre del Módulo
            </label>
            <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20 focus-within:ring-2 focus-within:ring-primary-600 dark:focus-within:ring-primary-500">
                <input 
                    type="text" 
                    x-model="newModule.name"
                    placeholder="Nombre del módulo"
                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 bg-transparent px-3 py-1.5"
                />
            </div>
        </div>
        
        <div>
            <label class="text-sm font-medium leading-6 text-gray-950 dark:text-white block mb-2" style="margin-bottom: 10px;">
                Tipo
            </label>
            <div class="fi-select-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20 focus-within:ring-2 focus-within:ring-primary-600 dark:focus-within:ring-primary-500">
                <select 
                    x-model="newModule.type"
                    class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 ps-3 text-base text-gray-950 transition duration-75 focus:ring-0 dark:text-white sm:text-sm sm:leading-6"
                >
                    <option value="">Seleccionar</option>
                    <option value="Basico">Básico</option>
                    <option value="Adicional">Adicional</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Botón centrado abajo de los campos -->
    <div class="text-center mb-6">
        <button 
            type="button"
            @click="addModule()"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition"
        >
            Agregar
        </button>
    </div>
    
    <!-- Lista de módulos agregados -->
    <div x-show="modules.length > 0">
        <h4 class="text-base font-medium text-gray-900 dark:text-white mb-3">
            Módulos Agregados (<span x-text="modules.length"></span>)
        </h4>
        
        <div class="space-y-2">
            <template x-for="(module, index) in modules" :key="index">
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <div class="flex items-center gap-3">
                        <span class="text-gray-900 dark:text-white" x-text="module.name"></span>
                        <span 
                            class="px-2 py-1 text-xs rounded-full"
                            :class="module.type === 'Basico' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'"
                            x-text="module.type === 'Basico' ? 'Básico' : 'Adicional'"
                        ></span>
                    </div>
                    <button 
                        type="button"
                        @click="removeModule(index)"
                        class="text-red-500 hover:text-red-700"
                    >
                        ✕
                    </button>
                </div>
            </template>
        </div>
    </div>
    
    <input type="hidden" name="modules" :value="JSON.stringify(modules)" />
</div>

<script>
function moduleManager() {
    return {
        modules: [],
        newModule: {
            name: '',
            type: ''
        },
        
        addModule() {
            if (this.newModule.name && this.newModule.type) {
                const exists = this.modules.some(module => module.name === this.newModule.name);
                
                if (!exists) {
                    this.modules.push({
                        name: this.newModule.name,
                        type: this.newModule.type
                    });
                    
                    this.newModule.name = '';
                    this.newModule.type = '';
                }
            }
        },
        
        removeModule(index) {
            this.modules.splice(index, 1);
        }
    }
}
</script>