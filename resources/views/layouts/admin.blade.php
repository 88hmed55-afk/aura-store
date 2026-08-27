<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AURA Admin | {{ __('Control Panel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        aura: {
                            gold: '#D97706',
                            darkbg: '#0B0F17',
                            darkcard: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['{{ app()->getLocale() == "ar" ? "Cairo" : "Plus Jakarta Sans" }}', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body x-data="{ isDark: localStorage.getItem('theme') !== 'light' }" x-init="if (isDark) { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark'); document.documentElement.classList.add('light'); }" class="bg-aura-darkbg text-slate-100 min-h-screen flex antialiased">

    <!-- Admin Sidebar -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col flex-shrink-0 min-h-screen">
        <div class="p-6 border-b border-slate-800 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-amber-700 flex items-center justify-center text-slate-950 font-black text-lg shadow-lg">
                A
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-black tracking-wider text-amber-500">{{ __('AURA') }}</span>
                <span class="text-[9px] uppercase tracking-widest text-slate-400 font-bold -mt-1">{{ __('Control Panel') }}</span>
            </div>
        </div>

        <nav class="flex-grow p-4 space-y-1 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 font-extrabold shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="fa-solid fa-gauge-high"></i>
                <span>{{ __('Overview') }}</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-slate-950 font-extrabold shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="fa-solid fa-box-open"></i>
                <span>{{ __('Products') }}</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-amber-500 text-slate-950 font-extrabold shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="fa-solid fa-layer-group"></i>
                <span>{{ __('Categories') }}</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-amber-500 text-slate-950 font-extrabold shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="fa-solid fa-receipt"></i>
                <span>{{ __('Orders') }}</span>
            </a>

            <a href="{{ route('admin.coupons.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.coupons.*') ? 'bg-amber-500 text-slate-950 font-extrabold shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="fa-solid fa-ticket"></i>
                <span>{{ __('Coupons') }}</span>
            </a>

            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-500 text-slate-950 font-extrabold shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="fa-solid fa-star"></i>
                <span>{{ __('Reviews') }}</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-amber-400 text-sm font-semibold transition-all">
                <i class="fa-solid fa-store"></i>
                <span>{{ __('Back to Storefront') }}</span>
            </a>
        </div>
    </aside>

    <!-- Admin Main Body -->
    <div class="flex-grow flex flex-col min-w-0">
        <header class="bg-slate-900/50 border-b border-slate-800 h-20 px-8 flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">@yield('title', __('Admin Dashboard'))</h1>

            <div class="flex items-center gap-4">
                
                <!-- Theme Toggle Button -->
                <button @click="isDark = !isDark; localStorage.setItem('theme', isDark ? 'dark' : 'light'); location.reload();" class="p-2.5 rounded-xl border border-slate-700 hover:border-amber-500 text-slate-300">
                    <i class="fa-solid" :class="isDark ? 'fa-sun text-yellow-400' : 'fa-moon text-indigo-400'"></i>
                </button>

                <!-- Language Switcher Pill -->
                <a href="{{ route('lang.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="px-3 py-1.5 rounded-xl border border-amber-500/40 hover:border-amber-500 text-amber-400 text-xs font-bold flex items-center gap-2">
                    <i class="fa-solid fa-globe"></i>
                    <span>{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}</span>
                </a>

                <div class="flex items-center gap-3 pl-2 border-l border-slate-800">
                    <div class="w-9 h-9 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-400 flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-bold text-slate-200">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        <main class="p-8 flex-grow">
            @if(session('success'))
                <div class="p-4 mb-6 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-semibold flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
