{{-- Modal Alerta Genérico --}}
<div id="alertModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 bg-black/60" role="dialog" aria-modal="true">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all">
        <div class="p-6 text-center">
            {{-- Icono --}}
            <div id="alert-icon-container" class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center">
            </div>
            {{-- Mensaje --}}
            <p id="alert-message" class="text-gray-700 font-medium text-sm leading-relaxed"></p>
        </div>
        <div class="px-6 pb-6">
            <button onclick="closeAlertModal()" class="w-full bg-[#0a0f2c] hover:bg-[#141a3d] text-white font-semibold py-3 rounded-lg transition-colors">
                Entendido
            </button>
        </div>
    </div>
</div>
