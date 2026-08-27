<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', __('Your cart is empty.'));
        }

        $coupon = session()->get('coupon', null);
        $subtotal = array_reduce($cart, fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);
        $discount = $coupon ? ($subtotal * $coupon['discount_percentage']) / 100 : 0;
        $total = max(0, $subtotal - $discount);

        $user = Auth::user();

        return view('checkout', compact('cart', 'subtotal', 'discount', 'total', 'coupon', 'user'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', __('Your cart is empty.'));
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,card',
        ]);

        $coupon = session()->get('coupon', null);
        $subtotal = array_reduce($cart, fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);
        $discount = $coupon ? ($subtotal * $coupon['discount_percentage']) / 100 : 0;
        $total = max(0, $subtotal - $discount);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'order_number' => 'AURA-' . strtoupper(Str::random(8)),
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'total_amount' => $subtotal,
                'discount_amount' => $discount,
                'final_amount' => $total,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'card' ? 'paid' : 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Update product stock and sales count
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                    $product->increment('sales_count', $item['quantity']);
                }
            }

            DB::commit();

            session()->forget('cart');
            session()->forget('coupon');

            return redirect()->route('orders.show', $order->order_number)->with('success', __('Order placed successfully! Thank you for choosing AURA.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('An error occurred while processing your order: ') . $e->getMessage());
        }
    }
}
