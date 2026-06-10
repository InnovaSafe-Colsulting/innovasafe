<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function index()
    {
        // Obtener tipos de pago disponibles (excluir Efecty)
        $paymentTypes = DB::table('type_payment')->where('status', 1)->where('name', '!=', 'Efecty')->get();

        // Obtener detalles de pago para cada tipo
        $paymentDetails = DB::table('type_payment_details')->get()->keyBy('id_payment_detail');

        // Obtener items del carrito
        $cart = Cart::getActiveCart(Auth::id());
        $cartItemsFromDB = $cart->items()->with('plan')->get();

        $cartItems = $cartItemsFromDB->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->plan->name . ' - ' . $item->billing_period,
                'description' => $item->plan->description ?? '',
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total' => $item->total_price,
                'image' => 'plan-default.png',
            ];
        })->toArray();

        $subtotal = collect($cartItems)->sum('total');
        $iva = $subtotal * 0.19;
        $grandTotal = $subtotal + $iva;

        return view('checkout.index', compact('cartItems', 'grandTotal', 'paymentTypes', 'paymentDetails'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_type_id' => 'required|exists:type_payment,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $paymentType = DB::table('type_payment')->find($request->payment_type_id);

        if (in_array($paymentType->name, ['Nequi', 'Daviplata'])) {
            $request->validate([
                'payment_image' => 'required|mimes:jpeg,jpg,png,webp,pdf|max:5120',
            ]);
        }

        try {
            DB::beginTransaction();

            $cart = Cart::getActiveCart(Auth::id());
            $cartItems = $cart->items()->get();

            if ($cartItems->isEmpty()) {
                return back()->withErrors(['error' => 'El carrito está vacío.']);
            }

            $subtotal = $cartItems->sum('total_price');
            $iva = $subtotal * 0.19;
            $total = $subtotal + $iva;

            // Subir comprobante
            $imagePath = null;
            if ($request->hasFile('payment_image')) {
                $image = $request->file('payment_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('payments'), $imageName);
                $imagePath = 'payments/' . $imageName;
            }

            // Crear orden
            $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

            $order = Order::create([
                'user_id' => Auth::id(),
                'cart_id' => $cart->id,
                'order_number' => $orderNumber,
                'payment_type_id' => $request->payment_type_id,
                'payment_proof' => $imagePath,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Copiar items del carrito a order_items y crear subscriptions
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'plan_id' => $item->plan_id,
                    'billing_period' => $item->billing_period,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price,
                ]);

                Subscription::create([
                    'user_id' => Auth::id(),
                    'plan_id' => $item->plan_id,
                    'order_id' => $order->id,
                    'quantity' => $item->quantity,
                    'total_prize' => $item->total_price,
                    'status_suscription' => 'Active',
                ]);
            }

            // Marcar carrito como completado y limpiar items
            $cart->update(['status' => 'completed']);
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('checkout.success')->with([
                'success' => 'Pago registrado exitosamente. Su orden #' . $orderNumber . ' está siendo procesada.',
                'order_id' => $orderNumber,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Hubo un error al procesar el pago: ' . $e->getMessage()]);
        }
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function downloadPaymentPdf($paymentTypeId)
    {
        $paymentType = DB::table('type_payment')->find($paymentTypeId);

        if (!$paymentType || $paymentType->name !== 'Consignación Bancaria') {
            abort(404);
        }

        $detail = DB::table('type_payment_details')
            ->where('id_payment_detail', $paymentTypeId)
            ->first();

        $pdf = Pdf::loadView('pdf.payment-info', compact('paymentType', 'detail'));

        return $pdf->download('datos-pago-consignacion-bancaria.pdf');
    }
}
