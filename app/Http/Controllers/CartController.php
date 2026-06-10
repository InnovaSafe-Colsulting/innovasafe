<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::getActiveCart(Auth::id());
        $cartItems = $cart->items()->with('plan')->get();

        $subtotalProducts = $cartItems->sum('total_price');
        $iva = $subtotalProducts * 0.19;
        $totalToPay = $subtotalProducts + $iva;

        return view('cart.index', compact('cartItems', 'subtotalProducts', 'iva', 'totalToPay'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
            'billing_period' => 'required|in:Mensual,Anual',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $cart = Cart::getActiveCart(Auth::id());

            $existingItem = CartItem::where('cart_id', $cart->id)
                ->where('plan_id', $request->plan_id)
                ->where('billing_period', $request->billing_period)
                ->first();

            if ($existingItem) {
                $existingItem->quantity += 1;
                $existingItem->calculateTotal();
                $existingItem->save();
            } else {
                $item = new CartItem([
                    'cart_id' => $cart->id,
                    'plan_id' => $request->plan_id,
                    'billing_period' => $request->billing_period,
                    'unit_price' => $request->price,
                    'quantity' => 1,
                ]);
                $item->calculateTotal();
                $item->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Producto agregado al carrito exitosamente',
                'cart_count' => $cart->items()->sum('quantity'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al agregar el producto al carrito',
            ], 500);
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $cart = Cart::getActiveCart(Auth::id());
            $cartItem = CartItem::where('id', $id)->where('cart_id', $cart->id)->firstOrFail();

            $cartItem->quantity = $request->quantity;
            $cartItem->calculateTotal();
            $cartItem->save();

            $subtotal = $cart->items()->sum('total_price');
            $iva = $subtotal * 0.19;
            $totalToPay = $subtotal + $iva;

            return response()->json([
                'success' => true,
                'message' => 'Cantidad actualizada',
                'new_total' => $cartItem->total_price,
                'grand_total' => $totalToPay,
                'cart_count' => $cart->items()->sum('quantity'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la cantidad',
            ], 500);
        }
    }

    public function removeItem($id)
    {
        try {
            $cart = Cart::getActiveCart(Auth::id());
            $cartItem = CartItem::where('id', $id)->where('cart_id', $cart->id)->firstOrFail();
            $cartItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado del carrito',
                'cart_count' => $cart->items()->sum('quantity'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el producto',
            ], 500);
        }
    }

    public function clear()
    {
        try {
            $cart = Cart::getActiveCart(Auth::id());
            $cart->items()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Carrito vaciado exitosamente',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al vaciar el carrito',
            ], 500);
        }
    }

    public function getCartData()
    {
        $cart = Cart::getActiveCart(Auth::id());
        $cartItems = $cart->items()->with('plan')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => true,
                'items' => [],
                'subtotal' => 0,
                'iva' => 0,
                'total' => 0,
                'count' => 0,
            ]);
        }

        $subtotal = $cartItems->sum('total_price');
        $iva = $subtotal * 0.19;
        $total = $subtotal + $iva;

        $formattedItems = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->plan->name . ' - ' . $item->billing_period,
                'billing_period' => $item->billing_period,
                'price' => $item->unit_price,
                'quantity' => $item->quantity,
                'total' => $item->total_price,
            ];
        });

        return response()->json([
            'success' => true,
            'items' => $formattedItems,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'count' => $cartItems->sum('quantity'),
        ]);
    }
}
