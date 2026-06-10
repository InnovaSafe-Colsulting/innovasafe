<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = User::where('email', $request->email)->first();
        if (!$user || !in_array($user->role_id, [1, 3])) {
            $errorMessage = $user && !in_array($user->role_id, [1, 3])
                ? 'No puede ingresar a la plataforma, porque no tiene los permisos necesarios, si considera que estamos equivocados por favor comuniquese con la empresa'
                : 'Su usuario no existe o tiene algún dato mal, verifique.';
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                ], $user ? 403 : 401);
            }
            
            return back()->withInput()->withErrors(['email' => $errorMessage]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $result = $this->authService->login($credentials, false);

        if ($result) {
            // Verificar si el usuario tiene al menos un plan pagado (excepto admin)
            if ($user->role_id != 1) {
                $hasPaidPlan = \Illuminate\Support\Facades\DB::table('orders')
                    ->where('user_id', $user->id)
                    ->where('status', 'paid')
                    ->exists();
                
                if (!$hasPaidPlan) {
                    // Desloguear inmediatamente
                    $this->authService->logout();
                    
                    $errorMessage = 'Debe tener al menos un plan activo para acceder al sistema.';
                    
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => $errorMessage,
                        ], 403);
                    }
                    
                    return back()->withInput()->withErrors(['email' => $errorMessage]);
                }
            }
            
            // Incrementar contador de login
            $user->increment('login_count');
            
            $request->session()->regenerate();

            $redirect = $user->role_id == 1 ? '/admin' : '/home';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => $redirect,
                ], 200);
            }

            return redirect($redirect);
        }

        $errorMessage = 'Su usuario no existe o tiene algún dato mal, verifique.';
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $errorMessage,
            ], 401);
        }

        return back()->withInput()->withErrors(['email' => $errorMessage]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Muchas gracias por tu visita, te esperamos pronto.');
    }
}
