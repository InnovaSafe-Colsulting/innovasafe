{{-- Modal Solicitar Demo --}}
@php
    use Illuminate\Support\Facades\DB;
    $typeServicesDemo = DB::table('type_services')
        ->where('status', '1')
        ->where('name', '!=', 'Consultoría')
        ->get();
@endphp
<div id="modal-demo" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div id="modal-demo-overlay" class="absolute inset-0 bg-black/60"></div>
    <div class="relative w-full max-w-md mx-4 bg-[#01020e] rounded-2xl p-8 border border-white/10">
        <button id="modal-demo-close" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h3 class="text-xl font-bold text-white mb-2">Solicita Tu Demo</h3>
        <p class="text-sm text-gray-400 mb-6">Completa el formulario y te mostraremos una demo personalizada.</p>
        <form id="form-demo" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nombre Completo <span class="text-red-400">*</span></label>
                <input type="text" name="name" placeholder="Tu nombre completo" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                <span class="text-red-400 text-xs mt-1 hidden" data-demo-error="name"></span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Correo Electrónico <span class="text-red-400">*</span></label>
                <input type="email" name="email" placeholder="correo@empresa.com" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                <span class="text-red-400 text-xs mt-1 hidden" data-demo-error="email"></span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Número Telefónico</label>
                <input type="tel" name="phone" placeholder="3001234567" maxlength="10" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                <span class="text-xs text-gray-500 mt-1">Entre 7 y 10 dígitos (opcional)</span>
                <span class="text-red-400 text-xs mt-1 hidden" data-demo-error="phone"></span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Servicio de Interés <span class="text-red-400">*</span></label>
                <select name="service_id" class="w-full px-4 py-3 bg-[#01020e] border border-white/10 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    <option value="" disabled selected>Selecciona un servicio</option>
                    @foreach($typeServicesDemo as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                <span class="text-red-400 text-xs mt-1 hidden" data-demo-error="service_id"></span>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                Enviar
            </button>
        </form>
    </div>
</div>