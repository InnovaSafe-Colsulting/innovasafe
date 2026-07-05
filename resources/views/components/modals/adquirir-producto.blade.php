{{-- Modal Adquirir Producto --}}
@php
    use Illuminate\Support\Facades\DB;
    $typeServicesAdquirir = DB::table('type_services')->where('status', '1')->get();
@endphp
<div id="modal-adquirir" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/70" onclick="closeAdquirirModal()"></div>
    <div class="relative w-full max-w-lg mx-4 bg-[#01020e] rounded-2xl border border-white/10 max-h-[90vh] overflow-y-auto">

        {{-- Header --}}
        <div style="background:linear-gradient(135deg,#01020e 0%,#0a1628 60%,#2268bd 100%);padding:28px 28px 20px;border-radius:16px 16px 0 0;">
            <button onclick="closeAdquirirModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 class="text-xl font-bold text-white mb-1">Adquirir Producto</h3>
            <p class="text-sm text-blue-300">Déjanos tus datos y te contactaremos con toda la información.</p>
        </div>

        <div class="p-7">
            <form id="form-adquirir" class="space-y-4">
                @csrf
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
                    <input type="email" name="email" placeholder="correo@empresa.com" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    <span class="text-red-400 text-xs mt-1 hidden" data-error="email"></span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Tipo de Servicio</label>
                    <select name="type_service" class="w-full px-4 py-3 bg-[#01020e] border border-white/10 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        <option value="" disabled selected>Selecciona un servicio</option>
                        @foreach($typeServicesAdquirir as $service)
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

                {{-- Productos seleccionados --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Productos seleccionados</label>
                    <div id="adquirir-productos-lista" class="space-y-2 min-h-[48px]">
                        <p id="adquirir-sin-productos" class="text-gray-500 text-sm italic px-1">No hay productos seleccionados.</p>
                    </div>
                    <span class="text-red-400 text-xs mt-1 hidden" data-error="productos"></span>
                </div>

                <button type="submit" id="btn-adquirir-submit" class="w-full text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2" style="background:linear-gradient(135deg,#1a3a6b,#2268bd);">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Enviar Solicitud
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Productos en el modal
    var adquirirProductos = [];

    function openAdquirirModal(planId, planName, planPeriod, planPrice) {
        // Agregar producto si no está ya
        var exists = adquirirProductos.find(function(p) { return p.id === planId && p.period === planPeriod; });
        if (!exists) {
            adquirirProductos.push({ id: planId, name: planName, period: planPeriod, price: planPrice });
        }
        renderAdquirirProductos();
        clearAdquirirErrors();
        var modal = document.getElementById('modal-adquirir');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeAdquirirModal() {
        var modal = document.getElementById('modal-adquirir');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function removeAdquirirProducto(index) {
        adquirirProductos.splice(index, 1);
        renderAdquirirProductos();
    }

    function renderAdquirirProductos() {
        var lista = document.getElementById('adquirir-productos-lista');
        var sinProductos = document.getElementById('adquirir-sin-productos');
        // Limpiar items previos (no el párrafo vacío)
        lista.querySelectorAll('.adquirir-item').forEach(function(el) { el.remove(); });

        if (adquirirProductos.length === 0) {
            sinProductos.classList.remove('hidden');
            return;
        }
        sinProductos.classList.add('hidden');
        adquirirProductos.forEach(function(p, i) {
            var div = document.createElement('div');
            div.className = 'adquirir-item flex items-center justify-between bg-white/5 border border-white/10 rounded-lg px-4 py-3';
            div.innerHTML =
                '<div>' +
                    '<p class="text-white text-sm font-semibold">' + p.name + '</p>' +
                    '<p class="text-blue-400 text-xs">' + p.period + ' · $' + parseFloat(p.price).toLocaleString('es-CO') + ' COP</p>' +
                '</div>' +
                '<button type="button" onclick="removeAdquirirProducto(' + i + ')" class="text-red-400 hover:text-red-300 transition ml-3 shrink-0">' +
                    '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>' +
                '</button>';
            lista.appendChild(div);
        });
    }

    function clearAdquirirErrors() {
        document.querySelectorAll('#form-adquirir [data-error]').forEach(function(el) {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    document.getElementById('form-adquirir').addEventListener('submit', function(e) {
        e.preventDefault();
        clearAdquirirErrors();

        if (adquirirProductos.length === 0) {
            var errProd = document.querySelector('#form-adquirir [data-error="productos"]');
            errProd.textContent = 'Debes seleccionar al menos un producto.';
            errProd.classList.remove('hidden');
            return;
        }

        var btn = document.getElementById('btn-adquirir-submit');
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Enviando...';

        var form = document.getElementById('form-adquirir');
        var formData = new FormData(form);
        formData.append('productos', JSON.stringify(adquirirProductos));

        fetch('/adquirir-producto', {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            btn.innerHTML = '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Enviar Solicitud';
            if (data.success) {
                closeAdquirirModal();
                form.reset();
                adquirirProductos = [];
                renderAdquirirProductos();
                document.querySelectorAll('.billing-check').forEach(function(chk) { chk.checked = false; });
                showToast('Nos comunicaremos en el transcurso del día para que podamos darte toda la información que desees y puedas adquirir nuestros productos', 'success', 5000);
            } else {
                if (data.errors) {
                    Object.keys(data.errors).forEach(function(field) {
                        var el = document.querySelector('#form-adquirir [data-error="' + field + '"]');
                        if (el) { el.textContent = data.errors[field][0]; el.classList.remove('hidden'); }
                    });
                } else {
                    showToast(data.message || 'Error al enviar la solicitud.', 'error');
                }
            }
        })
        .catch(function() {
            btn.disabled = false;
            btn.innerHTML = '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> Enviar Solicitud';
            showToast('Error al enviar la solicitud. Intenta nuevamente.', 'error');
        });
    });
</script>
