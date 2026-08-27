@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-black text-white mb-8">{{ __('Saved Wishlist') }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($wishlistItems as $item)
            @if($item->product)
                <div class="group rounded-3xl glass-panel bg-slate-900/60 border border-slate-800/80 hover:border-amber-500/40 transition-all duration-300 flex flex-col overflow-hidden shadow-xl">
                    <div class="relative h-60 overflow-hidden bg-slate-950/50">
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <form action="{{ route('products.wishlist.toggle', $item->product->id) }}" method="POST" class="absolute top-4 {{ app()->getLocale() == 'ar' ? 'left-4' : 'right-4' }}">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-full bg-rose-500 text-white flex items-center justify-center font-bold text-xs shadow-md hover:scale-110 transition-transform" title="{{ __('Remove from Wishlist') }}">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <span class="text-[10px] text-amber-400 font-extrabold uppercase tracking-wider">{{ $item->product->category->name ?? '' }}</span>
                        <a href="{{ route('products.show', $item->product->slug) }}" class="text-sm font-bold text-white hover:text-amber-400 transition-colors mt-1 line-clamp-1">
                            {{ $item->product->name }}
                        </a>

                        <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between">
                            <span class="text-base font-black text-white">${{ number_format($item->product->price, 2) }}</span>

                            <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3.5 py-2 rounded-xl gold-button text-slate-950 font-extrabold text-xs flex items-center gap-2 shadow-sm">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    <span>{{ __('Add to Bag') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-span-full py-16 text-center text-slate-400 glass-panel rounded-3xl border border-slate-800">
                <i class="fa-solid fa-heart text-5xl mb-4 text-slate-600"></i>
                <h3 class="text-lg font-bold text-white">{{ __('Your Wishlist is Empty') }}</h3>
                <p class="text-xs text-slate-400 mt-1 mb-4">{{ __('Save items you love to revisit them later.') }}</p>
                <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-xl gold-button text-slate-950 font-bold text-xs">
                    {{ __('Explore Collection') }}
                </a>
            </div>
        @endforelse
    </div>
</div>

@endsection
