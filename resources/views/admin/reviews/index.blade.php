@extends('layouts.admin')

@section('title', __('Reviews Moderation'))

@section('content')

<div class="rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-xl">
    <table class="w-full text-left rtl:text-right text-xs">
        <thead class="bg-slate-950 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
            <tr>
                <th class="py-3 px-4">{{ __('Item') }}</th>
                <th class="py-3 px-4">{{ __('Customer') }}</th>
                <th class="py-3 px-4">{{ __('Rating') }}</th>
                <th class="py-3 px-4">{{ __('Comment') }}</th>
                <th class="py-3 px-4">{{ __('Status') }}</th>
                <th class="py-3 px-4 text-center">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/60 font-medium">
            @foreach($reviews as $review)
                <tr>
                    <td class="py-3 px-4 font-bold text-white">{{ $review->product->name ?? 'Deleted Product' }}</td>
                    <td class="py-3 px-4 text-slate-300">{{ $review->user->name ?? 'Anonymous' }}</td>
                    <td class="py-3 px-4 text-amber-400 font-bold">★ {{ $review->rating }}/5</td>
                    <td class="py-3 px-4 text-slate-300 max-w-xs truncate">{{ $review->comment }}</td>
                    <td class="py-3 px-4">
                        @if($review->is_approved)
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-emerald-500/20 text-emerald-400">{{ __('Approved') }}</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-yellow-500/20 text-yellow-400">{{ __('Pending') }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center flex items-center justify-center gap-2">
                        <form action="{{ route('admin.reviews.toggle', $review->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-800 text-slate-300 hover:text-white border border-slate-700">
                                {{ __('Toggle Approval') }}
                            </button>
                        </form>
                        <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Delete review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white font-bold text-[10px] flex items-center gap-1 transition-all">
                                <i class="fa-solid fa-trash-can"></i>
                                <span>{{ __('Delete') }}</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
