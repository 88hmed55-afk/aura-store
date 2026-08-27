<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::with('items.product')->where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = Order::with('items.product')->where('order_number', $orderNumber)->firstOrFail();

        if (Auth::check() && $order->user_id && $order->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}
