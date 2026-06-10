<div style="
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .5rem .25rem;
    position: relative;
">
    {{-- Halo/glow detrás del logo para que se integre con el sidebar --}}
    <div style="
        position: absolute;
        left: -.25rem;
        top: 50%;
        transform: translateY(-50%);
        width: 3.5rem;
        height: 3.5rem;
        background: radial-gradient(ellipse at center, rgba(59,130,246,.25) 0%, transparent 70%);
        pointer-events: none;
        border-radius: 50%;
    "></div>

    {{-- Ícono --}}
    <img
        src="{{ asset('images/home/company-icon.png') }}"
        alt="InnovaSafe"
        style="
            width: 2.75rem;
            height: 2.75rem;
            object-fit: contain;
            position: relative;
            z-index: 1;
            mix-blend-mode: screen;
            filter: drop-shadow(0 0 8px rgba(59,130,246,.45));
        "
    >

    {{-- Texto --}}
    <div style="position: relative; z-index: 1; line-height: 1.15;">
        <div style="
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: .01em;
        ">InnovaSafe</div>
        <div style="
            font-size: .6rem;
            letter-spacing: .22em;
            color: #64748b;
            font-weight: 400;
            text-transform: uppercase;
            margin-top: .05rem;
        ">CONSULTING</div>
    </div>
</div>
