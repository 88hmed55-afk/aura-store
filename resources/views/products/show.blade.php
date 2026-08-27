@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12" x-data="{ mainImage: '{{ $product->image }}', selectedQty: 1 }">

        <!-- Product Image Gallery -->
        <div class="lg:col-span-6 space-y-4">
            <div class="rounded-3xl glass-panel bg-slate-900 border border-slate-800 p-4 overflow-hidden shadow-2xl relative">
                <img :src="mainImage" alt="{{ $product->name }}" class="w-full h-[450px] object-cover rounded-2xl transition-all duration-300">
                
                @if($product->stock <= 0)
                    <span class="absolute top-8 {{ app()->getLocale() == 'ar' ? 'right-8' : 'left-8' }} bg-rose-600 text-white text-xs font-extrabold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-md">
                        {{ __('Out of Stock') }}
                    </span>
                @else
                    <span class="absolute top-8 {{ app()->getLocale() == 'ar' ? 'right-8' : 'left-8' }} bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 text-xs font-extrabold px-3 py-1.5 rounded-full uppercase tracking-wider flex items-center gap-2 shadow-md">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ __('In Stock') }} ({{ $product->stock }} {{ __('Units Available') }})
                    </span>
                @endif
            </div>

            <!-- Thumbnail Selector -->
            @if(!empty($product->additional_images) && count($product->additional_images) > 0)
                <div class="flex gap-4 overflow-x-auto pb-2">
                    <button @click="mainImage = '{{ $product->image }}'" class="w-20 h-20 rounded-xl overflow-hidden border-2 transition-all" :class="mainImage === '{{ $product->image }}' ? 'border-amber-500 shadow-md' : 'border-slate-800 opacity-60'">
                        <img src="{{ $product->image }}" class="w-full h-full object-cover">
                    </button>
                    @foreach($product->additional_images as $img)
                        <button @click="mainImage = '{{ $img }}'" class="w-20 h-20 rounded-xl overflow-hidden border-2 transition-all" :class="mainImage === '{{ $img }}' ? 'border-amber-500 shadow-md' : 'border-slate-800 opacity-60'">
                            <img src="{{ $img }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Summary Details -->
        <div class="lg:col-span-6 space-y-6">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">{{ $product->category->name ?? '' }}</span>
                <h1 class="text-3xl sm:text-4xl font-black text-white mt-1">{{ $product->name }}</h1>
                <p class="text-xs text-slate-400 mt-1 font-mono">{{ __('SKU') }}: {{ $product->sku }}</p>
            </div>

            <!-- Rating & Reviews Counter -->
            <div class="flex items-center gap-4 py-3 border-y border-slate-800/80">
                <div class="flex text-amber-400 text-sm">
                    @for($i=1; $i<=5; $i++)
                        <i class="fa-solid fa-star {{ $i <= round($product->rating) ? 'text-amber-400' : 'text-slate-700' }}"></i>
                    @endfor
                </div>
                <span class="text-xs font-bold text-slate-300">{{ number_format($product->rating, 2) }} / 5.0</span>
                <span class="text-xs text-slate-400">({{ $product->reviews->count() }} {{ __('Customer Reviews') }})</span>
            </div>

            <!-- Pricing -->
            <div class="flex items-baseline gap-4">
                <span class="text-3xl font-black text-white">${{ number_format($product->price, 2) }}</span>
                @if($product->compare_price)
                    <span class="text-base text-slate-500 line-through">${{ number_format($product->compare_price, 2) }}</span>
                    <span class="bg-rose-500/20 text-rose-400 text-xs font-extrabold px-2.5 py-1 rounded-lg border border-rose-500/30">
                        {{ __('Save') }} {{ $product->discount_percentage }}%
                    </span>
                @endif
            </div>

            <!-- Description -->
            <p class="text-sm text-slate-300 leading-relaxed font-medium">
                {{ $product->description }}
            </p>

            <!-- Quantity & Add to Cart Form -->
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-4">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-300">{{ __('Quantity') }}:</label>
                    <div class="flex items-center border border-slate-700 rounded-xl bg-slate-900 overflow-hidden">
                        <button type="button" @click="selectedQty = Math.max(1, selectedQty - 1)" class="px-3 py-2 text-slate-300 hover:bg-slate-800 font-bold text-sm">-</button>
                        <input type="number" name="quantity" x-model="selectedQty" readonly class="w-12 text-center bg-transparent text-white font-bold text-sm outline-none">
                        <button type="button" @click="selectedQty = Math.min({{ $product->stock }}, selectedQty + 1)" class="px-3 py-2 text-slate-300 hover:bg-slate-800 font-bold text-sm">+</button>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow">
                        @csrf
                        <input type="hidden" name="quantity" :value="selectedQty">
                        <button type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }} class="w-full py-4 rounded-2xl gold-button text-slate-950 font-black text-xs uppercase tracking-wider shadow-xl flex items-center justify-center gap-3 disabled:opacity-50">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span>{{ __('Add To Shopping Bag') }}</span>
                        </button>
                    </form>

                    <form action="{{ route('products.wishlist.toggle', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto px-5 py-4 rounded-2xl glass-panel text-slate-300 hover:text-amber-400 border border-slate-700 hover:border-amber-500 transition-all flex items-center justify-center gap-2 text-xs font-bold" title="{{ __('Add to Wishlist') }}">
                            <i class="fa-solid fa-heart text-base text-rose-400"></i>
                            <span class="sm:hidden">{{ __('Add to Wishlist') }}</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Guarantees Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-slate-800/80">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/50 border border-slate-800">
                    <i class="fa-solid fa-truck-fast text-amber-400 text-lg"></i>
                    <div>
                        <span class="block text-xs font-bold text-white">{{ __('Express Delivery') }}</span>
                        <span class="text-[10px] text-slate-400">{{ __('Shipped within 24 hours') }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/50 border border-slate-800">
                    <i class="fa-solid fa-shield-halved text-amber-400 text-lg"></i>
                    <div>
                        <span class="block text-xs font-bold text-white">{{ __('AURA Guarantee') }}</span>
                        <span class="text-[10px] text-slate-400">{{ __('5-Year International Warranty') }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Reviews Section -->
    <div class="mt-20 pt-12 border-t border-slate-800">
        <h3 class="text-2xl font-black text-white mb-8">{{ __('Customer Reviews') }} ({{ $product->reviews->count() }})</h3>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Review Form -->
            <div class="lg:col-span-5 p-6 rounded-3xl glass-panel border border-slate-800 space-y-4">
                <h4 class="text-base font-bold text-white">{{ __('Write a Review') }}</h4>
                <form action="{{ route('products.review.store', $product->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">{{ __('Rating') }}</label>
                        <select name="rating" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white outline-none focus:border-amber-500">
                            <option value="5">★★★★★ (5/5) {{ __('Outstanding') }}</option>
                            <option value="4">★★★★☆ (4/5) {{ __('Very Good') }}</option>
                            <option value="3">★★★☆☆ (3/5) {{ __('Average') }}</option>
                            <option value="2">★★☆☆☆ (2/5) {{ __('Below Expectations') }}</option>
                            <option value="1">★☆☆☆☆ (1/5) {{ __('Poor') }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">{{ __('Your Feedback') }}</label>
                        <textarea name="comment" rows="4" required placeholder="{{ __('Share details of your experience...') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-xs text-white outline-none focus:border-amber-500"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl gold-button text-slate-950 font-extrabold text-xs uppercase tracking-wider">
                        {{ __('Submit Review') }}
                    </button>
                </form>
            </div>

            <!-- Review Cards List -->
            <div class="lg:col-span-7 space-y-4">
                @forelse($product->reviews as $review)
                    <div class="p-6 rounded-2xl glass-panel bg-slate-900/40 border border-slate-800 space-y-2">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-amber-500/20 text-amber-400 font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                                </div>
                                <span class="text-sm font-bold text-white">{{ $review->user->name ?? __('Verified Buyer') }}</span>
                            </div>
                            <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <div class="flex text-amber-400 text-xs">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-700' }}"></i>
                            @endfor
                        </div>

                        <p class="text-xs text-slate-300 font-medium pt-2">{{ $review->comment }}</p>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-400 text-xs font-semibold">
                        {{ __('No reviews yet. Be the first to leave a review!') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
