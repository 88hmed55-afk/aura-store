@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto px-4 py-16">
    <div class="p-8 rounded-3xl glass-panel border border-slate-800 space-y-6">
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-black text-white">{{ __('Create Account') }}</h1>
            <p class="text-xs text-slate-400">{{ __('Join AURA for bespoke privileges') }}</p>
        </div>

        @if($errors->any())
            <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Full Name') }}</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Email Address') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Password') }}</label>
                <input type="password" name="password" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Confirm Password') }}</label>
                <input type="password" name="password_confirmation" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl gold-button text-slate-950 font-black text-xs uppercase tracking-wider shadow-xl">
                {{ __('Create Account') }}
            </button>
        </form>

        <div class="pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-amber-400 font-bold hover:underline ml-1">{{ __('Sign In') }}</a>
        </div>
    </div>
</div>

@endsection
