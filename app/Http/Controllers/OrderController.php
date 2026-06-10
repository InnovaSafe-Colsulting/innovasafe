<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\UserServiceManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::with(['items.plan'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }
    
    /**
     * Marcar una orden como pagada y activar los servicios
     */
    public function markAsPaid($orderId, $paymentType = 'tarjeta')
    {
        try {
            DB::beginTransaction();
            
            $order = Order::find($orderId);
            
            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Orden no encontrada'], 404);
            }
            
            if ($order->status === 'paid') {
                return response()->json(['success' => false, 'message' => 'La orden ya está pagada'], 400);
            }
            
            // Actualizar status de la orden
            $order->status = 'paid';
            $order->save();
            
            // Crear los servicios de usuario
            $success = UserServiceManager::processPayment($orderId, $paymentType);
            
            if ($success) {
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Orden marcada como pagada y servicios activados']);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Error al activar servicios'], 500);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * Cancelar una orden y sus servicios
     */
    public function cancelOrder($orderId)
    {
        try {
            DB::beginTransaction();
            
            $order = Order::find($orderId);
            
            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Orden no encontrada'], 404);
            }
            
            // Actualizar status de la orden
            $order->status = 'canceled';
            $order->save();
            
            // Cancelar los servicios asociados
            UserServiceManager::cancelOrderServices($orderId);
            
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Orden cancelada']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}