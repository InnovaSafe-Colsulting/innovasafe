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
                <h3 class="text-lg font-bold text-[#0a0f2c] uppercase mb-4">{{ $plan->name }}</h3>
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
                            <input type="hidden" name="price" id="selected-price-{{ $plan->id }}">
                            <input type="hidden" name="billing_period" id="selected-period-{{ $plan->id }}">
                            
                            {{-- Opciones de facturación --}}
                            <div class="mb-6">
                                <p class="text-sm font-semibold text-gray-700 mb-4">Selecciona tu modalidad:</p>
                                
                                {{-- Opción Mensual --}}
                                <div class="mb-3">
                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                        <div class="flex items-center">
                                            <input type="radio" name="billing_type" value="mensual" 
                                                data-price="{{ $plan->prize }}" 
                                                data-period="Mensual"
                                                class="billing-radio text-[#2268bd] focus:ring-[#2268bd]" 
                                                onchange="updatePlanPrice({{ $plan->id }})" checked>
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
                                            1 => 0.2012, // Starter
                                            2 => 0.1896, // Beginners 
                                            3 => 0.2062, // Growth
                                            4 => 0.1935, // Business
                                            5 => 0.1984, // Corporate
                                        ];
                                        $valorAnual = $plan->prize * 12;
                                        $descuentoRate = $discountRates[$plan->id] ?? 0.20;
                                        $descuento = $valorAnual * $descuentoRate;
                                        $valorAnualConDescuento = $valorAnual - $descuento;
                                        $ahorroPorcentaje = $descuentoRate * 100;
                                    @endphp
                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition relative">
                                        <div class="flex items-center">
                                            <input type="radio" name="billing_type" value="anual" 
                                                data-price="{{ $valorAnualConDescuento }}" 
                                                data-period="Anual"
                                                class="billing-radio text-[#2268bd] focus:ring-[#2268bd]" 
                                                onchange="updatePlanPrice({{ $plan->id }})">
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
                            
                            {{-- Precio seleccionado --}}
                            <div class="text-center mb-4 p-4 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-600 mb-1">Precio seleccionado:</p>
                                <p id="display-price-{{ $plan->id }}" class="text-2xl font-black text-[#0a0f2c]">${{ number_format($plan->prize, 0, ',', '.') }}</p>
                                <p id="display-period-{{ $plan->id }}" class="text-sm font-semibold text-gray-500">Mensual</p>
                                <p class="text-xs text-gray-400">IVA incluido</p>
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
                        {{-- Botón de WhatsApp para plan Personalize con precio 0 --}}
                        <a href="https://wa.me/573122777482?text=Hola,%20estoy%20interesado%20en%20el%20plan%20{{ urlencode($plan->name) }}.%20Me%20gustar%C3%ADa%20conocer%20m%C3%A1s%20detalles%20sobre%20la%20tarifa." target="_blank" class="w-full bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.251"/>
                            </svg>
                            Comunícate con nosotros
                        </a>
                    @elseif($plan->id >= 1 && $plan->id <= 5)
                        {{-- Botón de agregar al carrito para planes normales --}}
                        @auth
                            <button type="submit" form="plan-form-{{ $plan->id }}" class="w-full bg-[#2268bd] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#1a4c8c] transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                </svg>
                                Agregar al carrito
                            </button>
                        @else
                            <button onclick="alert('Debes iniciar sesión para agregar productos al carrito')" class="w-full bg-gray-400 text-white font-semibold py-3 px-6 rounded-lg cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Iniciar sesión para comprar
                            </button>
                        @endauth
                    @else
                        {{-- Botón normal para otros planes --}}
                        <button class="w-full bg-[#2268bd] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#1a4c8c] transition-colors">
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
                    {{-- Contenido SST con datos dinámicos --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Módulos Básicos --}}
                        @if(isset($sstModules['Basico']))
                        <div class="bg-white rounded-2xl border border-gray-200 p-8">
                            <span class="inline-block bg-[#0a0f2c] text-white text-xs font-bold px-4 py-1 rounded-full mb-6">{{ count($sstModules['Basico']) }} MÓDULOS BÁSICOS</span>
                            <ol class="space-y-3 text-sm text-gray-700">
                                @foreach($sstModules['Basico'] as $index => $module)
                                <li class="flex items-start gap-2">
                                    <span class="font-bold text-[#2268bd]">{{ $index + 1 }}.</span>
                                    {{ $module->module }}
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif

                        {{-- Módulos Adicionales --}}
                        @if(isset($sstModules['Adicional']))
                        <div class="bg-white rounded-2xl border border-gray-200 p-8">
                            <span class="inline-block bg-[#0a0f2c] text-white text-xs font-bold px-4 py-1 rounded-full mb-6">{{ count($sstModules['Adicional']) }} MÓDULOS ADICIONALES (PLAN ELITE)</span>
                            <ol class="space-y-4 text-sm text-gray-700">
                                @foreach($sstModules['Adicional'] as $index => $module)
                                <li class="flex items-center gap-3">
                                    @if(str_contains(strtolower($module->module), 'inspecci'))
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    @elseif(str_contains(strtolower($module->module), 'comité'))
                                        <svg class="w-6 h-6 text-[#2268bd] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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
                @elseif($service->status == '1')
                    {{-- Otros servicios activos sin contenido aún --}}
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-6">{{ $service->description ?: 'Contenido en desarrollo para este servicio.' }}</p>
                            <span class="inline-block bg-blue-500 text-white px-6 py-2 rounded-full font-semibold">Próximamente</span>
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
                            <span class="inline-block bg-yellow-500 text-white px-6 py-2 rounded-full font-semibold">Muy Pronto</span>
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
            
            // Inicializar precios por defecto
            @foreach($plans as $plan)
                @if($plan->id >= 1 && $plan->id <= 5)
                    updatePlanPrice({{ $plan->id }});
                @endif
            @endforeach
        });
        
        // Función para actualizar el precio del plan según la selección
        function updatePlanPrice(planId) {
            const form = document.getElementById('plan-form-' + planId);
            const selectedRadio = form.querySelector('input[name="billing_type"]:checked');
            
            if (selectedRadio) {
                const price = selectedRadio.getAttribute('data-price');
                const period = selectedRadio.getAttribute('data-period');
                
                // Actualizar campos ocultos del formulario
                document.getElementById('selected-price-' + planId).value = price;
                document.getElementById('selected-period-' + planId).value = period;
                
                // Actualizar display del precio
                const displayPrice = document.getElementById('display-price-' + planId);
                const displayPeriod = document.getElementById('display-period-' + planId);
                
                if (displayPrice && displayPeriod) {
                    displayPrice.textContent = '$' + parseFloat(price).toLocaleString('es-CO');
                    displayPeriod.textContent = period;
                }
            }
        }
        
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
