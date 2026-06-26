<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        Log::info("Ingreso al login");
        $user = User::where('email', $request->email)->first();
        $credentials = ['email' => $request->email, 'password' => $request->password];
        
        // Si es admin, autenticar y redirigir al panel administrativo
        if ($user && $user->role_id == 1) {
            if (Auth::guard('web')->attempt($credentials, false)) {
                $user->increment('login_count');
                $request->session()->regenerate();
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Ingreso exitoso',
                        'redirect' => '/admin'
                    ]);
                }
                return redirect('/admin');
            } else {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['email' => ['Credenciales incorrectas.']]
                    ], 422);
                }
                return back()->withInput()->withErrors(['email' => 'Credenciales incorrectas.']);
            }
        }
        
        // Solo permitir clientes en esta ruta
        if (!$user || $user->role_id != 3) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['email' => ['Credenciales incorrectas o usuario no autorizado.']]
                ], 422);
            }
            return back()->withInput()->withErrors(['email' => 'Credenciales incorrectas o usuario no autorizado.']);
        }
        
        if (Auth::guard('web')->attempt($credentials, false)) {
            $hasPaidPlan = DB::table('orders')
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->exists();
            
            logger()->info('Login OK', [
               'check' => Auth::guard('web')->check(),
               'user' => Auth::guard('web')->user()?->email,
               'session' => session()->getId(),
           ]);
            if (!$hasPaidPlan) {
                Auth::guard('web')->logout();
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['email' => ['Debe tener al menos un plan activo.']]
                    ], 422);
                }
                return back()->withInput()->withErrors(['email' => 'Debe tener al menos un plan activo.']);
            }
            
            $user->increment('login_count');
            $request->session()->regenerate();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => '/home'
                ]);
            }
            return redirect()->intended('/home');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'errors' => ['email' => ['Credenciales incorrectas.']]
            ], 422);
        }
        return back()->withInput()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function logout(Request $request)
    {
        // Detectar desde qué guard cerrar sesión
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Muchas gracias por tu visita, te esperamos pronto.');
    }
}
