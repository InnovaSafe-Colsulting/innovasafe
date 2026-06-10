<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Si es la ruta de perfil o logout, permitir acceso
            if ($request->routeIs('profile') || $request->routeIs('profile.password') || $request->routeIs('logout')) {
                return $next($request);
            }
            
            // Si no ha cambiado la contraseña y tiene 3 o más logins, forzar cambio
            if (!$user->password_changed && $user->login_count >= 3) {
                session(['force_password_change' => true]);
                return redirect()->route('profile')->with('warning', 'Debe cambiar su contraseña para continuar');
            }
            
            // Si no ha cambiado la contraseña pero tiene menos de 3 logins, mostrar sugerencia
            if (!$user->password_changed && $user->login_count > 0) {
                session(['suggest_password_change' => true]);
            }
        }
        
        return $next($request);
    }
}