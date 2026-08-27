@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-black text-white mb-8">{{ __('Express Concierge Checkout') }}</h1>

    <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        @csrf

        <!-- Customer & Shipping Information -->
        <div class="lg:col-span-7 space-y-8">
            
            <!-- Personal Information -->
            <div class="p-8 rounded-3xl glass-panel border border-slate-800 space-y-6">
                <h3 class="text-lg font-bold text-white flex items-center gap-3">
                    <span class="w-7 h-7 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center font-black text-xs">1</span>
                    <span>{{ __('Shipping & Contact Details') }}</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Full Name') }}</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', $user->name ?? '') }}" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Email Address') }}</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email', $user->email ?? '') }}" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Phone Number') }}</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone', $user->phone ?? '') }}" required placeholder="+966 50 000 0000" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Full Shipping Address') }}</label>
                    <textarea name="shipping_address" rows="3" required placeholder="{{ __('Street, District, Building/Villa No., City, Country') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-4 text-xs text-white outline-none focus:border-amber-500">{{ old('shipping_address', $user->address ?? '') }}</textarea>
                </div>
            </div>

            <!-- Payment Method Selection -->
            <div class="p-8 rounded-3xl glass-panel border border-slate-800 space-y-6" x-data="{ paymentMethod: 'cod' }">
                <h3 class="text-lg font-bold text-white flex items-center gap-3">
                    <span class="w-7 h-7 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center font-black text-xs">2</span>
                    <span>{{ __('Payment Option') }}</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label @click="paymentMethod = 'cod'" :class="paymentMethod === 'cod' ? 'border-amber-500 bg-amber-500/10' : 'border-slate-800 bg-slate-950'" class="p-5 rounded-2xl border-2 cursor-pointer flex items-center gap-4 transition-all">
                        <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="hidden">
                        <i class="fa-solid fa-money-bill-wave text-2xl text-amber-400"></i>
                        <div>
                            <span class="block text-xs font-bold text-white">{{ __('Cash / Card on Delivery') }}</span>
                            <span class="text-[10px] text-slate-400">{{ __('Pay upon courier arrival') }}</span>
                        </div>
                    </label>

                    <label @click="paymentMethod = 'card'" :class="paymentMethod === 'card' ? 'border-amber-500 bg-amber-500/10' : 'border-slate-800 bg-slate-950'" class="p-5 rounded-2xl border-2 cursor-pointer flex items-center gap-4 transition-all">
                        <input type="radio" name="payment_method" value="card" x-model="paymentMethod" class="hidden">
                        <i class="fa-solid fa-credit-card text-2xl text-amber-400"></i>
                        <div>
                            <span class="block text-xs font-bold text-white">{{ __('Credit / Debit Card') }}</span>
                            <span class="text-[10px] text-slate-400">{{ __('Instant 256-Bit SSL Payment') }}</span>
                        </div>
                    </label>
                </div>
            </div>

        </div>

        <!-- Order Summary Column -->
        <div class="lg:col-span-5 space-y-6">
            <div class="p-8 rounded-3xl glass-panel border border-slate-800 space-y-6">
                <h3 class="text-base font-bold text-white border-b border-slate-800 pb-4">{{ __('Order Summary') }}</h3>

                <!-- Cart Items List -->
                <div class="space-y-4 max-h-64 overflow-y-auto">
                    @foreach($cart as $item)
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item['image'] }}" class="w-12 h-12 rounded-xl object-cover border border-slate-800">
                                <div>
                                    <h5 class="text-xs font-bold text-white truncate max-w-[180px]">{{ $item['name'] }}</h5>
                                    <span class="text-[10px] text-slate-400">Qty: {{ $item['quantity'] }}</span>
                                </div>
                            </div>
                            <span class="text-xs font-extrabold text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Totals Breakdown -->
                <div class="pt-4 border-t border-slate-800 space-y-3">
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
                        <span class="text-slate-400">{{ __('Express Shipping') }}</span>
                        <span class="text-emerald-400 uppercase tracking-wider">{{ __('Complimentary') }}</span>
                    </div>

                    <div class="pt-4 border-t border-slate-800 flex justify-between items-center">
                        <span class="text-sm font-extrabold text-white">{{ __('Final Amount') }}</span>
                        <span class="text-2xl font-black gold-gradient-text">${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 rounded-2xl gold-button text-slate-950 font-black text-xs uppercase tracking-wider shadow-2xl">
                    {{ __('Confirm & Place Order') }}
                </button>
            </div>
        </div>

    </form>
</div>

@endsection
