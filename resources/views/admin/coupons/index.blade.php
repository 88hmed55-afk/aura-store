@extends('layouts.admin')

@section('title', __('Coupons & Promotions'))

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Coupon Creation Form -->
    <div class="lg:col-span-4 p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-4 shadow-xl">
        <h3 class="text-sm font-bold text-white border-b border-slate-800 pb-3">{{ __('Create New Coupon') }}</h3>
        
        <form action="{{ route('admin.coupons.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            
            <div>
                <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('Code') }}</label>
                <input type="text" name="code" required placeholder="e.g. VIP25" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white font-mono uppercase">
            </div>

            <div>
                <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('Discount') }} (%)</label>
                <input type="number" step="1" min="1" max="100" name="discount_percentage" required placeholder="20" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
            </div>

            <div>
                <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('Min Spend') }} ($)</label>
                <input type="number" step="0.01" name="min_order_amount" value="0" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-amber-500 text-slate-950 font-black uppercase tracking-wider">
                {{ __('Create Coupon') }}
            </button>
        </form>
    </div>

    <!-- Coupons List Table -->
    <div class="lg:col-span-8 rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-xl">
        <table class="w-full text-left rtl:text-right text-xs">
            <thead class="bg-slate-950 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
                <tr>
                    <th class="py-3 px-4">{{ __('Code') }}</th>
                    <th class="py-3 px-4">{{ __('Discount') }}</th>
                    <th class="py-3 px-4">{{ __('Min Spend') }}</th>
                    <th class="py-3 px-4">{{ __('Status') }}</th>
                    <th class="py-3 px-4 text-center">{{ __('Toggle') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 font-medium">
                @foreach($coupons as $coupon)
                    <tr>
                        <td class="py-3 px-4 font-mono font-bold text-amber-400">{{ $coupon->code }}</td>
                        <td class="py-3 px-4 font-bold text-white">{{ $coupon->discount_percentage }}% OFF</td>
                        <td class="py-3 px-4 text-slate-300">${{ number_format($coupon->min_order_amount, 2) }}</td>
                        <td class="py-3 px-4">
                            @if($coupon->is_active)
                                <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-emerald-500/20 text-emerald-400">Active</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-rose-500/20 text-rose-400">Disabled</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.coupons.toggle', $coupon->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded-lg text-[10px] font-bold bg-slate-800 text-slate-300 hover:text-white border border-slate-700">
                                    {{ __('Toggle') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
