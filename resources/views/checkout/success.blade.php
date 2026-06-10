@extends('layouts.app')

@section('title', 'Pago Enviado')

@section('content')
<div class="pt-20 min-h-screen bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 py-16">
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            
            <!-- Icono de éxito -->
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <img src="{{ asset('images/home/company-icon.png') }}" alt="InnovaSafe" class="w-10 h-10">
            </div>
            
            <h1 class="text-2xl font-bold text-gray-900 mb-4">¡Pago Enviado Exitosamente!</h1>
            
            @if(session('order_id'))
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-blue-800">
                    <strong>Número de Orden:</strong> {{ session('order_id') }}
                </p>
            </div>
            @endif
            
            <div class="text-gray-600 mb-8 space-y-2">
                <p>Tu comprobante de pago ha sido recibido y está siendo procesado por nuestro equipo.</p>
                <p>Recibirás una confirmación por correo electrónico una vez que sea aprobado.</p>
                <p class="text-sm font-medium text-gray-800">Tiempo estimado de procesamiento: 1-3 días hábiles</p>
            </div>
            
            <!-- Estados del proceso -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado del Proceso</h3>
                <div class="flex items-center justify-between">
                    
                    <!-- Paso 1: Completado -->
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Pago Enviado</span>
                    </div>
                    
                    <!-- Línea de conexión -->
                    <div class="flex-1 h-0.5 bg-gray-300 mx-2"></div>
                    
                    <!-- Paso 2: En proceso -->
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Verificando</span>
                    </div>
                    
                    <!-- Línea de conexión -->
                    <div class="flex-1 h-0.5 bg-gray-300 mx-2"></div>
                    
                    <!-- Paso 3: Pendiente -->
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Confirmación</span>
                    </div>
                </div>
            </div>
            
            <!-- Información adicional -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-left">
                        <h4 class="text-sm font-medium text-yellow-800">Información Importante</h4>
                        <ul class="text-sm text-yellow-700 mt-1 list-disc list-inside space-y-1">
                            <li>Conserva el número de orden para futuras consultas</li>
                            <li>Recibirás actualizaciones por correo electrónico</li>
                            <li>Puedes consultar el estado en la sección "Mis Pagos"</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('orders.index') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Ir a Historial
                </a>
                
                <a href="{{ route('plans') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                    </svg>
                    Ver Más Planes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection