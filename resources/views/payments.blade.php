@extends('layouts.app')

@section('title', 'Pagos')

@section('content')

{{-- Hero Payments --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-[#2596be] font-semibold tracking-widest uppercase mb-4" style="font-size: 23px;">PAGOS</p>
        <h1 class="text-white font-bold leading-tight" style="font-size: clamp(2rem, 5vw, 40px);">Realiza tu pago de forma segura</h1>
        <p class="text-white mt-4 leading-relaxed mx-auto" style="font-size: 18px; max-width: 580px;">Selecciona tu método de pago preferido y completa tu transacción.</p>
    </div>
</section>

{{-- Payment Content --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Plan Info --}}
        @if($subscriptions->isEmpty())
        <div class="bg-[#0a0f2c] rounded-2xl p-6 mb-10 flex items-center justify-center">
            <p class="text-gray-400 text-sm">No hay productos adquiridos por el usuario de este perfil</p>
        </div>
        @else
            @foreach($subscriptions as $subscription)
            <div class="bg-[#0a0f2c] rounded-2xl p-6 mb-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <p class="text-gray-400 text-sm">{{ $subscription->billing_period ?? 'Plan actual' }}</p>
                    <h3 class="text-white text-xl font-bold">{{ $subscription->plan->name }}</h3>
                    @if($orderStatuses->isNotEmpty())
                        @php
                            $latestOrder = $orderStatuses->first();
                        @endphp
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $latestOrder->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                   ($latestOrder->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($latestOrder->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                @switch($latestOrder->status)
                                    @case('paid') ✓ Pagado @break
                                    @case('pending') ⏳ Pendiente @break
                                    @case('cancelled') ✗ Cancelado @break
                                    @default {{ ucfirst($latestOrder->status) }}
                                @endswitch
                            </span>
                        </div>
                    @else
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Sin órdenes
                            </span>
                        </div>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-gray-400 text-sm">Valor</p>
                    <p class="text-white text-2xl font-bold">${{ number_format($subscription->total_prize) }} <span class="text-sm font-normal text-gray-400">COP</span></p>
                </div>
            </div>
            @endforeach
        @endif

        {{-- Payment Methods --}}
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Métodos de pago</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($paymentDetails as $detail)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $detail->typePayment->name }}</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    @if($detail->agreement)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Convenio:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->agreement }}</span>
                    </div>
                    @endif
                    @if($detail->reference)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Referencia:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->reference }}</span>
                    </div>
                    @endif
                    @if($detail->bank)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Banco:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->bank }}</span>
                    </div>
                    @endif
                    @if($detail->account_type)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tipo:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->account_type }}</span>
                    </div>
                    @endif
                    @if($detail->account_number)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Número:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->account_number }}</span>
                    </div>
                    @endif
                    @if($detail->holder)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Titular:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->holder }}</span>
                    </div>
                    @endif
                    @if($detail->nit)
                    <div class="flex justify-between">
                        <span class="text-gray-500">NIT:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->nit }}</span>
                    </div>
                    @endif
                    @if($detail->cellphone)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Celular:</span>
                        <span class="font-semibold text-gray-900">{{ $detail->cellphone }}</span>
                    </div>
                    @endif

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
