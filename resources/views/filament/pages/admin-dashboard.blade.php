<x-filament-panels::page>
<style>
    /* ── Stat cards ── */
    .dash-stats { display: grid; grid-template-columns: repeat(5, 1fr); gap: .875rem; margin-bottom: 1.25rem; }
    @media(max-width:1400px){ .dash-stats{ grid-template-columns: repeat(3,1fr); } }
    @media(max-width:900px){ .dash-stats{ grid-template-columns: repeat(2,1fr); } }

    .stat-card {
        background: rgb(var(--gray-800, 31 41 55)); border: 1px solid rgb(var(--gray-700, 55 65 81));
        border-radius: .875rem; padding: 1.1rem 1.25rem; position: relative; overflow: hidden;
    }
    .dark .stat-card { background: #111827; border-color: #1e293b; }
    .stat-card-icon { width: 2.25rem; height: 2.25rem; border-radius: .5rem; display: flex; align-items: center; justify-content: center; margin-bottom: .625rem; }
    .stat-card-value { font-size: 1.75rem; font-weight: 700; color: #fff; line-height: 1; }
    .stat-card-label { font-size: .72rem; color: #94a3b8; margin-top: .2rem; }
    .stat-card-delta { font-size: .72rem; margin-top: .4rem; display: flex; align-items: center; gap: .2rem; }
    .stat-card-delta.up   { color: #22c55e; }
    .stat-card-delta.flat { color: #94a3b8; }
    .stat-sparkline { margin-top: .625rem; }

    /* ── Hero ── */
    .dash-hero {
        position: relative;
        border-radius: .875rem;
        overflow: hidden;
        background: linear-gradient(105deg, #0a1628 0%, #0d2348 45%, #071022 100%);
        border: 1px solid rgba(59,130,246,.18);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.75rem 2rem;
        min-height: 148px;
    }
    /* partículas de luz azul — fondo */
    .dash-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 80% at 70% 50%, rgba(37,99,235,.18) 0%, transparent 65%),
            radial-gradient(ellipse 30% 50% at 90% 20%, rgba(59,130,246,.10) 0%, transparent 60%);
        pointer-events: none;
        z-index: 0;
    }
    .dash-hero-text {
        position: relative;
        z-index: 2;
        flex: 1;
        padding-right: 1rem;
    }
    .dash-hero-text h1 { font-size: 1.65rem; font-weight: 700; color: #fff; margin-bottom: .3rem; }
    .dash-hero-text p  { font-size: .825rem; color: #94a3b8; margin-bottom: .65rem; line-height: 1.55; }
    .dash-hero-meta { display: flex; gap: 1.25rem; font-size: .75rem; color: #64748b; }
    .dash-hero-meta span { display: flex; align-items: center; gap: .3rem; }
    /* imagen integrada: se funde con el fondo oscuro */
    .dash-hero-img-wrap {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 340px;
        z-index: 1;
        pointer-events: none;
        /* máscara: la imagen desaparece hacia la izquierda y los bordes */
        -webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,.6) 30%, rgba(0,0,0,.85) 55%, black 75%);
        mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,.6) 30%, rgba(0,0,0,.85) 55%, black 75%);
    }
    .dash-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: left center;
        mix-blend-mode: screen;
        opacity: .75;
    }

    /* ── Grid medio ── */
    .dash-mid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: .875rem; margin-bottom: 1.25rem; }
    @media(max-width:1200px){ .dash-mid{ grid-template-columns: 1fr 1fr; } }
    @media(max-width:768px){ .dash-mid{ grid-template-columns: 1fr; } }

    /* ── Panel genérico ── */
    .d-panel { background: #111827; border: 1px solid #1e293b; border-radius: .875rem; padding: 1.1rem 1.25rem; }
    .d-panel-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: .875rem; }
    .d-panel-title { font-size: .85rem; font-weight: 600; color: #f1f5f9; }
    .d-panel-link { font-size: .72rem; color: #3b82f6; cursor: pointer; text-decoration: none; }
    .d-panel-link:hover { text-decoration: underline; }

    /* ── Activity ── */
    .act-item { display: flex; align-items: flex-start; gap: .625rem; padding: .5rem 0; border-bottom: 1px solid #1e293b; }
    .act-item:last-child { border-bottom: none; }
    .act-ico { width: 1.875rem; height: 1.875rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .act-title { font-size: .78rem; color: #cbd5e1; font-weight: 500; }
    .act-sub   { font-size: .72rem; color: #475569; }
    .act-time  { font-size: .68rem; color: #475569; white-space: nowrap; margin-left: auto; }

    /* ── Donut ── */
    .donut-wrap { display: flex; align-items: center; justify-content: center; gap: 1.25rem; flex-wrap: wrap; }
    .donut-legend { list-style: none; padding: 0; margin: 0; }
    .donut-legend li { display: flex; align-items: center; gap: .4rem; font-size: .75rem; color: #94a3b8; margin-bottom: .5rem; }
    .donut-legend li span.dot { width: .55rem; height: .55rem; border-radius: 50%; flex-shrink: 0; }

    /* ── Pay rows ── */
    .pay-row { display: flex; justify-content: space-between; align-items: center; padding: .625rem 0; border-bottom: 1px solid #1e293b; }
    .pay-row:last-child { border-bottom: none; }
    .pay-lbl { font-size: .75rem; color: #94a3b8; }
    .pay-val { font-size: 1.2rem; font-weight: 700; }

    /* ── Bottom grid ── */
    .dash-bot { display: grid; grid-template-columns: 1fr 1fr; gap: .875rem; }
    @media(max-width:900px){ .dash-bot{ grid-template-columns: 1fr; } }

    /* ── Content cards ── */
    .cc-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: .625rem; margin-bottom: .875rem; }
    .cc-card { background: #0d1117; border: 1px solid #1e293b; border-radius: .625rem; padding: .875rem; text-align: center; }
    .cc-ico { width: 2rem; height: 2rem; border-radius: .4rem; display: flex; align-items: center; justify-content: center; margin: 0 auto .4rem; }
    .cc-val { font-size: 1.375rem; font-weight: 700; color: #fff; }
    .cc-lbl { font-size: .68rem; color: #64748b; }
    .cc-delta { font-size: .68rem; color: #22c55e; }
    .d-btn { width: 100%; background: #1e293b; color: #94a3b8; border: none; border-radius: .4rem; padding: .4rem; font-size: .72rem; cursor: pointer; margin-top: .2rem; }
    .d-btn:hover { background: #273549; color: #e2e8f0; }

    /* ── Social ── */
    .soc-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: .625rem; }
    .soc-card { background: #0d1117; border: 1px solid #1e293b; border-radius: .625rem; padding: .875rem; }
    .soc-hd { display: flex; align-items: center; gap: .4rem; margin-bottom: .375rem; }
    .soc-name { font-size: .72rem; color: #94a3b8; font-weight: 600; }
    .soc-val { font-size: 1.25rem; font-weight: 700; color: #fff; }
    .soc-delta { font-size: .68rem; color: #22c55e; }
    .soc-lbl   { font-size: .68rem; color: #475569; }
</style>

{{-- Hero banner --}}
<div class="dash-hero">
    <div class="dash-hero-text">
        <h1>{{ $greeting }}, {{ $user->names }}! 👋</h1>
        <p>Bienvenido al Centro de Gestión Empresarial de InnovaSafe.<br>Desde aquí puedes administrar y hacer crecer tu empresa.</p>
        <div class="dash-hero-meta">
            <span>
                <svg style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $now->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            </span>
            <span>
                <svg style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span id="dash-clock">{{ $now->format('h:i A') }}</span>
            </span>
        </div>
    </div>
    {{-- imagen que se funde con el fondo --}}
    <div class="dash-hero-img-wrap">
        <img src="{{ asset('images/home/shield-hero.png') }}" alt="" class="dash-hero-img">
    </div>
</div>

{{-- Stats --}}
<div class="dash-stats">
    <div class="stat-card">
        <div class="stat-card-icon" style="background:rgba(59,130,246,.15)">
            <svg style="width:18px;height:18px;color:#3b82f6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-card-value">37</div>{{-- 🔴 QUEMADO: users con role_id=3 y status=1 --}}
        <div class="stat-card-label">Clientes Activos</div>
        <div class="stat-card-delta up">↑ +5 este mes</div>{{-- 🔴 QUEMADO --}}
        <div class="stat-sparkline"><svg viewBox="0 0 80 22" style="width:100%;height:22px"><polyline points="0,18 13,15 26,12 40,13 53,8 66,5 80,2" fill="none" stroke="#3b82f6" stroke-width="1.5" stroke-linecap="round"/></svg></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:rgba(139,92,246,.15)">
            <svg style="width:18px;height:18px;color:#8b5cf6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div class="stat-card-value">128</div>{{-- 🔴 QUEMADO: User::count() --}}
        <div class="stat-card-label">Usuarios Registrados</div>
        <div class="stat-card-delta up">↑ +14 este mes</div>{{-- 🔴 QUEMADO --}}
        <div class="stat-sparkline"><svg viewBox="0 0 80 22" style="width:100%;height:22px"><polyline points="0,20 13,17 26,15 40,12 53,9 66,5 80,2" fill="none" stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round"/></svg></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:rgba(34,197,94,.15)">
            <svg style="width:18px;height:18px;color:#22c55e" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <div class="stat-card-value">4</div>{{-- 🔴 QUEMADO: type_services activos --}}
        <div class="stat-card-label">Servicios Activos</div>
        <div class="stat-card-delta flat" style="color:#22c55e">✓ Todos operativos</div>
        <div class="stat-sparkline"><svg viewBox="0 0 80 22" style="width:100%;height:22px"><polyline points="0,11 20,11 40,11 60,11 80,11" fill="none" stroke="#22c55e" stroke-width="1.5" stroke-linecap="round"/></svg></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:rgba(249,115,22,.15)">
            <svg style="width:18px;height:18px;color:#f97316" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <div class="stat-card-value">135</div>{{-- 🔴 QUEMADO: blogs + documentos --}}
        <div class="stat-card-label">Recursos Publicados</div>
        <div class="stat-card-delta up">↑ +12 este mes</div>{{-- 🔴 QUEMADO --}}
        <div class="stat-sparkline"><svg viewBox="0 0 80 22" style="width:100%;height:22px"><polyline points="0,17 13,14 26,12 40,13 53,9 66,7 80,4" fill="none" stroke="#f97316" stroke-width="1.5" stroke-linecap="round"/></svg></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:rgba(20,184,166,.15)">
            <svg style="width:18px;height:18px;color:#14b8a6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-card-value">41</div>{{-- 🔴 QUEMADO: pagos del mes --}}
        <div class="stat-card-label">Pagos Recibidos (Mes)</div>
        <div class="stat-card-delta up">↑ +18 este mes</div>{{-- 🔴 QUEMADO --}}
        <div class="stat-sparkline"><svg viewBox="0 0 80 22" style="width:100%;height:22px"><polyline points="0,19 13,15 26,11 40,13 53,7 66,9 80,2" fill="none" stroke="#14b8a6" stroke-width="1.5" stroke-linecap="round"/></svg></div>
    </div>
</div>

{{-- Middle row --}}
<div class="dash-mid">

    {{-- Actividad Reciente --}}
    <div class="d-panel">
        <div class="d-panel-hd">
            <span class="d-panel-title">Actividad Reciente</span>
            <a href="#" class="d-panel-link">Ver todo</a>
        </div>
        {{-- 🔴 QUEMADO: últimos eventos del sistema --}}
        <div class="act-item">
            <div class="act-ico" style="background:rgba(249,115,22,.15)"><svg style="width:14px;height:14px;color:#f97316" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg></div>
            <div style="flex:1;min-width:0"><div class="act-title">Nueva noticia publicada</div><div class="act-sub">Nueva resolución SST 2026</div></div>
            <span class="act-time">10:30 AM</span>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(59,130,246,.15)"><svg style="width:14px;height:14px;color:#3b82f6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg></div>
            <div style="flex:1;min-width:0"><div class="act-title">Nuevo cliente registrado</div><div class="act-sub">Constructora del Norte S.A.S</div></div>
            <span class="act-time">10:28 AM</span>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(20,184,166,.15)"><svg style="width:14px;height:14px;color:#14b8a6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <div style="flex:1;min-width:0"><div class="act-title">Pago confirmado</div><div class="act-sub">Consultoría Integral S.A.S – Plan Empresarial</div></div>
            <span class="act-time">09:55 AM</span>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(34,197,94,.15)"><svg style="width:14px;height:14px;color:#22c55e" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
            <div style="flex:1;min-width:0"><div class="act-title">Guía práctica creada</div><div class="act-sub">Implementación del SG-SST</div></div>
            <span class="act-time">09:30 AM</span>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(139,92,246,.15)"><svg style="width:14px;height:14px;color:#8b5cf6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
            <div style="flex:1;min-width:0"><div class="act-title">Usuario creado</div><div class="act-sub">María José González</div></div>
            <span class="act-time">09:10 AM</span>
        </div>
        <div style="margin-top:.625rem;text-align:center"><button class="d-btn">Ver más actividades</button></div>
    </div>

    {{-- Clientes por Plan --}}
    <div class="d-panel">
        <div class="d-panel-hd">
            <span class="d-panel-title">Clientes por Plan</span>
            <a href="#" class="d-panel-link">Ver reporte</a>
        </div>
        {{-- 🔴 QUEMADO: distribución clientes por plan --}}
        <div class="donut-wrap">
            <div style="position:relative;width:120px;height:120px;flex-shrink:0">
                <svg viewBox="0 0 36 36" style="width:120px;height:120px;transform:rotate(-90deg)">
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#1e293b" stroke-width="3.5"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#3b82f6" stroke-width="3.5" stroke-dasharray="48.6 51.4" stroke-dashoffset="0"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#8b5cf6" stroke-width="3.5" stroke-dasharray="32.4 67.6" stroke-dashoffset="-48.6"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#22c55e" stroke-width="3.5" stroke-dasharray="18.9 81.1" stroke-dashoffset="-81"/>
                </svg>
                <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center">
                    <span style="font-size:1.375rem;font-weight:700;color:#fff">37</span>{{-- 🔴 QUEMADO --}}
                    <span style="font-size:.62rem;color:#64748b">Total Clientes</span>
                </div>
            </div>
            <ul class="donut-legend">
                <li><span class="dot" style="background:#3b82f6"></span>Empresarial <strong style="color:#fff;margin-left:.25rem">18 (48.6%)</strong></li>{{-- 🔴 QUEMADO --}}
                <li><span class="dot" style="background:#8b5cf6"></span>Premium <strong style="color:#fff;margin-left:.25rem">12 (32.4%)</strong></li>{{-- 🔴 QUEMADO --}}
                <li><span class="dot" style="background:#22c55e"></span>Básico <strong style="color:#fff;margin-left:.25rem">7 (18.9%)</strong></li>{{-- 🔴 QUEMADO --}}
            </ul>
        </div>
    </div>

    {{-- Resumen Pagos --}}
    <div class="d-panel">
        <div class="d-panel-hd">
            <span class="d-panel-title">Resumen de Pagos</span>
            <a href="#" class="d-panel-link">Ver reportes</a>
        </div>
        {{-- 🔴 QUEMADO: datos reales de pagos --}}
        <div class="pay-row">
            <div><div class="pay-lbl">Pagos Recibidos (Mes)</div><div class="pay-val" style="color:#22c55e">41</div><div style="font-size:.68rem;color:#22c55e">↑ +16 este mes</div></div>{{-- 🔴 QUEMADO --}}
            <svg viewBox="0 0 55 22" style="width:55px;height:22px"><polyline points="0,18 11,14 22,10 33,12 44,7 55,3" fill="none" stroke="#22c55e" stroke-width="1.5"/></svg>
        </div>
        <div class="pay-row">
            <div><div class="pay-lbl">Pagos Pendientes</div><div class="pay-val" style="color:#f59e0b">5</div><div style="font-size:.68rem;color:#64748b">Por cobrar</div></div>{{-- 🔴 QUEMADO --}}
            <svg viewBox="0 0 55 22" style="width:55px;height:22px"><polyline points="0,11 11,13 22,9 33,11 44,7 55,5" fill="none" stroke="#f59e0b" stroke-width="1.5"/></svg>
        </div>
        <div class="pay-row">
            <div><div class="pay-lbl">Pagos Vencidos</div><div class="pay-val" style="color:#ef4444">2</div><div style="font-size:.68rem;color:#ef4444">Atención requerida</div></div>{{-- 🔴 QUEMADO --}}
            <svg viewBox="0 0 55 22" style="width:55px;height:22px"><polyline points="0,7 11,9 22,11 33,9 44,13 55,15" fill="none" stroke="#ef4444" stroke-width="1.5"/></svg>
        </div>
    </div>
</div>

{{-- Bottom row --}}
<div class="dash-bot">

    {{-- Centro de Contenido --}}
    <div class="d-panel">
        <div class="d-panel-hd">
            <span class="d-panel-title">Centro de Contenido</span>
            <a href="#" class="d-panel-link">Ver todo el contenido</a>
        </div>
        <div class="cc-grid">
            <div class="cc-card">
                <div class="cc-ico" style="background:rgba(59,130,246,.15)"><svg style="width:16px;height:16px;color:#3b82f6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg></div>
                <div class="cc-val">45</div>{{-- 🔴 QUEMADO: BlogResourceDetail::count() --}}
                <div class="cc-lbl">Blog</div>
                <div class="cc-lbl">Artículos publicados</div>
                <div class="cc-delta">+6 este mes</div>{{-- 🔴 QUEMADO --}}
            </div>
            <div class="cc-card">
                <div class="cc-ico" style="background:rgba(34,197,94,.15)"><svg style="width:16px;height:16px;color:#22c55e" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                <div class="cc-val">18</div>{{-- 🔴 QUEMADO --}}
                <div class="cc-lbl">Guías Prácticas</div>
                <div class="cc-lbl">Guías disponibles</div>
                <div class="cc-delta">+3 este mes</div>{{-- 🔴 QUEMADO --}}
            </div>
            <div class="cc-card">
                <div class="cc-ico" style="background:rgba(249,115,22,.15)"><svg style="width:16px;height:16px;color:#f97316" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg></div>
                <div class="cc-val">72</div>{{-- 🔴 QUEMADO: DocumentsResourcesDetail::count() --}}
                <div class="cc-lbl">Descargables</div>
                <div class="cc-lbl">Archivos disponibles</div>
                <div class="cc-delta">+9 este mes</div>{{-- 🔴 QUEMADO --}}
            </div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem">
            <button class="d-btn">Gestionar Blog</button>
            <button class="d-btn">Gestionar Guías</button>
            <button class="d-btn">Gestionar Descargables</button>
        </div>
    </div>

    {{-- Redes Sociales --}}
    <div class="d-panel">
        <div class="d-panel-hd">
            <span class="d-panel-title">Estadísticas Redes Sociales</span>
            <a href="#" class="d-panel-link">Ver detalles</a>
        </div>
        {{-- 🔴 COMPLETAMENTE QUEMADO: sin integración aún --}}
        <div class="soc-grid">
            <div class="soc-card">
                <div class="soc-hd"><svg style="width:18px;height:18px" viewBox="0 0 24 24" fill="#E4405F"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg><span class="soc-name">Instagram</span></div>
                <div class="soc-val">2.540</div><div class="soc-delta">+42 este mes</div><div class="soc-lbl">Seguidores</div>
                <svg viewBox="0 0 55 18" style="width:100%;height:18px;margin-top:.4rem"><polyline points="0,14 11,11 22,8 33,10 44,5 55,2" fill="none" stroke="#E4405F" stroke-width="1.5"/></svg>
            </div>
            <div class="soc-card">
                <div class="soc-hd"><svg style="width:18px;height:18px" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg><span class="soc-name">Facebook</span></div>
                <div class="soc-val">1.860</div><div class="soc-delta">+17 este mes</div><div class="soc-lbl">Seguidores</div>
                <svg viewBox="0 0 55 18" style="width:100%;height:18px;margin-top:.4rem"><polyline points="0,13 11,10 22,9 33,11 44,7 55,4" fill="none" stroke="#1877F2" stroke-width="1.5"/></svg>
            </div>
            <div class="soc-card">
                <div class="soc-hd"><svg style="width:18px;height:18px" viewBox="0 0 24 24" fill="#0A66C2"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg><span class="soc-name">LinkedIn</span></div>
                <div class="soc-val">3.120</div><div class="soc-delta">+29 este mes</div><div class="soc-lbl">Seguidores</div>
                <svg viewBox="0 0 55 18" style="width:100%;height:18px;margin-top:.4rem"><polyline points="0,15 11,12 22,10 33,8 44,5 55,2" fill="none" stroke="#0A66C2" stroke-width="1.5"/></svg>
            </div>
        </div>
    </div>

</div>

<script>
(function(){
    var el = document.getElementById('dash-clock');
    if(!el) return;
    function tick(){
        var d=new Date(), h=d.getHours(), m=d.getMinutes(), s=d.getSeconds();
        var ap=h>=12?'PM':'AM'; h=h%12||12;
        el.textContent=(h<10?'0':'')+h+':'+(m<10?'0':'')+m+':'+(s<10?'0':'')+s+' '+ap;
    }
    tick(); setInterval(tick,1000);
})();
</script>
</x-filament-panels::page>
