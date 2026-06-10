@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')

{{-- Hero About --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-7xl mx-auto" style="padding-left: 5%; padding-right: 5%;">
        <p class="about-title font-semibold tracking-widest uppercase mb-4 text-center">QUIÉNES SOMOS</p>
        <h1 class="about-heading text-white font-bold leading-tight text-center">PASIÓN POR LA</h1>
        <p class="about-description text-white mt-6 text-justify">Somos un equipo multidisciplinario dedicado a transformar la forma en que las organizaciones gestionan la seguridad, la calidad y la sostenibilidad. Innovamos en prevención para impulsar empresas más seguras, eficientes y sostenibles.</p>
    </div>
</section>

{{-- Misión y Visión --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Misión --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-10 h-10 text-[#2268bd] mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
                    <circle cx="12" cy="12" r="6" stroke-width="1.5"/>
                    <circle cx="12" cy="12" r="2" stroke-width="2"/>
                </svg>
                <h3 class="text-2xl font-bold text-[#0a0f2c] mb-4">Misión</h3>
                <p class="text-gray-600">En Innovaself Consulting ofrecemos plataformas digitales especializadas que permiten a las organizaciones optimizar, automatizar y fortalecer sus procesos empresariales. A través de soluciones tecnológicas innovadoras, bajo un modelo de servicio continuo, brindamos herramientas eficientes, intuitivas y escalables en áreas como SST, calidad, gestión organizacional y otros procesos estratégicos, generando valor y crecimiento sostenible para nuestros clientes.</p>
            </div>

            {{-- Visión --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-10 h-10 text-[#2268bd] mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <h3 class="text-2xl font-bold text-[#0a0f2c] mb-4">Visión</h3>
                <p class="text-gray-600">Ser una empresa líder en Latinoamérica en soluciones tecnológicas empresariales, reconocida por contar con un ecosistema de aplicativos innovadores, confiables y adaptables a las necesidades del mercado. En Innovaself Consulting buscamos transformar la gestión empresarial mediante plataformas digitales que impulsen la eficiencia, el cumplimiento, la productividad y la evolución tecnológica de las organizaciones.</p>
            </div>

        </div>
    </div>
</section>

{{-- Valores Corporativos --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-[#2268bd] font-semibold text-sm tracking-widest uppercase mb-3">NUESTROS PRINCIPIOS</p>
            <h2 class="text-4xl sm:text-5xl font-black text-[#0a0f2c] mb-4">Valores Corporativos</h2>
            <p class="text-gray-500">Los pilares que guían cada decisión y cada solución que entregamos.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Innovación</h3>
                <p class="text-gray-600 text-sm">Buscamos constantemente nuevas ideas y tecnologías para ofrecer soluciones modernas y eficientes que generen valor real.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Compromiso</h3>
                <p class="text-gray-600 text-sm">Trabajamos con responsabilidad y dedicación para cumplir las expectativas de nuestros clientes y aliados.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Calidad</h3>
                <p class="text-gray-600 text-sm">Diseñamos productos y servicios con altos estándares técnicos y funcionales, enfocados en la excelencia.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Integridad</h3>
                <p class="text-gray-600 text-sm">Actuamos con honestidad, transparencia y ética en todas nuestras relaciones comerciales y profesionales.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Orientación al Cliente</h3>
                <p class="text-gray-600 text-sm">Entendemos las necesidades de nuestros clientes y desarrollamos soluciones adaptadas a sus retos y objetivos.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Trabajo en Equipo</h3>
                <p class="text-gray-600 text-sm">Creemos en la colaboración y en el talento conjunto como base para alcanzar resultados extraordinarios.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <svg class="w-8 h-8 text-[#2268bd] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">Mejora Continua</h3>
                <p class="text-gray-600 text-sm">Evaluamos y optimizamos constantemente nuestros procesos, productos y servicios para mantenernos competitivos.</p>
            </div>

        </div>
    </div>
</section>

@endsection
