@extends('layouts.app')

@section('title', 'Recursos')

@section('content')

<link rel="canonical" href="https://innovasafeconsulting.com/">

{{-- Hero Resources --}}
<section class="relative bg-[#01020e] pt-32 lg:pt-40 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="resources-title font-semibold tracking-widest uppercase mb-4">RECURSOS</p>
        <h1 class="resources-heading text-white font-bold leading-tight">Conocimiento que transforma</h1>
        <p class="text-gray-400 mt-6 text-lg leading-relaxed max-w-2xl mx-auto">Explora nuestra biblioteca de recursos: blogs, descargables y guías prácticas sobre SST, calidad, vigilancia, gestión empresarial y todo lo relacionado con las soluciones que ofrecemos. Contenido diseñado para impulsar tu organización.</p>
    </div>
</section>

{{-- Tabs --}}
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap gap-3 mb-10 border-b border-gray-200">
            <button onclick="switchTab('blog')" id="tab-btn-blog"
                class="tab-btn flex items-center gap-2 px-6 py-3 font-semibold text-sm transition border-b-2 border-[#2268bd] text-[#2268bd]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 2v6h6M9 13h6M9 17h4"/>
                </svg>
                Blog
            </button>
            <button onclick="switchTab('descargables')" id="tab-btn-descargables"
                class="tab-btn flex items-center gap-2 px-6 py-3 font-semibold text-sm transition border-b-2 border-transparent text-gray-500 hover:text-[#2268bd]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Descargables
            </button>
            <button onclick="switchTab('guias')" id="tab-btn-guias"
                class="tab-btn flex items-center gap-2 px-6 py-3 font-semibold text-sm transition border-b-2 border-transparent text-gray-500 hover:text-[#2268bd]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Guías Prácticas
            </button>
        </div>

        {{-- Tab: Blog --}}
        <div id="tab-blog">
            @if($blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-44 object-cover rounded-xl mb-5">
                            @else
                                <div class="w-full h-44 bg-blue-50 rounded-xl mb-5 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-lg font-bold text-[#0a0f2c] mb-2">{{ $blog->title }}</h3>
                            @if($blog->description)
                                <p class="text-gray-500 text-sm mb-4 flex-1">{{ Str::limit($blog->description, 100) }}</p>
                            @endif
                            @if($blog->url_link)
                                <a href="{{ $blog->url_link }}" target="_blank" class="inline-flex items-center gap-2 text-[#2268bd] font-medium text-sm hover:text-blue-800 transition mt-auto">
                                    Leer más
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if(!$isClient && $blogsTotal > 0)
                    @include('partials.recursos-login-banner')
                @endif
            @else
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6M9 17h4"/>
                    </svg>
                    <p class="text-gray-400 font-medium text-lg">No hay blogs disponibles</p>
                    <p class="text-gray-300 text-sm mt-1">Pronto publicaremos nuevos artículos.</p>
                </div>
            @endif
        </div>

        {{-- Tab: Descargables --}}
        <div id="tab-descargables" class="hidden">
            @if($descargables->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($descargables as $doc)
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-5">
                                <svg class="w-6 h-6 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[#0a0f2c] mb-4 flex-1">{{ $doc->title }}</h3>
                            @if($doc->path)
                                <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="inline-flex items-center gap-2 text-[#2268bd] font-medium text-sm hover:text-blue-800 transition mt-auto">
                                    Descargar
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if(!$isClient && $descargablesTotal > 0)
                    @include('partials.recursos-login-banner')
                @endif
            @else
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <p class="text-gray-400 font-medium text-lg">No hay descargables disponibles</p>
                    <p class="text-gray-300 text-sm mt-1">Pronto agregaremos nuevos recursos.</p>
                </div>
            @endif
        </div>

        {{-- Tab: Guías Prácticas --}}
        <div id="tab-guias" class="hidden">
            @if($guias->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($guias as $guia)
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-5">
                                <svg class="w-6 h-6 text-[#2268bd]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[#0a0f2c] mb-4 flex-1">{{ $guia->title }}</h3>
                            @if($guia->path)
                                <a href="{{ asset('storage/' . $guia->path) }}" target="_blank" class="inline-flex items-center gap-2 text-[#2268bd] font-medium text-sm hover:text-blue-800 transition mt-auto">
                                    Ver guía
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if(!$isClient && $guiasTotal > 0)
                    @include('partials.recursos-login-banner')
                @endif
            @else
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-gray-400 font-medium text-lg">No hay guías prácticas disponibles</p>
                    <p class="text-gray-300 text-sm mt-1">Pronto publicaremos nuevas guías.</p>
                </div>
            @endif
        </div>

    </div>
</section>

<script>
function switchTab(tab) {
    ['blog', 'descargables', 'guias'].forEach(t => {
        document.getElementById('tab-' + t).classList.add('hidden');
        const btn = document.getElementById('tab-btn-' + t);
        btn.classList.remove('border-[#2268bd]', 'text-[#2268bd]');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    document.getElementById('tab-' + tab).classList.remove('hidden');
    const activeBtn = document.getElementById('tab-btn-' + tab);
    activeBtn.classList.remove('border-transparent', 'text-gray-500');
    activeBtn.classList.add('border-[#2268bd]', 'text-[#2268bd]');
}
</script>

@include('components.modals.advisory')

<script>
document.getElementById('modal-close').addEventListener('click', () => {
    document.getElementById('modal-asesoria').classList.replace('flex','hidden');
});
document.getElementById('modal-overlay').addEventListener('click', () => {
    document.getElementById('modal-asesoria').classList.replace('flex','hidden');
});
</script>

@endsection
