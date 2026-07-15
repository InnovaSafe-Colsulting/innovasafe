@extends('layouts.app')

@section('title', 'Planes')

@section('content')

{{-- Hero Plans --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-[#2596be] font-semibold tracking-widest uppercase mb-4" style="font-size: 23px;">PLANES</p>
        <h1 class="text-white font-bold leading-tight" style="font-size: clamp(2rem, 5vw, 40px);">Catálogo de Soluciones SST</h1>
        <p class="text-white mt-4 leading-relaxed mx-auto" style="font-size: 18px; max-width: 620px;">Nuestro aplicativo te ayuda a gestionar el Sistema de Gestión de Seguridad y Salud en el Trabajo de forma simple, eficiente y 100% digital.</p>
    </div>
</section>

{{-- Planes y Precios --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-[#0a0f2c]">PLANES Y PRECIOS</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach($plans as $plan)
            {{-- Plan Card --}}
            <div class="bg-white rounded-2xl border {{ $plan->id == 5 ? 'border-2 border-[#2268bd]' : ($plan->id == 2 ? 'border-2 border-[#2268bd]' : 'border-gray-200') }} p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl text-center relative">
                <h3 class="text-lg font-bold text-[#0a0f2c] uppercase mb-4" data-plan-name="{{ $plan->id }}">{{ $plan->name }}</h3>
                <svg class="w-12 h-12 text-[#2268bd] mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    @if(strtolower($plan->name) == 'starter')
                        {{-- Icono de cohete/inicio --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/>
                    @elseif(strtolower($plan->name) == 'beginners')
                        {{-- Icono de usuario/principiante --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    @elseif(strtolower($plan->name) == 'growth')
                        {{-- Icono de gráfico de crecimiento --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                    @elseif(strtolower($plan->name) == 'business')
                        {{-- Icono de maletín/empresa --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                    @elseif(strtolower($plan->name) == 'corporate')
                        {{-- Icono de edificio/corporativo --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m2.25-18v18m13.5-18v18m2.25-18v18M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v3"/>
                    @elseif(strtolower($plan->name) == 'personalize' || strtolower($plan->name) == 'personalizado')
                        {{-- Icono de configuración/personalización --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    @else
                        {{-- Icono por defecto (estrella) --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    @endif
                </svg>
                <p class="text-sm text-gray-600 mb-6">{{ $plan->description }}</p>
                
                @if($plan->discount > 0)
                <span class="inline-block bg-[#2268bd]/10 text-[#2268bd] text-xs font-bold px-3 py-1 rounded-full mb-6">{{ $plan->discount }}% DE DESCUENTO</span>
                @endif
                <div class="border-t border-gray-200 pt-6">
                    @if($plan->id >= 1 && $plan->id <= 5)
                        {{-- Planes con opciones mensual y anual --}}
                        <form id="plan-form-{{ $plan->id }}" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <input type="hidden" name="product_name" value="{{ $plan->name }}">
                            
                            {{-- Opciones de facturación --}}
                            <div class="mb-6">
                                <p class="text-sm font-semibold text-gray-700 mb-4">Selecciona tu modalidad:</p>
                                
                                {{-- Opción Mensual --}}
                                <div class="mb-3">
                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="billing_mensual_{{ $plan->id }}" value="mensual"
                                                data-price="{{ $plan->prize }}"
                                                data-period="Mensual"
                                                data-plan-id="{{ $plan->id }}"
                                                class="billing-check w-4 h-4 text-[#2268bd] rounded focus:ring-[#2268bd]">
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">📅 Mensual</p>
                                                <p class="text-xs text-gray-500">Pago mes a mes</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-[#0a0f2c]">${{ number_format($plan->prize, 0, ',', '.') }}</p>
                                            <p class="text-xs text-gray-500">COP</p>
                                        </div>
                                    </label>
                                </div>
                                
                                {{-- Opción Anual --}}
                                <div>
                                    @php
                                        $discountRates = [
                                            1 => 0.2012,
                                            2 => 0.1896,
                                            3 => 0.2062,
                                            4 => 0.1935,
                                            5 => 0.1984,
                                        ];
                                        $valorAnual = $plan->prize * 12;
                                        $descuentoRate = $discountRates[$plan->id] ?? 0.20;
                                        $descuento = $valorAnual * $descuentoRate;
                                        $valorAnualConDescuento = $valorAnual - $descuento;
                                        $ahorroPorcentaje = $descuentoRate * 100;
                                    @endphp
                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition relative">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="billing_anual_{{ $plan->id }}" value="anual"
                                                data-price="{{ $valorAnualConDescuento }}"
                                                data-period="Anual"
                                                data-plan-id="{{ $plan->id }}"
                                                class="billing-check w-4 h-4 text-[#2268bd] rounded focus:ring-[#2268bd]">
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">📅 Anual</p>
                                                <p class="text-xs text-gray-500">Pago por año completo</p>
                                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full mt-1">
                                                    Ahorra {{ number_format($ahorroPorcentaje, 2) }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-[#2268bd]">${{ number_format($valorAnualConDescuento, 0, ',', '.') }}</p>
                                            <p class="text-xs text-gray-500">COP</p>
                                            <p class="text-xs text-gray-400 line-through">${{ number_format($valorAnual, 0, ',', '.') }}</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </form>
                    @elseif($plan->id == 6 && $plan->prize == 0)
                        {{-- Plan Personalize con precio 0 - Mensaje personalizado --}}
                        <div class="text-center py-4">
                            <p class="text-lg font-semibold text-[#2268bd] mb-2">Precio Personalizado</p>
                            <p class="text-sm text-gray-600 leading-relaxed px-2">
                                El valor o tarifa será acordada entre el cliente y la empresa
                            </p>
                        </div>
                    @else
                        {{-- Otros planes mantienen el formato original --}}
                        <p class="text-3xl font-black text-[#0a0f2c]">${{ number_format($plan->prize, 0, ',', '.') }}</p>
                        <p class="text-sm font-semibold text-gray-500">COP</p>
                        <p class="text-xs text-gray-400">IVA incluido</p>
                    @endif
                </div>
                <div class="mt-6">
                    @if($plan->id == 6 && $plan->prize == 0)
                        <button
                            onclick="openAdquirirModal({{ $plan->id }}, '{{ addslashes($plan->name) }}', 'Personalizado', 0)"
                            class="btn w-full text-white font-semibold py-3 px-6 rounded-lg transition-all flex items-center justify-center gap-2"
                            style="background:linear-gradient(135deg,#01020e 0%,#0a1628 50%,#2268bd 100%);">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Adquirir Producto
                        </button>
                    @elseif($plan->id >= 1 && $plan->id <= 5)
                        {{-- Botón de agregar al carrito para planes normales --}}
                        @auth
                            <button type="submit" form="plan-form-{{ $plan->id }}" class="btn w-full bg-[#2268bd] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#1a4c8c] transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                </svg>
                                Agregar al carrito
                            </button>
                        @else
                            <button
                                onclick="abrirAdquirirPlan({{ $plan->id }}, '{{ addslashes($plan->name) }}')"
                                class="btn w-full text-white font-semibold py-3 px-6 rounded-lg transition-all flex items-center justify-center gap-2"
                                style="background:linear-gradient(135deg,#01020e 0%,#0a1628 50%,#2268bd 100%);">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Adquirir Producto
                            </button>
                        @endauth
                    @else
                        {{-- Botón normal para otros planes --}}
                        <button class="btn w-full bg-[#2268bd] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#1a4c8c] transition-colors">
                            Agregar a carrito
                        </button>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- Productos y Módulos --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-black text-[#0a0f2c] text-center mb-10">NUESTROS PRODUCTOS</h2>

        {{-- Tabs Navigation --}}
        <div class="flex justify-center mb-12">
            <div class="inline-flex bg-white rounded-lg p-1 shadow-sm border border-gray-200 flex-wrap">
                @foreach($typeServices as $index => $service)
                <button id="service-{{ $service->id }}-tab" 
                    class="tab-btn {{ $index === 0 ? 'active bg-[#2268bd] text-white' : 'text-gray-500' }} {{ $service->status == '0' ? 'cursor-not-allowed' : '' }} px-4 py-3 text-sm font-semibold rounded-md transition-all duration-200 relative m-1">
                    {{ $service->name }}
                    @if($service->status == '0')
                        <span class="absolute -top-2 -right-2 bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full font-bold whitespace-nowrap">Muy Pronto</span>
                    @endif
                </button>
                @endforeach
            </div>
        </div>

        {{-- Tab Contents --}}
        @foreach($typeServices as $index => $service)
            <div id="service-{{ $service->id }}-content" class="tab-content {{ $index === 0 ? '' : 'hidden' }}">
                @if($service->id == 1 && $service->status == '1')
                    {{-- Contenido SST --}}
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Seguridad y Salud en el Trabajo - SST</h3>
                            <p class="text-gray-600 mb-6">Implementa y gestiona tu Sistema de Gestión de Seguridad y Salud en el Trabajo de manera integral. Protege a tu equipo, cumple con la normatividad y reduce los riesgos laborales en tu organización.</p>
                            {{-- <span class="inline-block bg-blue-500 text-white px-6 py-2 rounded-full font-semibold">Solícitalo</span> --}}
                        </div>
                    </div>
                @elseif($service->id == 2 && $service->status == '1')
                    {{-- Contenido Auditoría con datos dinámicos --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Módulos Básicos --}}
                        @if(isset($auditoriaModules['Basico']))
                        <div class="bg-white rounded-2xl border border-gray-200 p-8">
                            <span class="inline-block bg-[#0a0f2c] text-white text-xs font-bold px-4 py-1 rounded-full mb-6">{{ count($auditoriaModules['Basico']) }} MÓDULOS BÁSICOS</span>
                            <ol class="space-y-3 text-sm text-gray-700">
                                @foreach($auditoriaModules['Basico'] as $index => $module)
                                <li class="flex items-start gap-2">
                                    <span class="font-bold text-[#2268bd]">{{ $index + 1 }}.</span>
                                    {{ $module->module }}
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif

                        {{-- Módulos Adicionales --}}
                        @if(isset($auditoriaModules['Adicional']))
                        <div class="bg-white rounded-2xl border border-gray-200 p-8">
                            <span class="inline-block bg-[#0a0f2c] text-white text-xs font-bold px-4 py-1 rounded-full mb-6">{{ count($auditoriaModules['Adicional']) }} MÓDULOS ADICIONALES (PLAN ELITE)</span>
                            <ol class="space-y-4 text-sm text-gray-700">
                                @foreach($auditoriaModules['Adicional'] as $index => $module)
                                <li class="flex items-center gap-3">
                                    @if(str_contains(strtolower($module->module), 'evaluación') || str_contains(strtolower($module->module), 'evaluacion'))
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                    @elseif(str_contains(strtolower($module->module), 'plan') || str_contains(strtolower($module->module), 'planificación'))
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 8h6m-6-4h6m2-5H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2z"/></svg>
                                    @elseif(str_contains(strtolower($module->module), 'control') || str_contains(strtolower($module->module), 'seguimiento'))
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    @elseif(str_contains(strtolower($module->module), 'informe') || str_contains(strtolower($module->module), 'reporte'))
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    @else
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    @endif
                                    <span><span class="font-bold">{{ $index + 1 }}.</span> {{ $module->module }}</span>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif
                    </div>
                @elseif($service->status == '1' && !in_array($service->id, [1, 2]))
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-6">{{ $service->description ?: 'Contenido en desarrollo para este servicio.' }}</p>
                            {{-- <span class="inline-block bg-blue-500 text-white px-6 py-2 rounded-full font-semibold">Solícitalo</span> --}}
                        </div>
                    </div>
                @else
                    {{-- Servicios inactivos --}}
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-6">{{ $service->description ?: 'Estamos trabajando en este increíble servicio que transformará tu experiencia.' }}</p>
                            {{-- <span class="inline-block bg-yellow-500 text-white px-6 py-2 rounded-full font-semibold">Solícitalo</span> --}}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- JavaScript para los tabs --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Solo permitir clic en servicios activos
                    if (this.classList.contains('cursor-not-allowed')) {
                        return;
                    }

                    // Remover clase active de todos los botones
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-[#2268bd]', 'text-white');
                        if (!btn.classList.contains('cursor-not-allowed')) {
                            btn.classList.add('text-gray-500');
                        }
                    });

                    // Agregar clase active al botón clickeado
                    this.classList.add('active', 'bg-[#2268bd]', 'text-white');
                    this.classList.remove('text-gray-500');

                    // Ocultar todos los contenidos
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Mostrar el contenido correspondiente
                    const targetContent = document.getElementById(this.id.replace('-tab', '-content'));
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                    }
                });
            });
            
            // Inicializar
            @foreach($plans as $plan)
            @endforeach
        });
        
        function abrirAdquirirPlan(planId, planName) {
            // Leer todos los checks marcados en toda la página
            var allChecks = document.querySelectorAll('.billing-check:checked');
            if (allChecks.length === 0) {
                // Si ninguno marcado en toda la página, usar el card actual sin modalidad
                openAdquirirModal(planId, planName, 'Sin modalidad', 0);
            } else {
                allChecks.forEach(function(chk) {
                    var cardPlanId = chk.getAttribute('data-plan-id');
                    var cardPlanName = document.querySelector('[data-plan-name="' + cardPlanId + '"]');
                    var name = cardPlanName ? cardPlanName.textContent.trim() : planName;
                    openAdquirirModal(cardPlanId, name, chk.getAttribute('data-period'), chk.getAttribute('data-price'));
                });
            }
        }

        function updatePlanPrice(planId) {} // mantenida por compatibilidad
        
        // Manejar envío del formulario
        document.addEventListener('submit', function(e) {
            if (e.target.id && e.target.id.startsWith('plan-form-')) {
                e.preventDefault();
                
                const formData = new FormData(e.target);
                
                fetch(e.target.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar mensaje de éxito
                        showToast('Producto agregado al carrito exitosamente', 'success');
                        
                        // Actualizar carrito en navbar si existe la función
                        if (typeof loadCartDropdown === 'function') {
                            loadCartDropdown();
                        }
                        
                        // Actualizar badge del carrito
                        if (data.cart_count && typeof updateCartBadge === 'function') {
                            updateCartBadge(data.cart_count);
                        }
                    } else {
                        showToast(data.message || 'Error al agregar el producto', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error al agregar el producto al carrito', 'error');
                });
            }
        });
    </script>
</section>

{{-- Beneficios --}}
<section class="py-10 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Mejora la seguridad</p>
                    <p class="text-xs text-gray-500">y salud de tu equipo</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Ahorra tiempo</p>
                    <p class="text-xs text-gray-500">en procesos y reportes</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Reduce riesgos</p>
                    <p class="text-xs text-gray-500">y costos operativos</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Aumenta la productividad</p>
                    <p class="text-xs text-gray-500">y el cumplimiento</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@include('components.modals.adquirir-producto')
