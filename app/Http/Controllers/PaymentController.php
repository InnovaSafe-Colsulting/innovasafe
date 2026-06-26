<?php

namespace App\Http\Controllers;

use App\Interfaces\TypePaymentDetailServiceInterface;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct(
        private TypePaymentDetailServiceInterface $paymentDetailService
    ) {}

    public function index()
    {
        $paymentDetails = $this->paymentDetailService->getActive();
        
        // Obtener las órdenes del usuario con sus items y planes
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.plan', 'paymentType'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Crear una estructura similar a subscriptions para mantener compatibilidad con la vista
        $subscriptions = collect();
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $subscriptions->push((object) [
                    'id' => $item->id,
                    'billing_period' => $item->billing_period,
                    'total_prize' => $item->total_price,
                    'plan' => $item->plan,
                    'order_status' => $order->status,
                    'order_id' => $order->id,
                ]);
            }
        }

        // Obtener el estado de pago de las órdenes del usuario
        $orderStatuses = $orders->keyBy('id');

        return view('payments', compact('paymentDetails', 'subscriptions', 'orderStatuses'));
    }
}
