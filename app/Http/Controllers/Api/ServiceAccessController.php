<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceAccessController extends Controller
{
    public function activateService(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token || $token !== config('services.api_service_token')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $tenantId = $request->input('tenant_id');
        $email    = $request->input('email');
        $services = $request->input('services');
        $action   = $request->input('action');

        if (!$tenantId || !$email || !$services || !$action) {
            return response()->json(['success' => false, 'message' => 'Faltan campos requeridos: tenant_id, email, services, action'], 422);
        }

        if (!in_array($action, ['activate', 'deactivate'])) {
            return response()->json(['success' => false, 'message' => 'Action debe ser activate o deactivate'], 422);
        }

        $user = User::where('email', $email)->where('tenant_id', $tenantId)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado en la empresa indicada']);
        }

        $tenant = DB::table('tenants')->where('id', $tenantId)->where('status', 1)->first();
        if (!$tenant) {
            return response()->json(['success' => false, 'message' => 'Empresa no encontrada o inactiva']);
        }

        $subscriptionId = DB::table('subscriptions')
            ->where('tenant_id', $tenantId)
            ->where('status', 'active')
            ->value('id');

        if (!$subscriptionId) {
            return response()->json(['success' => false, 'message' => 'No hay suscripción activa para esta empresa']);
        }

        $serviceIds = DB::table('services')
            ->whereIn('slug', (array) $services)
            ->pluck('id');

        if ($serviceIds->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron los servicios indicados']);
        }

        $now    = now();
        $status = $action === 'activate' ? 'active' : 'inactive';

        DB::table('subscription_services')
            ->where('subscription_id', $subscriptionId)
            ->whereIn('service_id', $serviceIds)
            ->update([
                'status'             => $status,
                'activated_at'       => $action === 'activate' ? $now : null,
                'deactivated_at'     => $action === 'deactivate' ? $now : null,
                'deactivation_reason'=> $action === 'deactivate' ? 'Desactivado via API' : null,
                'updated_at'         => $now,
            ]);

        return response()->json([
            'success' => true,
            'message' => $action === 'activate' ? 'Servicios activados correctamente' : 'Servicios desactivados correctamente',
            'tenant'  => $tenant->name,
            'user'    => $user->names . ' ' . $user->last_names,
            'services'=> $serviceIds,
            'action'  => $action,
        ]);
    }
}
