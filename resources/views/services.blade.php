@extends('layouts.app')

@section('title', 'Servicios')

@section('content')

@php
    $services = $services ?? collect();
@endphp

{{-- Hero Services --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="services-title font-semibold tracking-widest uppercase mb-4">NUESTROS SERVICIOS</p>
        <h1 class="services-heading text-white font-bold leading-tight">Asesoría experta para tu organización</h1>
        <p class="text-white mt-4 leading-relaxed mx-auto" style="font-size: 18px; max-width: 620px;">Acompañamiento integral en cada etapa: diagnóstico, implementación, capacitación y mejora continua.</p>
    </div>
</section>

{{-- Services Cards --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @foreach($services as $service)
                @php
                    $serviceName = strtolower($service->name);
                    
                    if (strpos($serviceName, 'sst') !== false || strpos($serviceName, 'salud') !== false) {
                        $icon = '<svg class="w-7 h-7 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>';
                        $title = 'Seguridad y Salud en el Trabajo';
                        $description = 'Implementamos y administramos soluciones integrales para el Sistema de Gestión de Seguridad y Salud en el Trabajo (SG-SST), ayudando a tu empresa a cumplir con la normativa vigente, reducir riesgos laborales y fortalecer el bienestar de tus colaboradores.';
                    } elseif (strpos($serviceName, 'calidad') !== false) {
                        $icon = '<svg class="w-7 h-7 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>';
                        $title = 'Gestión de Calidad';
                        $description = 'Diseñamos, implementamos y optimizamos sistemas de gestión de calidad basados en estándares como ISO 9001, mejorando la eficiencia de tus procesos, la satisfacción del cliente y la cultura de mejora continua.';
                    } elseif (strpos($serviceName, 'ambiental') !== false) {
                        $icon = '<svg class="w-7 h-7 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                        $title = 'Gestión Ambiental';
                        $description = 'Desarrollamos estrategias y herramientas para la gestión ambiental de tu organización, facilitando el cumplimiento legal, el uso responsable de los recursos y el fortalecimiento de tus objetivos de sostenibilidad.';
                    } elseif (strpos($serviceName, 'digital') !== false || strpos($serviceName, 'transformación') !== false) {
                        $icon = '<svg class="w-7 h-7 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>';
                        $title = 'Transformación Digital';
                        $description = 'Creamos plataformas y soluciones tecnológicas a la medida para automatizar procesos, centralizar información y acelerar la transformación digital de tu empresa, aumentando la eficiencia y la competitividad.';
                    } else {
                        $icon = '<svg class="w-7 h-7 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>';
                        $title = $service->name;
                        $description = $service->description ?? 'Servicio especializado para tu organización.';
                    }
                @endphp
                <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center mb-6">
                        {!! $icon !!}
                    </div>
                    <h3 class="text-2xl font-bold text-[#0a0f2c] mb-4">{{ $title }}</h3>
                    <p class="text-gray-600 mb-6">{{ $description }}</p>
                    @if($service->status == '0')
                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-xl text-center font-bold text-lg shadow-lg">
                            🚧 En Construcción
                        </div>
                    @else
                        <a href="#" class="btn-service-info text-[#2268bd] font-medium text-sm hover:text-blue-800 transition">Solicitar Información &rarr;</a>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
