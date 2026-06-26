@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

@php
    use Illuminate\Support\Facades\DB;
    $stats = DB::table('configuration_company')->pluck('value', 'name');
@endphp

{{-- Hero Section --}}
<section class="relative bg-[#01020e] pt-24 lg:pt-32 pb-0 overflow-hidden">
    {{-- Background layers --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#01020e] via-[#020818] to-[#01020e]"></div>
    <div class="absolute top-0 right-0 w-2/3 h-full bg-[radial-gradient(ellipse_at_70%_50%,rgba(59,130,246,0.08),transparent_60%)]"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[radial-gradient(circle,rgba(59,130,246,0.05),transparent_70%)]"></div>

    {{-- Shield background image --}}
    <div class="absolute top-0 right-0 w-[60%] h-[85%] hidden lg:block">
        <img src="{{ asset('images/home/shield-hero.png') }}" alt="Shield" class="w-full h-full object-contain object-right mix-blend-lighten">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-[60vh] flex items-center">
            {{-- Left Content --}}
            <div class="py-8 lg:py-16 max-w-xl">
                <p class="text-[#1d4ed8] font-semibold text-sm tracking-widest uppercase mb-4">INNOVAMOS EN PREVENCIÓN</p>
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-white leading-[1.1]">
                    LIDERAMOS EN<br>
                    <span class="text-[#1d4ed8]">EXCELENCIA</span>
                </h1>
                <p class="mt-6 text-gray-400 text-base lg:text-lg max-w-lg leading-relaxed">
                    Ofrecemos soluciones integrales en Seguridad y Salud en el Trabajo, Calidad, Gestión Ambiental y Transformación Digital. Impulsamos organizaciones seguras, eficientes y sostenibles.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#" class="btn-asesoria bg-blue-600 hover:bg-blue-700 text-white px-7 py-3.5 rounded-lg font-semibold transition-all flex items-center gap-2 shadow-lg shadow-blue-600/25">
                        Solicitar Asesoría <span>&rarr;</span>
                    </a>
                    @auth
                        @if(Auth::user()->role_id == 3)
                            <button type="button" onclick="openRenovarModal(event)" class="border border-white/20 text-white px-7 py-3.5 rounded-lg font-semibold hover:bg-white/5 hover:border-white/40 transition-all">
                                ¿Deseas Renovar?
                            </button>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Stats bar --}}
    <div class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-white/5 border border-[#1d4ed8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1d4ed8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $stats['Años de Experiencia'] ?? '10+' }}</p>
                        <p class="text-xs text-gray-500">Años de Experiencia</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-white/5 border border-[#1d4ed8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1d4ed8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $stats['Empresas Asesoradas'] ?? '200+' }}</p>
                        <p class="text-xs text-gray-500">Empresas Asesoradas</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-white/5 border border-[#1d4ed8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1d4ed8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $stats['Consultores Expertos'] ?? '15+' }}</p>
                        <p class="text-xs text-gray-500">Consultores Expertos</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-white/5 border border-[#1d4ed8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1d4ed8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ $stats['Comprometidos'] ?? '100%' }}</p>
                        <p class="text-xs text-gray-500">Comprometidos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Soluciones Digitales Section --}}
<section id="servicios" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left --}}
            <div>
                <p class="text-green-600 font-medium text-sm mb-3">Transformamos ideas en soluciones que impulsan tu empresa</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
                    Soluciones digitales<br>que construyen un<br>futuro <span class="text-green-600 italic">más seguro</span>
                </h2>
                <p class="mt-6 text-gray-600 max-w-md">
                    En Innovasafe Consulting desarrollamos aplicaciones y plataformas digitales que optimizan la gestión, garantizan el cumplimiento y promueven entornos de trabajo más seguros y sostenibles.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#soluciones" class="bg-[#0a0f2c] hover:bg-[#141b4d] text-white px-5 py-3 rounded-lg font-medium text-sm transition">
                        Conocer nuestras soluciones
                    </a>
                    <a href="#" onclick="openVideoModalFunciona()" class="flex items-center gap-2 text-gray-700 hover:text-gray-900 font-medium text-sm transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Ver cómo funciona
                    </a>
                </div>
            </div>

            {{-- Right - Dashboard mockup --}}
            <div class="bg-gray-100 rounded-2xl p-6 shadow-lg">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-900">Dashboard</h3>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-green-100 rounded-full"></div>
                            <span class="text-xs text-gray-500">Administrador</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Tareas pendientes</p>
                            <p class="text-xl font-bold text-gray-900">24</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Cumplimiento</p>
                            <p class="text-xl font-bold text-gray-900">92%</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">No conformidades</p>
                            <p class="text-xl font-bold text-gray-900">7</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Reportes</p>
                            <p class="text-xl font-bold text-gray-900">15</p>
                        </div>
                    </div>
                    <div class="h-32 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg flex items-end justify-center p-4">
                        <div class="flex items-end gap-1 h-full w-full">
                            @foreach([40, 55, 45, 60, 70, 65, 75, 80, 72, 85, 78, 90] as $h)
                                <div class="flex-1 bg-green-400/60 rounded-t" style="height: {{ $h }}%"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Plataformas Section --}}
<section id="soluciones" class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-green-600 font-semibold text-sm tracking-wide mb-2">NUESTRAS SOLUCIONES</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Plataformas diseñadas para cada necesidad</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($typeServices as $service)
                @php
                    // Determinar icono y colores según el servicio
                    $serviceName = strtolower($service->name);
                    $cursorClass = 'service-sst'; // Default
                    if (strpos($serviceName, 'sst') !== false || strpos($serviceName, 'salud') !== false) {
                        $iconColor = 'text-green-600';
                        $bgColor = 'bg-green-100';
                        $cursorClass = 'service-sst';
                        $icon = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>';
                    } elseif (strpos($serviceName, 'calidad') !== false) {
                        $iconColor = 'text-red-600';
                        $bgColor = 'bg-red-100';
                        $cursorClass = 'service-quality';
                        $icon = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>';
                    } elseif (strpos($serviceName, 'ambiental') !== false) {
                        $iconColor = 'text-green-600';
                        $bgColor = 'bg-green-100';
                        $cursorClass = 'service-environmental';
                        $icon = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    } elseif (strpos($serviceName, 'consultor') !== false) {
                        $iconColor = 'text-blue-600';
                        $bgColor = 'bg-blue-100';
                        $cursorClass = 'service-sst';
                        $icon = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>';
                    } else {
                        $iconColor = 'text-blue-600';
                        $bgColor = 'bg-blue-100';
                        $cursorClass = 'service-sst';
                        $icon = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>';
                    }
                @endphp
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition {{ $cursorClass }}">
                    <div class="w-12 h-12 {{ $bgColor }} rounded-xl flex items-center justify-center mb-4">
                        {!! $icon !!}
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $service->description }}</p>
                    @if($service->status == '0')
                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-xl text-center font-bold text-lg shadow-lg">
                            🚧 En Construcción
                        </div>
                    @else
                        @php
                            $videoUrl = $service->video_url;
                            // Quitar 'public/' o '/public/' si existe
                            $videoUrl = preg_replace('/^\/?public\//', '', $videoUrl);
                        @endphp
                        <button type="button" onclick="openVideoModalDynamic('{{ $videoUrl }}')" class="text-green-600 text-sm font-medium hover:text-green-700">
                            Ver más &rarr;
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Beneficios Section --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-green-600 font-semibold text-sm tracking-wide mb-2">BENEFICIOS</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Impulsamos tu empresa hacia la excelencia</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 mb-1">Ahorra tiempo</h3>
                <p class="text-xs text-gray-600">Automatiza procesos y reduce tareas administrativas.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 mb-1">Cumple normativas</h3>
                <p class="text-xs text-gray-600">Asegura el cumplimiento legal de forma sencilla y eficiente.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 mb-1">Toma decisiones</h3>
                <p class="text-xs text-gray-600">Accede a información en tiempo real para decidir mejor.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 mb-1">Mejora la cultura</h3>
                <p class="text-xs text-gray-600">Promueve entornos de trabajo más seguros y sostenibles.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 mb-1">100% en la nube</h3>
                <p class="text-xs text-gray-600">Accede desde cualquier lugar, seguro y siempre disponible.</p>
            </div>
        </div>
    </div>
</section>

{{-- Contact Section --}}
<section id="contacto" class="py-16 lg:py-24 bg-[#01020e]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">¿Listo para transformar tu empresa?</h2>
        <p class="text-gray-400">Contáctanos y un asesor especializado te ayudará a encontrar la solución ideal para tu organización.</p>
    </div>
</section>

@endsection
