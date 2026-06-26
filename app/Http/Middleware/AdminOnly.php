<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si está autenticado
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autenticado.',
                    'redirect' => '/login'
                ], 401);
            }
            return redirect('/login');
        }
        
        $user = Auth::user();
        
        // Solo permitir administradores
        if ($user->role_id != 1) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Acceso no autorizado. Solo administradores.',
                    'redirect' => '/login'
                ], 403);
            }
            
            return redirect('/login')->with('error', 'Acceso no autorizado. Solo administradores.');
        }
        
        return $next($request);
    }
}