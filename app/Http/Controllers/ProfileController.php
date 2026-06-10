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
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                'min:8',
                'max:12',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ]
        ], [
            'new_password.regex' => 'La contraseña debe contener al menos: 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial'
        ]);

        $user = Auth::user();
        
        // Verificar contraseña actual
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
        }
        
        // Verificar que no sea una contraseña repetida
        $passwordHistory = DB::table('passwords_history_by_user')
            ->where('user_id', $user->id)
            ->pluck('password');
            
        foreach ($passwordHistory as $oldPassword) {
            if (Hash::check($request->new_password, $oldPassword)) {
                return back()->withErrors(['new_password' => 'No puede reutilizar una contraseña anterior']);
            }
        }
        
        // Actualizar contraseña
        $newHashedPassword = Hash::make($request->new_password);
        $user->update([
            'password' => $newHashedPassword,
            'password_changed' => true
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