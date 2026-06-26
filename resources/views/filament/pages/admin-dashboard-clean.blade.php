<x-filament-panels::page>
    <div style="padding: 2rem;">
        <div style="background: #111827; border: 1px solid #1e293b; border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
            <h1 style="color: #fff; font-size: 2rem; margin-bottom: 1rem;">
                {{ $greeting }}, {{ $user ? ($user->names ?? $user->name ?? 'Usuario') : 'Usuario' }}! 👋
            </h1>
            <p style="color: #94a3b8;">
                Bienvenido al Centro de Gestión Empresarial de InnovaSafe.<br>
                Desde aquí puedes administrar y hacer crecer tu empresa.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <div style="background: #111827; border: 1px solid #1e293b; border-radius: 12px; padding: 1.5rem;">
                <h3 style="color: #3b82f6; margin-bottom: 1rem;">📊 Estadísticas</h3>
                <p style="color: #94a3b8;">Panel de control con métricas del sistema</p>
            </div>
            
            <div style="background: #111827; border: 1px solid #1e293b; border-radius: 12px; padding: 1.5rem;">
                <h3 style="color: #22c55e; margin-bottom: 1rem;">👥 Gestión de Clientes</h3>
                <p style="color: #94a3b8;">Administrar usuarios y perfiles</p>
            </div>
            
            <div style="background: #111827; border: 1px solid #1e293b; border-radius: 12px; padding: 1.5rem;">
                <h3 style="color: #f59e0b; margin-bottom: 1rem;">🛡️ Servicios</h3>
                <p style="color: #94a3b8;">Configurar tipos de servicios</p>
            </div>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 8px;">
            <p style="color: #22c55e; margin: 0;">
                ✅ Sistema funcionando correctamente con guards separados
            </p>
        </div>
    </div>
</x-filament-panels::page>