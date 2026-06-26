@extends('layouts.app')

@section('title', 'Historial de Compras')

@section('content')
<div class="pt-20 min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 py-8">
        
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Historial de Compras</h1>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Total de órdenes: <span class="font-semibold text-gray-700">{{ $orders->count() }}</span></p>
                </div>
            </div>
        </div>

        @forelse($orders as $order)
            <!-- Order Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 overflow-hidden">
                
                <!-- Order Header -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Orden #{{ $order->id }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at ? $order->created_at->diffForHumans() : 'Sin fecha' }}</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                       ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                    @switch($order->status)
                                        @case('paid') Pagado @break
                                        @case('pending') Pendiente @break
                                        @case('cancelled') Cancelado @break
                                        @default {{ ucfirst($order->status) }}
                                    @endswitch
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Método de pago:</p>
                                <p class="text-sm font-medium text-gray-700 capitalize">{{ $order->paymentType->name ?? 'No definido' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-black text-[#0a0f2c]">${{ number_format($order->total) }}</p>
                            <p class="text-sm font-semibold text-gray-500">COP</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                @if($order->status === 'paid')
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Productos</h3>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs">
                                            PLAN
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $item->plan->name ?? 'Plan eliminado' }} - {{ $item->billing_period }}</h4>
                                            @if($item->plan)
                                                <p class="text-sm text-gray-600">{{ $item->plan->description }}</p>
                                            @endif
                                            <p class="text-xs text-gray-500">Cantidad: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-900">${{ number_format($item->total_price) }}</p>
                                        <p class="text-xs text-gray-500">COP</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-6">
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                @if($order->status === 'pending')
                                    Pago Pendiente de Verificación
                                @else
                                    Orden {{ ucfirst($order->status) }}
                                @endif
                            </h3>
                            <p class="text-gray-600">
                                @if($order->status === 'pending')
                                    Los productos se mostrarán una vez se confirme el pago
                                @else
                                    Esta orden no está disponible
                                @endif
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Order Summary -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 text-sm">
                            <span class="text-gray-500">Subtotal: <span class="font-semibold text-gray-700">${{ number_format($order->subtotal) }}</span></span>
                            <span class="text-gray-500">IVA (19%): <span class="font-semibold text-gray-700">${{ number_format($order->iva) }}</span></span>
                        </div>
                        @if($order->payment_screenshot)
                            <a href="{{ Storage::url($order->payment_screenshot) }}" target="_blank" 
                               class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Ver comprobante
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12">
                <div class="text-center">
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-4">No hay compras disponibles</h3>
                    <p class="text-gray-600 mb-8">Aún no has realizado ninguna compra. ¡Explora nuestros planes y comienza ahora!</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('plans') }}" 
                           class="inline-flex items-center gap-2 bg-[#2268bd] hover:bg-[#1a4c8c] text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Ver Planes
                        </a>
                        <a href="{{ route('services') }}" 
                           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Ver Servicios
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection