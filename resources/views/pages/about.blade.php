@extends('layouts.app')

@section('content')

<!-- Header Banner -->
<section class="relative py-20 overflow-hidden bg-slate-900/60 border-b border-slate-800/80">
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl space-y-4">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-panel border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-widest">
            <i class="fa-solid fa-crown"></i>
            <span>{{ __('Our Heritage & Distinction') }}</span>
        </div>
        <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight">
            {{ __('Defining The Future Of') }}
            <span class="block gold-gradient-text">{{ __('Digital Luxury') }}</span>
        </h1>
        <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-medium">
            {{ __('Founded on principles of extreme engineering precision and uncompromising aesthetic distinction, AURA brings aerospace-grade materials and handcrafted horology directly to connoisseurs worldwide.') }}
        </p>
    </div>
</section>

<!-- Stats Showcase -->
<section class="py-12 bg-slate-950 border-b border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
        <div class="p-6 rounded-2xl glass-panel border border-slate-800 space-y-1">
            <span class="text-3xl font-black gold-gradient-text">100%</span>
            <span class="block text-xs font-bold text-slate-300 uppercase tracking-wider">{{ __('Certified Authentic') }}</span>
            <span class="text-[10px] text-slate-400">{{ __('Grade 5 Titanium & 18k Gold') }}</span>
        </div>

        <div class="p-6 rounded-2xl glass-panel border border-slate-800 space-y-1">
            <span class="text-3xl font-black text-white">45+</span>
            <span class="block text-xs font-bold text-slate-300 uppercase tracking-wider">{{ __('Countries Served') }}</span>
            <span class="text-[10px] text-slate-400">{{ __('Insured VIP Air Concierge') }}</span>
        </div>

        <div class="p-6 rounded-2xl glass-panel border border-slate-800 space-y-1">
            <span class="text-3xl font-black gold-gradient-text">5-Year</span>
            <span class="block text-xs font-bold text-slate-300 uppercase tracking-wider">{{ __('Global Warranty') }}</span>
            <span class="text-[10px] text-slate-400">{{ __('Full International Coverage') }}</span>
        </div>

        <div class="p-6 rounded-2xl glass-panel border border-slate-800 space-y-1">
            <span class="text-3xl font-black text-white">99.8%</span>
            <span class="block text-xs font-bold text-slate-300 uppercase tracking-wider">{{ __('Satisfaction Index') }}</span>
            <span class="text-[10px] text-slate-400">{{ __('Audited by Independent Connoisseurs') }}</span>
        </div>
    </div>
</section>

<!-- Craftsmanship Showcase Video Card -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl glass-panel p-8 md:p-12 overflow-hidden border border-amber-500/20 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">{{ __('Mastery & Atelier') }}</span>
                    <h2 class="text-3xl font-black text-white">{{ __('Bespoke Horology Meets Semiconductor Intelligence') }}</h2>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        {{ __('Every AURA piece undergoes over 300 hours of microscopic calibration, hand-polishing, and thermal testing to ensure flawless performance under extreme atmospheric conditions.') }}
                    </p>
                    
                    <div class="space-y-3 text-xs font-semibold text-slate-200">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-amber-400"></i>
                            <span>{{ __('Aerospace-Grade Grade 5 Titanium Forging') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-amber-400"></i>
                            <span>{{ __('Sapphire Crystal Glass with Anti-Reflective Coating') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-amber-400"></i>
                            <span>{{ __('Planar Magnetic Acoustic Drivers') }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=1000&auto=format&fit=crop" class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-slate-950/40 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center text-xl shadow-2xl gold-glow group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Interactive Heritage Timeline -->
<section class="py-20 bg-slate-900/40 border-t border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">{{ __('The Journey') }}</span>
            <h2 class="text-3xl font-black text-white mt-1">{{ __('Milestones Of Innovation') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-3 relative">
                <span class="text-xs font-black text-amber-400 uppercase tracking-widest">2018</span>
                <h4 class="text-base font-bold text-white">{{ __('Atelier Foundation') }}</h4>
                <p class="text-xs text-slate-400 leading-relaxed">{{ __('Established in Geneva and Riyadh with a vision to revolutionize high-end wearable technology.') }}</p>
            </div>

            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-3 relative">
                <span class="text-xs font-black text-amber-400 uppercase tracking-widest">2021</span>
                <h4 class="text-base font-bold text-white">{{ __('Titanium Breakthrough') }}</h4>
                <p class="text-xs text-slate-400 leading-relaxed">{{ __('Patented aerospace titanium forging technique for ultra-lightweight smart watches.') }}</p>
            </div>

            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-3 relative">
                <span class="text-xs font-black text-amber-400 uppercase tracking-widest">2024</span>
                <h4 class="text-base font-bold text-white">{{ __('Planar Acoustics') }}</h4>
                <p class="text-xs text-slate-400 leading-relaxed">{{ __('Launched Zenith Studio headphones featuring bespoke planar magnetic sound architecture.') }}</p>
            </div>

            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-3 relative">
                <span class="text-xs font-black text-amber-400 uppercase tracking-widest">2026</span>
                <h4 class="text-base font-bold text-white">{{ __('Global Concierge') }}</h4>
                <p class="text-xs text-slate-400 leading-relaxed">{{ __('Expanded private VIP showrooms across Riyadh, Dubai, London, and Paris.') }}</p>
            </div>
        </div>
    </div>
</section>

@endsection
