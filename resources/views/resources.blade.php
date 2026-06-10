@extends('layouts.app')

@section('title', 'Recursos')

@section('content')

@php
    $resources = $resources ?? collect();
@endphp

{{-- Hero Resources --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="resources-title font-semibold tracking-widest uppercase mb-4">RECURSOS</p>
        <h1 class="resources-heading text-white font-bold leading-tight">Conocimiento que transforma</h1>
    </div>
</section>

{{-- Resources Cards --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach($resources as $resource)
                <div class="bg-white rounded-2xl border border-gray-200 p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-10 h-10 text-[#2268bd] mb-6">
                        {!! $resource->icon !!}
                    </div>
                    <h3 class="text-xl font-bold text-[#0a0f2c] mb-3">{{ $resource->resource }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $resource->description }}</p>
                    
                    @if($resource->resource == 'Blog' && $blogCount > 0)
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-[#2268bd] font-medium text-sm hover:text-blue-800 transition">
                            Ver el blog <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    @elseif($resource->resource == 'Blog')
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <p class="text-sm text-yellow-800">No hay blogs creados en el momento</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($resource->resource == 'Guías prácticas' && $documentsGuia > 0)
                        <a href="{{ route('documents.index') }}" class="inline-flex items-center gap-2 text-[#2268bd] font-medium text-sm hover:text-blue-800 transition">
                            Ver la guía <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    @elseif($resource->resource == 'Guías prácticas')
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <p class="text-sm text-yellow-800">El recurso no se encuentra disponible ahora</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($resource->resource == 'Descargables' && $documentsDescargables > 0)
                        <a href="{{ route('documents.index') }}" class="inline-flex items-center gap-2 text-[#2268bd] font-medium text-sm hover:text-blue-800 transition">
                            Ver la guía <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    @elseif($resource->resource == 'Descargables')
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <p class="text-sm text-yellow-800">El recurso no se encuentra disponible ahora</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
