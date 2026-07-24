<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="recaptcha-site-key" content="{{ config('services.recaptcha.site_key') }}">
    <link rel="icon" href="{{ asset('images/home/company-icon.png') }}" type="image/png">
    <title>InnovaSafe Consulting - @yield('title', 'Inicio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="canonical" href="{{ url()->current() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <style>
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #00020e;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #page-loader.hidden-loader {
            opacity: 0;
            visibility: hidden;
        }

        .loader-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Imagen de fondo del splash */
        .loader-splash {
            width: 340px;
            height: 340px;
            object-fit: contain;
            position: relative;
            z-index: 2;
        }

        /* Texto CARGANDO y porcentaje */
        .loader-text-block {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 3;
            white-space: nowrap;
        }

        .loader-label {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            letter-spacing: 0.35em;
            color: #cce6ff;
            font-weight: 500;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .loader-percent {
            font-family: 'Inter', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #3b9eff;
            letter-spacing: 0.05em;
            text-shadow: 0 0 12px rgba(59, 158, 255, 0.7);
        }

        /* Barra de progreso sutil debajo */
        .loader-bar-track {
            width: 200px;
            height: 3px;
            background: rgba(255,255,255,0.08);
            border-radius: 99px;
            margin-top: 10px;
            overflow: hidden;
        }

        .loader-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #1a6fc4, #3b9eff, #7dd3fc);
            border-radius: 99px;
            transition: width 0.2s ease;
            box-shadow: 0 0 8px rgba(59, 158, 255, 0.6);
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen bg-white text-gray-900 antialiased">
    {{-- Page Loader --}}
    <div id="page-loader">
        <div class="loader-wrapper">
            <img src="{{ asset('images/home/splash-loader.png') }}" alt="Cargando..." class="loader-splash">
            <div class="loader-text-block">
                <div class="loader-label">Cargando</div>
                <div class="loader-percent" id="loader-percent">0%</div>
                <div class="loader-bar-track">
                    <div class="loader-bar-fill" id="loader-bar"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var percent = 0;
            var targetPercent = 0;
            var finished = false;

            var percentEl = document.getElementById('loader-percent');
            var barEl = document.getElementById('loader-bar');
            var loaderEl = document.getElementById('page-loader');

            var earlyInterval = setInterval(function () {
                if (percent < 85) {
                    var increment = Math.random() * 4 + 1;
                    percent = Math.min(percent + increment, 85);
                    updateUI(percent);
                } else {
                    clearInterval(earlyInterval);
                }
            }, 80);

            // Cuando el DOM está listo, avanzar a 95%
            document.addEventListener('DOMContentLoaded', function () {
                clearInterval(earlyInterval);
                animateTo(95, 300);
            });

            // Cuando todo cargó (imágenes, estilos, etc.), ir al 100% y ocultar
            window.addEventListener('load', function () {
                animateTo(100, 400, function () {
                    setTimeout(function () {
                        loaderEl.classList.add('hidden-loader');
                        setTimeout(function () {
                            loaderEl.style.display = 'none';
                        }, 520);
                    }, 200);
                });
            });

            function animateTo(target, speed, callback) {
                var interval = setInterval(function () {
                    if (percent < target) {
                        percent = Math.min(percent + 1, target);
                        updateUI(percent);
                    } else {
                        clearInterval(interval);
                        if (callback) callback();
                    }
                }, speed / (target - percent || 1));
            }

            function updateUI(val) {
                var rounded = Math.round(val);
                percentEl.textContent = rounded + '%';
                barEl.style.width = rounded + '%';
            }
        })();
    </script>

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#01020e] backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/home/company-icon.png') }}" alt="InnovaSafe" class="w-9 h-9 nav-logo-icon" style="mix-blend-mode:screen;">
                    <div class="logo-text" style="line-height:1.2; text-align:center;">
                        <span class="text-lg font-medium">
                            <span style="color:#c0c8d8;">INNOVA</span><span style="color:#3b82f6;">SAFE</span>
                        </span>
                        <span class="block -mt-1 font-normal" style="font-size:.62rem; letter-spacing:.18em; color:#c0c8d8;">
                            <span style="color:#3b82f6;">——</span>&nbsp;CONSULTING&nbsp;<span style="color:#3b82f6;">——</span>
                        </span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-8">
                    <a href="/" class="nav-link text-sm text-white hover:text-green-400 transition">Inicio</a>
                    <a href="{{ route('services') }}" class="nav-link text-sm text-gray-300 hover:text-green-400 transition">Servicios</a>
                    <a href="{{ route('about') }}" class="nav-link text-sm text-gray-300 hover:text-green-400 transition">Nosotros</a>
                    <a href="{{ route('resources') }}" class="nav-link text-sm text-gray-300 hover:text-green-400 transition">Recursos</a>
                    <a href="{{ route('plans') }}" class="nav-link text-sm text-gray-300 hover:text-green-400 transition">Planes</a>
                    <a href="{{ route('contact') }}" class="nav-link text-sm text-gray-300 hover:text-green-400 transition">Contacto</a>
                    @if(false) {{-- cart: hidden until client login is enabled --}}
                    @auth
                        <div class="relative group">
                            <button class="nav-link p-2 hover:bg-white/10 rounded-lg transition relative cart-button">
                                <svg class="w-5 h-5 text-gray-300 hover:text-green-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                {{-- Badge de cantidad --}}
                                <span id="cart-badge" class="absolute -top-1 -right-1 bg-[#2268bd] text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center hidden">
                                    0
                                </span>
                            </button>
                            {{-- Dropdown del carrito --}}
                            <div class="absolute right-0 top-full w-96 pt-2 hidden group-hover:block z-50">
                                <div class="bg-white rounded-lg shadow-xl border border-gray-200 py-4 px-6">
                                    {{-- Cabecera --}}
                                    <div class="text-center mb-4 pb-3 border-b border-gray-100">
                                        <h3 class="text-lg font-semibold text-gray-800">Carrito de Compras</h3>
                                    </div>
                                    
                                    {{-- Contenido del carrito --}}
                                    <div id="cart-dropdown-content">
                                        {{-- Carrito vacío por defecto --}}
                                        <div id="empty-cart" class="text-center py-8">
                                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm mb-2">Tu carrito está vacío</p>
                                            <p class="text-gray-400 text-xs">Agrega productos para comenzar</p>
                                        </div>
                                        
                                        {{-- Productos del carrito (se cargarán dinámicamente) --}}
                                        <div id="cart-items" class="space-y-3 mb-4 max-h-60 overflow-y-auto hidden">
                                            {{-- Template para productos (se clona con JavaScript) --}}
                                            <template id="cart-item-template">
                                                <div class="border border-gray-100 rounded-lg p-3 cart-item" data-item-id="">
                                                    <div class="grid grid-cols-4 gap-2 items-center">
                                                        {{-- Cantidad --}}
                                                        <div class="flex items-center justify-center">
                                                            <div class="flex items-center border border-gray-200 rounded">
                                                                <button class="decrease-btn px-2 py-1 text-gray-500 hover:text-gray-700 hover:bg-gray-50 cart-button">
                                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                                    </svg>
                                                                </button>
                                                                <span class="item-quantity px-2 py-1 text-sm font-medium text-gray-700 min-w-[2rem] text-center">1</span>
                                                                <button class="increase-btn px-2 py-1 text-gray-500 hover:text-gray-700 hover:bg-gray-50 cart-button">
                                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- Nombre del producto --}}
                                                        <div class="col-span-2">
                                                            <p class="text-xs font-medium text-gray-700 leading-tight item-name">Plan</p>
                                                            <p class="text-xs text-gray-500 item-type">Tipo</p>
                                                        </div>
                                                        
                                                        {{-- Total y eliminar --}}
                                                        <div class="flex items-center justify-between">
                                                            <div class="text-center">
                                                                <p class="item-total text-sm font-bold text-gray-800">$0</p>
                                                                <p class="text-xs text-gray-500">COP</p>
                                                            </div>
                                                            <button class="remove-item ml-2 p-1 text-red-500 hover:text-red-700 hover:bg-red-50 rounded" title="Eliminar producto">
                                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        
                                        {{-- Total general (oculto inicialmente) --}}
                                        <div id="cart-total" class="border-t border-gray-200 pt-3 mb-4 hidden">
                                            <div class="space-y-1">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-xs text-gray-500">Subtotal:</span>
                                                    <span id="dropdown-subtotal" class="text-sm font-medium text-gray-700">$0</span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-xs text-gray-500">IVA (19%):</span>
                                                    <span id="dropdown-iva" class="text-sm font-medium text-gray-700">$0</span>
                                                </div>
                                                <div class="flex justify-between items-center pt-1 border-t border-gray-100">
                                                    <span class="text-sm font-medium text-gray-600">Total:</span>
                                                    <div class="text-right">
                                                        <p id="grand-total" class="text-lg font-black text-[#0a0f2c]">$0</p>
                                                        <p class="text-xs font-semibold text-gray-500">COP</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- Botones (ocultos inicialmente) --}}
                                        <div id="cart-actions" class="space-y-3 hidden">
                                            <button onclick="window.location.href='{{ route('checkout') }}'" class="w-full bg-[#2268bd] text-white font-semibold py-3 px-4 rounded-lg hover:bg-[#1a4c8c] transition-colors">
                                                Pagar
                                            </button>
                                            <button onclick="window.location.href='{{ route('cart') }}'" class="w-full bg-gray-100 text-gray-700 font-semibold py-2.5 px-4 rounded-lg hover:bg-gray-200 transition-colors">
                                                Ir al carrito
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                    @endif
                </div>

                {{-- Right Actions --}}
                <div class="hidden lg:flex items-center gap-3">
                    @guest
                        <a href="#" class="btn-asesoria text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition flex items-center gap-2">
                            Solicitar Asesoría <span>&rarr;</span>
                        </a>
                    @endguest
                    @if(false) {{-- user-menu: hidden until client login is enabled --}}
                    @auth
                        <div class="relative group">
                            <button class="nav-link text-sm text-gray-300 hover:text-green-400 transition flex items-center gap-1">
                                {{ Auth::user()->names }} {{ Auth::user()->last_names }}
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute right-0 top-full w-48 pt-2 hidden group-hover:block z-50">
                                <div class="bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#05df72]/10 hover:text-[#05df72]">Perfil</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#05df72]/10 hover:text-[#05df72]">Cerrar sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                    @endif
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="mobile-menu-btn lg:hidden text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden lg:hidden bg-[#0a0f2c] border-t border-white/10 px-4 pb-4">
            <a href="/" class="block py-2 text-sm text-white">Inicio</a>
            <a href="{{ route('services') }}" class="block py-2 text-sm text-gray-300">Servicios</a>
            <a href="{{ route('about') }}" class="block py-2 text-sm text-gray-300">Nosotros</a>
            <a href="{{ route('resources') }}" class="block py-2 text-sm text-gray-300">Recursos</a>
            <a href="{{ route('plans') }}" class="block py-2 text-sm text-gray-300">Planes</a>
            <a href="{{ route('contact') }}" class="block py-2 text-sm text-gray-300">Contacto</a>
            @guest
                <div class="flex flex-col gap-2 mt-3 pt-3 border-t border-white/10">
                    <a href="#" class="btn-asesoria text-sm text-center text-white bg-blue-600 px-4 py-2 rounded-lg">Solicitar Asesoría &rarr;</a>
                </div>
            @endguest
            @if(false) {{-- mobile-logout: hidden until client login is enabled --}}
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-3 pt-3 border-t border-white/10">
                    @csrf
                    <button type="submit" class="w-full text-sm text-white bg-red-600 px-4 py-2 rounded-lg">Cerrar sesión</button>
                </form>
            @endauth
            @endif
        </div>
    </nav>

    {{-- Toast Container --}}
    <div id="toast-container" class="toast-container"></div>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Modal Solicitar Renovación --}}
    @include('components.modals.renovar')

    {{-- Modal Solicitar Asesoría --}}
    @include('components.modals.advisory')

    {{-- Modal Login --}}
    @include('components.modals.login')

    {{-- Modal Solicitar Información Servicios --}}
    @include('components.modals.service-info')

    {{-- Modal Alerta Genérico --}}
    @include('components.modals.alert')

    {{-- Modal de Servicios --}}
    <div id="servicesModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/75 transition-opacity" onclick="closeServicesModal()"></div>
        <div class="relative w-full max-w-4xl bg-white rounded-lg shadow-2xl z-10 max-h-screen overflow-y-auto">
            <div class="sticky top-0 z-20 bg-white pt-6 pb-4 border-b border-gray-200">
                <div class="flex items-center justify-between px-4">
                    <h3 class="text-2xl font-bold text-gray-900">Nuestros Servicios</h3>
                    <button type="button" onclick="closeServicesModal()" class="rounded-full bg-gray-100 p-2 text-gray-500 hover:bg-gray-200 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mt-2 px-4">Selecciona el servicio que más se adapta a tus necesidades:</p>
            </div>
            <div class="p-6">
                <form id="form-services" class="space-y-4">
                    <div class="space-y-3">
                        @php
                            $typeServices = DB::table('type_services')->get();
                        @endphp
                        @foreach($typeServices as $service)
                            @if($service->status == '1')
                                <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                    <input type="radio" name="service_id" value="{{ $service->id }}" class="mt-1 w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <div>
                                        <span class="block font-medium text-gray-900">{{ $service->name }}</span>
                                        @if(!empty($service->description))
                                            <p class="text-sm text-gray-600 mt-1">{{ $service->description }}</p>
                                        @endif
                                    </div>
                                </label>
                            @else
                                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50/50">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1 w-4 h-4 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </div>
                                        <div>
                                            <span class="block font-medium text-gray-900">{{ $service->name }}</span>
                                            @if(!empty($service->description))
                                                <p class="text-sm text-gray-600 mt-1">{{ $service->description }}</p>
                                            @endif
                                            <span class="inline-block mt-2 px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded">En Construcción</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <button type="button" onclick="submitServiceSelection()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                            Seleccionar Servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Cambio de Contraseña --}}
    {{-- @include('components.modals.password-change') --}}

    {{-- Modal Video --}}
    <div id="videoModal" class="fixed inset-0 z-[100] hidden items-center justify-center" role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/80 transition-opacity" onclick="closeVideoModal()"></div>
            <div class="relative w-full max-w-2xl bg-black rounded-lg shadow-2xl z-10 overflow-hidden">
                <div class="absolute top-4 right-4 z-20">
                    <button type="button" onclick="closeVideoModal()" class="rounded-full bg-black/50 p-2 text-white hover:bg-black/70 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="relative aspect-video bg-black">
                    <video id="videoFrame" class="w-full h-full" controls autoplay></video>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-[#01020e] text-gray-400 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- Col 1: Logo + descripción + redes --}}
                <div>
                    <a href="/" class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('images/home/company-icon.png') }}" alt="InnovaSafe" class="w-9 h-9" style="mix-blend-mode:screen;">
                        <div class="logo-text" style="line-height:1.2; text-align:center;">
                            <span class="text-base font-medium">
                                <span style="color:#c0c8d8;">INNOVA</span><span style="color:#3b82f6;">SAFE</span>
                            </span>
                            <span class="block -mt-1 font-normal" style="font-size:.6rem; letter-spacing:.16em; color:#c0c8d8;">
                                <span style="color:#3b82f6;">——</span>&nbsp;CONSULTING&nbsp;<span style="color:#3b82f6;">——</span>
                            </span>
                        </div>
                    </a>
                    <p class="text-sm text-gray-500 mb-6">{{ $companyConfig['description'] ?? '' }}</p>
                    <div class="flex items-center gap-3">
                        <a href="https://www.facebook.com/niikoldsoto?locale=es_LA" class="social-link w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="social-link w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/in/innovasafe-consulting-5a5b74417/" target="_blank" rel="noopener noreferrer" class="social-link w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="social-link w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Col 2: Navegación --}}
                <div>
                    <h3 class="text-white font-semibold text-sm mb-4">Navegación</h3>
                    <ul class="space-y-3">
                        @foreach($footerNavigation as $item)
                            <li><a href="{{ $item->url }}" class="text-sm text-gray-500 hover:text-white transition">{{ $item->label }}</a></li>
                        @endforeach
                        @auth
                            <li><a href="{{ route('payments') }}" class="text-sm text-gray-500 hover:text-white transition">Pagos</a></li>
                            <li><a href="{{ route('plans') }}" class="text-sm text-gray-500 hover:text-white transition">Planes</a></li>
                            <li><a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-white transition">Historial</a></li>
                        @endauth
                    </ul>
                </div>

                {{-- Col 3: Servicios --}}
                <div>
                    <h3 class="text-white font-semibold text-sm mb-4">Servicios</h3>
                    <ul class="space-y-3">
                        @foreach($footerServices as $service)
                            <li>
                                <a href="{{ route('services') }}"
                                   class="text-sm text-gray-500 hover:text-white transition">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Col 4: Contacto --}}
                <div>
                    <h3 class="text-white font-semibold text-sm mb-4">Contacto</h3>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $companyConfig['email'] ?? 'info@innovasafe.com' }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            +57 {{ $companyConfig['cellphone'] ?? '' }}
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Colombia
                        </li>
                    </ul>
                    <a href="#" class="btn-asesoria inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm px-5 py-2.5 rounded-lg font-medium transition">
                        Solicitar Asesoría <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-600">&copy; {{ date('Y') }} InnovaSafe Consulting. Todos los derechos reservados.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-xs text-gray-600 hover:text-white transition">Política de Privacidad</a>
                    <a href="#" class="text-xs text-gray-600 hover:text-white transition">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Page Loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                loader.style.transition = 'opacity 0.3s ease';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 300);
            }
        });
        
        // Cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            @auth
                // Usuario autenticado - cargar carrito
                loadCartDropdown();
                
                // Actualizar carrito cada 30 segundos
                setInterval(loadCartDropdown, 30000);
            @else
                // Usuario no autenticado - ocultar carrito
                const cartButton = document.querySelector('.relative.group');
                if (cartButton && cartButton.querySelector('svg[viewBox="0 0 24 24"]')) {
                    cartButton.style.display = 'none';
                }
            @endauth
        });
        
        @auth
        function loadCartDropdown() {
            fetch('{{ route("cart.data") }}')
                .then(response => response.json())
                .then(data => {
                    updateCartDropdownUI(data);
                    updateCartBadge(data.count);
                    // Actualizar total en el header del dropdown
                    updateDropdownTotal(data.total);
                })
                .catch(error => {
                    console.error('Error loading cart:', error);
                });
        }
        
        function updateCartBadge(count) {
            const badge = document.getElementById('cart-badge');
            if (badge) {
                if (count > 0) {
                    badge.textContent = count > 99 ? '99+' : count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
        }
        
        function updateDropdownTotal(total) {
            const grandTotal = document.getElementById('grand-total');
            if (grandTotal) {
                grandTotal.textContent = `$${total.toLocaleString()}`;
            }
        }
        
        function updateCartDropdownUI(cartData) {
            const emptyCart = document.getElementById('empty-cart');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const cartActions = document.getElementById('cart-actions');
            const grandTotal = document.getElementById('grand-total');
            const dropdownSubtotal = document.getElementById('dropdown-subtotal');
            const dropdownIva = document.getElementById('dropdown-iva');
            
            if (cartData.items && cartData.items.length > 0) {
                // Mostrar productos
                emptyCart.classList.add('hidden');
                cartItems.classList.remove('hidden');
                cartTotal.classList.remove('hidden');
                cartActions.classList.remove('hidden');
                
                // Limpiar items existentes
                const existingItems = cartItems.querySelectorAll('.cart-item');
                existingItems.forEach(item => item.remove());
                
                // Agregar cada producto
                cartData.items.forEach(item => {
                    addCartItemToDropdown(item);
                });
                
                // Actualizar totales
                if (dropdownSubtotal) dropdownSubtotal.textContent = `$${cartData.subtotal.toLocaleString()}`;
                if (dropdownIva) dropdownIva.textContent = `$${Math.round(cartData.iva).toLocaleString()}`;
                grandTotal.textContent = `$${Math.round(cartData.total).toLocaleString()}`;
            } else {
                // Mostrar carrito vacío
                emptyCart.classList.remove('hidden');
                cartItems.classList.add('hidden');
                cartTotal.classList.add('hidden');
                cartActions.classList.add('hidden');
            }
        }
        
        function addCartItemToDropdown(item) {
            const template = document.getElementById('cart-item-template');
            const cartItems = document.getElementById('cart-items');
            const clone = template.content.cloneNode(true);
            
            // Configurar datos del producto
            const cartItem = clone.querySelector('.cart-item');
            cartItem.setAttribute('data-item-id', item.id);
            
            clone.querySelector('.item-name').textContent = item.product_name;
            clone.querySelector('.item-type').textContent = item.billing_period;
            clone.querySelector('.item-quantity').textContent = item.quantity;
            clone.querySelector('.item-total').textContent = `$${(item.price * item.quantity).toLocaleString()}`;
            
            // Configurar eventos
            const decreaseBtn = clone.querySelector('.decrease-btn');
            const increaseBtn = clone.querySelector('.increase-btn');
            const removeBtn = clone.querySelector('.remove-item');
            
            decreaseBtn.onclick = () => updateCartItemQuantity(item.id, item.quantity - 1);
            increaseBtn.onclick = () => updateCartItemQuantity(item.id, item.quantity + 1);
            removeBtn.onclick = () => removeCartItem(item.id);
            
            // Deshabilitar decrease si quantity es 1
            if (item.quantity <= 1) {
                decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
                decreaseBtn.onclick = null;
            }
            
            cartItems.appendChild(clone);
        }
        
        function updateCartItemQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;
            
            fetch(`{{ url('/cart/update') }}/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCartDropdown(); // Recargar carrito y badge
                    showToast('Cantidad actualizada', 'success');
                } else {
                    showToast('Error al actualizar cantidad', 'error');
                }
            })
            .catch(error => {
                console.error('Error updating quantity:', error);
                showToast('Error al actualizar cantidad', 'error');
            });
        }
        
        function removeCartItem(itemId) {
            if (!confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
                return;
            }
            
            fetch(`{{ url('/cart/remove') }}/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCartDropdown(); // Recargar carrito y badge
                    showToast('Producto eliminado del carrito', 'success');
                } else {
                    showToast('Error al eliminar producto', 'error');
                }
            })
            .catch(error => {
                console.error('Error removing item:', error);
                showToast('Error al eliminar producto', 'error');
            });
        }
        @endauth
        
        // JS moved to resources/js/layouts/app.js
    </script>

    {{-- Botón Flotante WhatsApp --}}
    <div class="whatsapp-float">
        <a href="https://wa.me/+57{{ preg_replace('/[^0-9]/', '', $companyConfig['cellphone'] ?? '3001234567') }}?text=Hola,%20necesito%20información%20sobre%20los%20servicios%20de%20InnovaSafe%20Consulting" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="whatsapp-btn">
            <div class="whatsapp-icon">
                <svg class="whatsapp-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#25D366">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </div>
        </a>
    </div>

    {{-- Flash messages from Laravel --}}
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', function(){ showToast('{{ session('success') }}', 'success'); });</script>
    @endif
    @if(session('warning'))
        <script>document.addEventListener('DOMContentLoaded', function(){ showToast('{{ session('warning') }}', 'warning'); });</script>
    @endif
    @if(session('error'))
        <script>document.addEventListener('DOMContentLoaded', function(){ showToast('{{ session('error') }}', 'danger'); });</script>
    @endif
</body>
</html>
