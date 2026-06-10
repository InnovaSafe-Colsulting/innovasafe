@extends('layouts.app')

@section('title', 'Blogs')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="resources-title font-semibold tracking-widest uppercase mb-4">BLOGS</p>
        <h1 class="resources-heading text-white font-bold leading-tight">Artículos y noticias</h1>
    </div>
</section>

{{-- Blog Content --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-[#0a0f2c] mb-8">Blogs</h2>
        <p class="text-gray-600">Contenido en construcción...</p>
    </div>
</section>

@endsection
