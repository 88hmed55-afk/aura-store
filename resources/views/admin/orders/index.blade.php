@extends('layouts.admin')

@section('title', __('Orders Management'))

@section('content')

<div class="rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-xl">
    <table class="w-full text-left rtl:text-right text-xs">
        <thead class="bg-slate-950 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
            <tr>
                <th class="py-3 px-4">{{ __('Order #') }}</th>
                <th class="py-3 px-4">{{ __('Customer') }}</th>
                <th class="py-3 px-4">{{ __('Phone Number') }}</th>
                <th class="py-3 px-4">{{ __('Amount') }}</th>
                <th class="py-3 px-4">{{ __('Payment Method') }}</th>
                <th class="py-3 px-4">{{ __('Fulfillment Status') }}</th>
                <th class="py-3 px-4 text-center">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/60 font-medium">
            @foreach($orders as $order)
                <tr>
                    <td class="py-3 px-4 font-bold text-amber-400">{{ $order->order_number }}</td>
                    <td class="py-3 px-4">
                        <span class="block font-bold text-white">{{ $order->customer_name }}</span>
                        <span class="text-[10px] text-slate-400">{{ $order->customer_email }}</span>
                    </td>
                    <td class="py-3 px-4 text-slate-300 font-mono">{{ $order->customer_phone }}</td>
                    <td class="py-3 px-4 font-black text-white">${{ number_format($order->final_amount, 2) }}</td>
                    <td class="py-3 px-4 uppercase text-[10px] font-bold text-slate-400">{{ $order->payment_method === 'cod' ? __('Cash / Card on Delivery') : __('Credit / Debit Card') }} ({{ $order->payment_status }})</td>
                    <td class="py-3 px-4">
                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="bg-slate-950 border border-slate-700 rounded-lg px-2 py-1 text-[11px] font-bold text-slate-200">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>{{ __('pending') }}</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>{{ __('processing') }}</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>{{ __('shipped') }}</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>{{ __('delivered') }}</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>{{ __('cancelled') }}</option>
                            </select>
                        </form>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <a href="{{ route('orders.show', $order->order_number) }}" class="px-2.5 py-1.5 rounded-lg bg-amber-500/10 border border-amber-500/30 text-amber-400 font-bold text-xs hover:bg-amber-500 hover:text-slate-950 transition-all flex items-center justify-center gap-1">
                            <i class="fa-solid fa-eye"></i>
                            <span>{{ __('View Tracking') }}</span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4 border-t border-slate-800">
        {{ $orders->links() }}
    </div>
</div>

@endsection
