<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientOnly
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
        
        // Solo permitir clientes
        if ($user->role_id != 3) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Acceso no autorizado. Solo clientes.',
                    'redirect' => '/login'
                ], 403);
            }
            
            return redirect('/login')->with('error', 'Acceso no autorizado. Solo clientes.');
        }
        
        // Verificar que el cliente esté activo
        if ($user->active != '1') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Su usuario todavía no está autorizado.', 'redirect' => '/login'], 403);
            }
            return redirect('/login')->with('error', 'Su usuario todavía no está autorizado.');
        }

        return $next($request);
    }
}