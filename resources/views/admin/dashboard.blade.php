@extends('layouts.admin')

@section('title', __('Executive Overview'))

@section('content')

<div class="space-y-8">
    
    <!-- KPI Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex justify-between items-center text-slate-400 text-xs font-bold uppercase tracking-wider">
                <span>{{ __('Total Gross Revenue') }}</span>
                <i class="fa-solid fa-sack-dollar text-amber-400 text-lg"></i>
            </div>
            <span class="text-3xl font-black text-white block">${{ number_format($totalSales, 2) }}</span>
            <span class="text-[10px] text-emerald-400 font-semibold">+18.5% {{ __('vs last month') }}</span>
        </div>

        <div class="p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex justify-between items-center text-slate-400 text-xs font-bold uppercase tracking-wider">
                <span>{{ __('Total Orders') }}</span>
                <i class="fa-solid fa-receipt text-indigo-400 text-lg"></i>
            </div>
            <span class="text-3xl font-black text-white block">{{ $totalOrders }}</span>
            <span class="text-[10px] text-indigo-400 font-semibold">{{ __('All-time completed orders') }}</span>
        </div>

        <div class="p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex justify-between items-center text-slate-400 text-xs font-bold uppercase tracking-wider">
                <span>{{ __('Active Customers') }}</span>
                <i class="fa-solid fa-users text-cyan-400 text-lg"></i>
            </div>
            <span class="text-3xl font-black text-white block">{{ $totalCustomers }}</span>
            <span class="text-[10px] text-cyan-400 font-semibold">{{ __('Registered clientele') }}</span>
        </div>

        <div class="p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-2">
            <div class="flex justify-between items-center text-slate-400 text-xs font-bold uppercase tracking-wider">
                <span>{{ __('Low Stock Items') }}</span>
                <i class="fa-solid fa-triangle-exclamation text-rose-400 text-lg"></i>
            </div>
            <span class="text-3xl font-black text-white block">{{ $lowStockProducts->count() }}</span>
            <span class="text-[10px] text-rose-400 font-semibold">{{ __('Requires immediate restock') }}</span>
        </div>

    </div>

    <!-- Order Status Distribution & Recent Orders -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Status Breakdown -->
        <div class="lg:col-span-4 p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-4">
            <h3 class="text-sm font-bold text-white border-b border-slate-800 pb-3">{{ __('Order Fulfillment Breakdown') }}</h3>
            <div class="space-y-3 text-xs font-semibold">
                <div class="flex justify-between items-center p-3 rounded-xl bg-slate-950">
                    <span class="text-yellow-400"><i class="fa-solid fa-clock mr-2"></i> {{ __('Pending') }}</span>
                    <span class="font-bold text-white">{{ $orderStatusCounts['pending'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3 rounded-xl bg-slate-950">
                    <span class="text-amber-400"><i class="fa-solid fa-box mr-2"></i> {{ __('Processing') }}</span>
                    <span class="font-bold text-white">{{ $orderStatusCounts['processing'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3 rounded-xl bg-slate-950">
                    <span class="text-indigo-400"><i class="fa-solid fa-truck-fast mr-2"></i> {{ __('Shipped') }}</span>
                    <span class="font-bold text-white">{{ $orderStatusCounts['shipped'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3 rounded-xl bg-slate-950">
                    <span class="text-emerald-400"><i class="fa-solid fa-circle-check mr-2"></i> {{ __('Delivered') }}</span>
                    <span class="font-bold text-white">{{ $orderStatusCounts['delivered'] }}</span>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="lg:col-span-8 p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-4">
            <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                <h3 class="text-sm font-bold text-white">{{ __('Recent Orders') }}</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-amber-400 font-bold hover:underline">{{ __('View All Orders') }}</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left rtl:text-right text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-800 text-[11px] uppercase tracking-wider">
                            <th class="py-2.5 px-3">Order #</th>
                            <th class="py-2.5 px-3">Customer</th>
                            <th class="py-2.5 px-3">Amount</th>
                            <th class="py-2.5 px-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 font-medium">
                        @foreach($recentOrders as $order)
                            <tr>
                                <td class="py-3 px-3 font-bold text-amber-400">{{ $order->order_number }}</td>
                                <td class="py-3 px-3 text-slate-200">{{ $order->customer_name }}</td>
                                <td class="py-3 px-3 text-white font-bold">${{ number_format($order->final_amount, 2) }}</td>
                                <td class="py-3 px-3">
                                    <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider
                                        {{ $order->status === 'delivered' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                                        {{ $order->status === 'shipped' ? 'bg-indigo-500/20 text-indigo-400' : '' }}
                                        {{ $order->status === 'processing' ? 'bg-amber-500/20 text-amber-400' : '' }}
                                        {{ $order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                    ">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

@endsection
