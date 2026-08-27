@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-black text-white mb-8">{{ __('Shopping Bag') }}</h1>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Cart Table Items -->
            <div class="lg:col-span-8 space-y-4">
                @foreach($cart as $id => $item)
                    <div class="p-6 rounded-3xl glass-panel bg-slate-900/60 border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-md">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-20 h-20 rounded-2xl object-cover border border-slate-800">
                            <div>
                                <h3 class="text-base font-bold text-white">{{ $item['name'] }}</h3>
                                <p class="text-xs text-slate-400 font-mono mt-0.5">{{ __('SKU') }}: {{ $item['sku'] }}</p>
                                <span class="text-sm font-extrabold text-amber-400 mt-1 block">${{ number_format($item['price'], 2) }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto">
                            <!-- Quantity Controls -->
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center border border-slate-700 rounded-xl overflow-hidden bg-slate-950">
                                @csrf
                                <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-xs font-bold text-white">-</button>
                                <span class="px-4 py-1.5 text-xs font-extrabold text-white">{{ $item['quantity'] }}</span>
                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-xs font-bold text-white">+</button>
                            </form>

                            <span class="text-base font-black text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>

                            <!-- Dedicated Prominent Delete Product Button -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-2 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white text-xs font-bold flex items-center gap-1.5 transition-all shadow-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                    <span>{{ __('Remove') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Card -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Coupon Box -->
                <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-300">{{ __('Promotional Coupon') }}</h4>
                    
                    @if($coupon)
                        <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest">{{ $coupon['code'] }}</span>
                                <span class="text-[10px] text-slate-400 block">({{ $coupon['discount_percentage'] }}% {{ __('Discount Applied') }})</span>
                            </div>
                            <form action="{{ route('cart.coupon.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-rose-400 hover:underline font-bold">{{ __('Remove') }}</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('cart.coupon') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="code" placeholder="{{ __('Enter coupon (e.g. AURA20)') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2 text-xs text-white uppercase placeholder-slate-500 outline-none focus:border-amber-500">
                            <button type="submit" class="px-4 py-2 rounded-xl gold-button text-slate-950 font-extrabold text-xs">
                                {{ __('Apply') }}
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Order Summary Breakdown -->
                <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-300 border-b border-slate-800/80 pb-3">{{ __('Order Summary') }}</h4>

                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-400">{{ __('Subtotal') }}</span>
                        <span class="text-white">${{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                        <div class="flex justify-between text-xs font-bold text-emerald-400">
                            <span>{{ __('Discount') }}</span>
                            <span>-${{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-400">{{ __('Shipping') }}</span>
                        <span class="text-emerald-400 uppercase tracking-wider">{{ __('Complimentary') }}</span>
                    </div>

                    <div class="pt-4 border-t border-slate-800 flex justify-between items-center">
                        <span class="text-sm font-extrabold text-white">{{ __('Total Amount') }}</span>
                        <span class="text-2xl font-black gold-gradient-text">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="w-full block py-4 rounded-2xl gold-button text-slate-950 font-black text-xs uppercase tracking-wider text-center shadow-xl">
                        {{ __('Proceed to Checkout') }}
                    </a>
                </div>

            </div>

        </div>
    @else
        <div class="py-20 text-center glass-panel rounded-3xl border border-slate-800">
            <i class="fa-solid fa-bag-shopping text-6xl text-slate-600 mb-4"></i>
            <h3 class="text-xl font-bold text-white">{{ __('Your cart is currently empty.') }}</h3>
            <p class="text-xs text-slate-400 mt-1 mb-6">{{ __('Explore Collection') }}</p>
            <a href="{{ route('products.index') }}" class="px-8 py-3.5 rounded-2xl gold-button text-slate-950 font-extrabold text-xs">
                {{ __('Explore Collection') }}
            </a>
        </div>
    @endif
</div>

@endsection
