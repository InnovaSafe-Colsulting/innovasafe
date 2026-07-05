<div x-data="{ modules: @entangle('data.modules').defer }" class="space-y-2">
    <template x-if="modules && modules.length > 0">
        <div>
            <h4 class="font-semibold text-sm text-gray-700 dark:text-gray-300 mb-3">Módulos Agregados:</h4>
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                <template x-for="(module, index) in modules" :key="index">
                    <div class="flex justify-between items-center py-2 px-3 bg-white dark:bg-gray-700 rounded-md mb-2 shadow-sm">
                        <div class="flex-1">
                            <span class="font-medium text-gray-800 dark:text-gray-200" x-text="module.name"></span>
                            <span class="ml-2 px-2 py-1 text-xs rounded-full" 
                                  :class="module.type === 'Basico' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'"
                                  x-text="module.type === 'Basico' ? 'Básico' : 'Adicional'">
                            </span>
                        </div>
                        <button 
                            type="button" 
                            @click="modules.splice(index, 1)"
                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                            title="Eliminar módulo">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>