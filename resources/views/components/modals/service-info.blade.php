{{-- Modal Solicitar Información Servicios --}}
<div id="modal-service-info" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div id="modal-service-info-overlay" class="absolute inset-0 bg-black/60"></div>
    <div class="relative w-full max-w-md mx-4 bg-[#01020e] rounded-2xl p-8 border border-white/10">
        <button id="modal-service-info-close" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h3 class="text-xl font-bold text-white mb-3">Solicitar Información</h3>
        <p class="text-sm text-gray-400 mb-6">Queremos que conozcas nuestros servicios, además de que queremos ayudarte. Danos tu correo y te enviaremos un email con toda la información que necesites.</p>
        <form id="form-service-info" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Correo electrónico</label>
                <input type="text" name="email" placeholder="correo@empresa.com" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                <span class="text-red-400 text-xs mt-1 hidden" data-service-info-error="email"></span>
            </div>
            <button type="submit" class="btn w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                Enviar
            </button>
        </form>
    </div>
</div>
