@extends('layouts.app')

@section('title', 'Contacto')

@section('content')

{{-- Hero Contact --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="contact-title font-semibold tracking-widest uppercase mb-4">CONTÁCTANOS</p>
        <h1 class="contact-heading text-white font-bold leading-tight">Estamos para ayudarte</h1>
        <p class="contact-subtitle text-white mt-4 leading-relaxed mx-auto">Cuéntanos sobre tu empresa y tus necesidades. Nuestro equipo te contactará en menos de 24 horas.</p>
    </div>
</section>

{{-- Contact Content --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Left - Info de contacto --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Información de contacto</h2>
                <div class="w-12 h-1 bg-[#39bf24] mb-8"></div>

                {{-- Email --}}
                <div class="flex items-start gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Correo electrónico</p>
                        <p class="text-lg font-bold text-gray-900">{{ $companyConfig['email'] ?? '' }}</p>
                        <p class="text-sm text-gray-500">Envíanos tu consulta y te responderemos a la brevedad.</p>
                    </div>
                </div>

                {{-- Teléfono --}}
                <div class="flex items-start gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Teléfono</p>
                        <p class="text-lg font-bold text-gray-900">+57 {{ $companyConfig['cellphone'] ?? '' }}</p>
                        <p class="text-sm text-gray-500">Lunes a Viernes de 8:00 a.m. a 6:00 p.m.</p>
                    </div>
                </div>

                {{-- Oficina --}}
                <div class="flex items-start gap-4 mb-10">
                    <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Oficina</p>
                        <p class="text-lg font-bold text-gray-900">Bogotá, Colombia</p>
                        <p class="text-sm text-gray-500">Atención presencial con cita previa, virtual o llamada telefónica.</p>
                    </div>
                </div>

                {{-- Card oscura --}}
                <div class="bg-[#0a0f2c] rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-[#39bf24]/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-white font-bold">Soluciones que impulsan tu crecimiento</h3>
                    </div>
                    <p class="text-gray-400 text-sm mb-6">Expertos en seguridad, calidad, medio ambiente y transformación digital.</p>
                    <div class="grid grid-cols-5 gap-4 text-center">
                        @foreach(json_decode($companyConfig['contact_solutions'] ?? '[]') as $solution)
                        <div>
                            {!! $solution->icon !!}
                            <p class="text-xs text-gray-300">{{ $solution->label }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right - Formulario --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-[#0a0f2c] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Envíanos tu mensaje</h3>
                </div>
                <p class="text-sm text-gray-500 mb-6">Completa el formulario y uno de nuestros asesores se pondrá en contacto contigo.</p>

                <form id="form-contact" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1">Nombres <span class="text-red-500">*</span></label>
                            <input type="text" name="names" placeholder="Tus nombres" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#39bf24] focus:border-transparent outline-none transition">
                            <span class="text-red-500 text-xs mt-1 hidden" data-contact-error="names"></span>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1">Apellidos <span class="text-red-500">*</span></label>
                            <input type="text" name="last_names" placeholder="Tus apellidos" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#39bf24] focus:border-transparent outline-none transition">
                            <span class="text-red-500 text-xs mt-1 hidden" data-contact-error="last_names"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1">Correo electrónico <span class="text-red-500">*</span></label>
                            <input type="text" name="email" placeholder="correo@empresa.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#39bf24] focus:border-transparent outline-none transition">
                            <span class="text-red-500 text-xs mt-1 hidden" data-contact-error="email"></span>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1">Teléfono <span class="text-red-500">*</span></label>
                            <input type="text" name="cellphone" placeholder="3001234567" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#39bf24] focus:border-transparent outline-none transition">
                            <span class="text-red-500 text-xs mt-1 hidden" data-contact-error="cellphone"></span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1">Servicio de interés <span class="text-red-500">*</span></label>
                        <select name="service_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#39bf24] focus:border-transparent outline-none transition text-gray-500">
                            <option value="">Selecciona un servicio</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-red-500 text-xs mt-1 hidden" data-contact-error="service_id"></span>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1">Mensaje</label>
                        <textarea name="message" rows="5" placeholder="Cuéntanos sobre tu proyecto o necesidad..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#39bf24] focus:border-transparent outline-none transition resize-none"></textarea>
                        <span class="text-red-500 text-xs mt-1 hidden" data-contact-error="message"></span>
                    </div>

                    <button type="submit" class="w-full bg-[#39bf24] hover:bg-[#2ea31d] text-white font-semibold py-4 rounded-full transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Enviar mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Valores --}}
<section class="py-10 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Confianza</p>
                    <p class="text-xs text-gray-500">Comprometidos con tu éxito</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Experiencia</p>
                    <p class="text-xs text-gray-500">Más de 10 años de trayectoria</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Calidad</p>
                    <p class="text-xs text-gray-500">Enfoque en la mejora continua</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Compromiso</p>
                    <p class="text-xs text-gray-500">Soluciones a la medida</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
