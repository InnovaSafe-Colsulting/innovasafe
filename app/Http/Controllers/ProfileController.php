<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Generar avatar por defecto basado en iniciales
        $initials = strtoupper(substr($user->names, 0, 1) . substr($user->last_names, 0, 1));
        $avatarUrl = "https://ui-avatars.com/api/?name={$initials}&background=2268bd&color=fff&size=128";
        
        return view('profile.index', compact('user', 'avatarUrl'));
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => [
                'required',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ]
        ], [
            'new_password.regex' => 'La contraseña debe contener al menos: 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial'
        ]);

        $user = Auth::user();
        $newPassword = $request->new_password;
        
        // Obtener historial de contraseñas ordenado por fecha (más reciente primero)
        $passwordHistory = DB::table('passwords_history_by_user')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Verificar si la contraseña ya fue usada
        foreach ($passwordHistory as $index => $historyRecord) {
            if (Hash::check($newPassword, $historyRecord->password)) {
                // Si está en las últimas 20 contraseñas, no permitir
                if ($index < 20) {
                    return back()->withErrors([
                        'new_password' => 'Este password ya fue usado, todavía no lo puede volver a usar'
                    ]);
                }
                // Si hay 20+ passwords después, permitir reutilización
                break;
            }
        }
        
        // Actualizar contraseña en users
        $newHashedPassword = Hash::make($newPassword);
        $user->update([
            'password' => $newHashedPassword
        ]);
        
        // Guardar en historial
        DB::table('passwords_history_by_user')->insert([
            'user_id' => $user->id,
            'password' => $newHashedPassword,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return back()->with('success', 'Contraseña actualizada correctamente');
    }
}