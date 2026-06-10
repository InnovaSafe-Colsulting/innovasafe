{{-- Modal Solicitar Renovación --}}
<div id="modal-renovar" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div id="modal-renovar-overlay" class="absolute inset-0 bg-black/60"></div>
    <div class="relative w-full max-w-2xl mx-4 bg-[#01020e] rounded-2xl border border-white/10 max-h-[90vh] overflow-y-auto">
        <button id="modal-renovar-close" class="absolute top-4 right-4 text-gray-400 hover:text-white transition z-10">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <div class="p-8">
            <h3 class="text-2xl font-bold text-white mb-2">¿Deseas Renovar?</h3>
            <p class="text-gray-400 mb-6">Deseas renovar como cliente nuevamente, déjanos saberlo, deja tu correo, para reenviarte un link de pago</p>
            
            <form id="form-renovar" class="space-y-6" novalidate>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Correo electrónico</label>
                    <input type="email" name="email" id="email-input" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                           placeholder="tu@correo.com">
                    <span class="text-red-500 text-sm mt-1 hidden" data-renovar-error="email"></span>
                </div>

                <div id="user-services" class="hidden">
                    <h4 class="font-semibold text-white mb-3">Tus servicios anteriores:</h4>
                    <div id="services-list" class="space-y-2 mb-4"></div>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-300 mb-2">¿Deseas renovar estos servicios?</p>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="renovar_servicios" value="si" class="mr-2">
                                <span class="text-sm text-white">Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="renovar_servicios" value="no" class="mr-2">
                                <span class="text-sm text-white">No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-300 mb-2">¿Quieres agregar algún otro servicio?</p>
                        <select name="nuevo_servicio" class="w-full px-4 py-3 bg-[#01020e] border border-white/10 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                            <option value="">Selecciona un servicio adicional (opcional)</option>
                            <option value="sst">SST - Seguridad y Salud en el Trabajo</option>
                            <option value="calidad">Gestión de Calidad</option>
                            <option value="ambiental">Gestión Ambiental</option>
                            <option value="consultoria">Consultoría Especializada</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                        Enviar
                    </button>
                </div>

                <div id="no-services" class="hidden">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-gray-300 text-center">Usted no es cliente todavía, lo invitamos a que se convierta en nuestro cliente.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Nombre completo</label>
                            <input type="text" name="nombre_nuevo" required 
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                                   placeholder="Tu nombre completo">
                            <span class="text-red-500 text-sm mt-1 hidden" data-renovar-error="nombre_nuevo"></span>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Teléfono</label>
                            <input type="tel" name="telefono_nuevo" required 
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                                   placeholder="+57 300 123 4567">
                            <span class="text-red-500 text-sm mt-1 hidden" data-renovar-error="telefono_nuevo"></span>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition mt-6">
                        Quiero comprar un producto
                    </button>
                </div>

                <div id="pending-orders" class="hidden">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <p class="text-gray-300 text-center">Ya compraste servicios con nosotros, estamos validando tu pago, dentro de poco te confirmaremos, ¿quieres comprar más servicios?</p>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex gap-6 justify-center">
                            <label class="flex items-center">
                                <input type="radio" name="comprar_mas" value="si" class="mr-2" onchange="showBuyMoreForm()">
                                <span class="text-sm font-medium text-white">Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="comprar_mas" value="no" class="mr-2" onchange="closeModalOnNo()">
                                <span class="text-sm font-medium text-white">No</span>
                            </label>
                        </div>
                    </div>
                    
                    <div id="buy-more-form" class="hidden space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Nombre completo</label>
                            <input type="text" name="nombre_mas" required 
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                                   placeholder="Tu nombre completo">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Teléfono</label>
                            <input type="tel" name="telefono_mas" required 
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                                   placeholder="+57 300 123 4567">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Selecciona el servicio que deseas adquirir</label>
                            <select name="servicio_adicional" required 
                                    class="w-full px-4 py-3 bg-[#01020e] border border-white/10 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                <option value="">-- Selecciona un servicio --</option>
                                <!-- Las opciones se llenarán dinámicamente con JavaScript -->
                            </select>
                        </div>
                        
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                            Quiero comprar más servicios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>