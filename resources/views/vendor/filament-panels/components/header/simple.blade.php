@props([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
])

<header class="fi-simple-header">
    @if ($logo)
        <div style="display:flex; flex-direction:column; align-items:center; gap:.75rem;">
            <img
                src="{{ asset('images/home/splash-loader.png') }}"
                alt="InnovaSafe"
                style="width:4rem; height:4rem; object-fit:contain;"
            >
            <div style="text-align:center; line-height:1.15;">
                <div style="font-size:1.05rem; font-weight:700; color:#fff; letter-spacing:.01em;">InnovaSafe</div>
                <div style="font-size:.6rem; letter-spacing:.22em; color:#64748b; font-weight:400; text-transform:uppercase; margin-top:.05rem;">CONSULTING</div>
            </div>
        </div>
    @endif

    @if (filled($heading) && $heading !== __('filament-panels::auth/pages/login.heading'))
        <h1 class="fi-simple-header-heading">
            {{ $heading }}
        </h1>
    @endif

    @if (filled($subheading))
        <p class="fi-simple-header-subheading">
            {{ $subheading }}
        </p>
    @endif
</header>
