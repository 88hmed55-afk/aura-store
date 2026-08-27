@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    
    <!-- Order Header -->
    <div class="p-8 rounded-3xl glass-panel border border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 shadow-xl">
        <div>
            <span class="text-xs text-amber-400 font-extrabold uppercase tracking-widest">{{ __('Order Confirmation') }}</span>
            <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">{{ $order->order_number }}</h1>
            <p class="text-xs text-slate-400 mt-1">{{ __('Placed on') }} {{ $order->created_at->format('M d, Y - h:i A') }}</p>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-4 py-2 rounded-xl text-xs font-extrabold uppercase tracking-wider shadow-sm
                {{ $order->status === 'delivered' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40' : '' }}
                {{ $order->status === 'shipped' ? 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/40' : '' }}
                {{ $order->status === 'processing' ? 'bg-amber-500/20 text-amber-400 border border-amber-500/40' : '' }}
                {{ $order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/40' : '' }}
                {{ $order->status === 'cancelled' ? 'bg-rose-500/20 text-rose-400 border border-rose-500/40' : '' }}
            ">
                <i class="fa-solid fa-circle text-[8px] mx-1 animate-pulse"></i>
                {{ __($order->status) }}
            </span>
        </div>
    </div>

    <!-- Visual Tracking Timeline -->
    <div class="p-8 rounded-3xl glass-panel border border-slate-800 shadow-xl">
        <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-300 mb-8">{{ __('Order Status Timeline') }}</h3>
        
        <div class="grid grid-cols-4 gap-4 text-center relative">
            
            <div class="space-y-2">
                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-xs shadow-lg bg-amber-500 text-slate-950">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <span class="block text-xs font-bold text-white">{{ __('Order Placed') }}</span>
            </div>

            <div class="space-y-2">
                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-xs shadow-lg {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-500' }}">
                    <i class="fa-solid fa-box font-bold"></i>
                </div>
                <span class="block text-xs font-bold {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'text-white' : 'text-slate-500' }}">{{ __('Processing') }}</span>
            </div>

            <div class="space-y-2">
                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-xs shadow-lg {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-500' }}">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <span class="block text-xs font-bold {{ in_array($order->status, ['shipped', 'delivered']) ? 'text-white' : 'text-slate-500' }}">{{ __('Shipped') }}</span>
            </div>

            <div class="space-y-2">
                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-xs shadow-lg {{ $order->status === 'delivered' ? 'bg-emerald-500 text-white' : 'bg-slate-800 text-slate-500' }}">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <span class="block text-xs font-bold {{ $order->status === 'delivered' ? 'text-white' : 'text-slate-500' }}">{{ __('Delivered') }}</span>
            </div>

        </div>
    </div>

    <!-- Items & Shipping Summary -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        
        <!-- Items Table -->
        <div class="md:col-span-8 p-8 rounded-3xl glass-panel border border-slate-800 space-y-4 shadow-xl">
            <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-300 border-b border-slate-800 pb-3">{{ __('Purchased Items') }}</h3>
            
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ $item->product->image ?? '' }}" class="w-14 h-14 rounded-xl object-cover border border-slate-800">
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $item->product->name ?? __('Product') }}</h4>
                                <span class="text-xs text-slate-400">{{ __('Qty') }}: {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</span>
                            </div>
                        </div>
                        <span class="text-sm font-extrabold text-white">${{ number_format($item->total, 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="pt-4 border-t border-slate-800 space-y-2 text-xs font-bold">
                <div class="flex justify-between text-slate-400">
                    <span>{{ __('Subtotal') }}</span>
                    <span class="text-white">${{ number_format($order->total_amount, 2) }}</span>
                </div>
                @if($order->discount_amount > 0)
                    <div class="flex justify-between text-emerald-400">
                        <span>{{ __('Discount') }}</span>
                        <span>-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between text-slate-400">
                    <span>{{ __('Shipping') }}</span>
                    <span class="text-emerald-400 uppercase">{{ __('Free') }}</span>
                </div>
                <div class="pt-2 border-t border-slate-800 flex justify-between items-center text-sm font-black">
                    <span class="text-white">{{ __('Final Total') }}</span>
                    <span class="gold-gradient-text text-xl">${{ number_format($order->final_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping & Customer Info -->
        <div class="md:col-span-4 p-8 rounded-3xl glass-panel border border-slate-800 space-y-6 shadow-xl">
            <div>
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-2">{{ __('Customer Info') }}</h4>
                <p class="text-sm font-bold text-white">{{ $order->customer_name }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $order->customer_email }}</p>
                <p class="text-xs text-slate-400">{{ $order->customer_phone }}</p>
            </div>

            <div>
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-2">{{ __('Delivery Address') }}</h4>
                <p class="text-xs text-slate-300 leading-relaxed font-medium">{{ $order->shipping_address }}</p>
            </div>

            <div>
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-2">{{ __('Payment Method') }}</h4>
                <p class="text-xs font-bold text-amber-400 uppercase">{{ $order->payment_method === 'cod' ? __('Cash / Card on Delivery') : __('Credit / Debit Card') }} ({{ $order->payment_status }})</p>
            </div>
        </div>

    </div>

</div>

@endsection
