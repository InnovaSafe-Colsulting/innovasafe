{{-- Modal Solicitar Asesoría --}}
@php
    use Illuminate\Support\Facades\DB;
    $typeServices = DB::table('type_services')->where('status', '1')->get();
@endphp
<div id="modal-asesoria" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div id="modal-overlay" class="absolute inset-0 bg-black/60"></div>
    <div class="relative w-full max-w-md mx-4 bg-[#01020e] rounded-2xl p-8 border border-white/10">
        <button id="modal-close" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h3 class="text-xl font-bold text-white mb-2">Solicitar Asesoría</h3>
        <p class="text-sm text-gray-400 mb-6">Déjanos tus datos y te contactaremos pronto.</p>
        <form id="form-asesoria" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Nombres</label>
                    <input type="text" name="names" placeholder="Tus nombres" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    <span class="text-red-400 text-xs mt-1 hidden" data-error="names"></span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Apellidos</label>
                    <input type="text" name="last_names" placeholder="Tus apellidos" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    <span class="text-red-400 text-xs mt-1 hidden" data-error="last_names"></span>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Correo electrónico</label>
                <input type="text" name="email" placeholder="correo@empresa.com" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                <span class="text-red-400 text-xs mt-1 hidden" data-error="email"></span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Tipo de Servicio</label>
                <select name="type_service" class="w-full px-4 py-3 bg-[#01020e] border border-white/10 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    <option value="" disabled selected>Selecciona un servicio</option>
                    @foreach($typeServices as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                <span class="text-red-400 text-xs mt-1 hidden" data-error="type_service"></span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Número telefónico</label>
                <input type="text" name="phone" placeholder="3001234567" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                <span class="text-red-400 text-xs mt-1 hidden" data-error="phone"></span>
            </div>
            <button type="submit" class="btn w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                Enviar
            </button>
        </form>
    </div>
</div>
