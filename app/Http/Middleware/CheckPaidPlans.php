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
        // Solo verificar usuarios autenticados que no sean admin
        if (Auth::check() && Auth::user()->role_id != 1) {
            $user = Auth::user();
            
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
        }
        
        return $next($request);
    }
}