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
        $subscriptions = Subscription::where('user_id', Auth::id())
            ->with('plan')
            ->get();

        // Obtener el estado de pago de las órdenes del usuario
        $orderStatuses = Order::where('user_id', Auth::id())
            ->select('id', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->keyBy('id');

        return view('payments', compact('paymentDetails', 'subscriptions', 'orderStatuses'));
    }
}
