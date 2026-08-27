@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-32">
    <!-- Glow Background Accents -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-amber-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute top-1/3 right-10 w-[400px] h-[400px] bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left rtl:lg:text-right">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-panel border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    {{ __('Bespoke Luxury Digital Commerce') }}
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight tracking-tight">
                    {{ __('Elevate Your Everyday With') }}
                    <span class="block gold-gradient-text">{{ __('Uncompromised Precision') }}</span>
                </h1>

                <p class="text-slate-300 text-base sm:text-lg max-w-2xl font-medium leading-relaxed">
                    {{ __('Discover curated aerospace-grade horology, acoustic masterpieces, and intelligent executive accessories crafted for those who demand distinction.') }}
                </p>

                <div class="flex flex-wrap justify-center lg:justify-start rtl:lg:justify-start gap-4">
                    <a href="{{ route('products.index') }}" class="px-8 py-4 rounded-2xl gold-button font-extrabold text-sm shadow-xl flex items-center gap-3">
                        <span>{{ __('Explore Collection') }}</span>
                        <i class="fa-solid fa-arrow-right rtl:rotate-180"></i>
                    </a>

                    <a href="{{ route('about') }}" class="px-8 py-4 rounded-2xl glass-panel text-slate-200 hover:text-white hover:bg-slate-800/60 text-sm font-bold border border-slate-700/80 transition-all flex items-center gap-3">
                        <i class="fa-solid fa-play text-amber-400"></i>
                        <span>{{ __('Our Heritage') }}</span>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-8 border-t border-slate-800/80 grid grid-cols-3 gap-6 text-center lg:text-left rtl:lg:text-right">
                    <div>
                        <span class="block text-2xl font-black text-white">100%</span>
                        <span class="text-xs text-slate-400 font-semibold">{{ __('Authentic Guaranteed') }}</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-white">24H</span>
                        <span class="text-xs text-slate-400 font-semibold">{{ __('Concierge Shipping') }}</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-white">5-Year</span>
                        <span class="text-xs text-slate-400 font-semibold">{{ __('Global Warranty') }}</span>
                    </div>
                </div>
            </div>

            <!-- Hero Image Visual Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-yellow-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative rounded-3xl glass-panel p-4 overflow-hidden border border-amber-500/20 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000&auto=format&fit=crop" alt="Hero Featured Product" class="w-full h-[420px] object-cover rounded-2xl transform hover:scale-105 transition-transform duration-700">
                        
                        <!-- Floating Glass Card Overlay -->
                        <div class="absolute bottom-8 left-8 right-8 p-4 rounded-2xl glass-panel bg-slate-950/80 border border-slate-700/80 flex items-center justify-between shadow-2xl">
                            <div>
                                <span class="text-[10px] text-amber-400 font-extrabold uppercase tracking-widest">{{ __('Featured Masterpiece') }}</span>
                                <h3 class="text-sm font-bold text-white">{{ $featuredProducts->first()->name ?? 'Chronos Titan X' }}</h3>
                            </div>
                            <span class="text-lg font-black text-amber-400">${{ number_format($featuredProducts->first()->price ?? 2499, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Featured Categories Section -->
<section class="py-16 bg-slate-900/40 border-y border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">{{ __('Curated Categories') }}</span>
                <h2 class="text-3xl font-black text-white mt-1">{{ __('Explore By Discipline') }}</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-xs font-bold text-slate-300 hover:text-amber-400 flex items-center gap-2 transition-colors">
                <span>{{ __('View All Categories') }}</span>
                <i class="fa-solid fa-arrow-right rtl:rotate-180"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative rounded-3xl overflow-hidden glass-panel border border-slate-800 hover:border-amber-500/50 transition-all duration-500 shadow-lg">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors">{{ $category->name }}</h3>
                        <p class="text-xs text-slate-400 font-medium mt-1">{{ $category->products_count ?? '' }} {{ __('Items') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Showcase -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">{{ __('Flagship Products') }}</span>
            <h2 class="text-3xl sm:text-4xl font-black text-white mt-2">{{ __('Selected For Perfection') }}</h2>
            <p class="text-slate-400 text-sm mt-3">{{ __('Handcrafted precision components designed for peak durability and unmatched aesthetic elegance.') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
                <div class="group rounded-3xl glass-panel bg-slate-900/60 border border-slate-800/80 hover:border-amber-500/40 transition-all duration-300 flex flex-col overflow-hidden shadow-xl hover:-translate-y-2">
                    
                    <!-- Product Image Container -->
                    <div class="relative h-64 overflow-hidden bg-slate-950/50">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-center pointer-events-none">
                            @if($product->is_new)
                                <span class="bg-amber-500 text-slate-950 text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md">
                                    {{ __('NEW') }}
                                </span>
                            @endif
                            
                            @if($product->discount_percentage > 0)
                                <span class="bg-rose-500 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md">
                                    -{{ $product->discount_percentage }}%
                                </span>
                            @endif
                        </div>

                        <!-- Quick Wishlist Button -->
                        <form action="{{ route('products.wishlist.toggle', $product->id) }}" method="POST" class="absolute bottom-4 {{ app()->getLocale() == 'ar' ? 'left-4' : 'right-4' }}">
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-full glass-panel bg-slate-900/80 text-slate-300 hover:text-amber-400 flex items-center justify-center transition-colors">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Details -->
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-[11px] text-amber-400 font-bold uppercase tracking-wider">{{ $product->category->name ?? '' }}</span>
                        <a href="{{ route('products.show', $product->slug) }}" class="text-base font-bold text-white hover:text-amber-400 transition-colors mt-1 line-clamp-1">
                            {{ $product->name }}
                        </a>

                        <!-- Rating Stars -->
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex text-amber-400 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <span class="text-xs font-bold text-slate-300 ml-1.5">{{ number_format($product->rating, 2) }}</span>
                            </div>
                        </div>

                        <!-- Price & Add To Cart -->
                        <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between">
                            <div>
                                <span class="text-lg font-black text-white">${{ number_format($product->price, 2) }}</span>
                                @if($product->compare_price)
                                    <span class="text-xs text-slate-500 line-through block">${{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </div>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-10 h-10 rounded-xl gold-button flex items-center justify-center font-bold shadow-md hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- AI Smart Recommendations Banner -->
<section class="py-16 bg-gradient-to-r from-amber-950/30 via-slate-900 to-slate-950 border-y border-amber-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-8">
            <i class="fa-solid fa-wand-magic-sparkles text-2xl text-amber-400 animate-bounce"></i>
            <div>
                <h3 class="text-xl font-extrabold text-white">{{ __('Intelligent Recommendations') }}</h3>
                <p class="text-xs text-slate-400">{{ __('Curated based on top customer reviews and engineering ratings') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($aiRecommendations as $rec)
                <a href="{{ route('products.show', $rec->slug) }}" class="p-4 rounded-2xl glass-panel border border-slate-800 hover:border-amber-500/40 flex items-center gap-4 group transition-all">
                    <img src="{{ $rec->image }}" alt="{{ $rec->name }}" class="w-16 h-16 rounded-xl object-cover">
                    <div class="overflow-hidden">
                        <h4 class="text-xs font-bold text-white group-hover:text-amber-400 truncate">{{ $rec->name }}</h4>
                        <span class="text-xs font-black text-amber-400 mt-1 block">${{ number_format($rec->price, 2) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
