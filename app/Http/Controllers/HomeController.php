<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado y tiene planes pagados
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verificar si tiene al menos un plan pagado
            $hasPaidPlan = DB::table('orders')
                ->where('user_id', $user->id)
                ->where('status', 'paid')
                ->exists();
            
            if (!$hasPaidPlan) {
                // Si no tiene planes pagados, desloguear
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
                
                return redirect('/#login-required')->with('error', 'Debe tener al menos un plan activo para acceder al sistema.');
            }
        }
        
        $typeServices = DB::table('type_services')->get();

        return view('home', compact('typeServices'));
    }
}
