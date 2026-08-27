@extends('layouts.app')

@section('content')

<!-- Header Banner -->
<div class="py-12 bg-slate-900/60 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-white">{{ __('Bespoke Product Catalog') }}</h1>
        <p class="text-sm text-slate-400 mt-1">{{ __('Filter and search across our aerospace-grade collection') }}</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Filters Sidebar -->
        <aside class="lg:col-span-3 space-y-6">
            <form action="{{ route('products.index') }}" method="GET" class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-6">
                
                <!-- Search Query -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Search') }}</label>
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Search products...') }}" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:border-amber-500 outline-none">
                        <button type="submit" class="absolute {{ app()->getLocale() == 'ar' ? 'left-3' : 'right-3' }} top-2.5 text-slate-400 hover:text-amber-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Categories') }}</label>
                    <div class="space-y-1">
                        <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}" class="block px-3 py-2 rounded-xl text-xs font-semibold transition-colors {{ !request('category') ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            {{ __('All Categories') }}
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('products.index', array_merge(request()->except('category', 'page'), ['category' => $cat->slug])) }}" class="flex justify-between items-center px-3 py-2 rounded-xl text-xs font-semibold transition-colors {{ request('category') == $cat->slug ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-[10px] opacity-75">({{ $cat->products_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Max Price') }}</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="$ Max" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-500 focus:border-amber-500 outline-none">
                </div>

                <!-- Stock Toggle -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="in_stock" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} class="rounded bg-slate-950 border-slate-700 text-amber-500 focus:ring-amber-500">
                    <label for="in_stock" class="text-xs font-semibold text-slate-300 cursor-pointer">{{ __('In Stock Only') }}</label>
                </div>

                <!-- Filter Actions -->
                <div class="pt-2 flex gap-2">
                    <button type="submit" class="w-full py-2.5 rounded-xl gold-button text-slate-950 font-extrabold text-xs">
                        {{ __('Apply Filters') }}
                    </button>
                    @if(request()->anyFilled(['q', 'category', 'max_price', 'in_stock', 'sort']))
                        <a href="{{ route('products.index') }}" class="p-2.5 rounded-xl border border-slate-700 hover:border-slate-500 text-slate-400 hover:text-white text-xs flex items-center justify-center">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>

            </form>
        </aside>

        <!-- Product Grid -->
        <main class="lg:col-span-9 space-y-6">
            
            <!-- Controls Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 p-4 rounded-2xl glass-panel border border-slate-800">
                <span class="text-xs font-bold text-slate-400">
                    {{ __('Showing') }} {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} {{ __('of') }} {{ $products->total() }} {{ __('results') }}
                </span>

                <!-- Sort Selector -->
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2">
                    @foreach(request()->except('sort', 'page') as $key => $val)
                        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                    @endforeach
                    <label class="text-xs font-bold text-slate-400">{{ __('Sort By') }}:</label>
                    <select name="sort" onchange="this.form.submit()" class="bg-slate-950 border border-slate-700 rounded-xl px-3 py-1.5 text-xs text-slate-200 font-semibold focus:border-amber-500 outline-none">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('Newest Arrivals') }}</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Highest Rated') }}</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>{{ __('Most Popular') }}</option>
                    </select>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="group rounded-3xl glass-panel bg-slate-900/60 border border-slate-800/80 hover:border-amber-500/40 transition-all duration-300 flex flex-col overflow-hidden shadow-xl hover:-translate-y-2">
                        <div class="relative h-60 overflow-hidden bg-slate-950/50">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <div class="absolute top-4 left-4 right-4 flex justify-between items-center pointer-events-none">
                                @if($product->stock <= 0)
                                    <span class="bg-rose-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                        {{ __('OUT OF STOCK') }}
                                    </span>
                                @elseif($product->stock <= 5)
                                    <span class="bg-amber-500 text-slate-950 text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                        {{ __('LOW STOCK') }}
                                    </span>
                                @endif
                            </div>

                            <form action="{{ route('products.wishlist.toggle', $product->id) }}" method="POST" class="absolute bottom-4 {{ app()->getLocale() == 'ar' ? 'left-4' : 'right-4' }}">
                                @csrf
                                <button type="submit" class="w-10 h-10 rounded-full glass-panel bg-slate-900/80 text-slate-300 hover:text-amber-400 flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <span class="text-[10px] text-amber-400 font-extrabold uppercase tracking-wider">{{ $product->category->name ?? '' }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="text-sm font-bold text-white hover:text-amber-400 transition-colors mt-1 line-clamp-1">
                                {{ $product->name }}
                            </a>

                            <div class="flex items-center gap-2 mt-2">
                                <div class="flex text-amber-400 text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <span class="text-xs font-bold text-slate-300 ml-1.5">{{ number_format($product->rating, 2) }}</span>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between">
                                <span class="text-base font-black text-white">${{ number_format($product->price, 2) }}</span>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }} class="w-9 h-9 rounded-xl gold-button flex items-center justify-center font-bold shadow-md hover:scale-105 transition-transform disabled:opacity-50">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 glass-panel rounded-3xl border border-slate-800">
                        <i class="fa-solid fa-box-open text-5xl mb-4 text-slate-600"></i>
                        <h3 class="text-lg font-bold text-white">{{ __('No Products Found') }}</h3>
                        <p class="text-xs text-slate-400 mt-1">{{ __('Try adjusting your filter settings or search query.') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pt-6">
                {{ $products->links() }}
            </div>

        </main>

    </div>
</div>

@endsection
