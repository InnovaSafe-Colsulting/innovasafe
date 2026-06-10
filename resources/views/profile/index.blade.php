@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="pt-20 min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                    <img src="{{ $avatarUrl }}" alt="Avatar" class="w-full h-full rounded-full">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->names }} {{ $user->last_names }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
            
            <!-- Información Personal -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Personal</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombres</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->names ?: 'Complete sus nombres' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->last_names ?: 'Complete sus apellidos' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->cellphone ?: 'Complete su número de teléfono' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->document ?: 'Complete su documento' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->address ?: 'Complete su dirección' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Registro</label>
                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection