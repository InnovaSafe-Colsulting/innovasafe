<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $user = DB::table('users')->where('email', $email)->first();
        if (!$user || $user->active != 1) {
            return response()->json(['access' => false]);
        }

        $contact = DB::table('contacts')->where('email', $email)->first();
        if (!$contact) {
            return response()->json(['access' => false]);
        }

        $hasActive = DB::table('user_services')
            ->where('contact_id', $contact->id)
            ->where('status', 'active')
            ->exists();

        return response()->json(['access' => $hasActive]);
    }
}
