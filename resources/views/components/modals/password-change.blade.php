<!-- Modal Cambio de Contraseña Obligatorio -->
<div id="passwordChangeModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/75 transition-opacity"></div>
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-2xl z-10">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.98-.833-2.75 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Cambio de Contraseña Requerido</h3>
                </div>
            </div>
            
            <div class="mb-6">
                <p class="text-gray-600 mb-4">
                    Por seguridad, debe cambiar su contraseña antes de continuar usando la plataforma.
                </p>
                <div class="bg-red-50 border border-red-200 rounded-md p-3">
                    <p class="text-sm text-red-700">
                        <strong>Importante:</strong> Esta es su tercera sesión. El cambio de contraseña es obligatorio.
                    </p>
                </div>
            </div>
            
            <div class="flex gap-3">
                <a href="{{ route('profile') }}" 
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md text-center transition-colors">
                    Cambiar Contraseña
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sugerencia de Cambio de Contraseña -->
<div id="passwordSuggestionModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeSuggestionModal()"></div>
    <div class="relative w-full max-w-md bg-white rounded-lg shadow-2xl z-10">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Recomendación de Seguridad</h3>
                </div>
                <button type="button" onclick="closeSuggestionModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="mb-6">
                <p class="text-gray-600 mb-4">
                    Le recomendamos cambiar su contraseña por una personalizada para mayor seguridad.
                </p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3">
                    <p class="text-sm text-yellow-700">
                        Está usando una contraseña asignada por el administrador.
                    </p>
                </div>
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="closeSuggestionModal()" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-md transition-colors">
                    Más Tarde
                </button>
                <a href="{{ route('profile') }}" 
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md text-center transition-colors">
                    Cambiar Ahora
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function closeSuggestionModal() {
    document.getElementById('passwordSuggestionModal').classList.add('hidden');
}

// Mostrar modales según las variables de sesión
document.addEventListener('DOMContentLoaded', function() {
    @if(session('force_password_change'))
        document.getElementById('passwordChangeModal').classList.remove('hidden');
        document.getElementById('passwordChangeModal').classList.add('flex');
    @elseif(session('suggest_password_change'))
        document.getElementById('passwordSuggestionModal').classList.remove('hidden');
        document.getElementById('passwordSuggestionModal').classList.add('flex');
    @endif
});
</script>