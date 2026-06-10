<?php

namespace App\Services;

use App\Models\UserService;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserServiceManager
{
    /**
     * Procesar una orden pagada y crear los servicios de usuario correspondientes
     */
    public static function processPayment($orderId, $paymentType = 'tarjeta')
    {
        try {
            $order = Order::with('orderItems.plan')->find($orderId);
            
            if (!$order) {
                Log::error("Orden no encontrada: {$orderId}");
                return false;
            }

            // La fecha de pago siempre es el último día del mes actual
            $paymentDate = Carbon::now()->endOfMonth();
            
            // Procesar cada item de la orden
            foreach ($order->orderItems as $item) {
                $expirationDate = UserService::calculateExpirationDate($paymentDate, $item->billing_period);
                
                UserService::create([
                    'user_id' => $order->user_id,
                    'plan_id' => $item->plan_id,
                    'order_id' => $order->id,
                    'payment_date' => $paymentDate,
                    'payment_type' => $paymentType,
                    'billing_period' => $item->billing_period,
                    'expires_at' => $expirationDate,
                    'status' => 'active'
                ]);
                
                Log::info("Servicio creado para usuario {$order->user_id}, plan {$item->plan_id}");
            }
            
            return true;
            
        } catch (\Exception $e) {
            Log::error("Error al procesar pago de orden {$orderId}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Cancelar servicios de una orden
     */
    public static function cancelOrderServices($orderId)
    {
        try {
            UserService::where('order_id', $orderId)->update(['status' => 'canceled']);
            Log::info("Servicios cancelados para orden {$orderId}");
            return true;
        } catch (\Exception $e) {
            Log::error("Error al cancelar servicios de orden {$orderId}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Marcar servicios expirados automáticamente
     */
    public static function markExpiredServices()
    {
        try {
            $expiredCount = UserService::where('status', 'active')
                ->where('expires_at', '<', Carbon::now())
                ->update(['status' => 'expired']);
                
            Log::info("Marcados como expirados {$expiredCount} servicios");
            return $expiredCount;
        } catch (\Exception $e) {
            Log::error("Error al marcar servicios expirados: " . $e->getMessage());
            return false;
        }
    }
}