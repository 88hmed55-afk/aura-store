@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-black text-white mb-8">{{ __('My Order History') }}</h1>

    <div class="space-y-6">
        @forelse($orders as $order)
            <div class="p-6 rounded-3xl glass-panel bg-slate-900/60 border border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 shadow-md">
                <div>
                    <span class="text-xs text-amber-400 font-extrabold uppercase tracking-widest">{{ $order->order_number }}</span>
                    <h3 class="text-sm font-bold text-white mt-1">{{ __('Placed on') }} {{ $order->created_at->format('M d, Y') }}</h3>
                    <p class="text-xs text-slate-400 mt-1">{{ $order->items->count() }} {{ __('Items') }} - ${{ number_format($order->final_amount, 2) }}</p>
                </div>

                <div class="flex items-center gap-4">
                    <span class="px-3.5 py-1.5 rounded-xl text-xs font-extrabold uppercase tracking-wider shadow-sm
                        {{ $order->status === 'delivered' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : '' }}
                        {{ $order->status === 'shipped' ? 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' : '' }}
                        {{ $order->status === 'processing' ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : '' }}
                        {{ $order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : '' }}
                        {{ $order->status === 'cancelled' ? 'bg-rose-500/20 text-rose-400 border border-rose-500/30' : '' }}
                    ">
                        {{ __($order->status) }}
                    </span>

                    <a href="{{ route('orders.show', $order->order_number) }}" class="px-4 py-2 rounded-xl gold-button text-slate-950 font-bold text-xs shadow-sm">
                        {{ __('View Tracking') }}
                    </a>
                </div>
            </div>
        @empty
            <div class="py-16 text-center text-slate-500 glass-panel rounded-3xl border border-slate-800">
                <i class="fa-solid fa-box text-5xl mb-4 text-slate-600"></i>
                <h3 class="text-lg font-bold text-white">{{ __('No Orders Found') }}</h3>
                <p class="text-xs text-slate-400 mt-1 mb-4">{{ __('You haven\'t placed any orders yet.') }}</p>
                <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-xl gold-button text-slate-950 font-bold text-xs">
                    {{ __('Explore Collection') }}
                </a>
            </div>
        @endforelse
    </div>
</div>

@endsection
