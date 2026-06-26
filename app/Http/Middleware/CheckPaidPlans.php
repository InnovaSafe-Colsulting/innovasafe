<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPaidPlans
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
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
        
        // Lógica para administradores (role_id = 1)
        if ($user->role_id == 1) {
            // Los admins tienen acceso completo, no necesitan verificación adicional
            return $next($request);
        }
        
        // Lógica para clientes (role_id = 3)
        elseif ($user->role_id == 3) {
            // Verificar si tiene al menos un plan pagado
            $hasPaidPlan = DB::table('orders')
                ->where('user_id', $user->id)
                ->where('status', 'paid')
                ->exists();
            
            if (!$hasPaidPlan) {
                // Desloguear y redirigir al login
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
        
        // Usuarios con otros roles no autorizados
        else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autorizado.',
                    'redirect' => '/login'
                ], 403);
            }
            
            return redirect('/login')->with('error', 'Usuario no autorizado.');
        }
    }
}