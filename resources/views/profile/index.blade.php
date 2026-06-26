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
                    
                    <!-- Cambio de Contraseña -->
                    <div class="border-t pt-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Cambiar Contraseña</h3>
                        
                        @if(session('success'))
                            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nueva Contraseña
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" 
                                           id="new_password" 
                                           name="new_password" 
                                           required 
                                           minlength="8" 
                                           maxlength="20"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors
                                                  text-sm sm:text-base"
                                           placeholder="Ingrese su nueva contraseña">
                                    <p class="mt-1 text-xs text-gray-500">
                                        Debe contener: 8-20 caracteres, 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial (@$!%*?&)
                                    </p>
                                </div>
                                
                                <div class="sm:col-span-2 flex flex-col sm:flex-row gap-3">
                                    <button type="submit" 
                                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                                   text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        Actualizar Contraseña
                                    </button>
                                    <button type="button" 
                                            onclick="document.getElementById('new_password').value = ''" 
                                            class="flex-1 sm:flex-none bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                                                   text-sm sm:text-base">
                                        Limpiar
                                    </button>
                                </div>
                            </div>
                        </form>
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