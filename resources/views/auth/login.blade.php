@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gray-50 pt-20 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h1>
            <p class="text-sm text-gray-500 mt-2">Accede a tu plataforma InnovaSafe</p>
        </div>

        {{-- Mensajes de éxito y error --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700 text-sm">{{ session('success') }}</p>
            </div>
        @endif
        
        @if (session('message'))
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-blue-700 text-sm">{{ session('message') }}</p>
            </div>
        @endif
        
        @if (session('error') || $errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                @if(session('error'))
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="text-red-700 text-sm">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" id="email" name="email" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    Recordarme
                </label>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
                Ingresar
            </button>
        </form>
    </div>
</section>
@endsection
