<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AURA') }} | {{ __('Luxury Digital Commerce') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN & Alpine.js CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        aura: {
                            gold: '#D97706',
                            amber: '#F59E0B',
                            lightgold: '#FBBF24',
                            darkbg: '#0B0F17',
                            darkcard: '#111827',
                            lightbg: '#F8FAFC',
                            lightcard: '#FFFFFF',
                        }
                    },
                    fontFamily: {
                        sans: ['{{ app()->getLocale() == "ar" ? "Cairo" : "Plus Jakarta Sans" }}', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }

        /* Typography & Direction Rules */
        html[dir="rtl"] {
            letter-spacing: 0 !important;
        }
        html[dir="rtl"] body {
            line-height: 1.75;
        }

        /* Dark Theme CSS Tokens */
        html.dark body {
            background-color: #0B0F17;
            color: #F3F4F6;
        }
        html.dark .glass-panel {
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        html.dark .site-footer {
            background-color: #05070B;
            border-top-color: rgba(255, 255, 255, 0.08);
        }
        html.dark input, html.dark select, html.dark textarea {
            background-color: #030712 !important;
            color: #FFFFFF !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }

        /* Light Theme High Contrast CSS Overrides */
        html.light body {
            background-color: #F8FAFC;
            color: #0F172A;
        }
        html.light .glass-panel {
            background: #FFFFFF !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid #E2E8F0 !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }
        html.light .site-footer {
            background-color: #0F172A;
            color: #94A3B8;
        }
        html.light .text-white {
            color: #0F172A !important;
        }
        html.light .text-slate-300, html.light .text-slate-400 {
            color: #334155 !important;
        }
        html.light .bg-slate-900, html.light .bg-slate-950 {
            background-color: #FFFFFF !important;
        }
        html.light .bg-slate-900\/60, html.light .bg-slate-900\/80, html.light .bg-slate-900\/50, html.light .bg-slate-900\/40 {
            background-color: #FFFFFF !important;
            border-color: #E2E8F0 !important;
        }
        html.light input, html.light select, html.light textarea {
            background-color: #F8FAFC !important;
            color: #0F172A !important;
            border-color: #CBD5E1 !important;
        }

        /* Button Visibility Overrides for Both Themes */
        .gold-button {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%) !important;
            color: #0F172A !important;
            font-weight: 800 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gold-button *, .gold-button span, .gold-button i {
            color: #0F172A !important;
        }

        html.light .gold-button, html.light .bg-amber-500 {
            background-color: #F59E0B !important;
            color: #0F172A !important;
        }
        html.light .gold-button *, html.light .bg-amber-500 * {
            color: #0F172A !important;
        }
        html.light .bg-rose-500, html.light .bg-rose-600 {
            background-color: #E11D48 !important;
            color: #FFFFFF !important;
        }
        html.light .bg-rose-500 *, html.light .bg-rose-600 * {
            color: #FFFFFF !important;
        }
        html.light .bg-emerald-500 {
            background-color: #10B981 !important;
            color: #FFFFFF !important;
        }

        .gold-glow {
            box-shadow: 0 0 25px rgba(217, 119, 6, 0.3);
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 50%, #B45309 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0B0F17;
        }
        ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #D97706;
        }
    </style>
</head>
<body x-data="auraApp()" x-init="initTheme()" class="min-h-screen flex flex-col font-sans transition-colors duration-300 antialiased selection:bg-amber-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-amber-600 via-yellow-600 to-amber-700 text-white text-xs font-semibold py-2.5 px-4 text-center tracking-wide flex justify-between items-center z-50 shadow-md">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-crown text-yellow-200 animate-pulse"></i>
                {{ __('AURA Luxury Collection | Use code AURA20 for 20% OFF') }}
            </span>
            <span class="hidden sm:inline-flex items-center gap-1 font-mono text-[11px] text-yellow-100">
                <i class="fa-solid fa-shield-halved"></i>
                {{ __('100% Certified Original') }}
            </span>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 glass-panel border-b transition-all duration-300 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 via-amber-600 to-amber-800 flex items-center justify-center text-slate-950 font-black text-xl shadow-lg gold-glow group-hover:scale-105 transition-transform duration-300">
                    A
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-wider gold-gradient-text">{{ __('AURA') }}</span>
                    <span class="text-[9px] uppercase tracking-widest text-slate-400 font-semibold -mt-1">{{ __('Digital Commerce') }}</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="{{ route('home') }}" class="transition-colors hover:text-amber-500 {{ request()->routeIs('home') ? 'text-amber-500 font-bold' : 'text-slate-300' }}">{{ __('Home') }}</a>
                <a href="{{ route('products.index') }}" class="transition-colors hover:text-amber-500 {{ request()->routeIs('products.*') ? 'text-amber-500 font-bold' : 'text-slate-300' }}">{{ __('Catalog') }}</a>
                <a href="{{ route('about') }}" class="transition-colors hover:text-amber-500 {{ request()->routeIs('about') ? 'text-amber-500 font-bold' : 'text-slate-300' }}">{{ __('About') }}</a>
                <a href="{{ route('contact') }}" class="transition-colors hover:text-amber-500 {{ request()->routeIs('contact') ? 'text-amber-500 font-bold' : 'text-slate-300' }}">{{ __('Contact') }}</a>
                <a href="{{ route('faq') }}" class="transition-colors hover:text-amber-500 {{ request()->routeIs('faq') ? 'text-amber-500 font-bold' : 'text-slate-300' }}">{{ __('FAQ') }}</a>
            </nav>

            <!-- Header Action Controls -->
            <div class="flex items-center gap-3">
                
                <!-- Quick Search Input Trigger -->
                <a href="{{ route('products.index') }}" class="p-2.5 text-slate-300 hover:text-amber-400 hover:bg-slate-800/50 rounded-xl transition-all flex items-center gap-1.5 text-xs font-semibold" title="{{ __('Search Products') }}">
                    <i class="fa-solid fa-magnifying-glass text-base"></i>
                    <span class="hidden xl:inline">{{ __('Search') }}</span>
                </a>

                <!-- PROMINENT Theme Switcher Button -->
                <button @click="toggleTheme()" class="px-3 py-2 text-slate-300 hover:text-amber-400 border border-slate-700/80 hover:border-amber-500 rounded-xl transition-all flex items-center gap-2 bg-slate-900/60 shadow-sm" title="{{ __('Toggle Mode') }}">
                    <template x-if="isDark">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-solid fa-sun text-yellow-400 text-sm"></i>
                            <span class="text-xs font-bold text-slate-200">{{ __('Light Mode') }}</span>
                        </div>
                    </template>
                    <template x-if="!isDark">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-solid fa-moon text-indigo-500 text-sm"></i>
                            <span class="text-xs font-bold text-slate-700">{{ __('Dark Mode') }}</span>
                        </div>
                    </template>
                </button>

                <!-- Wishlist Button -->
                <a href="{{ route('wishlist.index') }}" class="relative p-2.5 text-slate-300 hover:text-amber-400 hover:bg-slate-800/50 rounded-xl transition-all flex items-center gap-1.5 text-xs font-semibold" title="{{ __('Wishlist') }}">
                    <i class="fa-solid fa-heart text-base text-rose-400"></i>
                    <span class="hidden xl:inline">{{ __('Wishlist') }}</span>
                    @auth
                        @if(Auth::user()->wishlists()->count() > 0)
                            <span class="bg-amber-500 text-slate-950 font-bold text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
                                {{ Auth::user()->wishlists()->count() }}
                            </span>
                        @endif
                    @endauth
                </a>

                <!-- Cart Drawer Trigger Button -->
                <button @click="cartOpen = true" class="relative p-2.5 text-slate-300 hover:text-amber-400 hover:bg-slate-800/50 rounded-xl transition-all flex items-center gap-2 text-xs font-semibold">
                    <i class="fa-solid fa-bag-shopping text-base text-amber-500"></i>
                    <span class="hidden sm:inline font-bold">{{ __('Shopping Bag') }}</span>
                    <span class="bg-amber-500 text-slate-950 font-extrabold text-[11px] px-2 py-0.5 rounded-full">
                        {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                    </span>
                </button>

                <!-- PROMINENT Language Switcher Button -->
                <a href="{{ route('lang.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="px-3.5 py-2 rounded-xl border border-amber-500/40 hover:border-amber-500 text-amber-400 hover:bg-amber-500/10 text-xs font-extrabold transition-all flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-globe text-sm"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}</span>
                </a>

                <!-- Auth Navigation User Dropdown or Sign In -->
                <div class="relative" x-data="{ open: false }">
                    @auth
                        <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-xl border border-amber-500/30 hover:border-amber-500 transition-all bg-slate-800/40">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                        </button>
                        
                        <div x-show="open" @click.outside="open = false" x-cloak class="absolute {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-56 glass-panel rounded-2xl shadow-2xl py-2 z-50 border border-slate-700/80">
                            <div class="px-4 py-2 border-b border-slate-700/50">
                                <p class="text-xs text-slate-400 font-medium">{{ __('Signed in as') }}</p>
                                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            </div>

                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-amber-400 hover:bg-amber-500/10 transition-colors">
                                    <i class="fa-solid fa-gauge-high"></i>
                                    <span>{{ __('Admin Dashboard') }}</span>
                                </a>
                            @endif

                            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-slate-800/60 transition-colors">
                                <i class="fa-solid fa-user"></i>
                                <span>{{ __('Profile & Account') }}</span>
                            </a>

                            <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-slate-800/60 transition-colors">
                                <i class="fa-solid fa-box"></i>
                                <span>{{ __('My Orders') }}</span>
                            </a>

                            <div class="border-t border-slate-700/50 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition-colors text-left rtl:text-right">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>{{ __('Sign Out') }}</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold gold-button rounded-xl shadow-md transition-all">
                            <i class="fa-solid fa-user"></i>
                            <span>{{ __('Sign In') }}</span>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-semibold flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm font-semibold flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Cart Slide-Over Drawer -->
    <div x-show="cartOpen" class="fixed inset-0 z-50 overflow-hidden" x-cloak>
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" @click="cartOpen = false"></div>
        <div class="fixed inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} max-w-full flex">
            <div class="w-screen max-w-md glass-panel bg-slate-900 border-l border-slate-800 text-slate-100 flex flex-col shadow-2xl">
                
                <!-- Drawer Header -->
                <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bag-shopping text-xl text-amber-500"></i>
                        <h2 class="text-lg font-bold text-white">{{ __('Your Shopping Bag') }}</h2>
                    </div>
                    <button @click="cartOpen = false" class="p-2 text-slate-400 hover:text-white rounded-lg">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Drawer Body / Item List -->
                <div class="flex-grow p-6 overflow-y-auto space-y-4">
                    @forelse(session('cart', []) as $id => $item)
                        <div class="p-4 rounded-2xl bg-slate-800/40 border border-slate-700/50 flex gap-4 items-center">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 rounded-xl object-cover border border-slate-700">
                            <div class="flex-grow">
                                <h4 class="text-sm font-bold text-white truncate">{{ $item['name'] }}</h4>
                                <p class="text-xs text-amber-400 font-bold mt-1">${{ number_format($item['price'], 2) }}</p>
                                
                                <div class="flex items-center gap-3 mt-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center border border-slate-700 rounded-lg overflow-hidden">
                                        @csrf
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-2 py-0.5 bg-slate-800 hover:bg-slate-700 text-xs text-white">-</button>
                                        <span class="px-3 py-0.5 text-xs font-bold text-white">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-2 py-0.5 bg-slate-800 hover:bg-slate-700 text-xs text-white">+</button>
                                    </form>

                                    <!-- Dedicated Clear Delete Product Button -->
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white text-xs font-bold flex items-center gap-1.5 transition-all">
                                            <i class="fa-solid fa-trash-can"></i>
                                            <span>{{ __('Remove') }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-400">
                            <i class="fa-solid fa-bag-shopping text-4xl mb-3 text-slate-600"></i>
                            <p class="text-sm font-semibold">{{ __('Your cart is currently empty.') }}</p>
                            <a href="{{ route('products.index') }}" @click="cartOpen = false" class="mt-4 inline-block px-5 py-2.5 rounded-xl gold-button text-slate-950 text-xs font-extrabold">
                                {{ __('Explore Collection') }}
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Drawer Footer -->
                @if(count(session('cart', [])) > 0)
                    <div class="p-6 border-t border-slate-800 bg-slate-950/60 space-y-4">
                        <div class="flex justify-between items-center text-sm font-bold">
                            <span class="text-slate-400">{{ __('Subtotal') }}</span>
                            <span class="text-white text-lg font-extrabold">${{ number_format(array_reduce(session('cart', []), fn($c, $i) => $c + ($i['price'] * $i['quantity']), 0), 2) }}</span>
                        </div>

                        <a href="{{ route('cart.index') }}" class="w-full block py-3 rounded-xl border border-amber-500/50 hover:bg-amber-500/10 text-center text-xs font-bold text-amber-400 transition-all">
                            {{ __('View Detailed Cart') }}
                        </a>

                        <a href="{{ route('checkout.index') }}" class="w-full block py-3 rounded-xl gold-button text-center text-xs font-extrabold text-slate-950 uppercase tracking-wider">
                            {{ __('Proceed to Checkout') }}
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Luxury Footer -->
    <footer class="site-footer text-slate-400 py-16 mt-20 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-amber-700 flex items-center justify-center text-slate-950 font-black text-lg">
                        A
                    </div>
                    <span class="text-xl font-black tracking-widest gold-gradient-text">{{ __('AURA') }}</span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    {{ __('Pioneering digital commerce with bespoke luxury, ultra-precision engineering, and unparalleled customer satisfaction.') }}
                </p>
            </div>

            <div>
                <h4 class="text-xs uppercase font-extrabold tracking-widest text-slate-200 mb-4">{{ __('Quick Links') }}</h4>
                <ul class="space-y-2 text-xs font-medium">
                    <li><a href="{{ route('products.index') }}" class="hover:text-amber-400 transition-colors">{{ __('All Products') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">{{ __('About AURA') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-amber-400 transition-colors">{{ __('Contact Support') }}</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-amber-400 transition-colors">{{ __('Help & FAQ') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs uppercase font-extrabold tracking-widest text-slate-200 mb-4">{{ __('Customer Care') }}</h4>
                <ul class="space-y-2 text-xs font-medium">
                    <li><a href="{{ route('orders.index') }}" class="hover:text-amber-400 transition-colors">{{ __('Order Tracking') }}</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="hover:text-amber-400 transition-colors">{{ __('Saved Wishlist') }}</a></li>
                    <li><a href="#" class="hover:text-amber-400 transition-colors">{{ __('Warranty & Guarantee') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs uppercase font-extrabold tracking-widest text-slate-200 mb-4">{{ __('Security & Payment') }}</h4>
                <p class="text-xs text-slate-400 mb-4">{{ __('Protected by 256-Bit SSL Encryption.') }}</p>
                <div class="flex items-center gap-3 text-xl text-slate-400">
                    <i class="fa-brands fa-cc-visa hover:text-white"></i>
                    <i class="fa-brands fa-cc-mastercard hover:text-white"></i>
                    <i class="fa-brands fa-cc-apple-pay hover:text-white"></i>
                    <i class="fa-solid fa-money-bill-wave hover:text-white"></i>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 mt-12 pt-8 border-t border-slate-800/40 flex flex-col md:flex-row justify-between items-center text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} {{ __('AURA') }} {{ __('Digital Commerce') }}. {{ __('All Rights Reserved.') }}</p>
            <p class="mt-2 md:mt-0 font-semibold text-amber-500/80">{{ __('Designed & Engineered with Distinction.') }}</p>
        </div>
    </footer>

    <!-- Theme & Cart Alpine Script -->
    <script>
        function auraApp() {
            return {
                isDark: localStorage.getItem('theme') !== 'light',
                cartOpen: false,

                initTheme() {
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                        document.documentElement.classList.remove('light');
                    } else {
                        document.documentElement.classList.add('light');
                        document.documentElement.classList.remove('dark');
                    }
                },

                toggleTheme() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                    this.initTheme();
                }
            }
        }
    </script>
</body>
</html>
