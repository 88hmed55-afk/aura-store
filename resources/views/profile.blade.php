@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <h1 class="text-3xl font-black text-white">{{ __('Profile & Settings') }}</h1>

    <div class="p-8 rounded-3xl glass-panel border border-slate-800 space-y-6">
        <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-4">{{ __('Personal Information') }}</h3>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Full Name') }}</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Email Address') }}</label>
                <input type="email" value="{{ $user->email }}" disabled class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-xs text-slate-500 cursor-not-allowed">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Phone Number') }}</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+966 50 000 0000" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-xs text-white outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">{{ __('Default Shipping Address') }}</label>
                <textarea name="address" rows="3" class="w-full bg-slate-950 border border-slate-700 rounded-xl p-4 text-xs text-white outline-none focus:border-amber-500">{{ old('address', $user->address) }}</textarea>
            </div>

            <button type="submit" class="px-6 py-3 rounded-xl gold-button text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg">
                {{ __('Update Profile') }}
            </button>
        </form>
    </div>
</div>

@endsection
