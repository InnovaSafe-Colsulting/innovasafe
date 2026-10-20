<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Models\UserService;
use Illuminate\Http\Request;
class ServiceAccessController extends Controller
{
    public function check(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token || $token !== config('services.api_service_token')) {
            return response()->json(['access' => false, 'message' => 'Unauthorized'], 401);
        }

        $email = $request->input('email');
        if (!$email) {
            return response()->json(['access' => false, 'message' => 'Email requerido'], 422);
        }

        $user = User::where('email', $email)->first();
        if (!$user || $user->active != 1) {
            return response()->json(['access' => false, 'message' => 'El usuario esta inactivo']);
        }

        $contact = Contact::where('email', $email)->first();
        if (!$contact) {
            return response()->json(['access' => false, 'message' => 'El usuario no es un contacto activo de la empresa']);
        }

        $hasActive = UserService::where('contact_id', $contact->id)->where('status', 'active')->exists();
        return response()->json(['access' => $hasActive]);
    }
}
