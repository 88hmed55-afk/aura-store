<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $coupon = session()->get('coupon', null);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $discount = 0;
        if ($coupon) {
            $discount = ($subtotal * $coupon['discount_percentage']) / 100;
        }

        $total = max(0, $subtotal - $discount);

        return view('cart', compact('cart', 'subtotal', 'discount', 'total', 'coupon'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            if ($request->wantsJson()) {
                return response()->json(['status' => 'error', 'message' => __('Insufficient stock available.')], 400);
            }
            return back()->with('error', __('Insufficient stock available.'));
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'image' => $product->image,
                'sku' => $product->sku,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));
        $subtotal = array_reduce($cart, fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => __('Item added to cart!'),
                'cartCount' => $cartCount,
                'subtotal' => number_format($subtotal, 2),
                'cart' => $cart
            ]);
        }

        return back()->with('success', __('Item added to cart!'));
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = (int) $request->quantity;
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return back()->with('success', __('Cart updated.'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', __('Item removed from cart.'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $code = strtoupper(trim($request->code));
        $coupon = Coupon::where('code', $code)->first();

        $cart = session()->get('cart', []);
        $subtotal = array_reduce($cart, fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

        if (!$coupon || !$coupon->isValidForAmount($subtotal)) {
            return back()->with('error', __('Invalid or expired coupon code, or minimum purchase amount not met.'));
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount_percentage' => $coupon->discount_percentage,
        ]);

        return back()->with('success', __('Coupon applied successfully!'));
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return back()->with('success', __('Coupon removed.'));
    }
}
