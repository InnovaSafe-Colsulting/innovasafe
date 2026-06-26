<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        
        // Verificar planes pagados para clientes
        $hasPaidPlan = DB::table('orders')
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->exists();
        
        if (!$hasPaidPlan) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Debe tener al menos un plan activo para acceder al sistema.',
                    'redirect' => '/#login-required'
                ], 403);
            }
            
            return redirect('/#login-required')->with('error', 'Debe tener al menos un plan activo para acceder al sistema.');
        }
        
        return $next($request);
    }
}