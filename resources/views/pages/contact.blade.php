@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">

    <!-- Header Section -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
        <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">{{ __('Client Concierge') }}</span>
        <h1 class="text-4xl font-black text-white">{{ __('We Are At Your Service') }}</h1>
        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-medium">
            {{ __('Have inquiries regarding a custom order, global shipping, or technical specifications? Contact our private concierge team.') }}
        </p>
    </div>

    <!-- Contact Form & Direct Concierge Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12" x-data="{ inquiryType: 'general' }">

        <!-- Form Column -->
        <div class="lg:col-span-7 p-8 rounded-3xl glass-panel border border-slate-800 space-y-6">
            <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-3">{{ __('Private Consultation Request') }}</h3>

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Inquiry Type Pills Selector -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-3">{{ __('Inquiry Category') }}</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <button type="button" @click="inquiryType = 'general'" :class="inquiryType === 'general' ? 'border-amber-500 bg-amber-500/10 text-amber-400' : 'border-slate-800 bg-slate-950 text-slate-400'" class="p-3 rounded-xl border text-xs font-bold text-center transition-all">
                            {{ __('General Concierge') }}
                        </button>
                        <button type="button" @click="inquiryType = 'bespoke'" :class="inquiryType === 'bespoke' ? 'border-amber-500 bg-amber-500/10 text-amber-400' : 'border-slate-800 bg-slate-950 text-slate-400'" class="p-3 rounded-xl border text-xs font-bold text-center transition-all">
                            {{ __('Bespoke Customization') }}
                        </button>
                        <button type="button" @click="inquiryType = 'vip'" :class="inquiryType === 'vip' ? 'border-amber-500 bg-amber-500/10 text-amber-400' : 'border-slate-800 bg-slate-950 text-slate-400'" class="p-3 rounded-xl border text-xs font-bold text-center transition-all">
                            {{ __('VIP Appointment') }}
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Your Name') }}</label>
                        <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Email Address') }}</label>
                        <input type="email" name="email" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Subject') }}</label>
                    <input type="text" name="subject" required value="{{ old('subject') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Message') }}</label>
                    <textarea name="message" rows="4" required placeholder="{{ __('Provide details of your inquiry...') }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-4 text-xs text-white outline-none focus:border-amber-500"></textarea>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl gold-button text-slate-950 font-black text-xs uppercase tracking-wider shadow-xl">
                    {{ __('Transmit Message') }}
                </button>
            </form>
        </div>

        <!-- Direct Concierge Details -->
        <div class="lg:col-span-5 space-y-6">
            <div class="p-8 rounded-3xl glass-panel border border-slate-800 space-y-6">
                <h3 class="text-base font-bold text-white border-b border-slate-800 pb-3">{{ __('Direct Concierge Contacts') }}</h3>

                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-950/60 border border-slate-800">
                        <i class="fa-solid fa-phone text-amber-400 text-lg"></i>
                        <div>
                            <span class="block text-xs font-bold text-white">{{ __('VIP Phone Hotline') }}</span>
                            <span class="text-xs text-slate-400 font-mono">+966 11 800 AURA (2872)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-950/60 border border-slate-800">
                        <i class="fa-solid fa-envelope text-amber-400 text-lg"></i>
                        <div>
                            <span class="block text-xs font-bold text-white">{{ __('Email Concierge') }}</span>
                            <span class="text-xs text-slate-400">concierge@aura-commerce.com</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-950/60 border border-slate-800">
                        <i class="fa-solid fa-shield-halved text-amber-400 text-lg"></i>
                        <div>
                            <span class="block text-xs font-bold text-white">{{ __('Encrypted Channel') }}</span>
                            <span class="text-[10px] text-slate-400">Pgp / 256-bit SSL Protection</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- VIP Showrooms Section -->
    <div class="pt-8 border-t border-slate-800">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">{{ __('Global Presence') }}</span>
            <h2 class="text-2xl font-black text-white mt-1">{{ __('Private VIP Showrooms') }}</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-2">
                <span class="text-xs font-extrabold text-amber-400 uppercase tracking-widest">Riyadh</span>
                <h4 class="text-sm font-bold text-white">Financial District, Tower A</h4>
                <p class="text-xs text-slate-400">King Fahd Road, Level 42</p>
            </div>

            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-2">
                <span class="text-xs font-extrabold text-amber-400 uppercase tracking-widest">Dubai</span>
                <h4 class="text-sm font-bold text-white">Fashion Avenue Atelier</h4>
                <p class="text-xs text-slate-400">Downtown Dubai VIP Lounge</p>
            </div>

            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-2">
                <span class="text-xs font-extrabold text-amber-400 uppercase tracking-widest">London</span>
                <h4 class="text-sm font-bold text-white">Mayfair Executive Suite</h4>
                <p class="text-xs text-slate-400">New Bond Street, W1S</p>
            </div>

            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-2">
                <span class="text-xs font-extrabold text-amber-400 uppercase tracking-widest">Paris</span>
                <h4 class="text-sm font-bold text-white">Place Vendôme</h4>
                <p class="text-xs text-slate-400">12 Place Vendôme, 75001</p>
            </div>
        </div>
    </div>

</div>

@endsection
